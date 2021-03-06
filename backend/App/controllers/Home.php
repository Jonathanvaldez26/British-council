<?php
namespace App\controllers;
defined("APPPATH") OR die("Access denied");
//require dirname(__DIR__).'/../public/librerias/phpqrcode/qrlib.php';


use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \App\controllers\Mailer;
use \App\models\Constancia as ConstanciaDao;
use \Core\Controller;


class Home extends Controller{
  

    private $_contenedor;

    function __construct(){
        parent::__construct();
        $this->_contenedor = new Contenedor;
        View::set('header',$this->_contenedor->header());
        View::set('footer',$this->_contenedor->footer());
    }

    public function getUsuario(){
      return $this->__usuario;
    }

    public function index() {
        $extraHeader =<<<html
        <style>
          .logo{
            width:100%;
            height:150px;
            margin: 0px;
            padding: 0px;
          }
         
        .btn_qr{
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
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  html;
            $administrador_id = $_SESSION['administrador_id'];
            $constancias = ConstanciaDao::getByIdAdmin($administrador_id);
        
            $tablaHead = '';
            $tabla= '';
            $status= '';
            $btn_qr ='';

        if($_SESSION['tipo'] == 3){
            
            $tablaHead.=<<<html

            <tr> 
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Conference</th>         
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Download</th>
            </tr>

html;                
        }else{
            $tablaHead.=<<<html

            <tr>     
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Download</th>
            </tr>

html;

        }
            
        foreach ($constancias as $key => $value) {

            if($value['generada'] == 0){
                $btn_qr =<<<html
                    <button  class="btn btn-outline-primary btn_qr" value="{$value['id_constancia']}"><span class="fa fa-qrcode" style="padding: 0px;"></span></button>
html;
            }else{
                $btn_qr = <<<html
                <button  class="btn btn-outline-primary btn_ver" value="{$value['code']}" data-id="{$value['id_constancia']}"><span class="fa fa-qrcode"></span></button>
html;
            }

            if($_SESSION['tipo'] == 3){

                $name_conference = $value['nombre_conferencia'] <> '' ? $value['nombre_conferencia'] : 'does not apply';


                $tabla.=<<<html
                <tr>
                <td><h6 class="mb-0 text-sm">{$name_conference}</h6></td>
                <td><h6 class="mb-0 text-sm">{$value['nombre']}</h6></td>
                <td><span class="text-secondary text-sm">{$value['fecha']}</span></td>
                <td class="center" >
                    
                    {$btn_qr}
                    <a href="" class="btn btn-outline-success d-none btn_download" id="btn-download{$value['id_constancia']}"><span class="fa fa-download"> Certificate</span></a>  
                    <a href="" class="btn btn-outline-success a_download d-none" id="a-download{$value['id_constancia']}">des</a>           
                </td>
                </tr>
html;

            }else{

                $tabla.=<<<html
                <tr>
                <td><h6 class="mb-0 text-sm">{$value['nombre']}</h6></td>
                <td><span class="text-secondary text-sm">{$value['fecha']}</span></td>
                <td class="center" >
                    <!--<button  class="btn btn-outline-primary btn_qr" value="{$value['id_constancia']}"><span class="fa fa-qrcode" style="padding: 0px;"> </span></button>-->
                    {$btn_qr}
                    <a href="" class="btn btn-outline-success d-none btn_download" id="btn-download{$value['id_constancia']}"><span class="fa fa-download"> Certificate</span></a>  
                    <a href="" class="btn btn-outline-success a_download d-none" id="a-download{$value['id_constancia']}">des</a>           
                </td>
                </tr>
html;
            }
            
           
        }
    
      
      View::set('header',$extraHeader);
      View::set('footer',$extraFooter);
      View::set('tabla',$tabla);
      View::set('tablaHead',$tablaHead);
      //View::set('imagen_qr',$imagen);
      View::render("home");
    }

    public function enviarEmail(){

      $code = $_POST['code'];
      $constancias = ConstanciaDao::getByCode($code);
      $mailer = new Mailer();
      $mailer->mailer($constancias[0]);

    }

    function generateRandomString($length = 10) { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    } 

    public function generarPDF($data){
    

      $ids = MasterDom::getDataAll('borrar');
      $mpdf=new \mPDF('c');
      $mpdf->defaultPageNumStyle = 'I';
      $mpdf->h2toc = array('H5'=>0,'H6'=>1);
     

      if(!empty($data['nombre_conferencia'])){
        $mpdf->SetDefaultBodyCSS('background', "url('/PDF/template/Certificados_Speaker.png')");  
        $length_name_conference = strlen($data['nombre_conferencia']);
        if($length_name_conference > 80){
            $margin_top_qr = '150px';
        }else{
            $margin_top_qr = '210px';
        }
        $style =<<<html
            <style>
            
                .titulo{
                width:100%;
                margin-top: 30px;
                color: #F5AA3C;
                margin-left:auto;
                margin-right:auto;
                }

                .imagen{

                    float: left;	
                    margin-top: {$margin_top_qr};
                    width: 100px;
                    height: 100px;
                }

                .spacer{
                    margin-left: 7px;
                    padding-top: 320px!important;
                    text-align: center;
            
                }
                .name{
                    font-family: Arial, Helvetica, sans-serif;
                    color: #4B3049;
                }
                .name_user{
                    margin-top:120px!important;
                }

                .name_constancy{
                    margin-top:70px!important;
                }

            </style>
html;
            $tabla =<<<html

                <div style="page-break-inside: avoid;" class='spacer' align='center'>
                <h1 class='name name_user'>{$data['nombre']} {$data['apellido_p']} {$data['apellido_m']}</h1>
                <h1 class='name name_constancy'>{$data['nombre_conferencia']}</h1>
                <img class="imagen " src="{$data['ruta_qr']}"/>
                </div>
html;
      }else{
        $mpdf->SetDefaultBodyCSS('background', "url('/PDF/template/Certificados_Delegate.png')");
        $style =<<<html
            <style>
        
            .titulo{
                width:100%;
                margin-top: 30px;
                color: #F5AA3C;
                margin-left:auto;
                margin-right:auto;
            }
    
            .imagen{
    
                float: left;	
                margin-top: 325px;
                width: 100px;
                height: 100px;
            }
    
            .spacer{
                margin-left: 7px;
                padding-top: 450px!important;
                text-align: center;
        
            }
            .name{
                font-family: Arial, Helvetica, sans-serif;
                color: #4B3049;
            }
    
            </style>
  html;

            $tabla =<<<html
            <div style="page-break-inside: avoid;" class='spacer' align='center'>
            <h1 class='name'>{$data['nombre']} {$data['apellido_p']} {$data['apellido_m']}</h1>
            <img class="imagen " src="{$data['ruta_qr']}"/>
            </div>
html;
      }
  
      $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
      $mpdf->WriteHTML($style,1);
      $mpdf->WriteHTML($tabla,2);

      //$nombre_archivo = "MPDF_".uniqid().".pdf";/* se genera un nombre unico para el archivo pdf*/
      print_r($mpdf->Output('PDF/'.$data['code'].'.pdf','F'));/* se genera el pdf en la ruta especificada*/
      //echo $nombre_archivo;/* se imprime el nombre del archivo para poder retornarlo a CrmCatalogo/index */

     // exit;
      
    }


    //Funcion para borrar los arvhivos qr y constancias
    public function deleteFiles($id_constancia){
        $constancia = ConstanciaDao::getByIdConst($id_constancia)[0];

        $split_ruta_qr = explode("/",$constancia['ruta_qr']);
        $ruta_qr = $split_ruta_qr['1']."/".$split_ruta_qr['2'];

        $split_ruta_pdf = explode("/",$constancia['ruta_constancia']);
        $ruta_pdf = $split_ruta_pdf['1']."/".$split_ruta_pdf['2'];
        
        if (file_exists($ruta_qr)) {
            //echo "El fichero ". $constancia['ruta_qr']." existe";
            unlink($ruta_qr);
        } 

        if (file_exists($ruta_pdf)) {
            //echo "El fichero ". $constancia['ruta_constancia']." existe";
            unlink($ruta_pdf);
        } 
       
    }


    public function generaterQr(){
       
        $id_constancia = $_POST['id_constancia'];
        $user_id = $_SESSION['administrador_id'];

        //Eliminar los archivos del servidor
        //$this->deleteFiles($id_constancia);
      

        $codigo_rand = $this->generateRandomString();

        $config = array(
            'ecc' => 'H',    // L-smallest, M, Q, H-best
            'size' => 12,    // 1-50
            'dest_file' => '../public/qrs/'.$codigo_rand.'.png',
            'quality' => 90,
            'logo' => 'logo.jpg',
            'logo_size' => 100,
            'logo_outline_size' => 20,
            'logo_outline_color' => '#FFFF00',
            'logo_radius' => 15,
            'logo_opacity' => 100,
          );
    
          // Contenido del c??digo QR
          $data = 'https://bbeltcertificate.sas-lahe.com/DatosConstancia/datos/'.$codigo_rand;
    
          // Crea una clase de c??digo QR
          $oPHPQRCode = new PHPQRCode();
    
          // establecer configuraci??n
          $oPHPQRCode->set_config($config);
    
          // Crea un c??digo QR
          $qrcode = $oPHPQRCode->generate($data);
    
          $url = explode('/', $qrcode );
          $src = $url['0'].'/'.$url['2'].'/'.$url['3'];

          $documento = new \stdClass();
      

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $documento->_ruta_qr = $src;
            $documento->_ruta_constancia = '../PDF/'.$codigo_rand.'.pdf';
            $documento->_id_constancia = $id_constancia;
            $documento->_code = $codigo_rand;
            
            
            $id = ConstanciaDao::updateQrRute($documento);

            if ($id) {
              $constancia = ConstanciaDao::getByCode($codigo_rand);

              $this->generarPDF($constancia[0]);
              
                $data = [
                    'status' => 'success',
                    'src' => $src,
                    'nombre_constancia' => $constancia[0]['nombre_constancia'],
                    'ruta_constancia' => $constancia[0]['ruta_constancia'],
                    'code' => $constancia[0]['code'],
                    'id_constancia' => $constancia[0]['id_constancia'],
                    'url_qr' => 'https://bbeltcertificate.sas-lahe.com/DatosConstancia/datos/'.$codigo_rand,
                    'status_generada' => 1

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
            //echo 'fail REQUEST';
        }
     
          
          // Mostrar c??digo QR
          //$imagen = '<img src="'.$src.'">';
         //echo $src;
         echo json_encode($data);
    }

    public function verQr(){
       
        $code = $_POST['code'];
        $user_id = $_SESSION['administrador_id'];

        //Eliminar los archivos del servidor
        //$this->deleteFiles($id_constancia);
      
        $constancia = ConstanciaDao::getByCode($code);
              
                $data = [
                    'status' => 'success',
                    'src' => $constancia[0]['ruta_qr'],
                    'nombre_constancia' => $constancia[0]['nombre_constancia'],
                    'ruta_constancia' => $constancia[0]['ruta_constancia'],
                    'code' => $constancia[0]['code'],
                    'id_constancia' => $constancia[0]['id_constancia'],
                    'url_qr' => 'https://bbeltcertificate.sas-lahe.com/DatosConstancia/datos/'.$constancia[0]['code'],
                    'status_generada' => 1

                ];
          
         echo json_encode($data);
    }
    
    public function generarQr(){
       
        $id_constancia = $_POST['id_constancia'];
        $user_id = $_SESSION['administrador_id'];

        //Eliminar los archivos del servidor
        $this->deleteFiles($id_constancia);
      

        $codigo_rand = $this->generateRandomString();

        $config = array(
            'ecc' => 'H',    // L-smallest, M, Q, H-best
            'size' => 12,    // 1-50
            'dest_file' => '../public/qrs/'.$codigo_rand.'.png',
            'quality' => 90,
            'logo' => 'logo.jpg',
            'logo_size' => 100,
            'logo_outline_size' => 20,
            'logo_outline_color' => '#FFFF00',
            'logo_radius' => 15,
            'logo_opacity' => 100,
          );
    
          // Contenido del c??digo QR
          $data = 'https://bbeltcertificate.sas-lahe.com/DatosConstancia/datos/'.$codigo_rand;
    
          // Crea una clase de c??digo QR
          $oPHPQRCode = new PHPQRCode();
    
          // establecer configuraci??n
          $oPHPQRCode->set_config($config);
    
          // Crea un c??digo QR
          $qrcode = $oPHPQRCode->generate($data);
    
          $url = explode('/', $qrcode );
          $src = $url['0'].'/'.$url['2'].'/'.$url['3'];

          $documento = new \stdClass();
      

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $documento->_ruta_qr = $src;
            $documento->_ruta_constancia = '../PDF/'.$codigo_rand.'.pdf';
            $documento->_id_constancia = $id_constancia;
            $documento->_code = $codigo_rand;
            
            
            $id = ConstanciaDao::updateQrRute($documento);

            if ($id) {
              $constancia = ConstanciaDao::getByCode($codigo_rand);

              $this->generarPDF($constancia[0]);
              
                $data = [
                    'status' => 'success',
                    'src' => $src,
                    'nombre_constancia' => $constancia[0]['nombre_constancia'],
                    'ruta_constancia' => $constancia[0]['ruta_constancia'],
                    'code' => $constancia[0]['code'],
                    'id_constancia' => $constancia[0]['id_constancia'],
                    'url_qr' => 'https://bbeltcertificate.sas-lahe.com/DatosConstancia/datos/'.$codigo_rand

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
            //echo 'fail REQUEST';
        }
     
          
          // Mostrar c??digo QR
          //$imagen = '<img src="'.$src.'">';
         //echo $src;
         echo json_encode($data);
    }

}

class PHPQRCode{ // class start

  /** Configuraci??n predeterminada */
  private $_config = array(
      'ecc' => 'H',                       // Calidad del c??digo QR L-menor, M, Q, H-mejor
      'size' => 15,                       // Tama??o del c??digo QR 1-50
      'dest_file' => '',        // Ruta de c??digo QR creada
      'quality' => 100,                    // Calidad de imagen
      'logo' => '',                       // Ruta del logotipo, vac??o significa que no hay logotipo
      'logo_size' => null,                // tama??o del logotipo, nulo significa que se calcula autom??ticamente de acuerdo con el tama??o del c??digo QR
      'logo_outline_size' => null,        // Tama??o del trazo del logotipo, nulo significa que se calcular?? autom??ticamente de acuerdo con el tama??o del logotipo
      'logo_outline_color' => '#FFFFFF',  // color del trazo del logo
      'logo_opacity' => 100,              // opacidad del logo 0-100
      'logo_radius' => 0,                 // ??ngulo de empalme del logo 0-30
  );

  
  public function set_config($config){

      // Permitir configurar la configuraci??n
      $config_keys = array_keys($this->_config);

      // Obtenga la configuraci??n entrante y escriba la configuraci??n
      foreach($config_keys as $k=>$v){
          if(isset($config[$v])){
              $this->_config[$v] = $config[$v];
          }
      }

  }

  /**
         * Crea un c??digo QR
   * @param    Contenido del c??digo QR String $ data
   * @return String
   */
  public function generate($data){

      // Crea una imagen de c??digo QR temporal
      $tmp_qrcode_file = $this->create_qrcode($data);

      // Combinar la imagen del c??digo QR temporal y la imagen del logotipo
      $this->add_logo($tmp_qrcode_file);

      // Eliminar la imagen del c??digo QR temporal
      if($tmp_qrcode_file!='' && file_exists($tmp_qrcode_file)){
          unlink($tmp_qrcode_file);
      }

      return file_exists($this->_config['dest_file'])? $this->_config['dest_file'] : '';

  }

  /**
         * Crea una imagen de c??digo QR temporal
   * @param    Contenido del c??digo QR String $ data
   * @return String
   */
  private function create_qrcode($data){

      // Imagen de c??digo QR temporal
      $tmp_qrcode_file = dirname(__FILE__).'/tmp_qrcode_'.time().mt_rand(100,999).'.png';

      // Crea un c??digo QR temporal
      \QRcode::png($data, $tmp_qrcode_file, $this->_config['ecc'], $this->_config['size'], 2);

      // Regresar a la ruta temporal del c??digo QR
      return file_exists($tmp_qrcode_file)? $tmp_qrcode_file : '';

  }

  /**
         * Combinar im??genes de c??digos QR temporales e im??genes de logotipos
   * @param  String $ tmp_qrcode_file Imagen de c??digo QR temporal
   */
  private function add_logo($tmp_qrcode_file){

      // Crear carpeta de destino
      $this->create_dirs(dirname($this->_config['dest_file']));

      // Obtener el tipo de imagen de destino
      $dest_ext = $this->get_file_ext($this->_config['dest_file']);

      // Necesito agregar logo
      if(file_exists($this->_config['logo'])){

          // Crear objeto de imagen de c??digo QR temporal
          $tmp_qrcode_img = imagecreatefrompng($tmp_qrcode_file);

          // Obtener el tama??o de la imagen del c??digo QR temporal
          list($qrcode_w, $qrcode_h, $qrcode_type) = getimagesize($tmp_qrcode_file);

          // Obtener el tama??o y el tipo de la imagen del logotipo
          list($logo_w, $logo_h, $logo_type) = getimagesize($this->_config['logo']);

          // Crea un objeto de imagen de logo
          switch($logo_type){  
              case 1: $logo_img = imagecreatefromgif($this->_config['logo']); break;  
              case 2: $logo_img = imagecreatefromjpeg($this->_config['logo']); break;  
              case 3: $logo_img = imagecreatefrompng($this->_config['logo']); break;  
              default: return '';  
          }

          // Establezca el tama??o combinado de la imagen del logotipo, si no se establece, se calcular?? autom??ticamente de acuerdo con la proporci??n
          $new_logo_w = isset($this->_config['logo_size'])? $this->_config['logo_size'] : (int)($qrcode_w/5);
          $new_logo_h = isset($this->_config['logo_size'])? $this->_config['logo_size'] : (int)($qrcode_h/5);

          // Ajusta la imagen del logo seg??n el tama??o establecido
          $new_logo_img = imagecreatetruecolor($new_logo_w, $new_logo_h);
          imagecopyresampled($new_logo_img, $logo_img, 0, 0, 0, 0, $new_logo_w, $new_logo_h, $logo_w, $logo_h);

          // Determinar si se necesita un golpe
          if(!isset($this->_config['logo_outline_size']) || $this->_config['logo_outline_size']>0){
              list($new_logo_img, $new_logo_w, $new_logo_h) = $this->image_outline($new_logo_img);
          }

          // Determine si se necesitan esquinas redondeadas
          if($this->_config['logo_radius']>0){
              $new_logo_img = $this->image_fillet($new_logo_img);
          }

          // Combinar logotipo y c??digo QR temporal
          $pos_x = ($qrcode_w-$new_logo_w)/2;
          $pos_y = ($qrcode_h-$new_logo_h)/2;

          imagealphablending($tmp_qrcode_img, true);

          // Combinar las im??genes y mantener su transparencia
          $dest_img = $this->imagecopymerge_alpha($tmp_qrcode_img, $new_logo_img, $pos_x, $pos_y, 0, 0, $new_logo_w, $new_logo_h, $this->_config['logo_opacity']);

          // Generar imagen
          switch($dest_ext){
              case 1: imagegif($dest_img, $this->_config['dest_file'], $this->_config['quality']); break;
              case 2: imagejpeg($dest_img, $this->_config['dest_file'], $this->_config['quality']); break;
              case 3: imagepng($dest_img, $this->_config['dest_file'], (int)(($this->_config['quality']-1)/10)); break;
          } 

      // No es necesario agregar logo
      }else{

          $dest_img = imagecreatefrompng($tmp_qrcode_file);

          // Generar imagen
          switch($dest_ext){
              case 1: imagegif($dest_img, $this->_config['dest_file'], $this->_config['quality']); break;
              case 2: imagejpeg($dest_img, $this->_config['dest_file'], $this->_config['quality']); break;
              case 3: imagepng($dest_img, $this->_config['dest_file'], (int)(($this->_config['quality']-1)/10)); break;
          }
      }

  }

  /**
         * Acaricia el objeto de la imagen
   * @param    Objeto de imagen Obj $ img
   * @return Array
   */
  private function image_outline($img){

      // Obtener ancho y alto de la imagen
      $img_w = imagesx($img);
      $img_h = imagesy($img);

      // Calcula el tama??o del trazo, si no est?? configurado, se calcular?? autom??ticamente de acuerdo con la proporci??n
      $bg_w = isset($this->_config['logo_outline_size'])? intval($img_w + $this->_config['logo_outline_size']) : $img_w + (int)($img_w/5);
      $bg_h = isset($this->_config['logo_outline_size'])? intval($img_h + $this->_config['logo_outline_size']) : $img_h + (int)($img_h/5);

      // Crea un objeto de mapa base
      $bg_img = imagecreatetruecolor($bg_w, $bg_h);

      // Establecer el color del mapa base
      $rgb = $this->hex2rgb($this->_config['logo_outline_color']);
      $bgcolor = imagecolorallocate($bg_img, $rgb['r'], $rgb['g'], $rgb['b']);

      // Rellena el color del mapa base
      imagefill($bg_img, 0, 0, $bgcolor);

      // Combina la imagen y el mapa base para lograr el efecto de trazo
      imagecopy($bg_img, $img, (int)(($bg_w-$img_w)/2), (int)(($bg_h-$img_h)/2), 0, 0, $img_w, $img_h);

      $img = $bg_img;

      return array($img, $bg_w, $bg_h);

  }

  
  private function image_fillet($img){

      // Obtener ancho y alto de la imagen
      $img_w = imagesx($img);
      $img_h = imagesy($img);

      // Crea un objeto de imagen con esquinas redondeadas
      $new_img = imagecreatetruecolor($img_w, $img_h);

      // guarda el canal transparente
      imagesavealpha($new_img, true);

      // Rellena la imagen con esquinas redondeadas
      $bg = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
      imagefill($new_img, 0, 0, $bg);

      // Radio de redondeo
      $r = $this->_config['logo_radius'];

      // Realizar procesamiento de esquinas redondeadas
      for($x=0; $x<$img_w; $x++){
          for($y=0; $y<$img_h; $y++){
              $rgb = imagecolorat($img, $x, $y);

              // No en las cuatro esquinas de la imagen, dibuja directamente
              if(($x>=$r && $x<=($img_w-$r)) || ($y>=$r && $y<=($img_h-$r))){
                  imagesetpixel($new_img, $x, $y, $rgb);

              // En las cuatro esquinas de la imagen, elige dibujar
              }else{
                  // arriba a la izquierda
                  $ox = $r; // centro x coordenada
                  $oy = $r; // centro coordenada y
                  if( ( ($x-$ox)*($x-$ox) + ($y-$oy)*($y-$oy) ) <= ($r*$r) ){
                      imagesetpixel($new_img, $x, $y, $rgb);
                  }

                  // parte superior derecha
                  $ox = $img_w-$r; // centro x coordenada
                  $oy = $r;        // centro coordenada y
                  if( ( ($x-$ox)*($x-$ox) + ($y-$oy)*($y-$oy) ) <= ($r*$r) ){
                      imagesetpixel($new_img, $x, $y, $rgb);
                  }

                  // abajo a la izquierda
                  $ox = $r;        // centro x coordenada
                  $oy = $img_h-$r; // centro coordenada y
                  if( ( ($x-$ox)*($x-$ox) + ($y-$oy)*($y-$oy) ) <= ($r*$r) ){
                      imagesetpixel($new_img, $x, $y, $rgb);
                  }

                  // abajo a la derecha
                  $ox = $img_w-$r; // centro x coordenada
                  $oy = $img_h-$r; // centro coordenada y
                  if( ( ($x-$ox)*($x-$ox) + ($y-$oy)*($y-$oy) ) <= ($r*$r) ){
                      imagesetpixel($new_img, $x, $y, $rgb);
                  }

              }

          }
      }

      return $new_img;

  }

  // Combinar las im??genes y mantener su transparencia
  private function imagecopymerge_alpha($dest_img, $src_img, $pos_x, $pos_y, $src_x, $src_y, $src_w, $src_h, $opacity){

      $w = imagesx($src_img);
      $h = imagesy($src_img);

      $tmp_img = imagecreatetruecolor($src_w, $src_h);

      imagecopy($tmp_img, $dest_img, 0, 0, $pos_x, $pos_y, $src_w, $src_h);
      imagecopy($tmp_img, $src_img, 0, 0, $src_x, $src_y, $src_w, $src_h);
      imagecopymerge($dest_img, $tmp_img, $pos_x, $pos_y, $src_x, $src_y, $src_w, $src_h, $opacity);

      return $dest_img;

  }

  
  private function create_dirs($path){

      if(!is_dir($path)){
          return mkdir($path, 0777, true);
      }

      return true;

  }

 
  private function hex2rgb($hexcolor){
      $color = str_replace('#', '', $hexcolor);
      if (strlen($color) > 3) {
          $rgb = array(
              'r' => hexdec(substr($color, 0, 2)),
              'g' => hexdec(substr($color, 2, 2)),
              'b' => hexdec(substr($color, 4, 2))
          );
      } else {
          $r = substr($color, 0, 1) . substr($color, 0, 1);
          $g = substr($color, 1, 1) . substr($color, 1, 1);
          $b = substr($color, 2, 1) . substr($color, 2, 1);
          $rgb = array(
              'r' => hexdec($r),
              'g' => hexdec($g),
              'b' => hexdec($b)
          );
      }
      return $rgb;
  }

   
  private function get_file_ext($file){
      $filename = basename($file);
      list($name, $ext)= explode('.', $filename);

      $ext_type = 0;

      switch(strtolower($ext)){
          case 'jpg':
          case 'jpeg':
              $ext_type = 2;
              break;
          case 'gif':
              $ext_type = 1;
              break;
          case 'png':
              $ext_type = 3;
              break;
      }

      return $ext_type;
  }

} // class end
