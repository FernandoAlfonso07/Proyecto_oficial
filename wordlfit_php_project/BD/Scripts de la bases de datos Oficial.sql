create schema worldfitsbd;
use worldfitsbd;
SET sql_safe_updates = 0;	
-- Esta es la tabla de USUARIOS

create table usuarios(
	id_usuario int not null auto_increment,
    nombre varchar(100) not null,
    apellido varchar(100) null,
    correo varchar(100) not null,
    contraseña varchar(100) not null,
    peso_actual float not null,
    altura_actual float not null,
    id_genero boolean null,
    telefono int not null,
    pr int null,
    fecha_registro datetime null,
    
    
    primary key (id_usuario)
);
-- delete from usuarios;



-- ------------------------------------------------ Informacion de usurio;
-- select t1.nombre, t1.apellido, t1.correo, t1.contraseña, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero
-- FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = 3;

-- select t1.nombre, t1.apellido, t1.correo, t1.contraseña, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero
-- FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE correo = 'alfonso07amaya@gmail.com';

-- Esta es la tabla de GENERO

create table genero(
	id_genero boolean not null,
    genero varchar(100) not null,
    
    primary key(id_genero)
);

insert into genero (id_genero, genero) values (1, "masculino");
insert into genero (id_genero, genero) values (0, "femenino");

-- Creación llave foranea de la tabla USUARIOS y la tabla GENERO

ALTER TABLE usuarios
ADD CONSTRAINT FK_usuario_genero
foreign key (id_genero) references genero(id_genero);

-- creacion tabla EJERCICIOS 

create table ejercicios(

	id_ejercicio int not null auto_increment,
    nombre varchar(100) not null,
    fecha_registro datetime not null,
    id_media int null,
    
    primary key(id_ejercicio)

);

-- Creacion de la tabla para almacenar las rutas de los contenidos multimedia-----------------

create table media (
	id_media int not null auto_increment,
    direccion varchar(1000) not null,
    primary key (id_media)
);
select * from media;


alter table ejercicios
add constraint FK_meida_ejercicio
foreign key (id_media) references media(id_media);


-- creacion tabla RUTINAS 

create table rutinas(

	id_rutina int not null auto_increment,
    nombreRutina varchar(100) not null,
    descripcion varchar(200) not null,
    objetivo varchar(100) not null,
	fecha_registro datetime not null,
	primary key(id_rutina)
    
);

-- creacion relacion M:M de las tablas ejercicio y rutinas

create table ejercicio_rutinas(
	
    id_relacion int not null auto_increment,
	id_rutina int null,
    id_ejercicio int null,
    
    primary key(id_relacion)
);

-- creacion llaves foraneas para la relacion M:M de las tablas ejercicio y relacion...

ALTER TABLE ejercicio_rutinas
ADD constraint FK_ejercicio_rutinas_tb_ejerciciostb
foreign key (id_ejercicio) references ejercicios(id_ejercicio);

-- creacion llaves foraneas para la relacion M:M de las tablas rutinas y relacion...

ALTER TABLE ejercicio_rutinas
ADD constraint FK_ejercicio_rutinas_tb_rutinastb
foreign key (id_rutina) references rutinas(id_rutina);

-- Creacion de la tabla de los dias de la semana que va a trabjar Worldfit..

create table dias_semana (

	id_dia int not null,
    nombre varchar(80),
    
    primary key(id_dia)

);
select * from dias_semana;
insert into dias_semana (id_dia, nombre) values (0, 'Domingo');
insert into dias_semana (id_dia, nombre) values (1, 'Lunes');
insert into dias_semana (id_dia, nombre) values (2, 'Martes');
insert into dias_semana (id_dia, nombre) values (3, 'Miercoles');
insert into dias_semana (id_dia, nombre) values (4, 'Jueves');
insert into dias_semana (id_dia, nombre) values (5, 'Viernes');
insert into dias_semana (id_dia, nombre) values (6, 'Sabado');


-- Creacion de la tabla calendario rutinario del usuario.

create table relacion_dia_rutina(

	id_relacion_d_r int not null auto_increment,
    id_dia int null,
    id_rutina int null,
    
    primary key(id_relacion_d_r)

);
select * from relacion_dia_rutina;



-- creacion de las llaves foraneas para el id de la tabla DIA SEMANAS

ALTER TABLE relacion_dia_rutina 
ADD CONSTRAINT FK_relacion_dia_rutina_Dia
foreign key (id_dia) REFERENCES dias_semana(id_dia);

-- creacion de las llaves foraneas para el id de la tabla RELACION DE LAS RUTINAS CON EJERCICIOS

