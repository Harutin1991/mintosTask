<?php
/**
* Class RSSReader
* Allowed to convert Atom to Object
*  
*/
namespace libraries;

use libraries\FeedException;
use SimpleXMLElement;

class RSSReader {
    /** @var string */
    public static $cacheExpire = '1 day';
    
    /** @var string */
    public static $cacheDir;
    
    /** @var SimpleXMLElement */
    protected $xml;
    
    /**
     * Loads Atom feed.
     * @param  string  Atom feed URL
     * @param  string  optional user name
     * @param  string  optional password
     * @return Feed
     * @throws FeedException
     */
    public static function loadAtom($url, $user = null, $pass = null) {
	  return self::fromAtom(self::loadXml($url, $user, $pass));
    }
    
    private static function fromAtom(SimpleXMLElement $xml) {
	  if (!in_array('http://www.w3.org/2005/Atom', $xml->getDocNamespaces(), true) && !in_array('http://purl.org/atom/ns#', $xml->getDocNamespaces(), true)
	  ) {
		throw new FeedException('Invalid feed.');
	  }

	  // generate 'timestamp' tag
	  foreach ($xml->entry as $entry) {
		$entry->timestamp = strtotime($entry->updated);
	  }
	  $feed = new self;
	  $feed->xml = $xml;
	  return $feed;
    }
    
    /**
     * Converts a SimpleXMLElement into an array.
     * @param  SimpleXMLElement
     * @return array
     */
    public static function toArray(SimpleXMLElement $xml = null) {
	  if ($xml === null) {
		$xml = $this->xml;
	  }

	  if (!$xml->children()) {
		return (string) $xml;
	  }

	  $arr = [];
	  foreach ($xml->children() as $tag => $child) {
		if (count($xml->$tag) === 1) {
		    $arr[$tag] = $this->toArray($child);
		} else {
		    $arr[$tag][] = $this->toArray($child);
		}
	  }

	  return $arr;
    }
    
    /**
     * Load XML from cache or HTTP.
     * @param  string
     * @param  string
     * @param  string
     * @return SimpleXMLElement
     * @throws FeedException
     */
    private static function loadXml($url, $user, $pass) {
	  $e = self::$cacheExpire;
	  $cacheFile = self::$cacheDir . '/feed.' . md5(serialize(func_get_args())) . '.xml';

	  if (self::$cacheDir && (time() - @filemtime($cacheFile) <= (strtotime($e) - time())) && $data = @file_get_contents($cacheFile)
	  ) {
		// ok
	  } elseif ($data = trim(self::httpRequest($url, $user, $pass))) {
		if (self::$cacheDir) {
		    file_put_contents($cacheFile, $data);
		}
	  } elseif (self::$cacheDir && $data = @file_get_contents($cacheFile)) {
		// ok
	  } else {
		throw new FeedException('Cannot load feed.');
	  }

	  return new SimpleXMLElement($data, LIBXML_NOWARNING | LIBXML_NOERROR);
    }
    
    /**
     * Process HTTP request.
     * @param  string
     * @param  string
     * @param  string
     * @return string|false
     * @throws FeedException
     */
    private static function httpRequest($url, $user, $pass) {
	  if (extension_loaded('curl')) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		if ($user !== null || $pass !== null) {
		    curl_setopt($curl, CURLOPT_USERPWD, "$user:$pass");
		}
		$user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36";
		curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); // some feeds require a user agent
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_TIMEOUT, 20);
		curl_setopt($curl, CURLOPT_ENCODING, '');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // no echo, just return result
		if (!ini_get('open_basedir')) {
		    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // sometime is useful :)
		}
		$result = curl_exec($curl);
		return curl_errno($curl) === 0 && curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200 ? $result : false;
	  } else {
		$context = null;
		if ($user !== null && $pass !== null) {
		    $options = [
			  'http' => [
				'method' => 'GET',
				'header' => 'Authorization: Basic ' . base64_encode($user . ':' . $pass) . "\r\n",
			  ],
		    ];
		    $context = stream_context_create($options);
		}

		return file_get_contents($url, false, $context);
	  }
    }
    
    /**
     * Returns property value. Do not call directly.
     * @param  string  tag name
     * @return SimpleXMLElement
     */
    public function __get($name) {
	  return $this->xml->{$name};
    }
}