<?php


require_once(__DIR__ . '/controlador/ControladorAcceso.php');
$ControladorAcceso = new ControladorAcceso();
$controladorRegistrar = new controladorRegistro();


//INGRESAR
if(isset($_REQUEST['Validar'])){
    $ControladorAcceso->ValidarAcceso($_REQUEST['CorreoUsua'],$_REQUEST['ClaveUsuario']);
}

//REGISTRAR

if(isset($_REQUEST['botonRegistrar'])){
    $controladorRegistrar->registrarRegistro();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/ingresar.css">
    <title> JP licorera</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-menu" id="navMenu"></div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Ingresa</button>
            <button class="btn" id="registerBtn" onclick="register()">Registrate</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->
        
            <div class="login-container" id="login">
                <div class="top">
                    <span>¿Aún no tienes una cuenta? <a href="#" onclick="register()">Regístrate</a></span>
                    <header>Ingresa</header>
                </div>    


            <form class="form-signin" id="frmAcceso" name="frmAcceso" action="ingresar.php" method="POST">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Email" id="CorreoUsua" name="CorreoUsua">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" placeholder="Contraseña" id="ClaveUsuario" name="ClaveUsuario">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <button class="submit" type="submit" name="Validar" title="Botón para iniciar sesión">Ingresar</button>
                <br></br>
            </form>
            <a href="index.php"><button class="back">Volver</button></a>

            </div>
        

        <!------------------- registration form -------------------------->
        <div class="register-container" id="register">
            <div class="top">
                <header>Regístrate</header>
            </div>
                <form action="ingresar.php" method="POST">
                    <div class="two-forms">
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Nombre" name="NombreUsuario">
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Apellido" name="ApellidoUsuario">
                            <i class="bx bx-user"></i>
                        </div>
                    </div>
                    <div class="two-forms">
                        <div class="input-box">
                            <select class="input-field" name="TipoDocumento">
                                <option value="" disabled selected>Tipo de documento</option>
                                <option value="Cedula" style="color: black;">Cedula</option>
                                <option value="Tarjeda de identidad"  style="color: black;">Tarjeta de identidad</option>
                                <option value="Pasaporte"  style="color: black;">Otro</option>
                            </select>
                            <i class='bx bx-user'></i>
                        </div>
                        <div class="input-box">
                            <input type="text" class="input-field" placeholder="Documento" name="DocumentoUsua">
                            <i class='bx bx-file'></i>
                        </div>
                    </div>
                    <div class="two-forms">

                        <div class="input-box" style = "margin-right: 20px;">

                            <input type="date" class="input-field" name="FechaNacUsua">
                            <i class='bx bx-file'></i>
                        </div>

                        <div class="input-box">
                            <select class="input-field" name="Genero">
                                <option value="" disabled selected>Seleccione su género</option>
                                <option value="Masculino" style="color: black;">Masculino</option>
                                <option value="Femenino"  style="color: black;">Femenino</option>
                                <option value="Prefiero no decirlo"  style="color: black;">Otro</option>
                            </select>
                            <i class='bx bx-user'></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Numero de celular" name="CelUsua">
                        <i class='bx bx-mobile'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" class="input-field" placeholder="Email" name="CorreoUsua">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <div class="input-box">
                            <input type="password" class="input-field" placeholder="Contraseña" name="ClaveUsuario">
                            <i class='bx bx-lock'></i>
                    </div>
                    <button class="submit" type="submit" name="botonRegistrar" title="Botón para registrarse">Registrar</button>
                </form>
            
        </div>

    </div>
</div>   



<script>
   
   function myMenuFunction() {
        var i = document.getElementById("navMenu");

        if(i.className === "nav-menu") {
        i.className += " responsive";
        } else {
        i.className = "nav-menu";
        }
    }
 
</script>

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

</script>


</body>
</html>