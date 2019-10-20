<?php

define('CONFIGURATION', 'CONFIGURATION');
define('CONFIGURATION_INTRO', 'Pour modifier la configuration MySQL vous aurez besoin des droits d\'écriture sur le fichier de configuration situé dans le dossier /Project/CMS/. (les permissions d\'écriture sont (755 : Meilleure solution) ou 775)');
define('CONFIGURATION_TITLE', 'Titre');
define('CONFIGURATION_EMAIL_ADMIN', 'Courriel de l\'administrateur');
define('CONFIGURATION_MAINTENANCE', 'Maintenance');
define('CONFIGURATION_MAINTENANCE_YES', 'Oui');
define('CONFIGURATION_MAINTENANCE_NO', 'Non');
define('CONFIGURATION_EDITOR', 'Éditeur');
define('CONFIGURATION_EDITOR_NONE', 'AUCUN');
define('CONFIGURATION_EDITOR_CKEDITOR', 'CKeditor');
define('CONFIGURATION_EDITOR_BUILDER', 'Builder');
define('CONFIGURATION_MYSQL_INFO', 'Informations MySQL');
define('CONFIGURATION_MYSQL_HOST', 'Hébergeur MySQL');
define('CONFIGURATION_MYSQL_USER', 'Utilisateur de la base de données');
define('CONFIGURATION_MYSQL_PASSWORD', 'Mot de passe de la base de données');
define('CONFIGURATION_MYSQL_DB_NAME', 'Nom de la base de données');
define('CONFIGURATION_MYSQL_TABLE_PREFIX', 'Préfixe des tables');
define('CONFIGURATION_ALLOW_REGIS', 'Permettre l\'enregistrement');
define('CONFIGURATION_REGIS_LINK', 'Lien d\'enregistrement');
define('CONFIGURATION_SESSION_DOMAIN', 'Domaine des sessions');
define('CONFIGURATION_SESSION_TIME', 'Temps des sessions');
define('CONFIGURATION_SESSION_PATH', 'Chemin des sessions');
define('CONFIGURATION_TIMEZONE', 'Timezone');
define('CONFIGURATION_FORBIDDEN_PAGES', 'Pages interdites (liste avec virgule)');
define('CONFIGURATION_FORBIDDEN_ACTIONS', 'Action interdites (liste avec virgule)');
define('CONFIGURATION_EXCEPT_ADMIN', 'Excepté pour les admins (liste avec virgule)');
define('CONFIGURATION_RESTRICTIONS', 'Restrictions');
define('CONFIGURATION_SESSION', 'Sessions');
define('CONFIGURATION_REGISTRATION', 'Enregistrement');

define('CONFIGURATION_MAILER', 'Courriel');
define('CONFIGURATION_MAILER_MAIL', 'fonction mail()');
define('CONFIGURATION_MAILER_SMTP', 'SMTP');
define('CONFIGURATION_MAIL_SMTP_HOST', 'Hôte du SMTP');
define('CONFIGURATION_MAIL_SMTP_AUTH', 'Authentification du SMTP');
define('CONFIGURATION_MAILER_SMTP_AUTH_TRUE', 'oui');
define('CONFIGURATION_MAILER_SMTP_AUTH_FALSE', 'non');
define('CONFIGURATION_MAIL_SMTP_USERNAME', 'Utilisateur du SMTP');
define('CONFIGURATION_MAIL_SMTP_PASSWORD', 'Mot de passe du SMTP');
define('CONFIGURATION_MAIL_SMTP_FROM', 'Envoyeur du SMTP');
define('CONFIGURATION_MAIL_SMTP_HTML', 'HTML du SMTP');
define('CONFIGURATION_MAIL_SMTP_HTML_YES', 'Oui');
define('CONFIGURATION_MAIL_SMTP_HTML_NO', 'Non');
define('CONFIGURATION_MAIL_SMTP_SECURE', 'Encryption du SMTP');
define('CONFIGURATION_MAIL_SMTP_SECURE_SSL', 'SSL');
define('CONFIGURATION_MAIL_SMTP_SECURE_TLS', 'TLS');
define('CONFIGURATION_MAIL_SMTP_PORT', 'Port du SMTP');

define('CONFIGURATION_UPDATE', 'Mise à jour du CMS');
define('UPDATE_INTRO', 'Vous pouvez mettre à jour à la plus récente version le CMS. Assurez-vous d\'avoir une copie des fichiers du CMS avant de procéder.');
define('UPDATE_GIT_INSTALLED', 'La commande GIT est installé. Vous pouvez procéder à l\'installation.');
define('UPDATE_CMS', 'Cliquez sur le bouton ci-dessous pour mettre à jour le CMS.');
define('UPDATE_COMPOSER_WILL_BE_UPDATED', 'Le fichier composer.phar sera mis à jour ainsi que tous les autres projets du dossier vendor. Veuillez vérifier si vous avez la commande client PHP disponible.');
define('UPDATE_GIT_NOT_INSTALLED', 'La commande GIT n\'est pas installé. Vous allez devoir procéder manuellement.');
define('UPDATE_FILE_NEEDS_BE_COPIED', 'Les fichiers devront être copiés. Plus d\'informations sur la mise à jour manuelle (Version 3.x to latest) <a href="https://www.quartzcms.ca/list/download/tel3/0/Version_3_x" target="_blank">ici</a>');
define('UPDATE_COMPOSER_NEED_BE_UPDATED', 'Le fichier composer.phar devra être mis à jour manuellement. Plus d\'informations sur la mise à jour manuelle (Version 3.x to latest) <a href="https://www.quartzcms.ca/list/download/tel3/0/Version_3_x" target="_blank">ici</a>');
define('UPDATE_CMS_IS_UPTODATE', 'Le CMS a déjà la plus récente version installé. Si vous avez des erreurs, vous pouvez envoyer à nouveau manuellement les fichiers en suivant cette (Version 3.x to latest) <a href="https://www.quartzcms.ca/list/download/tel3/0/Version_3_x" target="_blank">documentation</a>');
define('TEMPLATES_OVERRIDE_CHECKUP', 'Verification de la template');
define('TEMPLATES_OVERRIDE_NOT_MATCHED', 'ne correspond pas à');
define('TEMPLATES_OVERRIDE_MATCHED', 'correspond à');
define('TEMPLATES_OVERRIDE_ALL_MATCHED', 'Toutes les templates correspondent aux modifications.');
define('TEMPLATES_OVERRIDE_NOT_MATCHED_ALL', 'Quelques une des templates ne correspondent pas aux modifications du CMS. Veuillez vérifier les nouveaux changements et assurez vous qu\'ils sont fonctionnels.');
define('UPDATE_FUNCTION_EXEC_DONT_EXIST', 'La fonction PHP exec() n\'existe pas ou n\'est pas accessible.');
define('UPDATE_COMPOSER_NEW_FILES', 'Attention ! Certains des projets de Composer vont être effacés après la mise à jour. Vous devrez les résinstallés. Si vous ne voulez pas que ceci arrive, veuillez mettre à jour le CMS manuellement et garder les modifications dans le fichier composer.json.');
define('UPDATE_COMPOSER_NEW_FILES_DONT_EXIST', 'Les projets suivant sont nouveaux:');

?>