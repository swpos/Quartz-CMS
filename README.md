# Quartz-CMS

# IMPORTANT: branch-v1.0 is legacy and no longer maintained
Please note that this branch is no longer maintained.
We keep this branch separate and under its original name by the original developer for historical purposes.
Please do not use it anymore and switch to the versions provided in the master branch.
Thank you.

Content Managing System

<p>Step 1</p>

<p>Extract and upload the zip files to the FTP.</p>

<p>Step 2</p>

<p>Create a new database with a user and a password. Set all privileges to the new user on the new database.</p>

<p>Step 3</p>

<p>Set the DOCUMENT_ROOT files permissions to write mode.</p>

<p>Step 4</p>

<p>The installation will start by accessing www.website.com/INSTALL</p>

<p>Installation will display a step by step procedure.</p>

<p>Step 5</p>

<p>The admin section will be available at www.website.com/administrator/</p>

<p>If there is no config.php file in DOCUMENT_ROOT, add one with these lines.</p>

<pre>&lt;?php
$al_host = 'MYSQL HOST';
$al_user = 'MYSQL USER';
$al_password = 'MYSQL PASSWORD';
$al_db_name = 'DATABASE NAME';
define('HASH', 'THE TABLE PREFIX');
$al_type_mysql = 'mysql';
$editor = 'none';
?&gt;</pre>

<p>The tables prefix is visible with a software to view databases.</p>

<p>The prefix should not include the underscore.</p>
