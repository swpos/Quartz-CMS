<?php

namespace CMS\Libraries\Classes\Container;

class Data {

    protected $db;

    public function __construct($container) {
		$this->db = $container->system_connexion->database();
    }

	public function setArrayInsert($array) {
		$table = array();
		foreach($array as $key => $value){
			$key = str_replace(':', '', $key);
			$table[$key] = "?";
		}
		return $table;
	}

	public function insertIntoDatabase($array, $table) {
		$arrayForInsert = $this->setArrayInsert($array);		
		$query = $this->db->createQueryBuilder()
		->insert($table)
		->values($arrayForInsert);
		$i = 0;
		foreach($array as $key => $value){
			$query->setParameter($i, $value);
			$i++;
		}
		$query->execute();
		return $this->db->lastInsertId();
	}

	public function updateDatabase($array_data, $array_where, $table) {		
		$query = $this->db->createQueryBuilder()->update($table, 't');
		foreach($array_data as $key => $value){
			$query->set('t.'.$key, '?');
		}
		if($array_where){
			$i = 0;
			foreach($array_where as $key => $value){
				if($i == 0){
					$query->where('t.'.$key.' = ?');
				}
				else {
					$query->andWhere('t.'.$key.' = ?');
				}
				$i++;
			}
		}
		$j = 0;
		foreach($array_data as $key => $value){
			$query->setParameter($j, $value);
			$j++;
		}
		if($array_where){
			foreach($array_where as $key => $value){
				$query->setParameter($j, $value);
				$j++;
			}
		}
		$query->execute();
	}

	public function deleteEntry($array_where, $table) {		
		$query = $this->db->createQueryBuilder()->delete($table);
		if($array_where){
			$i = 0;
			foreach($array_where as $key => $value){
				if($i > 0){
					$query->andWhere($key.' = ?');
				}
				else {
					$query->where($key.' = ?');
				}
				$i++;
			}
			$j = 0;
			foreach($array_where as $key => $value){
				$query->setParameter($j, $value);
				$j++;
			}
		}
		$query->execute();
	}
	
	public function getData($query) {		
		$query->setFetchMode(\PDO::FETCH_OBJ);
		$result = $query->fetchAll();
		
		if(count($result)==1){
			$result = $result[0];
		}

		return $result;
	}
}

?>