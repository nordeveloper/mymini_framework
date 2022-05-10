<?php
namespace Core;

use Jsonable;
use Arrayable;
use Core\DataBase;

abstract class Model extends DataBase implements Arrayable, Jsonable{

	protected static function getTableName(){
		
		$table = substr(strrchr(get_called_class(), "\\"), 1).'s';

		return strtolower($table);
	}


    public static function all(){
		
		$table = SELF::getTableName();

		$res = DataBase::Query("SELECT * FROM $table", get_called_class());

        return $res;
    }

    
    public static function find($id){
        
        if( !empty($id) && intval($id)>0){

			$table = SELF::getTableName();
			$sql = "SELECT * FROM $table WHERE id='$id'";

            $res = DataBase::Query($sql, get_called_class());

			return $res;
        }                
    }


    public static function Delete($id) {

        if( !empty($id) && intval($id)>0){

			$table = SELF::getTableName();
            $sql = "DELETE FROM $table WHERE id='$id'";
            DataBase::Query($sql, get_called_class());
			
            return true;
        }
	}


	public static function Update($data) {

		if( !empty($data) and intval($data->id)>0 ){

			$table = SELF::getTableName();

			$sets = '';
			foreach ($data as $column => $value) {
				$sets .= $sets ? ', ' : '';
				$sets .= "`$column` = '$value'";			
			}

			$id = $data->id;
			$sql = "UPDATE $table SET $sets WHERE id='$id'";
			$r = DataBase::query($sql);
			return $r;
		}
	}

	
	public static function Insert($data) {

		$table = SELF::getTableName();

		$columns 	= "";
		$values 	= "";

		foreach ($data as $column => $value) {
			$columns 	.= $columns ? ', ' : '';
			$columns 	.= "`$column`";
			$values 	.= $values 	? ', ' : '';
			$values 	.= "'$value'";
		}

		$sql = "INSERT INTO $table ($columns) VALUES ($values)";
		$r = DataBase::insert($sql);

		return $r;		
	}


    public function save(){		

		if( !empty($this->id) and intval($this->id) > 0 ){
			
			return SELF::Update($this);

		}else{

			return SELF::Insert($this);
		}
    }


	public function toArray()
	{
		return (array) $this;
	}


	public function toJson($options = 0){

		return json_encode($this, JSON_UNESCAPED_UNICODE);
	}
	
}