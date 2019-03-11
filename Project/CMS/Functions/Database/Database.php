<?php

namespace CMS\Functions\Database;

class Database {

    protected $al_db_name;
    protected $al_user;
    protected $al_password;
    protected $al_host;

    public function __construct($al_db_name, $al_user, $al_password, $al_host) {
        $this->al_db_name = $al_db_name;
        $this->al_user = $al_user;
        $this->al_password = $al_password;
        $this->al_host = $al_host;
    }

    public function database() {
        try {
			$config = new \Doctrine\DBAL\Configuration();
			$connectionParams = array(
				'dbname' => $this->al_db_name,
				'user' => $this->al_user,
				'password' => $this->al_password,
				'host' => $this->al_host,
				'driver' => 'pdo_mysql',
				'charset' => 'utf8',
			);
			$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
            return $conn;
			
        } catch (Exception $e) {
            echo "Connection à MySQL impossible : ", $e->getMessage();
            die();
        }
    }

}

?>