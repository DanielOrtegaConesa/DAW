/*DROP DATABASE IF EXISTS TRABAJO_DAW;
CREATE DATABASE TRABAJO_DAW;
USE TRABAJO_DAW;
*/  


DROP TABLE IF EXISTS lineasAlbaranes;
DROP TABLE IF EXISTS lineasFacturas;
DROP TABLE IF EXISTS lineasPedidos;
DROP TABLE IF EXISTS accesos;

DROP TABLE IF EXISTS articulos;
DROP TABLE IF EXISTS facturas;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS albaranes;
DROP TABLE IF EXISTS usuariosGestion;
DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS solicitudes;


CREATE TABLE solicitudes(
idSolicitud INT AUTO_INCREMENT,
dni VARCHAR(9),
razonSocial VARCHAR(50),
domicilioSocial VARCHAR(50),
ciudad VARCHAR(50),
email VARCHAR(50),
telefono INT(9),
nick VARCHAR(50),
pass VARCHAR(50),
PRIMARY KEY (idSolicitud)
);

CREATE TABLE clientes(
codCliente INT AUTO_INCREMENT,
dni VARCHAR(9),
razonSocial VARCHAR(50),
domicilioSocial VARCHAR(50),
ciudad VARCHAR(50),
email VARCHAR(50),
telefono INT(9),
nick VARCHAR(50) UNIQUE NOT NULL,
pass VARCHAR(50) NOT NULL,
activo TINYINT(1),#para dar de baja un cliente en lugar de borrarlo
img VARCHAR(200) DEFAULT "vista/img/usuarios/default.jpg",
PRIMARY KEY (codCliente)
);

CREATE TABLE pedidos(
codPedido INT AUTO_INCREMENT,
codCliente INT,
fecha DATETIME,
generadoPorCliente TINYINT(1),#para saber si ha sido un cliente el que ha realizado el pedido
#enviado
PRIMARY KEY (codPedido)
);

CREATE TABLE albaranes(
codAlbaran INT AUTO_INCREMENT,
codCliente INT,
fecha DATETIME,
concepto VARCHAR(50),
#facturado
PRIMARY KEY (codAlbaran)
);

CREATE TABLE facturas(
codFactura  INT AUTO_INCREMENT,
codCliente INT,
fecha DATETIME,
descuentoFactura DOUBLE, 
concepto VARCHAR(50),
PRIMARY KEY (codFactura)
);

CREATE TABLE lineasPedidos(
numLineaPedido INT, #no puede ser auto incrementable 
codPedido INT,
codArticulo INT,
codUsuarioGestion INT,
precio DOUBLE,
cantidad INT
);

CREATE TABLE lineasAlbaranes(
numLineaAlbaran INT,
codAlbaran INT,
codArticulo INT,
codUsuarioGestion INT,
numLineaPedido INT NOT NULL,
codPedido INT,
precio DOUBLE,
cantidad INT,
descuento DOUBLE,
iva DOUBLE
);

CREATE TABLE lineasFacturas(
numLineaFactura INT,
codFactura INT,
codArticulo INT,
codUsuarioGestion INT,
numLineaAlbaran INT NOT NULL,
codAlbaran INT,
precio DOUBLE,
cantidad INT,
descuento DOUBLE,
iva DOUBLE
);

CREATE TABLE usuariosGestion(
codUsuarioGestion INT AUTO_INCREMENT,
nombre VARCHAR(50),
nick VARCHAR(50),
pass VARCHAR(50),
PRIMARY KEY (codUsuarioGestion)
);


CREATE TABLE articulos(
codArticulo INT AUTO_INCREMENT,
img VARCHAR(200) DEFAULT "vista/img/articulos/default.png",
nombre VARCHAR(50),
descripcion VARCHAR(1000),
precio DOUBLE,
descuento DOUBLE,
iva DOUBLE DEFAULT 1.21,
PRIMARY KEY (codArticulo)
);


CREATE TABLE accesos(
idAcceso INT AUTO_INCREMENT,
codUsuarioGestion INT,
fechaHoraAcceso DATETIME,
fechaHoraSalida DATETIME,
PRIMARY KEY (idAcceso)
);


/*
	PRIMARY KEYS
*/
ALTER TABLE lineasPedidos ADD PRIMARY KEY (numLineaPedido,codPedido);
ALTER TABLE lineasAlbaranes ADD PRIMARY KEY (numLineaAlbaran,codAlbaran);
ALTER TABLE lineasFacturas ADD PRIMARY KEY (numLineaFactura,codFactura);

ALTER TABLE lineasAlbaranes ADD UNIQUE (numLineaPedido, codPedido);
ALTER TABLE lineasFacturas ADD UNIQUE (numLineaAlbaran, codAlbaran);


/*
	Insert
*/

/*
	FOREING KEYS
*/
# La recogen de clientes
ALTER TABLE pedidos ADD CONSTRAINT FK_PEDIDOS_CLIENTES FOREIGN KEY (codCliente) REFERENCES clientes (codCliente) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE albaranes ADD CONSTRAINT FK_ALBARANES_CLIENTES FOREIGN KEY (codCliente) REFERENCES clientes (codCliente) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE facturas ADD CONSTRAINT FK_FACTURAS_CLIENTES FOREIGN KEY (codCliente) REFERENCES clientes (codCliente) ON UPDATE CASCADE ON DELETE RESTRICT;

# de sus respectivas a lineas
ALTER TABLE lineasPedidos ADD CONSTRAINT FK_PEDIDO_LINEAS FOREIGN KEY (codPedido) REFERENCES pedidos (codPedido) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE lineasAlbaranes ADD CONSTRAINT FK_ALBARAN_LINEAS FOREIGN KEY (codAlbaran) REFERENCES albaranes (codAlbaran) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE lineasFacturas ADD CONSTRAINT FK_FACTURAS_LINEAS FOREIGN KEY (codFactura) REFERENCES facturas (codFactura) ON UPDATE CASCADE ON DELETE RESTRICT;

# de articulos a lineas
ALTER TABLE lineasPedidos ADD CONSTRAINT FK_ARTICULO_LP FOREIGN KEY (codArticulo) REFERENCES articulos (codArticulo) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE lineasAlbaranes ADD CONSTRAINT FK_ARTICULO_LA FOREIGN KEY (codArticulo) REFERENCES articulos (codArticulo) ON UPDATE CASCADE ON DELETE RESTRICT;
ALTER TABLE lineasFacturas ADD CONSTRAINT FK_ARTICULO_LF FOREIGN KEY (codArticulo) REFERENCES articulos (codArticulo) ON UPDATE CASCADE ON DELETE RESTRICT;

#de usuarios gestion a accesos
ALTER TABLE accesos ADD CONSTRAINT FK_UGESTION_ACCESOS FOREIGN KEY (codUsuarioGestion) REFERENCES usuariosGestion (codUsuarioGestion);

#de usuarios gestion a lineas
ALTER TABLE lineasPedidos ADD CONSTRAINT FK_UGESTION_LP FOREIGN KEY (codUsuarioGestion) REFERENCES usuariosGestion (codUsuarioGestion);
ALTER TABLE lineasAlbaranes ADD CONSTRAINT FK_UGESTION_LA FOREIGN KEY (codUsuarioGestion) REFERENCES usuariosGestion (codUsuarioGestion);
ALTER TABLE lineasFacturas ADD CONSTRAINT FK_UGESTION_LF FOREIGN KEY (codUsuarioGestion) REFERENCES usuariosGestion (codUsuarioGestion);

