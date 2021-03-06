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
ALTER TABLE `mat_articulos` 
ADD COLUMN `preciodistribuidor` FLOAT NULL AFTER `estado`;

ALTER TABLE `drc_articulos` 
ADD COLUMN `preciodistribuidor` FLOAT NULL AFTER `estado`;

ALTER TABLE `sin_articulos` 
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
--20/06/2018
ALTER TABLE `mat_articulos` 
ADD COLUMN `idlote` INT NULL AFTER `preciodistribuidor`,
ADD COLUMN `aprobado` VARCHAR(5) NULL AFTER `idlote`,
ADD COLUMN `notas` VARCHAR(200) NULL AFTER `aprobado`;

ALTER TABLE `sin_articulos` 
ADD COLUMN `idlote` INT NULL AFTER `preciodistribuidor`,
ADD COLUMN `aprobado` VARCHAR(5) NULL AFTER `idlote`,
ADD COLUMN `notas` VARCHAR(200) NULL AFTER `aprobado`;

ALTER TABLE `drc_articulos` 
ADD COLUMN `idlote` INT NULL AFTER `preciodistribuidor`,
ADD COLUMN `aprobado` VARCHAR(5) NULL AFTER `idlote`,
ADD COLUMN `notas` VARCHAR(200) NULL AFTER `aprobado`;

ALTER TABLE `lotes` 
ADD COLUMN `fechapago` VARCHAR(45) NULL AFTER `moneda`,
ADD COLUMN `fecharecibido` VARCHAR(45) NULL AFTER `fechapago`,
ADD COLUMN `pagado` VARCHAR(5) NULL AFTER `fecharecibido`,
ADD COLUMN `recibido` VARCHAR(5) NULL AFTER `pagado`;

