<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \Core\MasterDom;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class Usuario implements Crud{

    public static function getAll(){
      $mysqli = Database::getInstance();
      $query=<<<sql
        SELECT administrador_id, nombre, apellido_p, apellido_m, usuario, tipo, status FROM utilerias_administradores ORDER BY administrador_id ASC;
      sql;
      return $mysqli->queryAll($query);
    }

    public static function getUserWithoutConstancy(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * from `utilerias_administradores` ua WHERE ua.administrador_id NOT IN (select id_administrador from `constancia`) ORDER BY ua.administrador_id ASC;
sql;
      return $mysqli->queryAll($query);
    }

    public static function insert($usuario){
	    $mysqli = Database::getInstance(1);
      $query=<<<sql
        INSERT INTO utilerias_administradores VALUES(null, :nombre, :apellido_p, :apellido_m, :usuario, :contrasena, 1, :tipo)
sql;
        $parametros = array(
          ':nombre'=>$usuario->_nombre,
          ':apellido_p'=>$usuario->_apellido_p,
          ':apellido_m'=>$usuario->_apellido_m,
          ':usuario'=>$usuario->_usuario,
          'contrasena'=>$usuario->_contrasena,
          'tipo'=>$usuario->_tipo
        );

        $id = $mysqli->insert($query,$parametros);
        $accion = new \stdClass();
        $accion->_sql= $query;
        $accion->_parametros = $parametros;
        $accion->_id = $id;

        // UtileriasLog::addAccion($accion);
        return $id;
    }

    public static function update($user){

      $mysqli = Database::getInstance(1);
      $query=<<<sql
      UPDATE utilerias_administradores SET nombre = :nombre, apellido_p = :apellido_p, apellido_m = :apellido_m, usuario = :usuario WHERE administrador_id = :administrador_id
sql;
      $parametros = array(
        'nombre'=>$user->_nombre,
        'apellido_p'=>$user->_apellido_p,
        'apellido_m'=>$user->_apellido_m,
        'usuario'=>$user->_user,
        'administrador_id' => $user->_administrador_id
      );

      $accion = new \stdClass();
      $accion->_sql= $query;
      $accion->_parametros = $parametros;
      //$accion->_id = $user->_administrador_id;
      // UtileriasLog::addAccion($accion);
        return $mysqli->update($query, $parametros);
    }

    public static function delete($id){
      $mysqli = Database::getInstance();
      $select = <<<sql
      SELECT e.catalogo_empresa_id FROM catalogo_empresa e WHERE e.catalogo_empresa_id = $id
sql;

      $sqlSelect = $mysqli->queryAll($select);
      if(count($sqlSelect) >= 1){
        return array('seccion'=>2, 'id'=>$id); // NO elimina
      }else{
        $query = <<<sql
        UPDATE catalogo_empresa SET status = 2 WHERE catalogo_empresa.catalogo_empresa_id = $id;
sql;
        $mysqli->update($query);

        $accion = new \stdClass();
        $accion->_sql= $query;
        $accion->_parametros = $parametros;
        $accion->_id = $id;
        // UtileriasLog::addAccion($accion);
        return array('seccion'=>1, 'id'=>$id); // Cambia el status a eliminado
      }
    }

    public static function verificarRelacion($id){
      $mysqli = Database::getInstance();
      $select = <<<sql
      SELECT e.catalogo_empresa_id FROM catalogo_empresa e JOIN catalogo_colaboradores c
      ON e.catalogo_empresa_id = c.catalogo_empresa_id WHERE e.catalogo_empresa_id = $id
sql;
      $sqlSelect = $mysqli->queryAll($select);
      if(count($sqlSelect) >= 1)
        return array('seccion'=>2, 'id'=>$id); // NO elimina
      else
        return array('seccion'=>1, 'id'=>$id); // Cambia el status a eliminado
      
    }

    public static function getById($id){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT administrador_id, nombre, apellido_p, apellido_m, usuario, tipo, status FROM utilerias_administradores where administrador_id = $id;
      sql;
      return $mysqli->queryOne($query);
    }

    public static function getByIdReporte($id){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT e.catalogo_empresa_id, e.nombre, e.descripcion, e.status, s.nombre as status FROM catalogo_empresa e JOIN catalogo_status s ON s.catalogo_status_id = e.status WHERE e.status!=2 AND e.catalogo_empresa_id = $id
sql;

      return $mysqli->queryOne($query);
    }


    public static function getStatus(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * FROM catalogo_encargado
sql;
      return $mysqli->queryAll($query);
    }

    public static function getRFC($rfc_empresa){
      $mysqli = Database::getInstance();
      $query =<<<sql
      SELECT * FROM `catalogo_empresa` WHERE `rfc` LIKE '$rfc_empresa' 
sql;
      $dato = $mysqli->queryOne($query);
      return ($dato>=1) ? 1 : 2 ;
    }

    public static function getUser($user){
      $mysqli = Database::getInstance();
      $query =<<<sql
      SELECT * FROM utilerias_administradores WHERE usuario LIKE '$user' and
sql;
      $dato = $mysqli->queryOne($query);
      return ($dato>=1) ? 1 : 2 ;
    }

    public static function getIdComparacion($id, $nombre){
      $mysqli = Database::getInstance();
      $query =<<<sql
      SELECT * FROM catalogo_empresa WHERE catalogo_empresa_id = '$id' AND nombre Like '$nombre' 
sql;
      $dato = $mysqli->queryOne($query);
      // 0

      if($dato>=1){
        return 1;
      }else{
        return 2;
      }
    }
}
