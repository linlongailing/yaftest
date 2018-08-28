<?php
// 首页控制器
class IndexController extends Yaf_Controller_Abstract {

    // 登录页
	public function indexAction() {
	    $user=new site_user();
	    $user_info=$user->get_login_user();
	    if($user_info['status']==1){
	        $this->forward("Index","main");
        }
	    $this->getView()->assign("title",'首页');
	    return true;
	}

	// 注册页
    public function registerAction(){
        return true;
    }

    // 用户系统首页
    public function mainAction(){

    }
}
