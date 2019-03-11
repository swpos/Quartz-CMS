<?php

define('ADD_A_PLUGIN', 'ADD A PLUGIN');
define('ADD_A_PLUGIN_INTRO', 'Please make sure before installing a plugin the modules folders have (755 : Best solution) or 775 permission and that the cache folder have 775 permission.');

define('LIST_PLUGINS', 'LIST OF PLUGINS');
define('LIST_PLUGINS_TITLE', 'Title');
define('LIST_PLUGINS_DATE', 'Date');
define('LIST_PLUGINS_TIME', 'Time');
define('LIST_PLUGINS_PUBLISHED', 'Status');

define('UPLOAD_PLUGIN_STORED_IN', 'Stored in: " . "/Project/CMS/Administrator/Cache/');
define('UPLOAD_PLUGIN_COPYING_FILES', '<br />Copying files...');
define('UPLOAD_PLUGIN_UPLOAD', 'Upload: ');
define('UPLOAD_PLUGIN_TYPE', 'Type: ');
define('UPLOAD_PLUGIN_SIZE', 'Size: ');
define('UPLOAD_PLUGIN_TEMP_FILE', 'Temp file: ');
define('UPLOAD_PLUGIN_EXECUTING_SQL', '<br />Executing SQL of table file...');
define('UPLOAD_PLUGIN_DID_NOT_FOUND_SQL', '<br />Error! did not found the tables.sql file at the root');
define('UPLOAD_PLUGIN_DID_NOT_CONFIG_FILE', '<br />Error! did not found the config.php file at the root');
define('UPLOAD_PLUGIN_ERROR_COPYING_FILES', '<br />Error copying files ! : This may be because the files are in many subfolders. Verify that the files are in only one folder inside the zip file (with the same name \'without .zip extension\'), OR at the root of the zip file.<br /><br />This may also be a problem of permission on the modules folders');
define('UPLOAD_PLUGIN_ERROR_UPLOADING_ZIP', '<br />Error uploading the zip file. This may be a problem of permission on the Administrator/Cache folder.');
define('UPLOAD_PLUGIN_NO_ENTRY_WILL_BE_CREATED', '<br />WARNING: No entry will be created in the plugin table for this plugin.');
define('UPLOAD_PLUGIN_NO_FOLDERS_ARRAY', '<br />ERROR: There are no \'folders\' array in the config file or no \'folders\' variable.');
define('UPLOAD_PLUGIN_MAIN_DIRECTORY_VAR', '<br />ERROR: The main directory variable dosen\'t exist in the config file.');
define('UPLOAD_COULD_NOT_FOUND_CONFIG_FILE_PLUGIN', '<br />ERROR: Could not found the config file of the plugin.');
define('UPLOAD_PLUGIN_WARNING_FOLDER_ENTRY_1', '<br />WARNING: the folder or file entry');
define('UPLOAD_PLUGIN_WARNING_FOLDER_ENTRY_2', 'in the config file contain a slash');
define('UPLOAD_PLUGIN_FOLDER_NOT_DIR_1', '<br />WARNING: the folder or file entry');
define('UPLOAD_PLUGIN_FOLDER_NOT_DIR_2', 'don\'t exist');

?>