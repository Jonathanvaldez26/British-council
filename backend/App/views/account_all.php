<!-- <link id="pagestyle" href="/assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" /> -->
<?php echo $header; ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg "> 
    <div class="container-fluid py-0">
        <div class="row mt-4">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8 mt-lg-3 mt-6 card-form">

                <!-- <input type="text" class="form-control" id="name" name="name" value=" "> -->


                <!-- Card Basic Info -->
                <div class="login_part_form_iner btn-qr" id="basic-info">
                    <h3>Welcome Back<br>
                        Please Check your data.</h3>
                    <br>
                    <p>If your data is incorrect, please modify and indicate which data is correct to be corrected by our administration.</p>
                    <br>
                    <div login_part_form_iner>
                        <div class="btn-qr">
                            <form class="row contact_form" method="POST" enctype="multipart/form-data" id="form_confirm_datos">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label">Name</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" onfocus="focused(this)" onfocusout="defocused(this)" value="<?= $usuario['nombre'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Surname</label>
                                        <div class="input-group">
                                            <input id="primer_apellido_" name="primer_apellido_" class="form-control" type="text" placeholder="Surname" required="required" onfocus="focused(this)" onfocusout="defocused(this)" value="<?= $usuario['apellido_p'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Second Surname</label>
                                        <div class="input-group">
                                            <input id="segundo_apellido_" name="segundo_apellido_" class="form-control" type="text" placeholder="Second Surname" required="required" onfocus="focused(this)" onfocusout="defocused(this)" value="<?= $usuario['apellido_m'] ?>">
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
                                <button class="btn_1 btn-danger" style="background-color: red;" id="btn-cancelar" value="<?= $usuario['usuario'] ?>">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
    </div>

    </div>
    <?php echo $footer; ?>
</main>

<script>
    $(document).ready(function() {

        $("#btn-confirm").on("click", function(event) {
            event.preventDefault();

            var formData = new FormData(document.getElementById("form_confirm_datos"));
            console.log(formData);
            $.ajax({
                url: "/Login/updateStatus",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    console.log("Procesando....");

                },
                success: function(respuesta) {

                    if (respuesta == 'success') {
                        Swal.fire(
                            'OK',
                            'Your data was successfully verified !!!',
                            'Success'
                        );
                        setTimeout(() => {
                            window.location.reload();
                        }, 200);
                    }

                    console.log(respuesta);

                },
                error: function(respuesta) {
                    console.log(respuesta);
                }

            });
        });

        $("#btn-cancelar").on("click", function(event) {
            event.preventDefault();

           var usuario = $(this).val();
            
            $.ajax({
                url: "/Login/enviarMailValidate",
                type: "POST",
                data: {usuario:usuario},
                cache: false,
                beforeSend: function() {
                    console.log("Procesando....");

                },
                success: function(respuesta) {
                    console.log(respuesta);
                    Swal.fire(
                            'OK',
                            'Your data was sent !!!',
                            'Success'
                        );
                        setTimeout(() => {
                            window.location.href = "/Login";
                        }, 900);

                },
                error: function(respuesta) {
                    console.log(respuesta);
                }

            });
        });


    });
</script>