ALTER TABLE relacion_dia_rutina 
ADD CONSTRAINT FK_relacion_dia_rutina_RUTINAS_relacion
foreign key (id_rutina) REFERENCES rutinas(id_rutina);


-- CREACIÓN DE LA TABLA PARA ALMACENAR LOS CALENDARIOS RUTINARIOS DE LOS USUARIOS.



-- PRUEBAS DE RELACIONES JOINS.

-- Join para ver los ejercicios de una rutina:

/* 
select 
t3.id_rutina,
t3.nombreRutina as nombre_Rutina,
t3.fecha_registro,
t3.objetivo,
t2.nombre as nombre_Ejercicio,
t2.tiempo_descanso as Tiempo_Min
from ejercicio_rutinas t1 
join ejercicios t2 on t1.id_ejercicio = t2.id_ejercicio
join rutinas t3 on t1.id_rutina = t3.id_rutina;
-- FUNCIONA
 */

-- -------------------------------------------------------------

-- Join para que muestre el dia de la semana junto con la rutina y los ejercicios:

/* 
SELECT 
t4.id_dia,
t4.nombre AS dia,
t5.id_rutina,
t3.id_rutina,
t3.descripcion,
t3.nombreRutina AS nombre_rutina,
t3.fecha_registro,
t3.objetivo,
t2.nombre AS nombre_ejercicio,
t2.tiempo_descanso AS Descanso_min
FROM dias_semana t4
JOIN relacion_dia_rutina t5 ON t4.id_dia = t5.id_dia
JOIN ejercicio_rutinas t1 ON t5.id_rutina = t1.id_rutina
JOIN ejercicios t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina where t4.id_dia = '1'
limit 1, 1;
*/


-- FUNCIONAA !!
-- ------------------------------------------------------------- conteo de datos 
/*
SELECT 
count(*)
FROM dias_semana t4
JOIN relacion_dia_rutina t5 ON t4.id_dia = t5.id_dia
JOIN ejercicio_rutinas t1 ON t5.id_rutina = t1.id_rutina
JOIN ejercicios t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina;
*/
-- ------------------ Mostrar todos los ejercicios registrados y la rutina a la que estan asociados ------
/*
select t1.nombre, t1.fecha_registro, t1.tiempo_descanso, t3.nombreRutina, t4.direccion FROM ejercicios t1
JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina
JOIN media t4 ON t4.id_media = t1.id_media;
*/


-- ------------------------------------------- State: Funcionando
/*
select t1.id_ejercicio, t1.nombre, t1.fecha_registro, t1.tiempo_descanso, t3.nombreRutina, t4.direccion 
FROM ejercicios t1
JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina
JOIN media t4 ON t4.id_media = t1.id_media;

select * from usuarios;
-- Autenticacion ------------------------- 	
 
select count(*) from usuarios where correo = 'alfonso07amaya@gmail.com' and contraseña = '1234566910';

delete from ejercicios where id_ejercicio = 5;
*/
-- --------------------------------------- State: Funciona

-- -------------------------------- Borrar Datos -----------------------------------
/*
delete from ejercicio_rutinas where id_ejercicio = 2;
delete from ejercicios where id_ejercicio = 4;

delete from ejercicio_rutinas where id_ejercicio = 3; delete from ejercicios where id_ejercicio = 3;

-- -------------------------------Stete: funciona
insert into usuarios (nombre, correo, contraseña, peso_actual, altura_actual, id_genero) values ('Fernando Alfonso','alfonso07amaya@gmail.com','1234589pe!!',46, 1.70, 1);

select t1.id_usuario, t1.nombre, t1.apellido, t1.correo, t1.telefono, t2.genero, t1.fecha_registro from usuarios t1 join genero t2 on t1.id_genero = t2.id_genero;	

select count(*) from usuarios;

select *, (select count(*) 
from usuarios t1 where t1.id_genero= t2.id_genero) 
AS conteototal 
from genero t2;		

select t2.nombre, t2.apellido, t2.contraseña, t2.id_genero from genero t1 join usuarios t2 on t1.id_genero = t2.id_genero;

select t1.nombre, t1.id_dia from dias_semana t1 join relacion_dia_rutina t2 on t1.id_dia = t2.id_dia;

SELECT t1.*, 
(SELECT COUNT(*) 
FROM dias_semana t2 
WHERE t2.id_dia = t1.id_dia) AS totalito 
FROM dias_semana t1;

select count(*) from usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero;

insert into usuarios (nombre,apellido,telefono,correo,contraseña,peso_actual,altura_actual,id_genero, fecha_registro) values ('luiar' ,'2doblea', 3222423, 'luiar@gmail.com', '123453', 56 ,1.70, 1, now());
*/