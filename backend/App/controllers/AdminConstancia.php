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
      
      $usuarios = UsuarioDao::getAll();
      $extraFooter =<<<html
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
      <script src = "http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
      <link rel="stylesheet" href="http://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" />
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
      <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script>
        $(document).ready(function(){
          $('#usera').DataTable();
          $("#muestra-cupones").tablesorter();
          var oTable = $('#muestra-cupones').DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }],
                 "order": false
            });

            // Remove accented character from search input as well
            $('#muestra-cupones input[type=search]').keyup( function () {
                var table = $('#example').DataTable();
                table.search(
                    jQuery.fn.DataTable.ext.type.search.html(this.value)
                ).draw();
            });

            var checkAll = 0;
            $("#checkAll").click(function () {
              if(checkAll==0){
                $("input:checkbox").prop('checked', true);
                checkAll = 1;
              }else{
                $("input:checkbox").prop('checked', false);
                checkAll = 0;
              }

            });


            $("#export_pdf").click(function(){
              $('#all').attr('action', '/Empresa/generarPDF/');
              $('#all').attr('target', '_blank');
              $("#all").submit();
            });

            $("#export_excel").click(function(){
              $('#all').attr('action', '/Empresa/generarExcel/');
              $('#all').attr('target', '_blank');
              $("#all").submit();
            });

            $("#delete").click(function(){
              var seleccionados = $("input[name='borrar[]']:checked").length;
              if(seleccionados>0){
                alertify.confirm('¿Segúro que desea eliminar lo seleccionado?', function(response){
                  if(response){
                    $('#all').attr('target', '');
                    $('#all').attr('action', '/Empresa/delete');
                    $("#all").submit();
                    alertify.success("Se ha eliminado correctamente");
                  }
                });
              }else{
                alertify.confirm('Selecciona al menos uno para eliminar');
              }
            });

        });
      </script>
html;
        
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
              $button_activate = <<<html
              <!--<a href="/Accidentes/Edit/{$value['id_accidente']}" {$editarHidden} type="submit" name="id" class="btn btn-primary"><span class="fa fa-pencil-square-o" style="color:white"> edit</span> </a>-->
              <button  class="btn btn-success btn_status" title="Activate" value="{$value['id_constancia']}" data-id-status="{$value['id_constancia']}" data-value-status="{$value['code']}" disabled><span><i class="fa fa-check"></i></span></button>
              <a href="{$value['ruta_constancia']}" title="Download" class="btn btn-primary btn_download" id="btn-download{$value['id_constancia']}" data-id="{$value['id_constancia']}" data-value="{$value['code']}"><span class="fa fa-download"></span></a>
              <a href="{$value['ruta_constancia']}" class="btn btn-outline-success a_download d-none" id="a-download{$value['id_constancia']}" download>des</a>  
          html;
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
          $.validator.addMethod("verificarRFC",
            function(value, element) {
              var result = false;
              $.ajax({
                type:"POST",
                async: false,
                url: "/Empresa/validarRFC", // script to validate in server side
                data: {
                    nombre: function() {
                      return $("#rfc").val();
                    }},
                success: function(data) {
                    console.log("success::: " + data);
                    result = (data == "true") ? false : true;
                    if(result == true){
                      $('#availability').html('<span class="text-success glyphicon glyphicon-ok"></span><span> Nombre disponible</span>');
                      $('#register').attr("disabled", true);
                    }else{
                      $('#availability').html('<span class="text-danger glyphicon glyphicon-remove"></span>');
                      $('#register').attr("disabled", false);
                    }
                }
              });
              // return true if username is exist in database
              return result;
              },
              "<li>¡Este nombre ya está en uso. Intenta con otro!</li><li> Si no es visible en la tabla inicial, contacta a soporte técnico</li>"
          );
          $("#add").validate({
            rules:{
              rfc:{
               required: true,
               verificarRFC: true
              },
              razon_social:{
                required: true
              },
              email:{
                required: true
              },
              telefono_uno:{
                required: true
              },
              telefono_dos:{
                required: true
              },
              domicilio_fiscal:{
                required: true
              },
              sitio_web:{
                required: true
              }
            },
            messages:{
              rfc:{
                required: "Este campo es requerido",
                minlength: "Este campo debe tener minimo 13 caracteres"
              },
              razon_social:{
                required: "Este campo es requerido",
                minlength: "Este campo debe tener minimo 5 caracteres"
              },
              email:{
                required: "Este campo es requerido"
              },
              telefono_uno:{
                required: "Este campo es requerido"
              },
              telefono_dos:{
                required: "Este campo es requerido"
              },
              domicilio_fiscal:{
                required: "Este campo es requerido"
              },
              sitio_web:{
                required: "Este campo es requerido"
              }
            }
          });//fin del jquery validate

          $("#btnCancel").click(function(){
            window.location.href = "/Empresa/";
          });//fin del btnAdd

        });//fin del document.ready
      </script>
      html;

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
                      <button  class="btn btn-success btn_status" title="Activate" value="{$value['id_constancia']}" data-id-status="{$value['id_constancia']}" data-value-status="{$value['code']}" ><span><i class="fa fa-check"></i></span></button>
                      <a href="{$value['ruta_constancia']}" title="Download" class="btn btn-primary btn_download" id="btn-download{$value['id_constancia']}" data-id="{$value['id_constancia']}" data-value="{$value['code']}"><span class="fa fa-download"></span></a>
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
          
            <script>
              function redireccionar(){window.location="/AdminConstancia";}
              setTimeout ("redireccionar()", 1000);
            </script>
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

      View::set('alerta',$alerta);
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


