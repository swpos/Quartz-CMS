<?php 
	header('Content-Type: text/html; charset=utf-8');
	$username = (isset($_GET['username']) ? $_GET['username'] : ''); 
	$password = (isset($_GET['password']) ? $_GET['password'] : ''); 
	$email = (isset($_GET['email']) ? $_GET['email'] : ''); 
	$hash = (isset($_GET['hash']) ? $_GET['hash'] : ''); 
	$site = (isset($_GET['site']) ? $_GET['site'] : ''); 
?>

CREATE TABLE `cms_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `shortcut` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cms_comments` (`id`, `id_module`, `title`, `content`, `date`, `time`, `username`, `shortcut`) VALUES
(1,	115,	'Good Portfolio',	'<p>Abc abcdef abcdef ab abcde abcdefg abcdefghijkl abcdefg abcde abcdefgh. Abcd ab ab abcdefg abcdefghi abcd abcdef abcdef abcd. Abcde abcdefghijkl abcdef ab ab abcdefgh abcdef.</p>',	'0000-00-00',	'00:00:00',	'Mary',	'Resume'),
(2,	115,	'Awesome Design',	'<p>Abc abcdef abcdef ab abcde abcdefg abcdefghijkl abcdefg abcde abcdefgh. Abcd ab ab abcdefg abcdefghi abcd abcdef abcdef abcd. Abcde abcdefghijkl abcdef ab ab abcdefgh abcdef.</p>',	'0000-00-00',	'00:00:00',	'Roger',	'Resume');

CREATE TABLE `cms_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `states` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `daybirth` varchar(255) NOT NULL,
  `monthbirth` varchar(255) NOT NULL,
  `yearbirth` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `shortcut` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `cms_contact_config` (
  `id` int(1) NOT NULL,
  `users` varchar(255) NOT NULL,
  `send_email_admin` varchar(255) NOT NULL,
  `send_complete_mail` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cms_contact_config` (`id`, `users`, `send_email_admin`, `send_complete_mail`) VALUES
(1,	'',	'yes',	'yes');

