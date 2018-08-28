<?php

// 用户类
class Site_user
{
    public function __construct()
    {
        $this->user_model = new UserModel();
    }

    // 用户登录
    public function user_login($username, $password)
    {
        $redata = array('status' => -1, 'msg' => array("error" => "操作失败"), 'data' => array());

        $username = trim($username);
        $password = trim($password);

        if (empty($username)) {
            $redata['msg']['error'] = "用户名不能为空";
            return $redata;
        }
        if (!is_username($username)) {
            $redata['msg']['error'] = "用户名格式错误";
            return $redata;
        }
        if (empty($password)) {
            $redata['msg']['error'] = "密码不能为空";
            return $redata;
        }
        if (!is_passwd($password)) {
            $redata['msg']['error'] = "用户密码格式错误";
            return $redata;
        }

        $password = md5($password);
        $where_sql = "select * from t_user where user_name='{$username}' and user_password='{$password}'";
        $user_info = $this->user_model->get_user($where_sql);
        if (empty($user_info)) {
            $redata['msg']['error'] = "该用户不存在";
            return $redata;
        }

        // 设置session
        $session = Yaf_Session::getInstance();
        $session->set('user_id',$user_info['user_id']);

        // 设置用户登录时间
        $login_time=date('Y-m-d H:i:s');
        $update_sql = "update t_user set user_login_time = '{$login_time}' where user_name='{$username}'";
        $this->user_model->update_user($update_sql);

        $redata = array();
        $redata ["status"] = 1;
        $redata ["msg"] ["success"] = '登录成功';
        return $redata;
    }

    // 用户注册
    public function user_register($username, $password, $confirm_password)
    {
        $redata = array('status' => -1, 'msg' => array("error" => "操作失败"), 'data' => array());

        $username = trim($username);
        $password = trim($password);
        $confirm_password = trim($confirm_password);

        if (empty($username)) {
            $redata['msg']['error'] = "用户名不能为空";
            return $redata;
        }
        if (!is_username($username)) {
            $redata['msg']['error'] = "用户名格式错误";
            return $redata;
        }
        if (empty($password)) {
            $redata['msg']['error'] = "密码不能为空";
            return $redata;
        }
        if (!is_passwd($password)) {
            $redata['msg']['error'] = "密码格式错误";
            return $redata;
        }
        if (empty($confirm_password)) {
            $redata['msg']['error'] = "确认密码不能为空";
            return $redata;
        }
        if ($password != $confirm_password) {
            $redata['msg']['error'] = "密码和确认密码不相等";
            return $redata;
        }

        // 判断该用户名是否注册
        $where_sql = "select * from t_user where user_name='{$username}'";
        $user_exists = $this->user_model->user_is_exists($where_sql);
        if ($user_exists) {
            $redata['msg']['error'] = "该用户名已经被占用";
            return $redata;
        }

        $password = md5($password);
        $user_addtime = date('Y-m-d H:i:s');

        $insert_sql = "insert into t_user(user_name,user_password,user_addtime) values('{$username}','{$password}','{$user_addtime}')";
        $user_id = $this->user_model->add_user($insert_sql);
        if (!$user_id) {
            $redata['msg']['error'] = "用户注册失败";
            return $redata;
        }

        $redata = array();
        $redata ["status"] = 1;
        $redata ["msg"] ["success"] = '注册成功';
        return $redata;
    }

    // 登出
    public function user_logout($user_id)
    {
        $redata = array('status' => -1, 'msg' => array("error" => "操作失败"), 'data' => array());

        $user_id = intval($user_id);

        $where_sql = "select * from t_user where user_id={$user_id}";
        $user_info = $this->user_model->get_user($where_sql);
        if (empty($user_info)) {
            $redata['msg']['error'] = "该用户不存在";
            return $redata;
        }

        $session = Yaf_Session::getInstance();
        $session->__unset('user_id');

        $user_has=$session->has("user_id");
        if(!$user_has){
            $redata['msg']['error'] = "登出失败，请重试";
            return $redata;
        }

        $redata = array();
        $redata ["status"] = 1;
        $redata ["msg"] ["success"] = '登出成功';
        return $redata;
    }

    // 获取用户信息
    public function user_info($user_id)
    {
        $redata = array('status' => -1, 'msg' => array("error" => "操作失败"), 'data' => array());

        $user_id = intval($user_id);
        if (empty($user_id)) {
            $redata['msg']['error'] = "用户注册失败";
            return $redata;
        }

        $where_sql = "select * from t_user where user_id={$user_id}";
        $user_info = $this->user_model->get_user($where_sql);
        if (empty($user_info)) {
            $redata['msg']['error'] = "用户不存在";
            return $redata;
        }

        $redata = array();
        $redata ["status"] = 1;
        $redata['data'] = $user_info;
        $redata ["msg"] ["success"] = '注册成功';
        return $redata;
    }

    // 判断用户是否登录
    public function get_login_user()
    {
        $redata = array('status' => -1, 'msg' => array("error" => "操作失败"), 'data' => array());

        $session = Yaf_Session::getInstance();
        $user_id = $session->get('user_id');
        if (empty($user_id)) {
            $redata['msg']['error'] = "用户尚未登录";
            return $redata;
        }

        // 获取用户信息
        $where_sql = "select * from t_user where user_id={$user_id}";
        $user_info = $this->user_model->get_user($where_sql);
        if (empty($user_info)) {
            $redata['msg']['error'] = "用户不存在";
            return $redata;
        }

        $redata = array();
        $redata ["status"] = 1;
        $redata['data'] = $user_info;
        $redata ["msg"] ["success"] = '获取成功';
        return $redata;
    }
}