--24/06/2018
CREATE TABLE `drc_detalleventa` (
  `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descuentoporcentaje` float DEFAULT NULL,
  `descuentocantidad` float DEFAULT NULL,
  `preciomenudeo` float DEFAULT NULL,
  `preciomayoreo` float DEFAULT NULL,
  `tipoprecio` varchar(45) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`iddetalleventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `drc_ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(45) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `descuentoporcentaje` float DEFAULT NULL,
  `descuentocantidad` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `iva` float DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mat_detalleventa` (
  `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descuentoporcentaje` float DEFAULT NULL,
  `descuentocantidad` float DEFAULT NULL,
  `preciomenudeo` float DEFAULT NULL,
  `preciomayoreo` float DEFAULT NULL,
  `tipoprecio` varchar(45) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`iddetalleventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mat_ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(45) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `descuentoporcentaje` float DEFAULT NULL,
  `descuentocantidad` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `iva` float DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sin_detalleventa` (
  `iddetalleventa` int(11) NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `descuentoporcentaje` float DEFAULT NULL,
  `descuentocantidad` float DEFAULT NULL,
  `preciomenudeo` float DEFAULT NULL,
  `preciomayoreo` float DEFAULT NULL,
  `tipoprecio` varchar(45) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`iddetalleventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sin_ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(45) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `descuentoporcentaje` float DEFAULT NULL,
  `descuentocantidad` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `iva` float DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--25/06/2018
ALTER TABLE `lotes` 
ADD COLUMN `costoenvio` FLOAT NULL AFTER `recibido`;
--26/06/2018
CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `colonia` varchar(100) DEFAULT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `tienda` varchar(100) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `fechacaptura` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `notas` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--27/06/2018
ALTER TABLE `drc_ventas` 
ADD COLUMN `idcliente` INT NULL AFTER `iva`;
ALTER TABLE `mat_ventas` 
ADD COLUMN `idcliente` INT NULL AFTER `iva`;
ALTER TABLE `sin_ventas` 
ADD COLUMN `idcliente` INT NULL AFTER `iva`;
--30/06/2018
ALTER TABLE `lotes` 
ADD COLUMN `tipocambioenvio` FLOAT NULL AFTER `costoenvio`,
ADD COLUMN `monedaenvio` VARCHAR(10) NULL AFTER `tipocambioenvio`;

CREATE TABLE `costosextra` (
  `idcostoextra` int(11) NOT NULL AUTO_INCREMENT,
  `idlote` int(11) DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `tipocambio` float DEFAULT NULL,
  `moneda` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idcostoextra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--02/07/2018
CREATE TABLE `envios` (
  `idenvio` int(11) NOT NULL AUTO_INCREMENT,
  `idtiendade` int(11) DEFAULT NULL,
  `idtiendaa` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `notas` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idenvio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--04/07/2018
CREATE TABLE `detalleenvio` (
  `iddetalleenvio` int(11) NOT NULL AUTO_INCREMENT,
  `idenvio` int(11) DEFAULT NULL,
  `idarticulode` int(11) DEFAULT NULL,
  `idarticuloa` int(11) DEFAULT NULL,
  `cantidadenviada` int(11) DEFAULT NULL,
  `cantidadrecibida` int(11) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iddetalleenvio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--05/07/2018
ALTER TABLE `envios` 
DROP COLUMN `envioscol`,
ADD COLUMN `fechaenvio` VARCHAR(45) NULL AFTER `notas`,
ADD COLUMN `fecharecepcion` VARCHAR(45) NULL AFTER `fechaenvio`;
--18/07/2018
CREATE TABLE `mat_servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `esn` varchar(45) DEFAULT NULL,
  `folio` varchar(45) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `bateria` varchar(5) DEFAULT NULL,
  `tapa` varchar(5) DEFAULT NULL,
  `otro` varchar(100) DEFAULT NULL,
  `falla` varchar(300) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  `fechaentregaestimada` varchar(45) DEFAULT NULL,
  `contraseña` varchar(45) DEFAULT NULL,
  `costo` float DEFAULT NULL,
  `anticipo` float DEFAULT NULL,
  `fechaingresado` varchar(45) DEFAULT NULL,
  `fechaentregado` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `notas` varchar(250) DEFAULT NULL,
  `patron` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sin_servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `esn` varchar(45) DEFAULT NULL,
  `folio` varchar(45) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `bateria` varchar(5) DEFAULT NULL,
  `tapa` varchar(5) DEFAULT NULL,
  `otro` varchar(100) DEFAULT NULL,
  `falla` varchar(300) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  `fechaentregaestimada` varchar(45) DEFAULT NULL,
  `contraseña` varchar(45) DEFAULT NULL,
  `costo` float DEFAULT NULL,
  `anticipo` float DEFAULT NULL,
  `fechaingresado` varchar(45) DEFAULT NULL,
  `fechaentregado` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `notas` varchar(250) DEFAULT NULL,
  `patron` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `drc_servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `esn` varchar(45) DEFAULT NULL,
  `folio` varchar(45) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `bateria` varchar(5) DEFAULT NULL,
  `tapa` varchar(5) DEFAULT NULL,
  `otro` varchar(100) DEFAULT NULL,
  `falla` varchar(300) DEFAULT NULL,
  `observaciones` varchar(300) DEFAULT NULL,
  `fechaentregaestimada` varchar(45) DEFAULT NULL,
  `contraseña` varchar(45) DEFAULT NULL,
  `costo` float DEFAULT NULL,
  `anticipo` float DEFAULT NULL,
  `fechaingresado` varchar(45) DEFAULT NULL,
  `fechaentregado` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `notas` varchar(250) DEFAULT NULL,
  `patron` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--24/11/2018
CREATE TABLE `pdvweb`.`sin_bitacora` (
  `idbitacora` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NULL,
  `idservicio` INT NULL,
  `entrada` TEXT NULL,
  `fecha` VARCHAR(45) NULL,
  `prioridad` VARCHAR(45) NULL,
  PRIMARY KEY (`idbitacora`));

  CREATE TABLE `pdvweb`.`mat_bitacora` (
  `idbitacora` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NULL,
  `idservicio` INT NULL,
  `entrada` TEXT NULL,
  `fecha` VARCHAR(45) NULL,
  `prioridad` VARCHAR(45) NULL,
  PRIMARY KEY (`idbitacora`));

  CREATE TABLE `pdvweb`.`drc_bitacora` (
  `idbitacora` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NULL,
  `idservicio` INT NULL,
  `entrada` TEXT NULL,
  `fecha` VARCHAR(45) NULL,
  `prioridad` VARCHAR(45) NULL,
  PRIMARY KEY (`idbitacora`));

  --24/02/2019
CREATE TABLE `sin_servicios_refacciones` (
  `idserviciorefaccion` int(11) NOT NULL AUTO_INCREMENT,
  `idservicio` int(11) DEFAULT NULL,
  `idrefaccion` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `notas` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idserviciorefaccion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


  