CREATE TABLE `<?php echo $hash ?>_articles` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `modules` longtext NOT NULL,
  `shortcut` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `order1` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `publish` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_articles` (`id`, `title`, `username`, `category`, `modules`, `shortcut`, `date`, `time`, `order1`, `content`, `publish`) VALUES
(60,	'Contact Info',	'<?php echo $username ?>',	'Contact_Info',	'{article{::::}}',	'',	'0000-00-00',	'00:00:00',	'1',	'<div id=\\\"contact\\\">\r\n	<h2>Contact Informations</h2>\r\n	<div class=\\\"row\\\">\r\n		<div class=\\\"col-md-6\\\">\r\n			<div class=\\\"well\\\">\r\n				<p>Ab ab abc abcdefghi abcdefg ab abcd abcdefghi abcdef. Ab abcde abcde abcdefghi abcd abcdefg abc abcdef abc abcde. Ab abc abcdefghi abcdef abcdefgh. Abc abcdefg abcd abcde ab abcdef. Abcde abcde abc abcde. Abcde ab abcde abcdefgh abcdefgh abcde abcdef abcdefg abcde.</p>\r\n</div></div>\r\n				<div class=\\\"col-md-6\\\">\r\n			<div class=\\\"well\\\">\r\n				<p>Ab ab abc abcdefghi abcdefg ab abcd abcdefghi abcdef. Ab abcde abcde abcdefghi abcd abcdefg abc abcdef abc abcde. Ab abc abcdefghi abcdef abcdefgh. Abc abcdefg abcd abcde ab abcdef. Abcde abcde abc abcde. Abcde ab abcde abcdefgh abcdefgh abcde abcdef abcdefg abcde.</p>\r\n</div></div>\r\n	</div>\r\n</div>',	1),
(61,	'Resume',	'<?php echo $username ?>',	'Resume',	'{article{show_title:show_description:show_username:show_time:show_date}}',	'',	'0000-00-00',	'00:00:00',	'1',	'<div class=\\\"resume\\\" id=\\\"resume\\\">\r\n	<h1>Resume</h1>\r\n	<p>Ab ab abc abcdefghi abcdefg ab abcd abcdefghi abcdef. Ab abcde abcde abcdefghi abcd abcdefg abc abcdef abc abcde. Ab abc abcdefghi abcdef abcdefgh. Abc abcdefg abcd abcde ab abcdef. Abcde abcde abc abcde. Abcde ab abcde abcdefgh abcdefgh abcde abcdef abcdefg abcde. Abcd abcde abcde abcde ab abcdefg. Abcde abcdefgh abcd abcd a abcdef. Abcde abcdefghi abcdefghij abcde abcd abcdefg.</p>\r\n	<a href=\\\"Media/cv.pdf\\\" class=\\\"download-btn\\\">Resume</a>\r\n	<h2 class=\\\"title\\\">Experience</h2>\r\n	<div class=\\\"row experience\\\">\r\n		<div class=\\\"col-md-12\\\">\r\n			<div class=\\\"progress progress-striped\\\">\r\n			  <div class=\\\"progress-bar progress-bar-info\\\" style=\\\"width:90%;\\\">HTML (90%)</div>\r\n			</div>\r\n			<div class=\\\"progress progress-striped\\\">\r\n			  <div class=\\\"progress-bar progress-bar-info\\\" style=\\\"width:90%;\\\">CSS (90%)</div>\r\n			</div>\r\n			<div class=\\\"progress progress-striped\\\">\r\n			  <div class=\\\"progress-bar progress-bar-info\\\" style=\\\"width:85%;\\\">PHP (85%)</div>\r\n			</div>\r\n			<div class=\\\"progress progress-striped\\\">\r\n			  <div class=\\\"progress-bar progress-bar-info\\\" style=\\\"width:85%;\\\">JavaScript (85%)</div>\r\n			</div>\r\n		</div> \r\n	</div>\r\n</div>',	1),
(59,	'Presentation',	'<?php echo $username ?>',	'Presentation',	'{article{show_title:show_description:show_username:show_time:show_date}}',	'',	'0000-00-00',	'00:00:00',	'1',	'<div class=\\\"about\\\" id=\\\"about\\\">	\r\n	<div class=\\\"row\\\">\r\n		<div class=\\\"col-md-4\\\">\r\n			<img src=\\\"/media/default.jpg\\\" style=\\\"width:100%; height: auto;\\\" />\r\n		</div>\r\n		<div class=\\\"col-md-8 presentation\\\">\r\n			<h1 class=\\\"title\\\">Presentation</h1>\r\n			<p>Abcde abcde abcde abc abcde abcdefghijk abcdefghij abcd. Abcdef abcde abcd abc abcd abcdef abcdef abcdefgh abcdefgh abcde. Abcdefg ab abcd abcdefgh abcdefghi abcde abcdef abcdefgh abcde. Abc abc abcde ab ab abcdefg abcdef abc ab abcde. Abcde abc abcde abcd abcde abcdef abcdefghijk. Abcdefg abc abcdefgh abcd. Abcde abcdefghijkl abcd a abcde abcdefghi abcd abcdefghi abcd abcdefg.</p>\r\n			<ul class=\\\"row\\\">\r\n				<li class=\\\"col-md-6 block\\\">\r\n					<div class=\\\"panel panel-info\\\">\r\n					  <div class=\\\"panel-heading\\\"><span class=\\\"glyphicon glyphicon-education\\\"></span><strong>Technique</strong></div>\r\n					  <div class=\\\"panel-body\\\">\r\n						Integration of multimedia\r\n					  </div>\r\n					</div>\r\n				</li>\r\n				<li class=\\\"col-md-6 block\\\">\r\n					<div class=\\\"panel panel-info\\\">\r\n					  <div class=\\\"panel-heading\\\"><span class=\\\"glyphicon glyphicon-star\\\"></span><strong>Interest</strong></div>\r\n					  <div class=\\\"panel-body\\\">\r\n						Programmation\r\n					  </div>\r\n					</div>\r\n				</li>\r\n			</ul>\r\n			\r\n			<div class=\\\"row experience\\\">\r\n				<div class=\\\"col-md-12\\\">\r\n					<h2 class=\\\"title\\\">Experience</h2>\r\n					<div class=\\\"progress progress-striped\\\">\r\n					  <div class=\\\"progress-bar progress-bar-info\\\" style=\\\"width:90%;\\\">HTML (90%)</div>\r\n					</div>\r\n					<div class=\\\"progress progress-striped\\\">\r\n					  <div class=\\\"progress-bar progress-bar-info\\\" style=\\\"width:90%;\\\">CSS (90%)</div>\r\n					</div>\r\n					<div class=\\\"progress progress-striped\\\">\r\n					  <div class=\\\"progress-bar progress-bar-info\\\" style=\\\"width:85%;\\\">PHP (85%)</div>\r\n					</div>\r\n					<div class=\\\"progress progress-striped\\\">\r\n					  <div class=\\\"progress-bar progress-bar-info\\\" style=\\\"width:85%;\\\">JavaScript (85%)</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>	\r\n<div class=\\\"services\\\">\r\n	<h2>Services</h2>\r\n	<ul class=\\\"row services-list\\\">\r\n		<li class=\\\"col-md-4 block\\\">\r\n			<div class=\\\"panel panel-success\\\">\r\n				<div class=\\\"panel-heading\\\"><span class=\\\"glyphicon glyphicon-picture\\\"></span><strong>Illustrations</strong></div>\r\n				<div class=\\\"panel-body\\\">\r\n					<p>Abcdefghijk abcdefgh abc ab abcdefgh abcdefgh abcde abcde abcdefghi abcdef abcdefg abcdefgh abcdef abcd abcde abcde.</p>\r\n				</div>\r\n			</div>\r\n		</li>\r\n		<li class=\\\"col-md-4 block\\\">\r\n			<div class=\\\"panel panel-success\\\">\r\n				<div class=\\\"panel-heading\\\"><span class=\\\"glyphicon glyphicon-wrench\\\"></span><strong>Maintenance</strong></div>\r\n				<div class=\\\"panel-body\\\">\r\n					<p>Abcdefghijk abcdefgh abc ab abcdefgh abcdefgh abcde abcde abcdefghi abcdef abcdefg abcdefgh abcdef abcd abcde abcde.</p>\r\n				</div>\r\n			</div>\r\n		</li>\r\n		<li class=\\\"col-md-4 block\\\">\r\n			<div class=\\\"panel panel-success\\\">\r\n				<div class=\\\"panel-heading\\\"><span class=\\\"glyphicon glyphicon-link\\\"></span><strong>Websites developement</strong></div>\r\n				<div class=\\\"panel-body\\\">\r\n					<p>Abcdefghijk abcdefgh abc ab abcdefgh abcdefgh abcde abcde abcdefghi abcdef abcdefg abcdefgh abcdef abcd abcde abcde.</p>\r\n				</div>\r\n			</div>\r\n		</li>\r\n	</ul>\r\n\r\n	<h2>Workflow</h2>\r\n	<div class=\\\"workflow progress\\\">\r\n		<div class=\\\"progress-bar progress-bar-info idea\\\">Ideas</div>\r\n		<div class=\\\"progress-bar progress-bar-success code\\\">Code</div>\r\n		<div class=\\\"progress-bar progress-bar-warning illustration\\\">Illustration</div>\r\n		<div class=\\\"progress-bar progress-bar-danger quality\\\">Quality</div>\r\n		<div class=\\\"progress-bar launch\\\">Launch</div>\r\n	</div>	\r\n</div>',	1);

CREATE TABLE `<?php echo $hash ?>_category` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `date` varchar(40) NOT NULL,
  `time` varchar(40) NOT NULL,
  `order1` varchar(30) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_category` (`id`, `category`, `date`, `time`, `order1`) VALUES
