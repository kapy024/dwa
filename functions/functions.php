<?php
date_default_timezone_set('America/Mexico_City');
session_start();

/* Inicio de Sesión */
if (isset($_POST['login-submit'])) {

    if (empty($_POST['email'])) {
        $errors[] = "<li>Correo electrónico / Nombre de usuario vacío</li>";
    }
    if (empty($_POST['password'])) {
        $errors[] = "<li>Contraseña vacía</li>";
    }
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        /* Función strip_tags para elimitar etiquetas HTML y PHP */
        $email = strip_tags($_POST["email"], ENT_QUOTES);
        $password = strip_tags($_POST['password'], ENT_QUOTES);
        $encriptedPassword = sha1($password);

        $fileName = "../registros.txt";
        $loop = 0;
        $archivo = fopen($fileName, "r");
        $count = 0;
        /* Ciclo do while */
        do {
            $loop++;
            $line = fgets($archivo);
            $data[$loop] = explode(',', $line);
            $archivo++;
            if ($email == $data[$loop][0] || $email == $data[$loop][1]) {
                $count++;
            }
            /* Función de cadenas de texto sttcmp() para comparar dos strings */
            $passCmp = strcmp($encriptedPassword, $data[$loop][2]);
            if (($email == $data[$loop][0] && $passCmp == 0) || ($email == $data[$loop][1] && $passCmp == 0)) {
                $username = $data[$loop][0];
                $email = $data[$loop][1];
                $created_at = $data[$loop][3];
                $_SESSION['user_id'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['created_at'] = $created_at;
                header("location: ../home.php");
            } else if ($count == 0) {
                $errors[0] = 'El correo electrónico o nombre de usuario ingresados no se encuentran registrados. Por favor, diríjase a la Sección "Registrarse"';
                $warning = sha1($errors[0]);
                header("location:../index.php?warning=$warning");
            } else {
                $errors[0] = "Correo Electrónico / Contraseña inválidos. Intente nuevamente.";
                $warning = sha1($errors[0]);
                header("location:../index.php?warning=$warning");
            }
        } while (!feof($archivo));
    }
    if (isset($errors)) {

        /* Ciclo Foreach */
        foreach ($errors as $error) {
            $warning .= $error;
        }
        $warning = sha1($warning);
        header("location:../index.php?warning=$warning&username=$email");
    }
}

/* Registro de usuario */
if (isset($_POST['register-submit'])) {
    /*Inicia validacion del lado del servidor*/
    /* Array que contiene los errores de validación */
    if (empty($_POST['username'])) {
        $errors[] = "<li>Nombre de usuario vacío</li>";
    }
    if (empty($_POST['email'])) {
        $errors[] = "<li>Correo vacío</li>";
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "<li>Correo Electrónico no válido.</li>";
    }
    if (empty($_POST['password'])) {
        $errors[] = "<li>Contraseña vacía</li>";
    }
    if (empty($_POST['password_validation'])) {
        $errors[] = "<li>Valida la contraseña</li>";
    }
    if (($_POST['password']) != ($_POST['password_validation'])) {
        $errors[] = "<li>Las contraseñas no coinciden";
    } else if (strlen($_POST['password']) < 6) {
        $errors[] = "<li>El password debe tener al menos 6 caracteres.</li>";
    } else if (strlen($_POST['password']) > 16) {
        $errors[] = "<li>El password no puede tener más de 16 caracteres.</li>";
    } else if (!preg_match('`[a-z]`', $_POST['password'])) {
        $errors[] = "<li>El password debe tener al menos una letra minúscula.</li>";
    } else if (!preg_match('`[A-Z]`', $_POST['password'])) {
        $errors[] = "<li>El password debe tener al menos una letra mayúscula.</li>";
    } else if (!preg_match('`[0-9]`', $_POST['password'])) {
        $errors[] = "<li>El password debe tener al menos un número.</li>";
        /* En caso de que todos los datos sean correctos. Inicia el registro en archivo */
    } else {
        $username = strip_tags($_POST["username"], ENT_QUOTES);
        $email = strip_tags($_POST["email"], ENT_QUOTES);
        $password = strip_tags($_POST['password'], ENT_QUOTES);
        $encriptedPassword = sha1($password);
        $created_at = date("d/m/Y g:ia");

        $fileName = "../registros.txt";
        $loop = 0;
        $archivo = fopen($fileName, "r");
        /* Ciclo while */
        while (!feof($archivo)) {
            $loop++;
            $line = fgets($archivo);
            $data[$loop] = explode(',', $line);
            $archivo++;
            if (($username == $data[$loop][0] || $email == $data[$loop][1]) && !$registered) {
                $errors[] = "<li>El nombre de usuario o correo electrónico ingresados ya se encuentran registrados.</li>";
                $registered = true;
            }
        }

        $registerData = "$username,$email,$encriptedPassword,$created_at";

        if (file_exists($fileName) && $registered != true) {
            if ($archivo = fopen($fileName, "a")) {
                fwrite($archivo, $registerData . "\n");
                fclose($archivo);
                $messages[] = "El usuario ha sido registrado exitosamente.";
            }
        }
    }
    if (isset($errors)) {
        foreach ($errors as $error) {
            $warning .= $error;
        }
        $warning = sha1($warning);
        $username = $_POST["username"];
        $email = $_POST["email"];
        header("Location: ../register.php?warning=$warning&username=$username&email=$email");
    }
    if (isset($messages)) {
        foreach ($messages as $message) {
            $success .= $message;
        }
        $success = sha1($success);
        $username = $_POST["username"];
        header("location:../index.php?success=$success&username=$username");
    }
}

