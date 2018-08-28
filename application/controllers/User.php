<?php

// 用户控制器
class UserController extends Yaf_Controller_Abstract
{
    // 登录页
    public function loginAction()
    {
        $username = $this->getRequest()->getPost("username", '');
        $password = $this->getRequest()->getPost("password", '');

        $user = new site_user();
        $login_res = $user->user_login($username, $password);
        if ($login_res['status'] == 1) {
            // 登录成功，进入系统
            $this->forward('Index','main');
        } else {
            // 登录失败页
            $this->forward('Error','error');
        }
    }

    // 注册页
    public function registerAction()
    {
        $username = $this->getRequest()->getPost("username", '');
        $password = $this->getRequest()->getPost("password", '');
        $confirm_password = $this->getRequest()->getPost("confirm_password", '');

        $user = new site_user();
        $register_res = $user->user_register($username, $password, $confirm_password);
        exit(json_encode($register_res));
    }

    // 用户登出
    public function logout()
    {
        $user = new site_user();
        $user_info = $user->get_login_user();
        if ($user_info['status'] != 1) {
            $this->forward('Index', 'index');
        }

        $register_res = $user->user_register();
        exit(json_encode($register_res));
    }
}
