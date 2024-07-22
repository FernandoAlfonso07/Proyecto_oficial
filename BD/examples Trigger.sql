create schema someThimes;
use someThimes;


CREATE TABLE tb_conteo( -- // CREACION DE LA TABLA PARA ALMACENAR LOS TRIGGER
id_conteo int not null auto_increment,
descripcion varchar(10) null,
conteo int not null,
fec_reg datetime not null,
primary key(id_conteo)
);

CREATE TABLE usuarios(
id_user int not null auto_increment,
name varchar(100) null,
fec_reg datetime not null,
primary key(id_user)
);



DELIMITER // -- Se deben de agregar los DELIMITER
CREATE TRIGGER count_elements -- // Este es un TRIGGER PARA CUANDO SE ELIMINA ALGUN REGISTRO
AFTER DELETE ON 
	usuarios
FOR EACH ROW BEGIN
	INSERT INTO tb_conteo
	VALUES (null, 'Borrado',1, now() );
END;
//

DELIMITER // --  
CREATE TRIGGER count_elements_inserts -- // Este es un TRIGGER PARA CUANDO SE INGRESA UN NUEVO REGISTRO
AFTER INSERT ON 
	usuarios
FOR EACH ROW BEGIN
	INSERT INTO tb_conteo
	VALUES (null, 'Insertado',1, now() );
END;
//
-- // DROP TRIGGER count_elements; Para borrar los TRIGGER

DROP TRIGGER count_elements;

SELECT * FROM usuarios;
SELECT * FROM tb_conteo;






DELIMITER //

CREATE TRIGGER contando_elementos_detallado
AFTER INSERT ON 
	usuarios
FOR EACH ROW BEGIN
	DELETE FROM tb_conteo;
	INSERT INTO tb_conteo
	SELECT NULL AS id_conteo, 'Registrado' as descripcion, COUNT(id_user) as conteo_Total, now() as fecha_reg
	FROM usuarios
	GROUP BY id_conteo, descripcion, conteo_Total,fecha_reg;
END;
//

# F U N C I O N E S
DELIMITER //
CREATE FUNCTION sumar(n1 float, n2 float)
returns float
return n1 + n2;
//


DELIMITER //
CREATE FUNCTION promedio (n1 float, n2 float) 	
returns float
return sumar(n1, n2) / 2;
//

DROP FUNCTION promedio;

SELECT promedio(4, 4.5) as promedio;

DELIMITER //
CREATE FUNCTION conteo (tabla varchar(100)) 	
returns float
BEGIN

SELECT COUNT(*) INTO @conteo FROM tabla;
return @conteo;
END;
//

SELECT conteo('usuarios');

DELIMITER //
CREATE FUNCTION conteoUsers () 	
	returns float
BEGIN
	SELECT COUNT(*) INTO @conteo FROM usuarios;
	return @conteo;
END;
//
SELECT conteoUsers();

-- // ********************************************************************
DELIMITER //
CREATE FUNCTION userMoney (users float) 	
	returns float
BEGIN
	return conteoUsers() * 4.018;
END;
//

SELECT userMoney(conteoUsers());

