<?php

// 用户类
class Site_user
{
    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    // 用户登录
    public function user_login()
    {

    }

    // 用户注册
    public function user_register()
    {

    }

    // 获取用户信息
    public function user_info()
    {
        $wherearr = "select * from t_user";
        $user_info = $this->user_model->get_user($wherearr);
        return $user_info;
    }
}
