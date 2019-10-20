<?php

define('CONFIGURATION', 'CONFIGURATION');
define('CONFIGURATION_INTRO', 'To modifiy the MySQL configuration add write permission on the configuration file located in the folder /Project/CMS/. (write permission are (755 : Best solution) or 775)');
define('CONFIGURATION_TITLE', 'Title');
define('CONFIGURATION_EMAIL_ADMIN', 'Email of the admin');
define('CONFIGURATION_MAINTENANCE', 'Maintenance');
define('CONFIGURATION_MAINTENANCE_YES', 'Yes');
define('CONFIGURATION_MAINTENANCE_NO', 'No');
define('CONFIGURATION_EDITOR', 'Editor');
define('CONFIGURATION_EDITOR_NONE', 'NONE');
define('CONFIGURATION_EDITOR_CKEDITOR', 'CKeditor');
define('CONFIGURATION_EDITOR_BUILDER', 'Builder');
define('CONFIGURATION_MYSQL_INFO', 'MySQL Informations');
define('CONFIGURATION_MYSQL_HOST', 'MySQL Host');
define('CONFIGURATION_MYSQL_USER', 'Database User');
define('CONFIGURATION_MYSQL_PASSWORD', 'Database Password');
define('CONFIGURATION_MYSQL_DB_NAME', 'Database Name');
define('CONFIGURATION_MYSQL_TABLE_PREFIX', 'Table Prefix');
define('CONFIGURATION_ALLOW_REGIS', 'Allow Registration');
define('CONFIGURATION_REGIS_LINK', 'Registration Link');
define('CONFIGURATION_SESSION_DOMAIN', 'Session domain');
define('CONFIGURATION_SESSION_TIME', 'Session time');
define('CONFIGURATION_SESSION_PATH', 'Session path');
define('CONFIGURATION_TIMEZONE', 'Timezone');
define('CONFIGURATION_FORBIDDEN_PAGES', 'Forbidden pages (comma list)');
define('CONFIGURATION_FORBIDDEN_ACTIONS', 'Forbidden actions (comma list)');
define('CONFIGURATION_EXCEPT_ADMIN', 'Except for admins (comma list)');
define('CONFIGURATION_RESTRICTIONS', 'Restrictions');
define('CONFIGURATION_SESSION', 'Sessions');
define('CONFIGURATION_REGISTRATION', 'Registration');

define('CONFIGURATION_MAILER', 'Mailer');
define('CONFIGURATION_MAILER_MAIL', 'mail() function');
define('CONFIGURATION_MAILER_SMTP', 'SMTP');
define('CONFIGURATION_MAIL_SMTP_HOST', 'SMTP Host');
define('CONFIGURATION_MAIL_SMTP_AUTH', 'SMTP Authentification');
define('CONFIGURATION_MAILER_SMTP_AUTH_TRUE', 'true');
define('CONFIGURATION_MAILER_SMTP_AUTH_FALSE', 'false');
define('CONFIGURATION_MAIL_SMTP_USERNAME', 'SMTP Username');
define('CONFIGURATION_MAIL_SMTP_PASSWORD', 'SMTP Password');
define('CONFIGURATION_MAIL_SMTP_FROM', 'SMTP From');
define('CONFIGURATION_MAIL_SMTP_HTML', 'SMTP HTML');
define('CONFIGURATION_MAIL_SMTP_HTML_YES', 'Yes');
define('CONFIGURATION_MAIL_SMTP_HTML_NO', 'No');
define('CONFIGURATION_MAIL_SMTP_SECURE', 'SMTP Encryption');
define('CONFIGURATION_MAIL_SMTP_SECURE_SSL', 'SSL');
define('CONFIGURATION_MAIL_SMTP_SECURE_TLS', 'TLS');
define('CONFIGURATION_MAIL_SMTP_PORT', 'SMTP Port');

define('CONFIGURATION_UPDATE', 'CMS update');
define('UPDATE_INTRO', 'You can update the CMS below to the latest. Please make sure you you have a backup of the CMS files before proceding.');
define('UPDATE_GIT_INSTALLED', 'GIT command line is installed. You can proceed to the installation.');
define('UPDATE_CMS', 'Click on the update button below to update the CMS');
define('UPDATE_COMPOSER_WILL_BE_UPDATED', 'The composer.phar file will be updated and all the vendor repository as well. Please make sure you have the PHP client command line');
define('UPDATE_GIT_NOT_INSTALLED', 'GIT command line is not installed. You will need to proceed manually.');
define('UPDATE_FILE_NEEDS_BE_COPIED', 'Files will need to be copied. More information on manual (Version 3.x to latest) <a href="https://www.quartzcms.ca/list/download/tel3/0/Version_3_x" target="_blank">here</a>');
define('UPDATE_COMPOSER_NEED_BE_UPDATED', 'The composer.phar will need to be updated manually. More information on manual update (Version 3.x to latest) <a href="https://www.quartzcms.ca/list/download/tel3/0/Version_3_x" target="_blank">here</a>');
define('UPDATE_CMS_IS_UPTODATE', 'The CMS already have the latest version installed. If you have errors you can reupload manually the files by following this (Version 3.x to latest) <a href="https://www.quartzcms.ca/list/download/tel3/0/Version_3_x" target="_blank">documentation</a>');
define('TEMPLATES_OVERRIDE_CHECKUP', 'Template checkup');
define('TEMPLATES_OVERRIDE_NOT_MATCHED', 'does not match');
define('TEMPLATES_OVERRIDE_MATCHED', 'does match');
define('TEMPLATES_OVERRIDE_ALL_MATCHED', 'All the templates matches the override.');
define('TEMPLATES_OVERRIDE_NOT_MATCHED_ALL', 'Some of the templates does not match the override of the CMS. Please review the new changes and make sure they are functional.');
define('UPDATE_FUNCTION_EXEC_DONT_EXIST', 'The PHP function exec() don\'t exist or is not accessible.');
define('UPDATE_COMPOSER_NEW_FILES', 'Attention ! Some Composer repositories will be removed after the update. You will have to reinstall them. If you do not want this to happen, please update the CMS manually and keep your modifications in the composer.json file.');
define('UPDATE_COMPOSER_NEW_FILES_DONT_EXIST', 'The following repository is new:');



?>