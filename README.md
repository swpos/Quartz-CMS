# Quartz-CMS
Content Managing System

<p>Step 1</p>

<p>Extract and upload the zip files to the FTP.</p>

<p><span style="color:#5cb85c">Set the DOCUMENT_ROOT directory to the /Project/CMS folder (in the virtual host). Reload the apache.</span></p>

<p>Step 2</p>

<p>Open an SSH connection with command line interface.</p>

<p>Inside the folder of the composer.phar file, execute this command line:</p>

<pre><span style="color:null">php composer.phar install</span></pre>

<p>Step 3</p>

<p>Create a new database with a user and a password. Set all privileges to the new user on the new database.</p>

<p>Step 4</p>

<p>Set the DOCUMENT_ROOT files permissions to write mode.</p>

<p>Step 5</p>

<p>The installation will start by accessing www.website.com/INSTALL</p>

<p>Installation will display a step by step procedure.</p>

<p>Step 6</p>

<p>The admin section will be available at www.website.com/Administrator/</p>

<p>If there is no config.php file in Project/CMS/, add one with these lines.</p>

<pre>&lt;?php
$al_host = 'MYSQL HOST';
$al_user = 'MYSQL USER';
$al_password = 'MYSQL PASSWORD';
$al_db_name = 'DATABASE NAME';
$prefix_table = 'THE TABLE PREFIX';
$al_type_mysql = 'mysql';
$editor = 'none';
?&gt;</pre>

<p>The tables prefix is visible with a software to view databases.</p>

<p>The prefix should not include the underscore.</p>