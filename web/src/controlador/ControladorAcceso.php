<?php
//incluir un archivo
require_once(__DIR__ . '/../modelo/Usuario.php');
require_once(__DIR__ . '/../modelo/Acceso.php');


class ControladorAcceso{

    public function __construct(){

    }

    public function ValidarAcceso($CorreoUsua, $ClaveUsuario){
        $Usuario = new Usuario();
        $Usuario->setCorreoUsua($CorreoUsua);
        $Usuario->setClaveUsuario($ClaveUsuario);
        $Acceso = new Acceso();
        $Acceso->ValidarAcceso($Usuario);
        if($Usuario->getUsuarioLogueado()==1){
            session_start();//variables de sesion
            session_regenerate_id(true);//evita fijacion de sesion
            $_SESSION['CorreoUsua'] = $CorreoUsua;
            $_SESSION['NombreUsuario'] = $Usuario->getNombreUsuario();
            $_SESSION['ApellidoUsuario'] = $Usuario->getApellidoUsuario();
            $_SESSION['Rol'] = $Usuario->getRol();
            $_SESSION['DocumentoUsua'] = $Usuario->getDocumentoUsua();
                header("Location:vista/carrito.php");
        }
        else{
            ?>
            <script>alert("usuario y/o contraseña incorrectos");</script>
            <?php 
        } 
    }


    public function DestruirSesion(){
        session_destroy();//destruir la session
        header("Location:../");

    }


}

class controladorRegistro{
    
    public function __construct(){}


    public function registrarRegistro(){
        $registro = new Usuario(); //Creando un objeto de la clase Encuesta
        //Setear el objeto con los valores ingresados en el formulario
        $registro->setDocumentoUsua($_REQUEST['DocumentoUsua']);
        $registro->setTipoDocumento($_REQUEST['TipoDocumento']);
        $registro->setGenero($_REQUEST['Genero']);
        $registro->setNombreUsuario($_REQUEST['NombreUsuario']);
        $registro->setApellidoUsuario($_REQUEST['ApellidoUsuario']);
        $registro->setFechaNacUsua($_REQUEST['FechaNacUsua']);
        $registro->setCelUsua($_REQUEST['CelUsua']);
        $registro->setCorreoUsua($_REQUEST['CorreoUsua']);
        $registro->setClaveUsuario($_REQUEST['ClaveUsuario']);//el hash se genera en el modelo (password_hash)
        $crudRegistrar = new Registrar();
        echo $crudRegistrar->registrarRegistro($registro);//Llamado al método del crud  
    }
}