<?php
namespace App\controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View;
use \Core\MasterDom;
use \App\controllers\Mailer;
use \App\models\Login AS LoginDao;


class Login{
    private $_contenedor;

    public function index() {
        
        $extraHeader =<<<html
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>BRITISH COUNCIL</title>
        <link rel="icon" href="../../assets_2/img/icono_bbelt.png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../assets_2/css/bootstrap.min.css">
        <!-- animate CSS -->
        <link rel="stylesheet" href="../../assets_2/css/animate.css">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="../../assets_2/css/owl.carousel.min.css">
        <!-- font awesome CSS -->
        <link rel="stylesheet" href="../../assets_2/css/all.css">
        <!-- flaticon CSS -->
        <link rel="stylesheet" href="../../assets_2/css/flaticon.css">
        <link rel="stylesheet" href="../../assets_2/css/themify-icons.css">
        <!-- font awesome CSS -->
        <link rel="stylesheet" href="../../assets_2/css/magnific-popup.css">
        <!-- swiper CSS -->
        <link rel="stylesheet" href="../../assets_2/css/slick.css">
        <!-- style CSS -->
        <link rel="stylesheet" href="../../assets_2/css/style.css">

        <!-- style CSS -->
        <link rel="stylesheet" href="../../assets_2/css/login.css">
html;
        $extraFooter =<<<html

        <!-- jquery plugins here-->
        <script src="../../assets_2/js/jquery-1.12.1.min.js"></script>
        <!-- popper js -->
        <script src="../../assets_2/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="../../assets_2/js/bootstrap.min.js"></script>
        <!-- easing js -->
        <script src="../../assets_2/js/jquery.magnific-popup.js"></script>
        <!-- swiper js -->
        <script src="../../assets_2/js/swiper.min.js"></script>
        <!-- swiper js -->
        <script src="../../assets_2/js/mixitup.min.js"></script>
        <!-- particles js -->
        <script src="../../assets_2/js/owl.carousel.min.js"></script>
        <script src="../../assets_2/js/jquery.nice-select.min.js"></script>
        <!-- slick js -->
        <script src="../../assets_2/js/slick.min.js"></script>
        <script src="../../assets_2/js/jquery.counterup.min.js"></script>
        <script src="../../assets_2/js/waypoints.min.js"></script>
        <script src="../../assets_2/js/contact.js"></script>
        <script src="../../assets_2/js/jquery.ajaxchimp.min.js"></script>
        <script src="../../assets_2/js/jquery.form.js"></script>
        <script src="../../assets_2/js/jquery.validate.min.js"></script>
        <script src="../../assets_2/js/mail-script.js"></script>
        <!-- custom js -->
        <script src="../../assets_2/js/custom.js"></script>
        <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
          var options = {
            damping: '0.5'
          }
          Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>

      

        <script>
            $(document).ready(function(){
                $.validator.addMethod("checkUserName",function(value, element) {
                  var response = false;
                    $.ajax({
                        type:"POST",
                        async: false,
                        url: "/Login/isUserValidate",
                        data: {usuario: $("#usuario").val()},
                        success: function(data) {
                            if(data=="true"){
                                $('#btnEntrar').attr("disabled", false);
                                response = true;
                            }else{
                                $('#btnEntrar').attr("disabled", true);
                            }
                        }
                    });

                    return response;
                },"                This user is not registered");

                $("#login").validate({
                   rules:{
                        usuario:{
                            required: true,
                            checkUserName: true
                        },
                        password:{
                            required: true,
                        }
                    },
                    messages:{
                        usuario:{
                            required: "Este campo es requerido",
                        },
                        password:{
                            required: "Este campo es requerido",
                        }
                    }
                });

                $("#btnEntrar").click(function(){
                    $.ajax({
                        type: "POST",
                        url: "/Login/verificarUsuario",
                        data: $("#login").serialize(),
                        success: function(response){
                            if(response!=""){
                                var usuario = jQuery.parseJSON(response);
                                if(usuario.nombre!=""){
                                    $("#login").append('<input type="hidden" name="autentication" id="autentication" value="OK"/>');
                                    $("#login").append('<input type="hidden" name="nombre" id="nombre" value="'+usuario.nombre+'"/>');
                                    $("#login").submit();
                            }else{
                                alertify.alert("Error de autenticación <br> El usuario o contraseña es incorrecta");
                            }
                            }else{
                                alertify.alert("Error de autenticación <br> El usuario o contraseña es incorrecta");
                            }
                        }
                    });
                });
            });    

        </script>

        
html;
 
        View::set('header',$extraHeader);
        View::set('footer',$extraFooter);
        View::render("login");
    }

    public function isUserValidate(){
        echo (count(LoginDao::getUser($_POST['usuario']))>=1)? 'true' : 'false';
    }

    public function verificarUsuario(){
        $usuario = new \stdClass();
        $usuario->_usuario = MasterDom::getData("usuario");
        $usuario->_password = MD5(MasterDom::getData("password"));
        $user = LoginDao::getById($usuario);
        if (count($user)>=1) {
            $user['nombre'] = utf8_encode($user['nombre']);
            echo json_encode($user);
        }
    }

    public function crearSession(){
        $usuario = new \stdClass();
        $usuario->_usuario = MasterDom::getData("usuario");
        $user = LoginDao::getById($usuario);
        session_start();
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['administrador_id'] = $user['administrador_id'];
        header("location: /Home/");
    }

