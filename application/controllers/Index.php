<?php
// 首页控制器
class IndexController extends Yaf_Controller_Abstract {

    // 登录页
	public function indexAction() {
	    $this->getView()->assign("title",'首页');
	    return true;
	}

	// 注册页
    public function registerAction(){
        return true;
    }

    // 用户系统首页
    public function main(){

    }


}
