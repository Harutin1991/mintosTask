<?php
namespace controller;

use system\Controller;
use system\Session;
use libraries\Redirect;
use libraries\RSSReader;
use model\RssFeedsModel;
use model\RssModel;

class HomeController extends Controller {

    function __construct() {
        parent::__construct();
	  if(!Session::get('isLogedin')) 
		Redirect::redirectTo (URL);
    }

    public function index() {
	  $rssObj = RSSReader::loadAtom(RSS_PATH);
	  $rssInfo = [
		'name'=>$rssObj->id,
		'title'=>$rssObj->title,
		'self_link'=>$rssObj->link[0]->href,
		'alternate_link'=>$rssObj->link[1]->href,
		'rights'=>$rssObj->rights,
		'author_name'=>$rssObj->author->name,
		'author_email'=>$rssObj->author->email,
		'uri'=>$rssObj->author->uri,
		'icon'=>$rssObj->icon,
		'subtitle'=>$rssObj->subtitle,
		'logo'=>$rssObj->logo,
		'updated'=> strtotime($rssObj->updated)
	  ];
	  $rssModel = new RssModel();
	  $rssModel->loadData($rssInfo, FALSE);
	  if($feedId = $rssModel->save(true)){
		foreach($rssObj->entry as $feedInfo) {
		    $rssFeeds = [
			  'title'=>$feedInfo->title,
			  'author_name'=>$feedInfo->author->name,
			  'uri'=>$feedInfo->author->uri,
			  'link'=>$feedInfo->link->href,
			  'feed_id'=>$feedId,
			  'entry_id'=>$feedInfo->id,
			  'uri'=>$rssObj->author->uri,
			  'summary'=>$rssObj->summary,
			  'updated'=> strtotime($rssObj->timestamp)
		    ];
		    print_r($rssFeeds);die;
		    $rssFeedModel = new RssFeedsModel();
		    $rssFeedModel->loadData($rssFeeds, FALSE);
		    $rssFeedModel->save();
		}
	  }
        $this->view->title = "This is home page";
        $this->view->render('home/index');
    }
    
    public function feedInfo() {
	  $this->view->render('home/feed');
    }
}