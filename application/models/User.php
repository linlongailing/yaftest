<?php
// 用户
class UserModel {
	public function __construct(){
		$config=Yaf_Application::app()->getConfig();
		$db_config=$config->db;
//		Yaf_loader::import("Db.php");
		$this->db=Db::getInstance($db_config);
	}

	// 添加用户
	public function add_user($where){
		$this->db->where($where);
		$user_id=$this->db->add();
		return $user_id;
	}

	// 修改用户
	public function update_user($where){
		$this->db->where($where);
		return $this->db->update();
	}

	// 删除用户
	public function delete_user($where){
		$this->db->where($where);
		return $this->db->delete();
	}

	// 获取用户
	public function get_user($where){
		$this->db->where($where);
		return $this->db->find();
	}

	// 获取用户列表
	public function get_user_arr($where){
		$this->db->where($where);
		return $this->db->select();
	}

	// 获取用户数
	public function get_user_num($where){
		$this->db->where($where);
		return $this->db->count();
	}
	
	// 用户是否存在
	public function user_is_exists($where){
		$this->db->where($where);
		return $this->db->count();
	}
}
