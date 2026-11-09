<?php
require_once(__DIR__ . '/Conexion.php');

class Acceso{ 

    public function __construct(){

    }

    public function ValidarAcceso($Usuario){
        $mensaje = "";
        $BaseDatos = Conexion::Conectar();

        $sql = $BaseDatos->prepare('SELECT u.NombreUsuario, u.ApellidoUsuario, u.DocumentoUsua, u.Rol, Ul.CorreoUsua, Ul.ClaveUsuario FROM usuario u
        INNER JOIN usuariologin Ul ON u.CorreoUsua = Ul.CorreoUsua
        WHERE Ul.CorreoUsua = :CorreoUsua');

        $sql->bindValue('CorreoUsua', $Usuario->getCorreoUsua());
        try{
            $sql->execute();
            $Usuario->setUsuarioLogueado(0);//asignar que el usuario no se logueo
            $DatosUsuario = $sql->fetch();//registro del usuario (o false si el correo no existe)

            // La clave se guarda con password_hash(); aqui se compara con password_verify()
            if($DatosUsuario && password_verify((string)$Usuario->getClaveUsuario(), $DatosUsuario['ClaveUsuario'])){
                $Usuario->setClaveUsuario('');
                $Usuario->setUsuarioLogueado(1);

                $Usuario->setNombreUsuario($DatosUsuario['NombreUsuario']);
                $Usuario->setApellidoUsuario($DatosUsuario['ApellidoUsuario']);
                $Usuario->setRol($DatosUsuario['Rol']);
                $Usuario->setDocumentoUsua($DatosUsuario['DocumentoUsua']);
            }
        }
        catch(Exception $e){
            error_log('Error al validar acceso: ' . $e->getMessage());
        }
        Conexion::Desconectar($BaseDatos);
        //contiene los registros de la consulta
        return $mensaje;
   
    }


}

Class Registrar{
    public function __construct(){
        
    }

    public function registrarRegistro($registro){
        $mensaje = "";
        
        $basedatos = Conexion::Conectar();

        $sql = $basedatos->prepare('INSERT INTO usuario(DocumentoUsua, TipoDocumento, Rol, Genero, NombreUsuario, ApellidoUsuario, FechaNacUsua, CelUsua, CorreoUsua)
                                    VALUES(:DocumentoUsua, :TipoDocumento, "Cliente", :Genero, :NombreUsuario, :ApellidoUsuario, :FechaNacUsua, :CelUsua, :CorreoUsua)');
        $sql->bindValue('DocumentoUsua', $registro->getDocumentoUsua());
        $sql->bindValue('TipoDocumento', $registro->getTipoDocumento());
        $sql->bindValue('Genero', $registro->getGenero());
        $sql->bindValue('NombreUsuario', $registro->getNombreUsuario());
        $sql->bindValue('ApellidoUsuario', $registro->getApellidoUsuario());
        $sql->bindValue('FechaNacUsua', $registro->getFechaNacUsua());
        $sql->bindValue('CelUsua', $registro->getCelUsua());
        $sql->bindValue('CorreoUsua', $registro->getCorreoUsua());

        $sql2 = $basedatos->prepare('INSERT INTO usuariologin(CorreoUsua,ClaveUsuario)
                                     VALUES(:CorreoUsua, :ClaveUsuario)');
        $sql2->bindValue('CorreoUsua', $registro->getCorreoUsua());
        $sql2->bindValue('ClaveUsuario', password_hash((string)$registro->getClaveUsuario(), PASSWORD_DEFAULT));

        try{
            $sql->execute();//ejectar sql
            $sql2->execute();
            $mensaje = '<script language="javascript">
                            alert("Registro Exitoso");
                            window.location.href = "ingresar.php";
                        </script>'; 
        }
        catch(Exception $e){
            $mensaje = $e->getMessage();
        }
        Conexion::Desconectar($basedatos);
        return $mensaje;
    }
}
?>