<?php echo $header; ?>
<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/">
                            <img id="logo-bbelt" src="../../assets_2/img/logo_bbelt.png" alt="logo">  
                        </a>
                        <p><?php echo $_SESSION['nombre']; ?></p>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Home</a>
                                </li>
                                <li class="nav-item d-flex align-items-center">
                                    <a href="/Login/cerrarSession" class="nav-link text-body font-weight-bold px-0">
                                        <i class="fa fa-power-off me-sm-1"></i>
                                        <span class="d-sm-inline">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex align-items-center">
                            <a id="search_1" href="javascript:void(0)"><i class=""></i></a>
                            <a href="cart.html">
                                <i class=""></i>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <style>
        @media (max-width: 576px){
            .banner_part .banner_img {
                display: none;
            }
        }
    </style>

    <!-- banner part start-->
    <section id="content" class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="banner_text mt-4">
                        <div class="banner_text_iner">
                            <h2>Download your
                                Certificate
                            </h2>
                            <p>Check the information below, if all it is ok, download <br> your certificate, click at the bottom</p>
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                   
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Download</th>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                    <?php echo $tabla; ?>
                                </tbody>
                            </table>
                           
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .banner_part .banner_img {
                right: -8%;
            }
        </style>
        <div class=" banner_img" >
            <img src="../../assets_2/img/registration-bg.jpg" alt="#" class="img-fluid">
            <img src="../../assets_2/img/banner_pattern.png " alt="#" class="pattern_img img-fluid" hidden>
        </div>
    </section>
    <!-- banner part start-->

    <!-- product list start-->
    <section id="qr" class="single_product_list">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single_product_iner">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-6 col-sm-6">
                            <h2 id="cons-q2"> <a href="#">Consult your QR Constance</a> </h2>
                                <div class="single_product_img">
                                
                                    <!-- <img src="../../assets_2/img/single_product_1.png" class="img-fluid" alt="#"> -->
                                    <!-- <?php //echo $imagen_qr; ?> -->
                                    <img id="img_qr">

                                    <?php echo $imagen_qr; ?>

                                    <img src="../../assets_2/img/product_overlay.png" alt="#" class="product_overlay img-fluid">
                                </div>
                                <br>
                            </div>

                            <style>
                                @media(max-width: 576px){
                                    #cons-qr{
                                        padding-top: 105px;
                                        display: none;
                                    }

                                    #cons-q2{
                                        display: block;
                                        font-size: xx-large;
                                        padding-top: 10%;
                                        color: #4B3049 !important;
                                    }

                                    #cons-q2 a{
                                        color: #4B3049 !important;
                                    }

                                    #qr{
                                        padding-top: 0;
                                    }
                                }

                                @media (max-width: 991px){
                                    .single_product_list .single_product_content {
                                        margin-top: 0px;
                                    }
                                }
                                @media(min-width: 577px){

                                    #cons-q2{
                                        display: none;
                                    }
                                }
                            </style>

                            <div class="col-lg-5 col-sm-6">
                                <div class="single_product_content">
                                    <h5 id="title_constancia"></h5>
                                   <!--  <h5>British Council</h5> -->
                                    <h2 id="cons-qr"> <a href="#">Consult your QR Constance</a> </h2>
                                    <a href="#" class="btn_3 d-none" id="btn_ruta_qr">Go</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product list end-->


    <!--::footer_part start::-->
    <footer class="footer_part">

        <div class="footer_iner">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-8">
                    </div>
                </div>
            </div>
        </div>

        
        <div class="copyright_part">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="copyright_text">
                            <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://grupolahe.com" target="_blank">Grupo LAHE</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                            <div class="copyright_link">
                                <a href="#">Turms & Conditions</a>
                                <a href="#">FAQ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->
</body>

<?php echo $footer; ?>

