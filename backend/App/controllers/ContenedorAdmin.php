<?php
namespace App\controllers;
defined("APPPATH") OR die("Access denied");

use \App\models\General AS GeneralDao;
use \Core\Controller;

require_once dirname(__DIR__).'/../public/librerias/mpdf/mpdf.php';
require_once dirname(__DIR__).'/../public/librerias/phpexcel/Classes/PHPExcel.php';
require_once dirname(__DIR__).'/../public/librerias/phpqrcode/qrlib.php';

class ContenedorAdmin extends Controller{


    function __construct(){
      parent::__construct();
    }

    public function getUsuario(){
      return $this->__usuario;
    }

    public function header($extra = ''){
     $usuario = $this->__usuario;
      
     $header =<<<html
     <!DOCTYPE html>
         <html lang="en">
           <head>
             <meta charset="utf-8" />
             <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
             <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icono_bbelt.png">
             <link rel="icon" href="../../assets_2/img/icono_bbelt.png">
             <title>
                Users - British Council
             </title>
             <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
             <!-- Nucleo Icons -->
             <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
             <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
             <!-- Font Awesome Icons -->
             <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
             <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
             <!-- CSS Files -->
             <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
             <!-- TEMPLATE VIEJO-->
             <link rel="stylesheet" href="/css/alertify/alertify.core.css" />
             <link rel="stylesheet" href="http://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
             <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" />
             <link rel="stylesheet" href="/css/alertify/alertify.default.css" id="toggleCSS" />
 
 
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
             
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <script src = "http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer ></script>
             <!-- TEMPLATE VIEJO-->
         </head>
html;
$menu =<<<html
<body class="g-sidenav-show  bg-gray-100">
   <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
     <div class="sidenav-header">
       <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
       <a class="navbar-brand m-0" href="/Principal/">
         <img src="../../assets_2/img/icono_bbelt.png" class="navbar-brand-img h-100" alt="main_logo">
         <span class="ms-1 font-weight-bold">British Council</span>
       </a>
     </div>
     <hr class="horizontal dark mt-0">
 
 
     <div class="collapse navbar-collapse  w-auto h-auto h-100" id="sidenav-collapse-main">
       <ul class="navbar-nav">
         <!--<li class="nav-item">
           <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link active" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
             <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
               <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                 <title>shop </title>
                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                   <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                     <g transform="translate(1716.000000, 291.000000)">
                       <g transform="translate(0.000000, 148.000000)">
                         <path class="color-background" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z" opacity="0.598981585"></path>
                         <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                       </g>
                     </g>
                   </g>
                 </g>
               </svg>
             </div>
             <span class="nav-link-text ms-1">Home</span>
           </a>
           <div class="collapse  show " id="dashboardsExamples">
             <ul class="nav ms-4 ps-3">
               <li class="nav-item active">
                 <a class="nav-link active" href="/AdminHome/">
                   <span class="sidenav-mini-icon"> P </span>
                   <span class="sidenav-normal"> Principal </span>
                 </a>
               </li>
             </ul>
           </div>
         </li>-->

         <style>
            #change:hover{
              color: white; border-radius: 10px;
              background-color: #aaa;
              padding-right: 35px;
              box-shadow: 0px 0px 10px black;
            }
            
            #change{
              border-radius: 10px;
              padding-right: 35px;
            }

            #current-page{
              color: white; border-radius: 10px;
              box-shadow: 0px 0px 10px black;
              margin-bottom: 4%;
              padding-right: 35px;
            }

            #icon-page{
              margin-right: 10%;
              box-shadow: 0px 0px 10px #aaa;
              border-radius: 10px;
              padding: 10%;
              background: white;
              color: #aaa;
            }
         </style>
         
         <li class="nav-item mt-3">
           <!--h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CATÁLOGOS</h6 -->
         </li>
         <li class="nav-item">
           <div class="" id="pagesExamples">
             <ul class="nav ms-4 ps-3">
               <li class="">
               <a style="margin: 0;" data-bs-toggle="" href="/Usuarios/" class="nav-link active" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                <div style="color: white;" class="fa fa-user icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                  
                </div>
                <span class="nav-link-text ms-1">Users</span>
              </a>
               </li>
               <li>
                
               </li>
               <li class="">
               <a style="margin: 0;" data-bs-toggle="" href="/AdminConstancia/" class="nav-link " aria-controls="pagesExamples" role="button" aria-expanded="false">
                <div style="color: #24085E;" class="fa fa-certificate icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                  
                </div>
                <span class="nav-link-text ms-1">Constancy</span>
             </a>
               </li>
               
               
         </ul>
     </div>
    
   </aside>
   
 </body>
 
