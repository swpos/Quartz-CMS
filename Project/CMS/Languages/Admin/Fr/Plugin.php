<?php

define('ADD_A_PLUGIN', 'AJOUTER UN PLUGIN');
define('ADD_A_PLUGIN_INTRO', 'Veuillez faire sûr que vous avez bien les permissions (755 : Meilleure solution) ou les permissions 775 et que le dossier cache a les permissions 775.');

define('LIST_PLUGINS', 'LISTE DES PLUGINS');
define('LIST_PLUGINS_TITLE', 'Titre');
define('LIST_PLUGINS_DATE', 'Date');
define('LIST_PLUGINS_TIME', 'Heure');
define('LIST_PLUGINS_PUBLISHED', 'Statut');

define('UPLOAD_PLUGIN_STORED_IN', 'Conservé dans : " . "/Project/CMS/Administrator/Cache/');
define('UPLOAD_PLUGIN_COPYING_FILES', '<br />Copiage des fichiers...');
define('UPLOAD_PLUGIN_UPLOAD', 'Téléchargement: ');
define('UPLOAD_PLUGIN_TYPE', 'Type: ');
define('UPLOAD_PLUGIN_SIZE', 'Taille: ');
define('UPLOAD_PLUGIN_TEMP_FILE', 'Fichier temporaire: ');
define('UPLOAD_PLUGIN_EXECUTING_SQL', '<br />Exécution des tables du fichier SQL...');
define('UPLOAD_PLUGIN_DID_NOT_FOUND_SQL', '<br />Erreur! n\'a pu trouver le fichier tables.sql à la base du plugin');
define('UPLOAD_PLUGIN_DID_NOT_CONFIG_FILE', '<br />Erreur! n\'a pu trouvé le fichier config.php à la base du plugin');
define('UPLOAD_PLUGIN_ERROR_COPYING_FILES', '<br />Erreur durant le copiage des fichiers ! : Ceci est peut-être dû au fait qu\'il y a plusieurs sous-dossiers avant d\'arriver aux fichiers. Vérifiez que les fichiers ne sont que dans un seul dossier dans le fichier zip (avec le même nom \'sans l\'extension .zip \'), ou à la base du fichier zip.<br /><br />Ceci est peut-être aussi une erreur de permission d\'écriture sur les dossiers.');
define('UPLOAD_PLUGIN_ERROR_UPLOADING_ZIP', '<br />Erreur lors du téléchargement du fichier zip. Ceci est peut-être un problème de permissions d\'écriture sur le dossier Administrator/Cache.');
define('UPLOAD_PLUGIN_NO_ENTRY_WILL_BE_CREATED', '<br />ATTENTION: Aucune entré vont être créé dans la table du plugin pour ce plugin.');
define('UPLOAD_PLUGIN_NO_FOLDERS_ARRAY', '<br />Erreur: Il y a aucun tableau \'folders\' dans le fichier de configuration ou aucune variable \'folders\'.');
define('UPLOAD_PLUGIN_MAIN_DIRECTORY_VAR', '<br />Erreur: La variable du principal dossier n\'existe pas dans le fichier de configuration.');
define('UPLOAD_COULD_NOT_FOUND_CONFIG_FILE_PLUGIN', '<br />Erreur: Le fichier de configuration du plugin n\'a pu être trouvé.');
define('UPLOAD_PLUGIN_WARNING_FOLDER_ENTRY_1', '<br />ATTENTION: Le dossier ou fichier');
define('UPLOAD_PLUGIN_WARNING_FOLDER_ENTRY_2', 'dans le fichier de configuration contient une bar oblique');
define('UPLOAD_PLUGIN_FOLDER_NOT_DIR_1', '<br />ATTENTION: Le dossier ou fichier');
define('UPLOAD_PLUGIN_FOLDER_NOT_DIR_2', 'n\'existe pas');

?>