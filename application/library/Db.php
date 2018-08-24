<?php

// 数据库操作类
class DB
{
    private $conn = null;
    private $where = "";

    // 构造函数
    private function __construct($db_host, $db_port, $db_user, $db_password, $db_name)
    {
        $this->conn = mysqli_connect($db_host, $db_user, $db_password, $db_name, $db_port);
        if (!$this->conn) {
            echo mysqli_connect_error();
            exit;
        }
    }

    // 获取数据库实例
    public static function getInstance($db_config)
    {
	if(empty($db_config)) return false;
        $db_host = $db_config['host'];
        $db_port = $db_config['port'];
        $db_user = $db_config['user'];
        $db_password = $db_config['password'];
        $db_name = $db_config['name'];

        $db = new self($db_host, $db_port, $db_user, $db_password, $db_name);
        return $db;
    }

    // where条件
    public function where($where)
    {
        $this->where=$where;
    }

    // 增加数据
    public function add()
    {
        $add_sql = $this->where;
        if (empty($add_sql)) return false;

        mysqli_query($this->conn, $add_sql);

        return mysqli_insert_id($this->conn);
    }

    // 删除数据
    public function delete()
    {
        $delete_sql = $this->where;
        if (empty($delete_sql)) return false;

        mysqli_query($this->conn, $delete_sql);

        return mysqli_affected_rows($this->conn);
    }

    // 更新数据
    public function update()
    {
        $update_sql = $this->where;
        if (empty($update_sql)) return false;

        mysqli_query($this->conn, $update_sql);

        return mysqli_affected_rows($this->conn);
    }

    // 查询
    public function select()
    {
        $select_sql = $this->where;
        if (empty($select_sql)) return false;

        $result = mysqli_query($this->conn, $select_sql);
        if (!$result) return false;

        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_free_result($result);

        return $res;
    }

    // 获取一行数据
    public function find(){
	$select_sql=$this->where;
	if(empty($select_sql)) return false;
	
	$result=mysqli_query($this->conn,$select_sql);
	if(!$result) return false;
	
	$res=mysqli_fetch_assoc($result);
	
	mysqli_free_result($result);
	
	return $res;
    }

    // 获取数量
    public function count()
    {
        $select_sql = $this->where;
        if (empty($select_sql)) return false;

        $result = mysqli_query($this->conn, $select_sql);
        if (!$result) return false;

        $count = mysqli_num_rows($result);

        mysqli_free_result($result);

        return $count;
    }

    // 开始事务
    public function start_commit()
    {
        return mysqli_autocommit($this->conn, FALSE);
    }

    // 提交事务
    public function commit()
    {
        return mysqli_commit($this->conn);
    }

    // 事务回滚
    public function rollback()
    {
        return mysqli_rollback($this->conn);
    }

    // 关闭数据库
    public function close()
    {
        mysqli_close($this->conn);
    }
}
