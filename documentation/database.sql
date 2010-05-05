CREATE TABLE `Categoria` (
      `CatID` tinyint(4) NOT NULL auto_increment,
      `Categoria` varchar(50) NOT NULL default '',
      PRIMARY KEY  (`CatID`),
      UNIQUE KEY `Categoria` (`Categoria`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    INSERT INTO `Categoria` VALUES (1,'Almacenamiento'),(2,'Audio/Sonido'),
                                   (3,'Cables'),        (4,'Camaras'),
                                   (5,'Copiadoras'),    (6,'Energia'),
                                   (7,'FAX'),           (8,'Gabinetes'),
                                   (9,'Impresoras'),    (10,'Memoria'),
                                   (11,'Miscelanea'),   (12,'Monitores'),
                                   (13,'Mouse'),        (14,'Muebles'),
                                   (15,'Notebooks'),    (16,'PCs'),
                                   (17,'PDAs'),         (18,'Redes'),
                                   (19,'Scanners'),     (20,'Tarjetas Madres'),
                                   (21,'Teclados'),     (22,'Telefonia'),
                                   (23,'Video'),        (26,'No Computacional');

    CREATE TABLE `Vendedores` (
      `UserID` int(7) NOT NULL auto_increment,
      `ApellidoPaterno` varchar(25) NOT NULL default '',
      `ApellidoMaterno` varchar(25) default '',
      `Nombres` varchar(30) NOT NULL default '',
      `Login` varchar(25) NOT NULL default '',
      `PWD` varchar(50) NOT NULL default '',
      `Fecha` date NOT NULL default '0000-00-00',
      `Correo` varchar(75) NOT NULL default '',
      `MexTelLada` varchar(2) NOT NULL default '0',
      `MexTelFront` varchar(4) NOT NULL default '0',
      `MexTelBack` varchar(4) NOT NULL default '0',
      PRIMARY KEY  (`UserID`),
      UNIQUE KEY `Login` (`Login`),
      UNIQUE KEY `Correo` (`Correo`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE `Ventas` (
      `VentaID` int(7) NOT NULL auto_increment,
      `UserID` int(7) NOT NULL default '0',
      `Fecha` date NOT NULL default '0000-00-00',
      `Articulo` varchar(175) NOT NULL default '',
      `Cantidad` tinyint(4) NOT NULL default '1',
      `Descripcion` varchar(250) NOT NULL default '',
      `Calidad` enum('Excelente','Muy Buena','Buena','Regular','Partes') default 'Muy Buena',
      `Precio` varchar(10) NOT NULL default '00.00',
      `LinkFoto` varchar(175) default '',
      `CompraVenta` enum('Se Vende','Quiero Comprar') default 'Se Vende', `InterCambiar` varchar(12) default '',
      `CambiarParaQue` varchar(250) default '',
      `Categoria` varchar(50) NOT NULL default '',
      PRIMARY KEY  (`VentaID`),
      KEY `UserID` (`UserID`),
      KEY `Categoria` (`Categoria`),
      CONSTRAINT `Ventas_ibfk_2` FOREIGN KEY (`Categoria`) REFERENCES `Categoria` (`Categoria`),
      CONSTRAINT `Ventas_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Vendedores` (`UserID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

