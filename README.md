
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


```

