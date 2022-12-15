<?php
session_start();
include("functions/functions.php");
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Práctica Desarrollo Web Avanzado UNIR 2022">
    <meta name="author" content="JuanMa Capistrán Fabela">
    <title>Desarrollo Web Avanzado UNIR 2022</title>
    <!-- Carga de CSS para Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Carga de estilos personalizados -->
    <link href="css/style.css" rel="stylesheet">
</head>
<!-- Registro de usuario -->
<div class="container justify-content-center align-items-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <?php
            textAlert();
            ?>
        </div>
    </div>
    <h1 class="h3 font-weight-normal mb-4 text-center" style="width: auto; color: #979898;">Registro de usuario</h1>
    <hr>
</div>
<div class="container justify-content-center align-items-center mt-5">
    <div class="row justify-content-center align-items-center">
        <form class="form-register" action="functions/functions.php" method="post" name="register-form">
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="col-12 text-center">
                            <label for="register-username" class="text-secondary">Nombre de Usuario</label>
                        </div>
                        <input type="text" class="form-control mb-3 text-center" id="register-username" placeholder="Ingresa un nombre de usuario" style="font-size: 12px;" name="username" required value="<?php echo $_GET['username']; ?>">
                    </div>
                    <div class=" col-12 col-md-6">
                        <div class="col-12 text-center">
                            <label for="register-email" class="text-secondary">Correo Electrónico</label>
                        </div>
                        <input type="email" class="form-control mb-3 text-center" id="register-email" placeholder="Ingresa tu correo electrónico" style="font-size: 12px;" name="email" required value="<?php echo $_GET['email']; ?>">
                    </div>
                    <div class=" col-12 col-md-6">
                        <div class="col-12 text-center">
                            <label for="register-password" class="text-secondary">Contraseña</label>
                        </div>
                        <input type="password" class="form-control text-center mb-3" id="register-password" placeholder="Ingresa tu contraseña" style="font-size: 12px;" name="password" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12 text-center">
                            <label for="register-dup-password" class="text-secondary">Valida Contraseña</label>
                        </div>
                        <input type="password" class="form-control text-center mb-3" id="register-dup-password" placeholder="Ingresa nuevamente tu contraseña" style="font-size: 12px;" name="password_validation" required>
                    </div>
                </div>
            </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="btn btn-default btn-light btn-cancel" data-dismiss="modal" href="index.php">Cancelar</a>
        <button type="submit" class="btn btn-primary modal-btn" style="background-color: #26a69a;" name="register-submit">Enviar</button>
    </div>
    </form>
    <!-- Footer -->
    <footer class="text-center mt-5" style="font-size: 12px;">
        <a class="mt-5 text-muted mb-1" href="https://github.com/OthoArenas/Desarrollo_Web_Avanzado/tree/master" target="_blank">© 2022&nbsp;JuanMa Capistrán Fabela</a>
        <p class="mt-1 mb-3 text-muted">Computación en el Servidor Web UNIR 2022</p>
    </footer>
</div>
<!-- Script para acción de modales en pantalla -->
<script>
    $(function() {
        $('[data-toggle="popover"]').popover();
    })
</script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>