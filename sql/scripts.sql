CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `categoria` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `drc_articulos` (
  `idarticulo` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `idmatriz` int(11) DEFAULT NULL,
  `codigo` varchar(60) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `minimo` int(11) DEFAULT NULL,
  `costopublico` float DEFAULT NULL,
  `costoreal` float DEFAULT NULL,
  `costodistribuidor` float DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idarticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `marcas` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mat_articulos` (
  `idarticulo` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `idmatriz` int(11) DEFAULT NULL,
  `codigo` varchar(60) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `minimo` int(11) DEFAULT NULL,
  `costopublico` float DEFAULT NULL,
  `costoreal` float DEFAULT NULL,
  `costodistribuidor` float DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idarticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mat_preciosmayoreo` (
  `idpreciosmayoreo` int(11) NOT NULL AUTO_INCREMENT,
  `idarticulo` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `de` int(11) DEFAULT NULL,
  `a` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpreciosmayoreo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sin_articulos` (
  `idarticulo` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) DEFAULT NULL,
  `idmatriz` int(11) DEFAULT NULL,
  `codigo` varchar(60) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `minimo` int(11) DEFAULT NULL,
  `costopublico` float DEFAULT NULL,
  `costoreal` float DEFAULT NULL,
  `costodistribuidor` float DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idarticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tiendas` (
  `idtienda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `prefijo` varchar(5) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `idmatriz` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `prefijo` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(45) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `descuentoporcentaje` float DEFAULT NULL,
  `descuentocantidad` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `cambio` float DEFAULT NULL,
  `iva` float DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--13/06/2018
ALTER TABLE `pdvweb`.`mat_articulos` 
ADD COLUMN `preciodistribuidor` FLOAT NULL AFTER `estado`;

ALTER TABLE `pdvweb`.`drc_articulos` 
ADD COLUMN `preciodistribuidor` FLOAT NULL AFTER `estado`;

ALTER TABLE `pdvweb`.`sin_articulos` 
ADD COLUMN `preciodistribuidor` FLOAT NULL AFTER `estado`;
--17/06/2018
CREATE TABLE `origeneslote` (
  `idorigenlote` int(11) NOT NULL AUTO_INCREMENT,
  `origen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idorigenlote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `lotes` (
  `idlote` int(11) NOT NULL AUTO_INCREMENT,
  `idorigen` int(11) DEFAULT NULL,
  `fechalote` varchar(45) DEFAULT NULL,
  `tipocambio` float DEFAULT NULL,
  `fechaingreso` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `costolote` float DEFAULT NULL,
  `moneda` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idlote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