<script>
    $(document).ready(function() {

        $(".btn_qr").on("click", function(event){
            event.preventDefault();

            var valueButton = $(this).val();
            $(this).hide();
           
            $.ajax({
                url: "/Home/generaterQr",
                type: "POST",
                data: {id_constancia:valueButton},
                cache: false,
                dataType: "json",
                // contentType: false,
                // processData: false,
                beforeSend: function() {
                    console.log("Procesando....");

                },
                success: function(respuesta) {
                    //console.log(respuesta);
                    $("#img_qr").attr("src",respuesta.src);
                    $("#title_constancia").html(respuesta.nombre_constancia);
                    $("#btn_ruta_qr").attr("href",respuesta.url_qr);
                    $("#btn_ruta_qr").removeClass("d-none");

                    //boton descargar
                   $("#btn-download"+valueButton).attr("data-id",respuesta.id_constancia);
                   $("#btn-download"+valueButton).attr("data-value",respuesta.code);
                   $("#btn-download"+valueButton).removeClass("d-none");
                   $("#btn-download"+valueButton).attr("href", respuesta.ruta_constancia);                   
                   //$("#btn-download"+valueButton).attr("download","");
                   // $("#btn-download"+valueButton).attr("target", "_blank");

                   // a de descargar pdf
                   $("#a-download"+valueButton).attr("href", respuesta.ruta_constancia); 
                   $("#a-download"+valueButton).attr("download","");
                   //$("#btn-download-"+valueButton).attr("value",respuesta.code);

                   
                  
                },
                error: function(respuesta) {
                    console.log(respuesta);
                }

            });
        });

        $(".btn_ver").on("click", function(event){
            event.preventDefault();

            var valueButton = $(this).val();
           
            $.ajax({
                url: "/Home/verQr",
                type: "POST",
                data: {code:valueButton},
                cache: false,
                dataType: "json",
                // contentType: false,
                // processData: false,
                beforeSend: function() {
                    console.log("Procesando....");

                },
                success: function(respuesta) {
                    //console.log(respuesta);
                    $("#img_qr").attr("src",respuesta.src);
                    $("#title_constancia").html(respuesta.nombre_constancia);
                    $("#btn_ruta_qr").attr("href",respuesta.url_qr);
                    $("#btn_ruta_qr").removeClass("d-none");

                    //boton descargar
                   $("#btn-download"+respuesta.id_constancia).attr("data-id",respuesta.id_constancia);
                   $("#btn-download"+respuesta.id_constancia).attr("data-value",respuesta.code);
                   $("#btn-download"+respuesta.id_constancia).removeClass("d-none");
                   $("#btn-download"+respuesta.id_constancia).attr("href", respuesta.ruta_constancia);                   
                   //$("#btn-download"+valueButton).attr("download","");
                   // $("#btn-download"+valueButton).attr("target", "_blank");

                   // a de descargar pdf
                   $("#a-download"+respuesta.id_constancia).attr("href", respuesta.ruta_constancia); 
                   $("#a-download"+respuesta.id_constancia).attr("download","");
                   //$("#btn-download-"+valueButton).attr("value",respuesta.code);
                  
                },
                error: function(respuesta) {
                    console.log(respuesta);
                }

            });
        });

        // $(".btn_qr").on("click", function(event){
        //     event.preventDefault();

        //     var valueButton = $(this).val();
           
        //     $.ajax({
        //         url: "/Home/generarQr",
        //         type: "POST",
        //         data: {id_constancia:valueButton},
        //         cache: false,
        //         dataType: "json",
        //         // contentType: false,
        //         // processData: false,
        //         beforeSend: function() {
        //             console.log("Procesando....");

        //         },
        //         success: function(respuesta) {
        //             //console.log(respuesta);
        //             $("#img_qr").attr("src",respuesta.src);
        //             $("#title_constancia").html(respuesta.nombre_constancia);
        //             $("#btn_ruta_qr").attr("href",respuesta.url_qr);
        //             $("#btn_ruta_qr").removeClass("d-none");

        //             //boton descargar
        //            $("#btn-download"+valueButton).attr("data-id",respuesta.id_constancia);
        //            $("#btn-download"+valueButton).attr("data-value",respuesta.code);
        //            $("#btn-download"+valueButton).removeClass("d-none");
        //            $("#btn-download"+valueButton).attr("href", respuesta.ruta_constancia);                   
        //            //$("#btn-download"+valueButton).attr("download","");
        //            // $("#btn-download"+valueButton).attr("target", "_blank");

        //            // a de descargar pdf
        //            $("#a-download"+valueButton).attr("href", respuesta.ruta_constancia); 
        //            $("#a-download"+valueButton).attr("download","");
        //            //$("#btn-download-"+valueButton).attr("value",respuesta.code);
                  
        //         },
        //         error: function(respuesta) {
        //             console.log(respuesta);
        //         }

        //     });
        // });



        $(".btn_download").on("click", function(event){
            event.preventDefault();
            var valueButton = $(this).attr('id');
            var code = $(this).attr('data-value');
            var id_constancia = $(this).attr('data-id');

            document.getElementById('a-download'+id_constancia).click();

            
            $.ajax({
                url: "/Home/enviarEmail",
                type: "POST",
                data: {code:code},
                cache: false,
                dataType: "json",
                // contentType: false,
                // processData: false,
                beforeSend: function() {
                    console.log("Procesando....");

                },
                success: function(respuesta) {
                    console.log(respuesta);

                    Swal.fire(
                            'OK',
                            'Your certificate has been sent !!!',
                            'Success'
                        );

                },
                error: function(respuesta) {
                    console.log(respuesta);
                }

            });
            
        });

    });
</script>

