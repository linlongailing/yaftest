<?php
// 首页控制器
class IndexController extends Yaf_Controller_Abstract {

	public function indexAction() {
	    $this->getView()->assign("title",'首页');
	    return true;
	}
}
