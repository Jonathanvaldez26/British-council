<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \App\interfaces\Crud;

class Login{

    public static function getById($usuario){
        
        $mysqli = Database::getInstance(true);
        $query =<<<sql
         SELECT * FROM utilerias_administradores WHERE usuario LIKE :usuario
sql;
        $params = array(
            ':usuario'=> $usuario->_usuario
        );

        return $mysqli->queryOne($query,$params);
    }

    public static function getUser($usuario){
        $mysqli = Database::getInstance(true);
        $query =<<<sql
        SELECT * FROM utilerias_administradores WHERE usuario = '$usuario'
sql;

        return $mysqli->queryAll($query);
    }

    public static function updateStatus($data){
        $mysqli = Database::getInstance(true);
        $query=<<<sql
        UPDATE utilerias_administradores SET
        status = :status
        WHERE usuario = :usuario
  sql;
          $parametros = array(
              ':status' => $data->_status,
              ':usuario' => $data->_usuario
          );
  
        $accion = new \stdClass();
        $accion->_sql= $query;
        $accion->_parametros = $parametros;
       
      return $mysqli->update($query, $parametros);
      }
}
