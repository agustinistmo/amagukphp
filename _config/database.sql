CREATE TABLE `mgk_tipo_usuario` (
  `tipo_usuario_id` int(10) unsigned NOT NULL auto_increment,
  `tipo_usuario_nombre` varchar(50) NOT NULL,
  `descripcion` varchar(250) default NULL,
  PRIMARY KEY  (`tipo_usuario_id`),
  UNIQUE KEY `tipo_usuario_nombre` (`tipo_usuario_nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


/*!40000 ALTER TABLE `mgk_tipo_usuario` DISABLE KEYS */;
INSERT INTO `mgk_tipo_usuario` (`tipo_usuario_id`,`tipo_usuario_nombre`,`descripcion`) VALUES 
 (1,'super','Super usuario'),
 (2,'admin','Administrador por modulos'),
 (3,'Usuario','usuario final');
/*!40000 ALTER TABLE `mgk_tipo_usuario` ENABLE KEYS */;



CREATE TABLE `mgk_usuario` (
  `usuario_id` int(10) unsigned NOT NULL auto_increment,
  `usuario_email` varchar(150) NOT NULL,
  `usuario_password` varchar(50) NOT NULL,
  `tipo_usuario_id` int(10) unsigned NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `token` varchar(20) NOT NULL default '0',
  `fecha_inserta` datetime NOT NULL,
  `fecha_inicio` date default NULL,
  `fecha_elimina` datetime default NULL,
  `usuario_id_inserta` int(10) unsigned NOT NULL,
  `usuario_id_actualiza` int(10) unsigned NOT NULL,
  `fecha_actualiza` datetime NOT NULL,
  `comentarios` text NOT NULL,
  PRIMARY KEY  (`usuario_id`),
  UNIQUE KEY `usuario_email` (`usuario_email`),
  KEY `tipo_usuario_id` (`tipo_usuario_id`),
  CONSTRAINT `FK_mgk_usuario_1` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `mgk_tipo_usuario` (`tipo_usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `mgk_usuario` DISABLE KEYS */;
INSERT INTO `mgk_usuario` (`usuario_id`,`usuario_email`,`usuario_password`,`tipo_usuario_id`,`nombre`,`token`,`fecha_inserta`,`fecha_inicio`,`fecha_elimina`,`usuario_id_inserta`,`usuario_id_actualiza`,`fecha_actualiza`,`comentarios`) VALUES 
 (1,'admin@localhost','21232f297a57a5a743894a0e4a801fc3',1,'Administrador','0','2013-12-10 00:00:00','2013-12-10',NULL,1,1,'2013-12-10 00:00:00','usuario creado por default');
/*!40000 ALTER TABLE `mgk_usuario` ENABLE KEYS */;



CREATE TABLE `mgk_historia_acceso` (
  `historia_id` int(10) unsigned NOT NULL auto_increment,
  `usuario_id` int(10) unsigned NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_salida` datetime default NULL,
  `direccion_id` varchar(15) NOT NULL,
  `latitud` varchar(18) default NULL,
  `longitud` varchar(18) default NULL,
  PRIMARY KEY  (`historia_id`),
  KEY `usuario_id` (`usuario_id`),
  CONSTRAINT `mgk_historia_acceso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `mgk_usuario` (`usuario_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;