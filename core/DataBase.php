<?php
namespace Core;

use mysqli;

class DataBase
{
    private static $instance;

//   private $dbhost;
//   private $dbuser;
//   private $dbpass;
//   private $dbnane;
 
    /**
     * Singleton pattern
    */
    public static function getInstance()
    {
        if (!isset(DataBase::$instance)) {
            self::connect(DBCONFIG);
        }
 
        return DataBase::$instance;
    }
   
 
    /**
     * DB connection
     */
    public static function connect(array $db)
    {
        //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli($db['host'], $db['dbuser'], $db['dbpass'], $db['dbname']);
 
        if (!$mysqli->connect_error) {
            DataBase::$instance = $mysqli;
        }
 
        return $mysqli;
    }


    /**
     * DB query
    */
    public static function query($query, $modelname=NULL)
    {

        $dbres  = self::getInstance()->query($query);

        if(!empty($dbres->num_rows) and $dbres->num_rows > 1){

            while( $row = $dbres->fetch_object() ){
                $res[] = $row;               
            }
            
            return $res;

        }else if( !empty($dbres->num_rows) and $dbres->num_rows==1 ) {

            if( $obj = $dbres->fetch_object($modelname) ){

               return $obj;
            }
        }
      
    }
    

    /**
     * DB insert
    */
    public static function insert($query)
    {
        $dbres  = self::getInstance()->query($query);

        return $dbres;
    }

}