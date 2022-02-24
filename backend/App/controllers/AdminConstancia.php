<?php
namespace App\controllers;
defined("APPPATH") OR die("Access denied");
//require dirname(__DIR__).'/../public/librerias/phpqrcode/qrlib.php';


use \Core\View;
use \Core\MasterDom;
use \App\controllers\ContenedorAdmin;
use \App\controllers\Mailer;
use \Core\Controller;
use \App\models\Constancia AS ConstanciaDao;
use \App\models\Usuario AS UsuarioDao;


class AdminConstancia extends Controller{


    private $_contenedor;

    function __construct(){
        parent::__construct();
        $this->_contenedor = new ContenedorAdmin;
        View::set('header',$this->_contenedor->header());
        View::set('footer',$this->_contenedor->footer());
    }

    public function getUsuario(){
      return $this->__usuario;
    }

    public function index() {

      $extraFooter =<<<html
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
      <script src = "http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
      <link rel="stylesheet" href="http://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" />
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
      <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready(function(){
          $('#constanciasAll').DataTable();
          
        });
      </script>
html;

// if($value['generada'] == 0){
//   $btn_qr =<<<html
//       <button  class="btn btn-outline-primary btn_qr" value="{$value['id_constancia']}"><span class="fa fa-qrcode" style="padding: 0px;"></span></button>
// html;
// }else{
//   $btn_qr = <<<html
//   <button  class="btn btn-outline-primary btn_ver" value="{$value['code']}" data-id="{$value['id_constancia']}"><span class="fa fa-qrcode"></span></button>
// html;
// }
      
      $usuarios = UsuarioDao::getAll();
      
          $constancias = ConstanciaDao::getByIdConst();

          $tabla= '';
          foreach ($constancias as $key => $value) {
             
            $status = $value['status'];
            if($status == 1)
            {
              $status = 'Active';
              $style = <<<html
              <span class="badge badge-pill badge-primary">         
html;
              if ($value['code'] == '') {
                $button_activate = <<<html
                <button  class="btn btn-outline-primary btn_qr" value="{$value['id_constancia']}"><span class="fa fa-qrcode" style="padding: 0px;"></span></button>
                <!--<button  class="btn btn-success btn_status" title="Activate" value="{$value['id_constancia']}" data-id-status="{$value['id_constancia']}" data-value-status="{$value['code']}" disabled><span><i class="fa fa-check"></i></span></button>-->
                <a href="{$value['ruta_constancia']}" title="Download" class="btn btn-primary d-none btn_download" id="btn-download{$value['id_constancia']}" data-id="{$value['id_constancia']}" data-value="{$value['code']}" target="_blank"><span class="fa fa-download"></span></a>  
                <a href="" class="btn btn-outline-success a_download d-none" id="a-download{$value['id_constancia']}">des</a>
html;
              } else {
              $button_activate = <<<html
                
                
                <a href="{$value['ruta_constancia']}" title="Download" class="btn btn-primary" id="btn-download{$value['id_constancia']}" data-id="{$value['id_constancia']}" data-value="{$value['code']}" download><span class="fa fa-download"></span></a>
                
html;
              }
            }
            else
            {
              $status = 'Inactive';
              $style = <<<html
              <span class="badge badge-pill badge-danger">         
html;
              $button_activate = <<<html
              <button  class="btn btn-success btn_status" title="Activate Constancy" value="{$value['id_constancia']}" data-id-status="{$value['id_constancia']}" data-value-status="{$value['code']}"><span><i class="fa fa-check"></i></span></button>
html;
            }

              $tabla.=<<<html
              
                  <tr>
                      <td><p class="text-sm text-secondary mb-0">{$value['nombre_user']} {$value['apellido_p']} {$value['apellido_m']}</p></td>
                      <td><p class="text-sm text-secondary mb-0">{$value['nombre']}</p></td>
                      <td><p class="text-sm text-secondary mb-0">{$value['fecha']}</p></td>
                      <td><p class="text-sm text-secondary mb-0">{$style}$status</span></p></td>
                      <td class="center" >
                         
                          {$button_activate}
                          
                      </td>
                  </tr>
  html;
          }

    
      View::set('tabla',$tabla);
      View::set('header',$this->_contenedor->header_constancy($extraHeader));
      View::set('footer',$this->_contenedor->footer($extraFooter));
      View::render("constancias_all");
    }

    public function Add(){

      $extraFooter =<<<html
      <script>
        $(document).ready(function(){
          $('#id_administrador').select2();
        });//fin del document.ready
      </script>
      html;
      //usuario
      //$tipo = 1;
      $usuarios = UsuarioDao::getUserWithoutConstancy();
        $option = '';
      foreach ($usuarios as $key => $value) {
        $option .=<<<html
        <option value="{$value['administrador_id']}">{$value['nombre']} {$value['apellido_m']} {$value['apellido_p']}</option>   
html;
      }



      
      View::set('header',$this->_contenedor->header_constancy($extraHeader));
      View::set('usuarios',$usuarios);
      View::set('option',$option);
      View::set('footer',$extraFooter);
      View::render("constancias_add");
    }

