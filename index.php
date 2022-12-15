<?php
session_start();

if (isset($_SESSION['user_id']) && $_SESSION !== null) {
    header("location: home.php");
}

include("functions/functions.php");
createFile();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Práctica Desarrollo Web Avanzado">
    <meta name="author" content="JuanMa Capistrán Fabela">
    <title>Desarrollo Web Avanzado UNIR 2022</title>
    <!-- Carga de CSS para Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Carga de estilos personalizados -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <?php
                textAlert();
                ?>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <form class="form-login" action="functions/functions.php" method="post" name="login-form">
                    <h1 class="h3 font-weight-normal line-decorator mb-4 text-center" style="width: auto; color: #979898;">Iniciar Sesión</h1>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="text" id="inputEmail" class="form-control text-center rounded mb-3 mt-3" autofocus placeholder="Correo Electónico / Nombre de usuario" style="font-size: 12px;" name="email" required value="<?php echo $_GET['username']; ?>">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control text-center rounded mb-4" placeholder="Contraseña" style="font-size: 12px;" name="password" required>
                    <button class="btn btn-block btn-success text-uppercase mb-4 btn-lg" type="submit" style="background-color: #26a69a; font-size: 16px;" name="login-submit">Iniciar Sesión</button>
                </form>
                <hr />
                <div class="row justify-content-center mb-3">
                    <div class="col-12 text-center">
                        <a style="font-size: 13px;" href="register.php">¿Aún no tienes cuenta?</a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <button class="btn btn-success text-uppercase mb-4" type="button" style="background-color: #26a69a; font-size: 16;" name="register-btn" data-html="false" data-toggle="modal" data-target="#register-modal">Registrarse</button>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <!-- Footer -->
                    <div class="col-12">
                        <footer class="text-center mt-5" style="font-size: 12px;">
                            <a class="mt-5 text-muted mb-1" href="https://github.com/kapy024/dwa/tree/master" target="_blank">© 2022&nbsp;JuanMa Capistrán Fabela</a>
                            <p class="mt-1 mb-3 text-muted">Computación en el Servidor Web 2022</p>
                        </footer>
                    </div>
                </div>
            </div>
            <!-- Sección para modal de registro -->
            <div class="modal fade pg-show-modal" id="register-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="h3 font-weight-normal text-center" style="color: #26a69a;">Registrarse</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form class="form-register" action="functions/functions.php" method="post" name="register-form">
                                <div class="form-group">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-md-6">
                                            <div class="col-12 text-center">
                                                <label for="register-username" class="text-secondary">Nombre de Usuario</label>
                                            </div>
                                            <input type="text" class="form-control mb-3 text-center" id="register-username" placeholder="Ingresa un nombre de usuario" style="font-size: 12px;" name="username" value="<?php echo $_GET['username']; ?>" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="col-12 text-center">
                                                <label for="register-email" class="text-secondary">Correo Electrónico</label>
                                            </div>
                                            <input type="email" class="form-control mb-3 text-center" id="register-email" placeholder="Ingresa tu correo electrónico" style="font-size: 12px;" name="email" value="<?php echo $_GET['username']; ?>" required>
                                        </div>
                                        <div class="col-12 col-md-6">
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
                            <button type="button" class="btn btn-default btn-light btn-cancel" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary modal-btn" style="background-color: #26a69a;" name="register-submit">Enviar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Script para acción de modales en pantalla -->
            <script>
                $(function() {
                    $('[data-toggle="popover"]').popover();
                })
            </script>
            <!-- Carga de archivos js de Bootstrap -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/popper.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>