(43,	'Resume',	'0000-00-00',	'00:00:00',	'1'),
(42,	'Contact_Info',	'0000-00-00',	'00:00:00',	'1'),
(41,	'Presentation',	'0000-00-00',	'00:00:00',	'1');

CREATE TABLE `<?php echo $hash ?>_config` (
  `id` varchar(10) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `emailadmin` varchar(255) NOT NULL DEFAULT '',
  `pause` varchar(255) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_config` (`id`, `title`, `emailadmin`, `pause`) VALUES
('1',	'<?php echo $site ?>',	'<?php echo $email ?>',	'0');

CREATE TABLE `<?php echo $hash ?>_link_menu` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_index` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortcut` varchar(255) NOT NULL,
  `order1` varchar(255) NOT NULL,
  `published` int(10) NOT NULL,
  `sub_menu` int(10) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_link_menu` (`id`, `id_index`, `name`, `shortcut`, `order1`, `published`, `sub_menu`) VALUES
(49,	10,	'Contact',	'Contact',	'3',	1,	0),
(48,	10,	'Resume',	'Resume',	'2',	1,	0),
(47,	10,	'About Me',	'About_Me',	'1',	1,	0),
(34,	1,	'index',	'index',	'',	1,	0),
(35,	1,	'all',	'all',	'',	1,	0);

CREATE TABLE `<?php echo $hash ?>_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `modules` longtext NOT NULL,
  `order1` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `shortcut` varchar(255) DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `published` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_modules` (`id`, `title`, `category`, `modules`, `order1`, `date`, `time`, `shortcut`, `position`, `published`) VALUES
(117,	'Contact_Info_Form',	'Contact_Info_Form',	'{type_contact{contacts{0:show_first_name:show_last_name:show_email:show_phone:show_postal_code:show_city:show_state:show_country:show_daybirth:show_monthbirth:show_yearbirth:show_gender:show_content:}}}',	'3a',	'0000-00-00',	'00:00:00',	'Contact:About_Me:index',	'article',	'1'),
(115,	'Comments',	'Comments',	'{type_comment{comments{show_title:show_description:show_username:show_time:show_date}}}',	'9a',	'0000-00-00',	'00:00:00',	'Resume',	'article',	'0'),
(114,	'Gallery',	'Gallery',	'{type_gallery{gallery{show_title:show_description:show_time:show_date}}}',	'1',	'0000-00-00',	'00:00:00',	'Resume',	'article',	'1'),
(78,	'Resume',	'Resume',	'{type_article{category{0}:article{0:show_description:0:0:0}}}',	'1',	'0000-00-00',	'00:00:00',	'Resume',	'article',	'1'),
(62,	'Main Menu',	'Main_Menu',	'{type_menu{category{0}}}',	'1',	'0000-00-00',	'00:00:00',	'index:all',	'menu',	'1'),
(77,	'Contact_Info',	'Contact_Info',	'{type_article{category{0}:article{0:show_description:0:0:0}}}',	'2',	'0000-00-00',	'00:00:00',	'Contact:About_Me:index',	'article',	'1'),
(76,	'Presentation',	'Presentation',	'{type_article{category{0}:article{0:show_description:0:0:0}}}',	'1',	'0000-00-00',	'00:00:00',	'About_Me:index',	'article',	'1'),
(125,	'Counter',	'Counter',	'{type_counter{counter{0}}}',	'0',	'0000-00-00',	'00:00:00',	'all',	'extra',	'1');

CREATE TABLE `<?php echo $hash ?>_plugins` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `default_shortcut` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `publish` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_plugins` (`id`, `title`, `date`, `time`, `default_shortcut`, `content`, `publish`) VALUES
(1,	'Comment',	'0000-00-00',	'00:00:00',	'list_comments',	'comment',	1),
(2,	'Contact',	'0000-00-00',	'00:00:00',	'list_contact',	'contact',	1),
(3,	'Gallery',	'0000-00-00',	'00:00:00',	'list_gallery',	'gallery',	1),
(4,	'Counter',	'0000-00-00',	'00:00:00',	'counter_main',	'counter',	1);

CREATE TABLE `<?php echo $hash ?>_section_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) NOT NULL,
  `id_module` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_section_name` (`id`, `section`, `id_module`) VALUES
(10,	'Main',	62),
(1,	'index',	59);

CREATE TABLE `<?php echo $hash ?>_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `admin` int(1) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_template` (`id`, `title`, `description`, `date`, `time`, `active`, `admin`) VALUES
(6,	'default',	'The default template',	'0000-00-00',	'00:00:00',	1,	0),
(5,	'<?php echo $username ?>',	'The admin template',	'0000-00-00',	'00:00:00',	1,	1);

CREATE TABLE `<?php echo $hash ?>_users` (
  `id` mediumint(4) NOT NULL AUTO_INCREMENT,
  `idm` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `picture` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `level` char(1) NOT NULL DEFAULT '3',
  `gender` varchar(255) NOT NULL DEFAULT '0',
  `ip` varchar(25) NOT NULL DEFAULT '---',
  `city` varchar(255) NOT NULL DEFAULT '--',
  `first_name` varchar(255) NOT NULL DEFAULT '--',
  `last_name` varchar(255) NOT NULL DEFAULT '--',
  `age` varchar(255) NOT NULL DEFAULT '--',
  `about` longtext NOT NULL,
  `articles` varchar(255) NOT NULL DEFAULT '0',
  `country` varchar(255) NOT NULL DEFAULT '--',
  `blocked` char(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_users` (`id`, `idm`, `username`, `password`, `email`, `picture`, `level`, `gender`, `ip`, `city`, `first_name`, `last_name`, `age`, `about`, `articles`, `country`, `blocked`) VALUES
(1,	'0',	'<?php echo $username ?>',	'<?php echo $password ?>',	'<?php echo $email ?>',	'000.jpg',	'1',	'-1',	'255.255.255.255',	'',	'',	'',	'',	'',	'0',	'',	'0');

-- 0000-00-00 00:00:00
