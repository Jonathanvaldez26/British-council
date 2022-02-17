
<?php echo $header; ?>
<body>
    

    <!-- banner part start-->

    <!-- banner part start-->

    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg "> 
    
    <div id="logos-con">
        <a href="/">
            <img id="logo-bbelt-0" src="../../assets_2/img/logo_bbelt.png" alt="logo">
        </a>

        <a href="/">
            <img id="logo-bbelt-2" src="../../assets_2/img/logo_1.png" alt="logo">
        </a>

        <a href="/">
            <img id="logo-bbelt-3" src="../../assets_2/img/logo_2.png" alt="logo">
        </a>
    </div>

    <div class="container-fluid py-0">
        <div class="row mt-4">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 mt-lg-3 mt-6 card-form">

                <!-- <input type="text" class="form-control" id="name" name="name" value=" "> -->


                <!-- Card Basic Info -->
                <div class="login_part_form_iner btn-qr" id="basic-info">
                <h3>This certificate has been issued by our system with the following </h3>
                    <br><br><br>
                    <?php echo $pdf_constancia; ?>
                   
                </div>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>

    </div>
    <?php echo $footer; ?>
</main>


<!-- <div login_part_form_iner>
                        <div class="btn-qr">
                            <form class="row contact_form" method="POST" enctype="multipart/form-data" id="form_confirm_datos">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label">Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" onfocus="focused(this)" onfocusout="defocused(this)" readonly="readonly" value="<?= $usuario['nombre'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Surname</label>
                                        <div class="input-group">
                                            <input id="primer_apellido_" name="primer_apellido_" class="form-control" type="text" placeholder="Surname" required="required" onfocus="focused(this)" onfocusout="defocused(this)" readonly="readonly" value="<?= $usuario['apellido_p'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Second Surname</label>
                                        <div class="input-group">
                                            <input id="segundo_apellido_" name="segundo_apellido_" class="form-control" type="text" placeholder="Second Surname" required="required" onfocus="focused(this)" onfocusout="defocused(this)" readonly="readonly" value="<?= $usuario['apellido_m'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <br>
                                        <label class="form-label">Email Registered</label>
                                        <div class="input-group">
                                            <input id="email_" name="email_" class="form-control" type="email" placeholder="example@email.com" onfocus="focused(this)" onfocusout="defocused(this)" readonly="readonly" value="<?= $usuario['usuario'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <br>

                        <div class="btn-qr">
                                <button class="btn_1 btn-primary btn_confirm" id="btn-confirm">Confirm</button>
                                <a href="/Login" class="btn_danger ">Cancelar</a>
                        </div>
                    </div> -->
</body>

<?php echo $footer; ?>