    public function cerrarSession(){
        //unset($_SESSION);
        session_start();
        //session_unset();
        session_destroy();
        header("Location: /Login/");
    }

    public function validarDatos(){
        $extraHeader =<<<html
        <style>
          .logo{
            width:100%;
            height:150px;
            margin: 0px;
            padding: 0px;
          }
        </style>
        <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>Login - BRITISH COUNCIL</title>
          <link rel="icon" href="../../assets_2/img/icono_bbelt.png">
          <link rel="icon" type="image/vnd.microsoft.icon" href="/img/icono_bbelt.png">
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="../../assets_2/css/bootstrap.min.css">
          <!-- animate CSS -->
          <link rel="stylesheet" href="../../assets_2/css/animate.css">
          <!-- owl carousel CSS -->
          <link rel="stylesheet" href="../../assets_2/css/owl.carousel.min.css">
          <!-- font awesome CSS -->
          <link rel="stylesheet" href="../../assets_2/css/all.css">
          <!-- flaticon CSS -->
          <link rel="stylesheet" href="../../assets_2/css/flaticon.css">
          <link rel="stylesheet" href="../../assets_2/css/themify-icons.css">
          <!-- font awesome CSS -->
          <link rel="stylesheet" href="../../assets_2/css/magnific-popup.css">
          <!-- swiper CSS -->
          <link rel="stylesheet" href="../../assets_2/css/slick.css">
          <!-- style CSS -->
          <link rel="stylesheet" href="../../assets_2/css/style.css">
  
          <!-- style CSS -->
          <link rel="stylesheet" href="../../assets_2/css/home.css">
  html;
  
          $extraFooter=<<<html
          <!-- jquery plugins here-->
          <script src="../../assets_2/js/jquery-1.12.1.min.js"></script>
          <!-- popper js -->
          <script src="../../assets_2/js/popper.min.js"></script>
          <!-- bootstrap js -->
          <script src="../../assets_2/js/bootstrap.min.js"></script>
          <!-- easing js -->
          <script src="../../assets_2/js/jquery.magnific-popup.js"></script>
          <!-- swiper js -->
          <script src="../../assets_2/js/swiper.min.js"></script>
          <!-- swiper js -->
          <script src="../../assets_2/js/mixitup.min.js"></script>
          <!-- particles js -->
          <script src="../../assets_2/js/owl.carousel.min.js"></script>
          <script src="../../assets_2/js/jquery.nice-select.min.js"></script>
          <!-- slick js -->
          <script src="../../assets_2/js/slick.min.js"></script>
          <script src="../../assets_2/js/jquery.counterup.min.js"></script>
          <script src="../../assets_2/js/waypoints.min.js"></script>
          <script src="../../assets_2/js/contact.js"></script>
          <script src="../../assets_2/js/jquery.ajaxchimp.min.js"></script>
          <script src="../../assets_2/js/jquery.form.js"></script>
          <script src="../../assets_2/js/jquery.validate.min.js"></script>
          <script src="../../assets_2/js/mail-script.js"></script>
          <!-- custom js -->
          <script src="../../assets_2/js/custom.js"></script>
        
        <script src="/js/jquery.min.js"></script>
        <script src="/js/validate/jquery.validate.js"></script>
        <script src="/js/alertify/alertify.min.js"></script>
        <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        <script src="/assets/js/core/popper.min.js"></script>
        <script src="/assets/js/core/bootstrap.min.js"></script>
        <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
        <!-- Kanban scripts -->
        <script src="/assets/js/plugins/dragula/dragula.min.js"></script>
        <script src="/assets/js/plugins/jkanban/jkanban.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
         
html;
        $usuario = new \stdClass();
        $usuario->_usuario = MasterDom::getData("usuario");
        $user = LoginDao::getById($usuario);
        
        if($user['status'] == 1){
            session_start();
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['administrador_id'] = $user['administrador_id'];
            header("location: /Home/");

        }elseif(count($user) <= 0){
            $alerta =<<<html

            <div class="alert alert-warning" role="alert">
                It seems that you are not registered, check your user
            </div>
html;
            View::set('alerta',$alerta);
            View::set('header',$extraHeader);
            View::set('footer',$extraFooter);
            View::render("login");
        }
        else{
            View::set('header',$extraHeader);
            View::set('footer',$extraFooter);
            View::set('usuario',$user);
            View::render("account_all");
        }
    }

    public function updateStatus(){
        $documento = new \stdClass();
      

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $nombre = $_POST['name_'];
          $email = $_POST['email_'];
          $documento->_nombre = $nombre;
          $documento->_usuario = $email;
          $documento->_status = 1;

          $id = LoginDao::updateStatus($documento);

          if ($id) {
              echo 'success';

          } else {
              echo 'fail';
          }
      } else {
          echo 'fail REQUEST';
      }
    }

    public function enviarMailValidate(){
        $userData =  new \stdClass();
        $usuario =  $_POST['usuario'];
     
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $userData->_usuario = $usuario;

        $user = LoginDao::getById($userData);
        $mailer = new Mailer();
        $mailer->mailerValidateData($user);
        } else {
            echo 'fail REQUEST';
        }
    }

}
