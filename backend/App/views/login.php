<!doctype html>
<html lang="zxx">

<head>
    <!-- Header From Controller -->
    <?php echo $header;?>
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/Home/"> <img id="logo-bbelt" src="../../assets_2/img/logo_bbelt.png" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/Home/" id="home-hide">.</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex align-items-center">
                            <a id="search_1" href="javascript:void(0)">
                                <i class=""></i>
                            </a>
                            <a href="cart.html">
                                <!-- <i class="flaticon-shopping-cart-black-shape"></i> -->
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
        @media (max-width: 576px) {
            #snd-text{
                display: none;
            }

            .hide-elem.login_part_text.text-center {
                float: none;
                background-image: linear-gradient(90deg, #25085e 0%, #4B3049 64%, #B08EAD 100%);
                height: 284px;
            }
        }
    </style>

    <!--================login_part Area =================-->
    <section class="login_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="hide-elem login_part_text text-center">
                        <div class="login_part_text_iner">
                            
                            <h2>Welcome to British Council Certificates</h2>
                            
                            <p id="snd-text">You can get your certificate here. Please login with your ID.</p>
                            <!-- <a href="#" class="btn_3">Create an Account</a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <?php echo $alerta; ?>
                            <h3>
                                Please sign in.</h3>
                                <!-- <form role="form" class="text-start" id="login" action="/Login/crearSession" method="POST" class="form-horizontal"> -->
                            <form role="form" class="row contact_form" id="login" action="/Login/validarDatos" method="POST" class="form-horizontal">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Identification" aria-label="Email">
                                </div>
                                <!-- <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value=""
                                        placeholder="Password">
                                </div> -->
                                <div class="col-md-12 form-group">
                                    <!-- <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Remember me</label>
                                    </div> -->
                                    <button type="submit" value="submit" class="btn_3">
                                        log in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->

    
</body>

<!--::footer_part start::-->
<footer class="footer_part">
        <style>

                #footer-fix{
                    position: relative;
                    width: 100%;
                    bottom: -225px;
                }
        </style>
        
        <div id="footer-fix" class="copyright_part">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="copyright_text">
                            <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Create by <i class="ti-heart" aria-hidden="true"></i> by <a href="https://grupolahe.com" target="_blank">GRUPO LAHE</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
                            <div class="copyright_link">
                                <!-- <a href="#">Turms & Conditions</a>
                                <a href="#">FAQ</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

<!-- Header From Controller -->
<?php echo $footer;?>

</html>
