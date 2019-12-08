<?php
namespace controller;

use system\Controller;
use system\Session;
use libraries\Redirect;
use libraries\RSSReader;
use model\RssFeedsModel;
use model\RssModel;
use libraries\Request;

class HomeController extends Controller {

    function __construct() {
        parent::__construct();
	  if(!Session::get('isLogedin')) 
		Redirect::redirectTo (URL);
    }

    /*
    * Home page
    * @return void 
    */
    public function index() {
	  $rssInfoModel = new RssModel(); // creating Rss Model object
	  $rssInfo = $rssInfoModel->getRssInfo(); // geting rss info from DB
	  $showData = [];
	  foreach($rssInfo as $info) {
		$showData[$info['feed_id']][] = $info;
	  }
	  $this->view->pushCSS([
		URL.'public/vendor/plugins/datatables/media/css/dataTables.bootstrap.css',
		URL.'public/vendor/plugins/datatables/media/css/dataTables.plugins.css',
	  ]); // adding CSS only for this view
	  
	  $this->view->pushJS([
		URL.'public/vendor/plugins/datatables/media/js/jquery.dataTables.js',
		URL.'public/vendor/plugins/datatables/media/js/dataTables.bootstrap.js',
	  ]); // adding JS only for this view
        $this->view->title = "This is home page"; // Page title
        $this->view->render('home/index',['data'=>$showData]);
    }
    
    /*
    * Stored RSS info into DB
    * @return void 
    */
    public function importXmlData() {
	  $request = new Request(); // creating Request object
	  if($request->isPost()){ // checking if request is post
		$rssUrl = $request->getPost('rssUrl'); // getting form input data
		if($rssUrl != '') {
		    $rssObj = RSSReader::loadAtom($rssUrl); // Converting Atom to Object
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
			  'updated'=> date('Y-m-d H:i:s',strtotime(RSSReader::toArray($rssObj->updated)))
		    ]; // creating array to store to DB

		    $rssModel = new RssModel();
		    $rssModel->loadData($rssInfo, false);
		    if($feedId = $rssModel->save(true)){
			  foreach($rssObj->entry as $feedInfo) {
				$rssFeeds = [
				    'title'=>$feedInfo->title,
				    'author_name'=>$feedInfo->author->name,
				    'uri'=>$feedInfo->author->uri,
				    'link'=>$feedInfo->link->href,
				    'feed_id'=>$feedId,
				    'entry_id'=>$feedInfo->id,
				    'uri'=>$feedInfo->author->uri,
				    'summary'=>$feedInfo->summary,
				    'updated'=> date('Y-m-d H:i:s',RSSReader::toArray($feedInfo->timestamp))
				];
				$rssFeedModel = new RssFeedsModel();
				$rssFeedModel->loadData($rssFeeds, FALSE);
				$rssFeedModel->save();
			  }
		    }
		    Redirect::redirectTo(URL.'home'); 
		} else {
		    Redirect::redirectTo(URL.'home'); 
		}
	  }
    }
    
    public function feedInfo() {
	  $this->view->render('home/feed');
    }
}