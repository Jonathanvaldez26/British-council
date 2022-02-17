<?php
namespace App\controllers;
defined("APPPATH") OR die("Access denied");

use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \Core\Controller;
use \App\models\Constancia AS ConstanciaDao;

class DatosConstancia{

    private $_contenedor;

    public function datos($code) {  
 

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
          <title>Home - BRITISH COUNCIL</title>
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
  html;
      
      $constancias = ConstanciaDao::getByCodeData($code);

      $pdf_constancia =<<<html

      <h1 id="data_name">Name:
      {$constancias[0]['nombre']} {$constancias[0]['apellido_p']} {$constancias[0]['apellido_m']}
      <br>Event: BBELT 2022
      </h1>

      <!-- div class="card p-3">
            <div class="card-body d-flex flex-column justify-content-center text-center">
        
              <iframe src="/PDF/{$constancias[0]['ruta_constancia']}" style="width:100%; height:460px;" frameborder="0" >
              </iframe>
            </div>
      </div 
html;
  
      //var_dump($constancias);
        
     // $data = $_GET['user'];
       //echo $code; 

      View::set('header',$extraHeader);
      View::set('footer',$extraFooter);
      View::set('pdf_constancia',$pdf_constancia);
      View::set('data_constancia',$constancias[0]);
      View::render("datos_constancia");
    
    }   
    
  
}
