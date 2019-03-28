<?php 
	header('Content-Type: text/html; charset=utf-8');
	$username = $_GET['username']; 
	$password = $_GET['password']; 
	$email = $_GET['email']; 
	$hash = $_GET['hash']; 
	$site = $_GET['site']; 
?>

CREATE TABLE `<?php echo $hash ?>_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL DEFAULT '0',
  `modules` longtext,
  `shortcut` varchar(255) DEFAULT NULL,
  `date` varchar(40) NOT NULL DEFAULT '0000-00-00',
  `time` varchar(40) NOT NULL DEFAULT '00:00:00',
  `order1` varchar(30) DEFAULT NULL,
  `content` longtext,
  `publish` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `<?php echo $hash ?>_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `date` varchar(40) NOT NULL DEFAULT '0000-00-00',
  `time` varchar(40) NOT NULL DEFAULT '00:00:00',
  `order1` varchar(30) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `<?php echo $hash ?>_config` (
  `id` int(1) NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `emailadmin` varchar(255) DEFAULT NULL,
  `pause` int(1) NOT NULL DEFAULT '0',
  `allow_regis` int(1) DEFAULT NULL,
  `regis_link` int(1) DEFAULT NULL,
  `forbidden_pages` varchar(255) DEFAULT NULL,
  `forbidden_actions` varchar(255) DEFAULT NULL,
  `except_admin` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_config` (`id`, `title`, `emailadmin`, `pause`, `allow_regis`, `regis_link`, `forbidden_pages`, `forbidden_actions`, `except_admin`, `username`) VALUES
('1',	'<?php echo $site ?>',	'<?php echo $email ?>',	0,	0,	0,	'',	'',	'', '<?php echo $username ?>');

CREATE TABLE `<?php echo $hash ?>_link_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_index` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `shortcut` varchar(255) DEFAULT NULL,
  `order1` varchar(30) DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT '0',
  `sub_menu` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_link_menu` (`id`, `id_index`, `name`, `shortcut`, `order1`, `published`, `sub_menu`, `username`) VALUES
(34,	1,	'index',	'index',	'',	1,	0, '<?php echo $username ?>'),
(35,	1,	'all',	'all',	'',	1,	0, '<?php echo $username ?>'),
(47,	10,	'About Me',	'About_Me',	'1',	1,	0, '<?php echo $username ?>'),
(48,	10,	'Resume',	'Resume',	'2',	1,	0, '<?php echo $username ?>'),
(49,	10,	'Contact',	'Contact',	'3',	1,	0, '<?php echo $username ?>');

CREATE TABLE `<?php echo $hash ?>_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `modules` longtext,
  `order1` varchar(30) DEFAULT NULL,
  `date` varchar(40) NOT NULL DEFAULT '0000-00-00',
  `time` varchar(40) NOT NULL DEFAULT '00:00:00',
  `shortcut` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `content` longtext,
  `published` int(1) NOT NULL DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_modules` (`id`, `title`, `category`, `modules`, `order1`, `date`, `time`, `shortcut`, `position`, `content`, `published`, `username`) VALUES
(1,	'0',	'0',	'0',	'0',	'0000-00-00',	'00:00:00',	'0',	'0',	'',	'0',	NULL),
(107,	'Presentation',	'Presentation',	'{\"type_custom\":{\"article\":{\"show_title\":\"0\",\"show_description\":\"show_description\",\"show_time\":\"0\",\"show_date\":\"0\"}}}',	'1',	'0000-00-00',	'00:00:00',	'index:About_Me',	'article',	'<div class=\"about\" id=\"about\">	\r\n	<div class=\"row\">\r\n		<div class=\"col-md-4\">\r\n			<img src=\"/Media/default.jpg\" style=\"width:100%; height: auto;\" />\r\n		</div>\r\n		<div class=\"col-md-8 presentation\">\r\n			<h1 class=\"title\"><\?php echo PRESENTATION ?></h1>\r\n			<p><\?php echo PRESENTATION_DESCRIPTION_1 ?> <\?php echo PRESENTATION_DESCRIPTION_2 ?></p>\r\n			<ul class=\"row\">\r\n				<li class=\"col-md-6 block\">\r\n					<div class=\"panel panel-info\">\r\n					  <div class=\"panel-heading\"><span class=\"glyphicon glyphicon-education\"></span><strong><\?php echo TECHNIQUE ?></strong></div>\r\n					  <div class=\"panel-body\">\r\n						<\?php echo TECHNIQUE_TYPE ?>\r\n					  </div>\r\n					</div>\r\n				</li>\r\n				<li class=\"col-md-6 block\">\r\n					<div class=\"panel panel-info\">\r\n					  <div class=\"panel-heading\"><span class=\"glyphicon glyphicon-star\"></span><strong><\?php echo INTERETS ?></strong></div>\r\n					  <div class=\"panel-body\">\r\n						<\?php echo INTERETS_TYPE ?>\r\n					  </div>\r\n					</div>\r\n				</li>\r\n			</ul>\r\n			\r\n			<div class=\"row experience\">\r\n				<div class=\"col-md-12\">\r\n					<h2 class=\"title\"><\?php echo RESUME_EXPERIENCE ?></h2>\r\n					<div class=\"progress progress-striped\">\r\n					  <div class=\"progress-bar progress-bar-info\" style=\"width:90%;\">HTML (90%)</div>\r\n					</div>\r\n					<div class=\"progress progress-striped\">\r\n					  <div class=\"progress-bar progress-bar-info\" style=\"width:90%;\">CSS (90%)</div>\r\n					</div>\r\n					<div class=\"progress progress-striped\">\r\n					  <div class=\"progress-bar progress-bar-info\" style=\"width:85%;\">PHP (85%)</div>\r\n					</div>\r\n					<div class=\"progress progress-striped\">\r\n					  <div class=\"progress-bar progress-bar-info\" style=\"width:85%;\">JavaScript (85%)</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>	\r\n<div class=\"services\">\r\n	<h2><\?php echo SERVICES ?></h2>\r\n	<ul class=\"row services-list\">\r\n		<li class=\"col-md-4 block\">\r\n			<div class=\"panel panel-success\">\r\n				<div class=\"panel-heading\"><span class=\"glyphicon glyphicon-picture\"></span><strong><\?php echo SERVICES_DESIGN ?></strong></div>\r\n				<div class=\"panel-body\">\r\n					<p><\?php echo SERVICES_DESIGN_DESCRIPTION ?></p>\r\n				</div>\r\n			</div>\r\n		</li>\r\n		<li class=\"col-md-4 block\">\r\n			<div class=\"panel panel-success\">\r\n				<div class=\"panel-heading\"><span class=\"glyphicon glyphicon-wrench\"></span><strong><\?php echo SERVICES_ILLUSTRATION ?></strong></div>\r\n				<div class=\"panel-body\">\r\n					<p><\?php echo SERVICES_ILLUSTRATION_DESCRIPTION ?></p>\r\n				</div>\r\n			</div>\r\n		</li>\r\n		<li class=\"col-md-4 block\">\r\n			<div class=\"panel panel-success\">\r\n				<div class=\"panel-heading\"><span class=\"glyphicon glyphicon-link\"></span><strong><\?php echo SERVICES_DEVELOPPEMENT ?></strong></div>\r\n				<div class=\"panel-body\">\r\n					<p><\?php echo SERVICES_DEVELOPPEMENT_DESCRIPTION ?></p>\r\n				</div>\r\n			</div>\r\n		</li>\r\n	</ul>\r\n\r\n	<h2><\?php echo WORKFLOW ?></h2>\r\n	<div class=\"workflow progress\">\r\n		<div class=\"progress-bar progress-bar-info idea\"><\?php echo WORKFLOW_IDEAS ?></div>\r\n		<div class=\"progress-bar progress-bar-success code\"><\?php echo WORKFLOW_CODE ?></div>\r\n		<div class=\"progress-bar progress-bar-warning illustration\"><\?php echo WORKFLOW_ILLUSTRATION ?></div>\r\n		<div class=\"progress-bar progress-bar-danger quality\"><\?php echo WORKFLOW_QUALITY ?></div>\r\n		<div class=\"progress-bar launch\"><\?php echo WORKFLOW_LAUNCH ?></div>\r\n	</div>	\r\n</div>',	1,	'<?php echo $username ?>'),
(59,	'hidden',	'hidden',	'{\"type_menu\":{\"category\":{\"show_title\":\"show_title\"}}}',	'',	'',	'',	'all',	'',	'',	'0',	NULL),
(62,	'Main Menu',	'Main_Menu',	'{\"type_menu\":{\"category\":{\"show_title\":\"0\"}}}',	'1',	'0000-00-00',	'00:00:00',	'all',	'menu',	'',	'1',	NULL),
(108,	'Contact Me',	'Contact_Me',	'{\"type_custom\":{\"article\":{\"show_title\":\"0\",\"show_description\":\"show_description\",\"show_time\":\"0\",\"show_date\":\"0\"}}}',	'3',	'0000-00-00',	'00:00:00',	'Contact:index:About_Me',	'article',	'<div id=\"contact\">\r\n	<h2><\?php echo CONTACT_ME ?></h2>\r\n	<div class=\"row\">\r\n		<div class=\"col-md-6\">\r\n			<div class=\"well\">\r\n				<p><\?php echo CONTACT_ME_SUB_DESCRPTION1 ?></p>\r\n		</div>\r\n	</div>\r\n		<div class=\"col-md-6\">\r\n			<div class=\"well\">\r\n	<p><\?php echo CONTACT_ME_SUB_DESCRPTION2 ?></p>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>',	'1',	'<?php echo $username ?>'),
(109,	'Resume',	'Resume',	'{\"type_custom\":{\"article\":{\"show_title\":\"0\",\"show_description\":\"show_description\",\"show_time\":\"0\",\"show_date\":\"0\"}}}',	'1',	'0000-00-00',	'00:00:00',	'Resume',	'article',	'<div class=\"resume\" id=\"resume\">\r\n	<h1><\?php echo RESUME_EDUCATION_EXPERIENCE ?></h1>\r\n	<p><\?php echo RESUME_EDUCATION_EXPERIENCE_DESCRIPTION ?></p>\r\n	<a href=\"Media/cv.pdf\" class=\"download-btn\"><\?php echo RESUME_EDUCATION_EXPERIENCE_DOWNLOAD_CV ?></a>\r\n	<h2 class=\"title\"><\?php echo RESUME_EXPERIENCE ?></h2>\r\n	<div class=\"row experience\">\r\n		<div class=\"col-md-12\">\r\n			<div class=\"progress progress-striped\">\r\n			  <div class=\"progress-bar progress-bar-info\" style=\"width:90%;\">HTML (90%)</div>\r\n			</div>\r\n			<div class=\"progress progress-striped\">\r\n			  <div class=\"progress-bar progress-bar-info\" style=\"width:90%;\">CSS (90%)</div>\r\n			</div>\r\n			<div class=\"progress progress-striped\">\r\n			  <div class=\"progress-bar progress-bar-info\" style=\"width:85%;\">PHP (85%)</div>\r\n			</div>\r\n			<div class=\"progress progress-striped\">\r\n			  <div class=\"progress-bar progress-bar-info\" style=\"width:85%;\">JavaScript (85%)</div>\r\n			</div>\r\n		</div> \r\n	</div>\r\n</div>',	'1',	'<?php echo $username ?>'),
(110,	'Language Switcher',	'Language_Switcher',	'{\"type_language\":{\"article\":{\"show_title\":\"0\",\"show_description\":\"show_description\",\"show_time\":\"0\",\"show_date\":\"0\"}}}',	'1',	'0000-00-00',	'00:00:00',	'all',	'menu',	'',	'1',	NULL),
(114,	'Gallery',	'Gallery',	'{\"type_gallery\":{\"gallery\":{\"show_title\":\"show_title\",\"show_description\":\"show_description\",\"show_time\":\"0\",\"show_date\":\"0\"}}}',	'1',	'0000-00-00',	'00:00:00',	'Resume',	'article',	'',	'1',	NULL),
(115,	'Comments',	'Comments',	'{\"type_comment\":{\"category\":{\"show_title\":\"show_title\"},\"article\":{\"show_title\":\"show_title\",\"show_description\":\"show_description\",\"show_username\":\"show_username\",\"show_time\":\"show_time\",\"show_date\":\"show_date\"}}}',	'9a',	'0000-00-00',	'00:00:00',	'Resume',	'article',	'',	'0',	'<?php echo $username ?>'),
(116,	'Counter',	'Counter',	'{\"type_counter\":{\"counter\":{\"show_title\":\"0\"}}}',	'9b',	'0000-00-00',	'00:00:00',	'all',	'article',	'',	'1',	NULL),
(117,	'Contact Me Form',	'Contact_Me_Form',	'{\"type_contact\":{\"contacts\":{\"show_title\":\"0\",\"show_first_name\":\"show_first_name\",\"show_last_name\":\"show_last_name\",\"show_email\":\"show_email\",\"show_phone\":\"show_phone\",\"show_postal_code\":\"show_postal_code\",\"show_city\":\"show_city\",\"show_state\":\"show_state\",\"show_country\":\"show_country\",\"show_daybirth\":\"show_daybirth\",\"show_monthbirth\":\"show_monthbirth\",\"show_yearbirth\":\"show_yearbirth\",\"show_gender\":\"show_gender\",\"show_content\":\"show_content\"}}}',	'3a',	'0000-00-00',	'00:00:00',	'Contact:index:About_Me',	'article',	'',	'1',	NULL);

CREATE TABLE `<?php echo $hash ?>_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `date` varchar(40) NOT NULL DEFAULT '0000-00-00',
  `time` varchar(40) NOT NULL DEFAULT '00:00:00',
  `default_shortcut` varchar(255) DEFAULT NULL,
  `content` longtext,
  `publish` int(1) NOT NULL DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_plugins` (`title`, `date`, `time`, `default_shortcut`, `content`, `publish`, `username`) VALUES
('Article',	'0000-00-00',	'00:00:00',	'_add_module',	'article',	1, '<?php echo $username ?>'),
('Custom',	'0000-00-00',	'00:00:00',	'_add_module',	'custom',	1, '<?php echo $username ?>'),
('Language',	'0000-00-00',	'00:00:00',	'_add_module',	'language',	1, '<?php echo $username ?>'),
('Menu',	'0000-00-00',	'00:00:00',	'_add_module',	'menu',	1, '<?php echo $username ?>'),
('User',	'0000-00-00',	'00:00:00',	'_add_module',	'user',	1, '<?php echo $username ?>'),
('Gallery',	'0000-00-00',	'00:00:00',	'gallery_listed',	'gallery',	1, '<?php echo $username ?>'),
('Contact',	'0000-00-00',	'00:00:00',	'contact_listed',	'contact',	1, '<?php echo $username ?>'),
('Comment',	'0000-00-00',	'00:00:00',	'comment_listed_comments',	'comment',	1, '<?php echo $username ?>'),
('Counter',	'0000-00-00',	'00:00:00',	'counter_listed',	'counter',	1, '<?php echo $username ?>'),
('FileUpload',	'0000-00-00',	'00:00:00',	'',	'fileupload',	1, '<?php echo $username ?>'),
('Chosen',	'0000-00-00',	'00:00:00',	'',	'chosen',	1, '<?php echo $username ?>'),
('DataTable',	'0000-00-00',	'00:00:00',	'',	'datatable',	1, '<?php echo $username ?>'),
('CKeditor',	'0000-00-00',	'00:00:00',	'',	'ckeditor',	1, '<?php echo $username ?>'),
('DatePicker',	'0000-00-00',	'00:00:00',	'',	'datepicker',	1, '<?php echo $username ?>');

CREATE TABLE `<?php echo $hash ?>_section_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) DEFAULT NULL,
  `id_module` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_section_name` (`id`, `section`, `id_module`, `username`) VALUES
(1,	'index',	59, '<?php echo $username ?>'),
(10,	'Main',	62, '<?php echo $username ?>');

CREATE TABLE `<?php echo $hash ?>_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` varchar(40) NOT NULL DEFAULT '0000-00-00',
  `time` varchar(40) NOT NULL DEFAULT '00:00:00',
  `active` int(1) NOT NULL DEFAULT '0',
  `admin` int(1) NOT NULL DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_template` (`id`, `title`, `description`, `date`, `time`, `active`, `admin`, `username`) VALUES
(5,	'admin',	'The admin template',	'0000-00-00',	'00:00:00',	1,	1, '<?php echo $username ?>'),
(6,	'default',	'The default template',	'0000-00-00',	'00:00:00',	1,	0, '<?php echo $username ?>');

CREATE TABLE `<?php echo $hash ?>_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idm` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `level` char(1) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `ip` varchar(25) NOT NULL DEFAULT '255.255.255.255',
  `city` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT '',
  `last_name` varchar(255) DEFAULT '',
  `age` varchar(255) NOT NULL DEFAULT '0',
  `about` longtext,
  `articles` varchar(255) NOT NULL DEFAULT '0',
  `country` varchar(255) DEFAULT '',
  `blocked` int(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `<?php echo $hash ?>_users` (`id`, `idm`, `username`, `password`, `email`, `picture`, `level`, `gender`, `ip`, `city`, `first_name`, `last_name`, `age`, `about`, `articles`, `country`, `blocked`) VALUES
(1,	'0',	'<?php echo $username ?>',	'<?php echo $password ?>',	'<?php echo $email ?>',	'000.jpg',	'1',	'male',	'255.255.255.255',	'-',	'-',	'-',	'0',	'<p>-</p>\r\n',	'0',	'-',	'0');

CREATE TABLE `cms_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `date` varchar(40) NOT NULL DEFAULT '0000-00-00',
  `time` varchar(40) NOT NULL DEFAULT '00:00:00',
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `shortcut` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cms_comments` (`id`, `id_module`, `title`, `content`, `date`, `time`, `username`, `email`, `shortcut`) VALUES
(1,	115,	'Good Portfolio',	'<p>Abc abcdef abcdef ab abcde abcdefg abcdefghijkl abcdefg abcde abcdefgh. Abcd ab ab abcdefg abcdefghi abcd abcdef abcdef abcd. Abcde abcdefghijkl abcdef ab ab abcdefgh abcdef.</p>\r\n',	'0000-00-00',	'00:00:00',	'Mary', 'mary@example.com',	'Resume'),
(2,	115,	'Awesome Design',	'<p>Abc abcdef abcdef ab abcde abcdefg abcdefghijkl abcdefg abcde abcdefgh. Abcd ab ab abcdefg abcdefghi abcd abcdef abcdef abcd. Abcde abcdefghijkl abcdef ab ab abcdefgh abcdef.</p>',	'0000-00-00',	'00:00:00',	'Roger', 'roger@example.com',	'Resume');

CREATE TABLE `cms_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_module` int(11) DEFAULT NULL,
  `date` varchar(40) NOT NULL DEFAULT '0000-00-00',
  `time` varchar(40) NOT NULL DEFAULT '00:00:00',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `states` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `daybirth` varchar(255) DEFAULT NULL,
  `monthbirth` varchar(255) DEFAULT NULL,
  `yearbirth` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `shortcut` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `cms_contact_config` (
  `id` int(1) NOT NULL DEFAULT '1',
  `users` varchar(255) DEFAULT NULL,
  `send_email_admin` varchar(255) DEFAULT NULL,
  `send_complete_mail` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cms_contact_config` (`id`, `users`, `send_email_admin`, `send_complete_mail`, `username`) VALUES
(1,	'<?php echo $email ?>',	'yes',	'yes', '<?php echo $username ?>');

-- 0000-00-00 00:00:00