-- Script de inicialización de la base de datos de Licorera JP.
-- MySQL lo ejecuta automáticamente la PRIMERA vez que se crea el volumen de datos
-- (carpeta /docker-entrypoint-initdb.d). La base de datos y el usuario los crean
-- las variables MYSQL_DATABASE / MYSQL_USER / MYSQL_PASSWORD del docker-compose.yml.



SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS usuario (
    DocumentoUsua   VARCHAR(20)  NOT NULL,
    TipoDocumento   VARCHAR(30)  NOT NULL,
    Rol             VARCHAR(20)  NOT NULL DEFAULT 'Cliente',
    Genero          VARCHAR(30)  NOT NULL,
    NombreUsuario   VARCHAR(60)  NOT NULL,
    ApellidoUsuario VARCHAR(60)  NOT NULL,
    FechaNacUsua    DATE         NULL,
    CelUsua         VARCHAR(20)  NULL,
    CorreoUsua      VARCHAR(100) NOT NULL,
    PRIMARY KEY (DocumentoUsua),
    UNIQUE KEY uq_usuario_correo (CorreoUsua)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS usuariologin (
    CorreoUsua   VARCHAR(100) NOT NULL,
    ClaveUsuario VARCHAR(255) NOT NULL,
    PRIMARY KEY (CorreoUsua),
    CONSTRAINT fk_login_usuario FOREIGN KEY (CorreoUsua) REFERENCES usuario (CorreoUsua)
        ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pedidos (
    idPedido              INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    NombreDestinatario    VARCHAR(60)   NOT NULL,
    ApellidoDestinatario  VARCHAR(60)   NOT NULL,
    CorreoDestinatario    VARCHAR(100)  NOT NULL,
    CelularDestinatario   VARCHAR(20)   NOT NULL,
    DireccionDestinatario VARCHAR(150)  NOT NULL,
    OpcionPago            VARCHAR(30)   NOT NULL,
    TotalCompra           DECIMAL(12,2) NOT NULL DEFAULT 0,
    FechaPedido           TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (idPedido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS productos_pedidos (
    idProductoPedido INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    idPedido         INT UNSIGNED  NOT NULL,
    nombreProducto   VARCHAR(150)  NOT NULL,
    cantidad         INT UNSIGNED  NOT NULL DEFAULT 1,
    PrecioProducto   DECIMAL(12,2) NOT NULL,
    PRIMARY KEY (idProductoPedido),
    CONSTRAINT fk_prodped_pedido FOREIGN KEY (idPedido) REFERENCES pedidos (idPedido)
        ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla usada por prueba_db.php para demostrar la comunicación web <-> db
CREATE TABLE IF NOT EXISTS prueba_comunicacion (
    id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    mensaje   VARCHAR(255) NOT NULL,
    origen    VARCHAR(100) NOT NULL,
    creado_en TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