/* Cerrar sesión */
if (isset($_POST['logout-btn'])) {
    if (isset($_SESSION['user_id'])) {
        session_destroy();
        header("location: ../index.php"); //Redirije a index.php
    }
}

/* Función para crear el archivo de registros en caso de no existir. */
function createFile()
{
    date_default_timezone_set('America/Mexico_City');

    $fileName = "registros.txt";
    if (!file_exists($fileName)) {
        $mensaje = "El Archivo $fileName se ha creado correctamente.";
        if ($archivo = fopen($fileName, "a")) {
            fwrite($archivo, date("d/m/Y g:ia") . " " . $mensaje . "\n");
            fclose($archivo);
        }
    }
}

/* Función para alertar al usuario sobre validaciones y éxito en el registro */
function textAlert()
{
    /* Estructura switch */
    switch ($_GET['warning']) {
        case '3d5f4deab95d598c8a2fc23e7ee72d5b8bac451a':
            echo '<div class="bg-warning text-light rounded-lg p-3 " style="font-size: 14px;
                    "><strong>¡Advertencia!</strong> El correo electrónico o nombre de usuario ingresados no se encuentran registrados. Por favor, diríjase a la Sección "Registrarse"</div>';
            break;
        case '9d3ffa0001e5244e6ae0c1fb92adb020d7e0da38':
            echo '<div class="bg-danger text-light rounded-lg p-3 " style="font-size: 14px;
                    "><strong>¡Error!</strong> Correo Electrónico / Contraseña inválidos. Intente nuevamente.</div>';
            break;
        case 'b165432c2ac41d7cc14b81c42370a889e0f4dace':
            echo '<div class="bg-danger text-light rounded-lg p-3 " style="font-size: 14px;"><strong>¡Error!</strong> Favor de verificar que se cumplan los siguientes campos:<li>Las contraseñas no coinciden</li></div>';
            break;
        case 'dfbda2363956ab6169ca1df5374c076b03a80c66':
            echo '<div class="bg-danger text-light rounded-lg p-3 " style="font-size: 14px;"><strong>¡Error!</strong><li>El nombre de usuario o correo electrónico ingresados, ya se encuentra registrado.</li></div>';
            break;
    }
    if (
        isset($_GET['warning']) && $_GET['warning'] == "69232514f27a8cb3ac9928d84ea06b375e641846" || $_GET['warning'] == "95347e1a2095a019de52b313f686422f443af8ba" || $_GET['warning'] == "82d025de0b64e0f52d602d48df4821b6b6b11042" || $_GET['warning'] == "e0ae0f981eb11bb38c73042780f53797a7f854aa" || $_GET['warning'] == "75f9954faccb3488a02c36a7cbdfb5c11a2c631b"
    ) {
        echo '<div class="bg-danger text-light rounded-lg p-3 " style="font-size: 14px;"><strong>¡Error!</strong><li>El password debe tener al menos 6 caracteres.</li><li>El password no puede tener más de 16 caracteres.</li><li>El password debe tener al menos una letra minúscula.</li><li>El password debe tener al menos una letra mayúscula.</li><li>El password debe tener al menos un número.</li></div>';
    } else if (isset($_GET['success']) && $_GET['success'] == "b866736afa95e3a93bbcf58292bcc5f14892c23e") {
        echo '<div class="bg-success text-light rounded-lg p-3 " style="font-size: 14px;
                    "><strong>¡Bien hecho!</strong> El usuario ha sido registrado exitosamente. Ya puede iniciar sesión.</div>';
    }
}

function sessionData()
{
    $sessionData[0] = $_SESSION['user_id'];
    $sessionData[1] = $_SESSION['email'];
    $sessionData[2] = $_SESSION['created_at'];
    $sessionData[3] = "Nombre de usuario: ";
    $sessionData[4] = "Email: ";
    $sessionData[5] = "Fecha de registro: ";

    return $sessionData;
}
