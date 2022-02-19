<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \App\interfaces\Crud;

class Constancia{

  public static function getAll(){
    $mysqli = Database::getInstance();
    $query=<<<sql
    SELECT administrador_id, nombre, apellido_p, apellido_m, usuario, tipo, status FROM utilerias_administradores ORDER BY administrador_id ASC;
    sql;
    return $mysqli->queryAll($query);
  }

  public static function insert($empresa){
    $mysqli = Database::getInstance(1);
    $query=<<<sql
      INSERT INTO constancia VALUES(null, :id_administrador, :code, :nombre, NOW(), :ruta_constancia, :ruta_qr, 0, 0)
    sql;

    $parametros = array(
      ':id_administrador'=>$empresa->_id_administrador,
      ':code'=>$empresa->_code,
      ':nombre'=>$empresa->_nombre,
      // ':fecha'=>$empresa->_fecha,
      'ruta_constancia'=>$empresa->_ruta_constancia,
      'ruta_qr'=>$empresa->_ruta_qr,
      // 'status'=>$empresa->_status
    );

    $id = $mysqli->insert($query,$parametros);
    $accion = new \stdClass();
    $accion->_sql= $query;
    $accion->_parametros = $parametros;
    $accion->_id = $id;

    return $id;
  }

  public static function getByIdAdmin($user){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT id_constancia, nombre, fecha, code, ruta_qr, ruta_constancia, generada FROM constancia where id_administrador = $user and status = '1';
      sql;
      return $mysqli->queryAll($query);
    }

    public static function getByIdConst(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT
      c.id_constancia,
      ua.nombre As nombre_user,
      ua.apellido_p,
      ua.apellido_m,
      c.code,
      c.nombre,
      c.fecha,
      c.ruta_constancia,
      c.ruta_qr,
      c.status
      FROM constancia AS c
      INNER JOIN utilerias_administradores ua ON ua.administrador_id = c.id_administrador ORDER BY c.id_constancia;
sql;
      return $mysqli->queryAll($query);
    }

    public static function getByCode($code){
      $mysqli = Database::getInstance();
      $query=<<<sql
SELECT c.id_constancia, c.nombre as nombre_constancia, c.fecha, c.ruta_qr, c.code, c.ruta_constancia, c.generada, ua.nombre, ua.apellido_p, ua.apellido_m
FROM constancia c 
INNER JOIN utilerias_administradores ua ON (ua.administrador_id = c.id_administrador)
WHERE c.code = '$code';

sql;
      return $mysqli->queryAll($query);
    }

    public static function getByCodeData($code){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * FROM constancia INNER JOIN utilerias_administradores ON id_administrador = administrador_id  WHERE code = '$code';

sql;
      return $mysqli->queryAll($query);
    }


    public static function updateQrRute($constancia){

      $mysqli = Database::getInstance(true);
      $query=<<<sql
      UPDATE constancia SET
      ruta_qr = :ruta_qr,
      code = :code,
      ruta_constancia = :ruta_constancia,
      generada = 1      
      WHERE id_constancia = :id_constancia
sql;
        $parametros = array(
            ':ruta_qr' => $constancia->_ruta_qr,
            ':code' => $constancia->_code,
            ':id_constancia' => $constancia->_id_constancia,
            ':ruta_constancia' => $constancia->_ruta_constancia
            
        );

      $accion = new \stdClass();
      $accion->_sql= $query;
      $accion->_parametros = $parametros;
     
    return $mysqli->update($query, $parametros);
    }

    public static function updateStatus($constancia){

      $mysqli = Database::getInstance(true);
      $query=<<<sql
      UPDATE constancia SET
      status = 1     
      WHERE id_constancia = :id_constancia
sql;
        $parametros = array(
            ':id_constancia' => $constancia->_id_constancia
        );

      $accion = new \stdClass();
      $accion->_sql= $query;
      $accion->_parametros = $parametros;
     
    return $mysqli->update($query, $parametros);
    }

}
