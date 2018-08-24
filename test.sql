-- 测试数据库用
-- 需求:学生登录系统，没有账号的需要注册，学生登录系统，课程，每个课程对应一个授课老师，每个学生有对应总学分
-- 	 注册时需要选择学院，填写学号，用户名和密码
	
CREATE TABLE t_student(
  `student_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '自增ID',
  `student_uuid` varchar(200) NOT NULL COMMENT '学号',
  `student_name` varchar(200) NOT NULL DEFAULT '' COMMENT '姓名',
  `student_sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别：1女2男',
  `student_username` varchar(200) NOT NULL COMMENT '登录用户名',
  `student_password` varchar(200) NOT NULL COMMENT '登录密码',
  `student_college_id` int(11) NOT NULL COMMENT '交易类型 1签约 2投资 3回款',
  `student_addr` varchar(200) DEFAULT NULL COMMENT '学生地址',
  `student_score` int(11) NOT NULL DEFAULT 0 COMMENT '学分',
  `student_remark` varchar(500) NOT NULL DEFAULT '' COMMENT '个人签名',
  `student_addtime` datetime DEFAULT NULL COMMENT '添加时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '学生表';


CREATE TABLE t_college(
  `college_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '自增ID',
  `college_number` varchar(200) NOT NULL COMMENT '学院编号',
  `college_level` tinyint(4) NOT NULL DEFAULT 1 COMMENT '学院等级:1专科2',
  `college_name` varchar(200) NOT NULL COMMENT '学院名称',
  `college_tel` varchar(15) NOT NULL COMMENT '学院联系方式',
  `college_addr` varchar(200) NOT NULL COMMENT '学院地址',
  `college_student_num` int(11) NOT NULL DEFAULT 0 COMMENT '学生人数',
  `college_website` varchar(200) NOT NULL COMMENT '学院官网',
  `college_addtime` datetime DEFAULT NULL COMMENT '添加时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '学院表';


CREATE TABLE t_teacher(
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '自增ID',
  `college_id` int(11) NOT NULL COMMENT '学院ID',
  `teacher_name` varchar(200) NOT NULL COMMENT '姓名',
  `teacher_job_title` tinyint(4) NOT NULL DEFAULT 1 COMMENT '职称:1助教2讲师3副教授4教授',
  `teacher_sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别：1女2男',
  `teacher_age` tinyint(4) DEFAULT NULL COMMENT '年龄',
  `teacher_teach_age` int(11) NOT NULL COMMENT '教龄',
  `teacher_addtime` datetime DEFAULT NULL COMMENT '添加时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '教师表';


CREATE TABLE t_course(
  `course_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '自增ID',
  `college_id` int(11) NOT NULL COMMENT '学院ID',
  `teacher_id` int(11) NOT NULL COMMENT '教师ID',
  `course_number` varchar(200) NOT NULL COMMENT '教程编号',
  `course_name` varchar(200) NOT NULL COMMENT '名称',
  `course_desc` varchar(500) DEFAULT NULL COMMENT '课程简介',
  `course_credit` int(11) NOT NULL COMMENT '教程学分',
  `course_addtime` datetime DEFAULT NULL COMMENT '添加时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '课程表';


CREATE TABLE t_sc(
  `sc_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '自增ID',
  `student_id` int(11) NOT NULL COMMENT '学生ID',
  `course_id` int(11) NOT NULL COMMENT '课程ID',
  `sc_score` int(11) NOT NULL DEFAULT 0 COMMENT '成绩',
  `sc_addtime` datetime DEFAULT NULL COMMENT '选课时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '选课表';


CREATE TABLE t_user(
  `user_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '自增ID',
  `user_name` varchar(200) NOT NULL COMMENT '用户名',
  `user_password` varchar(200) NOT NULL COMMENT '密码',
  `user_group` tinyint(4) NOT NULL DEFAULT 1 COMMENT '用户组',
  `user_login_time` datetime DEFAULT NULL COMMENT '最近登录时间',
  `user_addtime` datetime DEFAULT NULL COMMENT '添加时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '用户表';


CREATE TABLE t_group(
  `group_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '自增ID',
  `group_name` varchar(200) NOT NULL COMMENT '组名',
  `group_permission` text DEFAULT NULL COMMENT '权限',
  `group_addtime` datetime DEFAULT NULL COMMENT '添加时间'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '用户组表';