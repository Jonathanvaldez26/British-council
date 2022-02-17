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

    <!-- banner part start-->
    <section id="content" class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 col-sm-12">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h3>
                                <?php echo $data_constancia['nombre_constancia'] ?>
                            </h3>
                            <!-- <p>lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum </p>
                            <?php //var_dump($data_constancia); ?> -->
                           
                           
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                <?php echo $pdf_constancia; ?>
                </div>
            </div>
        </div>
        
    </section>
    <!-- banner part start-->

    


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