html;

    return $header.$extra.$menu;
    }

    public function header_constancy($extra = ''){
      $usuario = $this->__usuario;
       
      $header =<<<html
         <!DOCTYPE html>
         <html lang="en">
           <head>
             <meta charset="utf-8" />
             <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
             <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icono_bbelt.png">
             <link rel="icon" href="../../assets_2/img/icono_bbelt.png">
             <title>
              Constancy - British Council
             </title>
             <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
             <!-- Nucleo Icons -->
             <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
             <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
             <!-- Font Awesome Icons -->
             <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
             <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
             <!-- CSS Files -->
             <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
             <!-- TEMPLATE VIEJO-->
             <link rel="stylesheet" href="/css/alertify/alertify.core.css" />
             <link rel="stylesheet" href="http://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
             <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" />
             <link rel="stylesheet" href="/css/alertify/alertify.default.css" id="toggleCSS" />
 
 
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
             
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <script src = "http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer ></script>
             <!-- TEMPLATE VIEJO-->
         </head>
 html;
 $menu =<<<html
 <body class="g-sidenav-show  bg-gray-100">
   <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
     <div class="sidenav-header">
       <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
       <a class="navbar-brand m-0" href="/Principal/">
         <img src="../../assets_2/img/icono_bbelt.png" class="navbar-brand-img h-100" alt="main_logo">
         <span class="ms-1 font-weight-bold">British Council</span>
       </a>
     </div>
     <hr class="horizontal dark mt-0">
 
 
     <div class="collapse navbar-collapse  w-auto h-auto h-100" id="sidenav-collapse-main">
       <ul class="navbar-nav">
         <style>
            #change:hover{
              color: white; border-radius: 10px;
              background-color: #aaa;
              padding-right: 35px;
              box-shadow: 0px 0px 10px black;
            }
            
            #change{
              border-radius: 10px;
              padding-right: 35px;
            }

            #current-page{
              color: white; border-radius: 10px;
              box-shadow: 0px 0px 10px black;
              margin-bottom: 4%;
              padding-right: 35px;
            }

            #icon-page{
              margin-right: 10%;
              box-shadow: 0px 0px 10px #aaa;
              border-radius: 10px;
              padding: 10%;
              background: white;
              color: #aaa;
            }
         </style>
         
         <li class="nav-item mt-3">
           <!--h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CATÁLOGOS</h6 -->
         </li>
         <li class="nav-item">
           <div class="" id="pagesExamples">
             <ul class="nav ms-4 ps-3">
                <li class="">
                <a style="margin: 0;" data-bs-toggle="" href="/Usuarios/" class="nav-link " aria-controls="pagesExamples" role="button" aria-expanded="false">
                    <div style="color: #24085E;" class="fa fa-user icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                    
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                  </a>
                </li>
               <li class="m-0">
               <a style="margin: 0;" data-bs-toggle="" href="/AdminConstancia/" class="nav-link active" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                <div style="color: #fff;" class="fa fa-certificate icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                  
                </div>
                <span class="nav-link-text ms-1">Constancy</span>
              </a>
               </li>
               <li>
                
               </li>
               
               
               
         </ul>
     </div>
    
   </aside>
   
 </body>
 html;
 
     return $header.$extra.$menu;
     }

    public function footer($extra = ''){
        $footer =<<<html

        <footer class="footer pt-0" style="position: fixed;
        width: -webkit-fill-available;
        bottom: 0px;
        margin-top: 20px;
        z-index: -1;">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="www.grupolahe.com">Creative GRUPO LAHE</a>.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">privacy policies</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
<!-- jQuery -->
        <script src="/js/jquery.min.js"></script>
        <!--   Core JS Files   -->
        <script src="/assets/js/core/popper.min.js"></script>
        <script src="/assets/js/core/bootstrap.min.js"></script>
        <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
        <!-- Kanban scripts -->
        <script src="/assets/js/plugins/dragula/dragula.min.js"></script>
        <script src="/assets/js/plugins/jkanban/jkanban.js"></script>
        <script src="/assets/js/plugins/chartjs.min.js"></script>
        <script src="/assets/js/plugins/threejs.js"></script>
        <script src="/assets/js/plugins/orbit-controls.js"></script>
        
      <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
      <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="/assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>


        <!-- VIEJO INICIO -->
        <script src="/js/jquery.min.js"></script>
       
        <script src="/js/custom.min.js"></script>

        <script src="/js/validate/jquery.validate.js"></script>
        <script src="/js/alertify/alertify.min.js"></script>
        <script src="/js/login.js"></script>
        <!-- VIEJO FIN -->

        <script>
        $(document).ready( function () {
          // $('#constanciasAll').DataTable();
          $('#userAll').DataTable( {
            "drawCallback": function( settings ) {
                 $('.current').addClass("btn btn-info").removeClass("paginate_button");
                 $('.dataTables_length').addClass("m-4");
                 $('.dataTables_filter').addClass("m-4");
                 $('input').addClass("form-control");
                 $('select').addClass("form-control");
            }
          });
          
          $('#constanciasAll').DataTable( {
            "drawCallback": function( settings ) {
                 $('.current').addClass("btn btn-info").removeClass("paginate_button");
                 $('.dataTables_length').addClass("m-4");
                 $('.dataTables_filter').addClass("m-4");
                 $('input').addClass("form-control");
                 $('select').addClass("form-control");
            }
          });
        });
        </script>
html;

    return $footer.$extra;
    }

}
