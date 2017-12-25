
接口表:
```

	CREATE TABLE `sos_api_accept_log` (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `request_url` varchar(150) DEFAULT '' COMMENT '请求路径',
	  `request_param` text COMMENT '请求参数',
	  `response_param` text COMMENT '返回参数',
	  `createtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
	  `info` text COMMENT '详细报文信息',
	  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT 'ip',
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM AUTO_INCREMENT=3317 DEFAULT CHARSET=utf8 COMMENT='客户端请求服务api记录表';



	CREATE TABLE `sos_api_push_log` (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `sender` text NOT NULL COMMENT '推送内容',
	  `text` text NOT NULL COMMENT '请求service',
	  `createtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
	  `return_info` text NOT NULL COMMENT '返回消息',
	  `user_id` text NOT NULL COMMENT '保存推送的用户id，以，进行拆分；最后要加上，',
	  `registration_id` text NOT NULL COMMENT '推送设备id,以text保存',
	  `send_port` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:极光，2：友盟',
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='推送记录';




```

