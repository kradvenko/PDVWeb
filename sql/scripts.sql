CREATE TABLE `ciudades` (
  `idciudad` int(11) NOT NULL AUTO_INCREMENT,
  `idpais` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE `paises` (
  `idpais` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpais`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

CREATE TABLE `regiones` (
  `idregion` int(11) NOT NULL AUTO_INCREMENT,
  `idtiporegion` int(11) DEFAULT NULL,
  `idpais` int(11) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idregion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

CREATE TABLE `tiposregiones` (
  `idtiporegion` int(11) NOT NULL AUTO_INCREMENT,
  `tiporegion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idtiporegion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
<!--29/04/2018-->
CREATE TABLE `categoriasinstitucion` (
  `idcategoriainstitucion` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcategoriainstitucion`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `instituciones` (
  `idinstitucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombreInstitucion` varchar(100) DEFAULT NULL,
  `sectorInstitucion` varchar(45) DEFAULT NULL,
  `tipoInstitucion` varchar(45) DEFAULT NULL,
  `sitioWeb` varchar(100) DEFAULT NULL,
  `correoElectronico` varchar(150) DEFAULT NULL,
  `telefonos` varchar(100) DEFAULT NULL,
  `extension` varchar(45) DEFAULT NULL,
  `domicilio` varchar(200) DEFAULT NULL,
  `colonia` varchar(100) DEFAULT NULL,
  `codigoPostal` varchar(45) DEFAULT NULL,
  `idpais` int(11) DEFAULT NULL,
  `idregion` int(11) DEFAULT NULL,
  `idciudad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idinstitucion`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `institucioncategorias` (
  `idinstitucioncategoria` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` int(11) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idinstitucioncategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
<!--07/05/2018-->
CREATE TABLE `contactos` (
  `idcontacto` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` varchar(45) DEFAULT NULL,
  `nombreContacto` varchar(250) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `telefonos` varchar(100) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `correoElectronico` varchar(100) DEFAULT NULL,
  `notas` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idcontacto`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
<!--17/05/2018-->
CREATE TABLE `albumes` (
  `idalbum` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` int(11) DEFAULT NULL,
  `album` varchar(150) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `numerofotografias` int(11) DEFAULT NULL,
  PRIMARY KEY (`idalbum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `autores` (
  `idautor` int(11) NOT NULL AUTO_INCREMENT,
  `autor` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idautor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `estudiosfotograficos` (
  `idestudiofotografico` int(11) NOT NULL AUTO_INCREMENT,
  `estudio` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idestudiofotografico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `fotografiatemas` (
  `idfotografiatema` int(11) NOT NULL AUTO_INCREMENT,
  `idfotografia` int(11) DEFAULT NULL,
  `tema` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idfotografiatema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `temas` (
  `idtema` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idtema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tecnicasfotograficas` (
  `idtecnicafotografica` int(11) NOT NULL AUTO_INCREMENT,
  `tecnica` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idtecnicafotografica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `soportesflexibles` (
  `idsoporteflexible` int(11) NOT NULL AUTO_INCREMENT,
  `soporte` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsoporteflexible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `soportesrigidos` (
  `idsoporterigido` int(11) NOT NULL AUTO_INCREMENT,
  `soporterigido` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsoporterigido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `generosfotografia` (
  `idgenerofotografia` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idgenerofotografia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
--//19/05/2018
--Notas de cambios en la base de datos
--Se ha cambiado la forma en la que funciona el guardado de
--el sitio web. Ahora se pueden tener varios sitios web y agregar
--una nota para cada sitio web
CREATE TABLE `institucionsitiosweb` (
  `idinstitucionsitioweb` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` int(11) DEFAULT NULL,
  `sitio` varchar(150) DEFAULT NULL,
  `notas` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idinstitucionsitioweb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `institucioncorreos` (
  `idinstitucioncorreo` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` int(11) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `notas` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idinstitucioncorreo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `instituciontelefonos` (
  `idinstituciontelefono` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` int(11) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `extension` varchar(45) DEFAULT NULL,
  `notas` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idinstituciontelefono`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `institucionareas` (
  `idinstitucionarea` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` int(11) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `notas` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idinstitucionarea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `contactos` (
  `idcontacto` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` varchar(45) DEFAULT NULL,
  `nombreContacto` varchar(250) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `telefonos` varchar(100) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `correoElectronico` varchar(100) DEFAULT NULL,
  `notas` varchar(400) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idcontacto`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `institucionpendientes` (
  `idinstitucionpendiente` int(11) NOT NULL AUTO_INCREMENT,
  `idinstitucion` int(11) DEFAULT NULL,
  `pendiente` varchar(300) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `fechaInicio` varchar(45) DEFAULT NULL,
  `fechaFin` varchar(45) DEFAULT NULL,
  `resolucion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idinstitucionpendiente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