    public function constanciaAdd(){
      $constancia = new \stdClass();

      $id_administrador = MasterDom::getDataAll('id_administrador');
      $id_administrador = MasterDom::procesoAcentosNormal($id_administrador);
      $constancia->_id_administrador = $id_administrador;

      $nombre = MasterDom::getDataAll('nombre');
      $nombre = MasterDom::procesoAcentosNormal($nombre);
      $constancia->_nombre = $nombre;

      $code = MasterDom::getDataAll('code');
      $code = MasterDom::procesoAcentosNormal($code);
      $constancia->_code = $code;

      $ruta_constancia = MasterDom::getDataAll('ruta_constancia');
      $ruta_constancia = MasterDom::procesoAcentosNormal($ruta_constancia);
      $constancia->_ruta_constancia = $ruta_constancia;

      $ruta_qr = MasterDom::getDataAll('ruta_qr');
      $ruta_qr = MasterDom::procesoAcentosNormal($ruta_qr);
      $constancia->_ruta_qr = $ruta_qr;

      $constancias = ConstanciaDao::getByIdConst();

      $tabla= '';
      foreach ($constancias as $key => $value) {
          
        $status = $value['status'];
        if($status == 1)
        {
          $status = 'Activo';
        }
        else
        {
          $status = 'Inactivo';
        }

          $tabla.=<<<html
              <tr>
                  
                  <td>{$value['nombre_user']}</td>
                  <td>{$value['nombre']}</td>
                  <td>{$value['fecha']}</td>
                  <td>$status</td>
                  <td class="center" >
                      <!--<a href="/Accidentes/Edit/{$value['id_accidente']}" {$editarHidden} type="submit" name="id" class="btn btn-primary"><span class="fa fa-pencil-square-o" style="color:white"> edit</span> </a>-->
                      <button  class="btn btn-success btn_status" title="Activate" value="{$value['id_constancia']}" data-id-status="{$value['id_constancia']}" data-value-status="{$value['code']}" disabled><span><i class="fa fa-check"></i></span></button>
                      <a href="{$value['ruta_constancia']}" title="Download" class="btn btn-primary btn_download" id="btn-download{$value['id_constancia']}" data-id="{$value['id_constancia']}" data-value="{$value['code']}" ><span class="fa fa-download"></span></a>
                      <a href="{$value['ruta_constancia']}" class="btn btn-outline-success a_download d-none" id="a-download{$value['id_constancia']}" download>des</a>  
                  </td>
              </tr>
  html;
          }


      

      $id = ConstanciaDao::insert($constancia);
      if($id >= 1){
        //$this->alerta($id,'add');
        $alerta =<<<html

        <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="badge-danger close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                Certificate has Generate
            </div>
html;
      }else{
        //$this->alerta($id,'error');
        $alerta =<<<html

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="badge-danger close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            A problem has ocurred with the Certificate
        </div>
html;
      }

      // View::set('alerta',$alerta);
      // View::set('tabla',$tabla);
      // View::set('header',$this->_contenedor->header_constancy($extraHeader));
      // View::set('footer',$this->_contenedor->footer($extraFooter));
      // View::render("constancias_all");
      header("location: /AdminConstancia/");
    }

    public function alerta($id, $parametro){
      $regreso = "/AdminConstancia/";

      if($parametro == 'add'){
        $mensaje = "Se ha agregado correctamente";
        $class = "success";
      }

      if($parametro == 'edit'){
        $mensaje = "Se ha modificado correctamente";
        $class = "success";
      }

      if($parametro == 'delete'){
        $mensaje = "Se ha eliminado la empresa {$id}, ya que cambiaste el estatus a eliminado";
        $class = "success";
      }

      if($parametro == 'nothing'){
        $mensaje = "Posibles errores: <li>No intentaste actualizar ningún campo</li> <li>Este dato ya esta registrado, comunicate con soporte técnico</li> ";
        $class = "warning";
      }

      if($parametro == 'no_cambios'){
        $mensaje = "No intentaste actualizar ningún campo";
        $class = "warning";
      }

      if($parametro == 'union'){
        $mensaje = "Al parecer este campo de está ha sido enlazada con un campo de Catálogo de Colaboradores, ya que esta usuando esta información";
        $class = "info";
      }

      if($parametro == "error"){
        $mensaje = "Al parecer ha ocurrido un problema";
        $class = "danger";
      }


      View::set('class',$class);
      View::set('regreso',$regreso);
      View::set('mensaje',$mensaje);
      // View::set('header',$this->_contenedor->header($extraHeader));
      // View::set('footer',$this->_contenedor->footer($extraFooter));
      View::render("alerta");
    }

    public function updateStatus(){

      $id_constancia = $_POST['id_constancia'];
      
      $documento = new \stdClass();
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //$documento->_status = $src;
        $documento->_id_constancia = $id_constancia;
        
        
        
        $id = ConstanciaDao::updateStatus($documento);

        if ($id) {
         
            $data = [
                'status' => 'success'
            ];
            //echo 'success';

        } else {
            $data = [
                'status' => 'fail'
                
            ];
            //echo 'fail';
        }
    } else {
        $data = [
            'status' => 'fail REQUEST'
            
        ];
       
    }
 
     echo json_encode($data);
    }
}


