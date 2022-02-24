<?php echo $header;?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-3 text-dark" href="javascript:;">
                            <svg width="12px" height="12px" class="mb-1" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#252f40" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                                                <path d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark active" aria-current="page" href="/AdminConstancia/">Certificate</a></li>
                    <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark">Clientes</a></li>
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/Empresa/">Empresas</a></li> -->
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add</li>
                </ol>
            </nav>
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
                <a href="javascript:;" class="nav-link text-body p-0">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <!-- <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here..."> -->
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="/LoginAdmin/cerrarSession" class="nav-link text-body font-weight-bold px-0" target="_blank">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Logout</span>
                        </a>
                    </li>
                    
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-2 d-flex align-items-center">
                        
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <br>
    <div class="container-fluid col-md-8 card" id="basic-info">
        <form method="POST" class="form-horizontal" id="add" action="/AdminConstanciaSpeaker/constanciaAdd">
            <div class="form-group ">
                <div class="card-header">
                    <h5>General Data to Generate Certificate</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="form-group col-6">
                            <label class="form-label">User *</label>
                            <div class="input-group">
                                <!-- <input id="id_administrador" name="id_administrador" class="form-control" type="text" placeholder="1" required="required" onfocus="focused(this)" onfocusout="defocused(this)"> -->
                                <select id="id_administrador" name="id_administrador" class="form-control">
                                    <?php echo $option; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-label">Certificate Name *</label>
                            <div class="input-group">
                                <input id="nombre" name="nombre" class="form-control" maxlength="44" type="text" placeholder="Academic Record" value="British Council 2022" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <!-- <div class="form-group col-6">
                            <label class="form-label">Code *</label>
                            <div class="input-group">
                                <input id="code" name="code" class="form-control" type="text" placeholder="Azs324aDda32A" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                      <label class="form-label">Conference Name *</label>
                            <div class="input-group">
                                <input id="nombre_conferencia" name="nombre_conferencia" class="form-control" maxlength="160" type="text" placeholder="Academic Record" value="" required="required" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                      </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                <div class="form-check form-switch ms-2">
                                    <button class="btn btn-outline-primary mb-0 ms-auto" type="submit" id="btnAdd">Register</button>
                                    <a href="/AdminConstanciaSpekaer"></a>
                                    <!-- <button class="btn btn-outline-secondary mb-0 ms-2" type="button" id="btnCancel">Cancelar</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
</main>

<!-- <script>
          $(document).ready(function(){
            $.validator.addMethod("verificarRFC",
              function(value, element) {
                var result = false;
                $.ajax({
                  type:"POST",
                  async: false,
                  url: "/AdminConstancia/validarRFC", // script to validate in server side
                  data: {
                      nombre: function() {
                        return $("#nombre").val();
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
</script> -->

<?php echo $footer;?>
