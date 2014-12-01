CREATE TABLE IF NOT EXISTS `codoforum_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) NOT NULL,
  `option_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='contains codoforum configuration' AUTO_INCREMENT=0 ;

INSERT INTO `codoforum_config` (`id`, `option_name`, `option_value`) VALUES
(1, 'client_id', 'CLIENT_ID'),
(2, 'secret', 'SSO_SECRET');
