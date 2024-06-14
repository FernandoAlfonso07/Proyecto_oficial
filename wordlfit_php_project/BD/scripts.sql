create schema worldfitsBD;
use worldfitsBD;
SET sql_safe_updates = 0;
-- Esta es la tabla de USUARIOS
create table usuarios(
	id_usuario int not null auto_increment,
    nombre varchar(100) not null,
    correo varchar(100) not null,
    contraseña varchar(100) not null,
    peso_actual float not null,
    altura_actual float not null,
    id_genero boolean null,
    
    primary key(id_usuario)
);
update usuarios set telefono = 312433215 where id_usuario = 1;

alter table usuarios ADD telefono int null;
alter table usuarios ADD pr int null;
alter table usuarios ADD apellido varchar(100) null;

insert into usuarios (nombre, apellido, correo, contraseña, peso_actual, altura_actual, pr, telefono, id_genero) 
values ('Ricardo Rivera',
'Rivera',
'flexsay@gmail.com',
'993nn31b',
70,
1.70,
80,
348318513,
1
);
select * from usuarios;
-- ------------------------------------------------ Informacion de usurio;
select t1.nombre, t1.apellido, t1.correo, t1.contraseña, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero
FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = 3;

-- Esta es la tabla de GENERO
create table genero(
	id_genero boolean not null,
    genero varchar(100) not null,
    
    primary key(id_genero)
);
select * from genero;
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
    
    primary key(id_ejercicio)

);
alter table ejercicios ADD id_media int null;
select * from ejercicios;
update ejercicios set id_media = '1' where id_ejercicio = '1';
update ejercicios set id_media = '2' where id_ejercicio = '2';
update ejercicios set id_media = '3' where id_ejercicio = '3';
-- Creacion de la tabla para almacenar las rutas de los contenidos multimedia-----------------

create table media (
	id_media int not null auto_increment,
    direccion varchar(1000) not null,
    primary key (id_media)
);
select * from media;
INSERT INTO media (direccion) values ('https://i.makeagif.com/media/12-13-2023/N2UbmL.gif');
INSERT INTO media (direccion) values ('https://i.makeagif.com/media/11-19-2019/VqeNlV.gif');
INSERT INTO media (direccion) values ('https://i.pinimg.com/originals/69/49/92/694992d664b631eb9b1295490f21536b.gif');

alter table ejercicios
add constraint FK_meida_ejercicio
foreign key (id_media) references media(id_media);

-- Creacion de la tabla que almacenara los calendarios rutinarios de cada usuario...

create table calendario_rutinario (

	id_calendario int not null auto_increment,
    nombrePersonalizado varchar(100) not null,
    id_usuario int null,
	id_relacion_d_r int null,
    
    primary key(id_calendario)

);



insert into ejercicios (nombre, fecha_registro, tiempo_descanso) values ('Dominadas', now(), 1);
insert into ejercicios (nombre, fecha_registro, tiempo_descanso) values ('Curl de martillo', now(), 1);
insert into ejercicios (nombre, fecha_registro, tiempo_descanso) values ('Curl con barra', now(), 1.5);
insert into ejercicios (nombre, fecha_registro, tiempo_descanso) values ('Sendatillas', now(), 1);
insert into ejercicios (nombre, fecha_registro, tiempo_descanso) values ('Press de pierna', now(), 1);
insert into ejercicios (nombre, fecha_registro, tiempo_descanso) values ('Elevacion de talon', now(), 1);



-- creacion tabla RUTINAS 

create table rutinas(

	id_rutina int not null auto_increment,
    nombreRutina varchar(100) not null,
    descripcion varchar(200) not null,
    objetivo varchar(100) not null,
	fecha_registro datetime not null,
	primary key(id_rutina)
    
);
select * from rutinas;

insert into rutinas (nombreRutina, descripcion, objetivo, fecha_registro) 
values ('Rutina de pierna v1',
'rutina para mas fuerza de piera','aumentar cuadriceps', 
now());


-- creacion relacion M:M de las tablas ejercicio y rutinas

create table ejercicio_rutinas(
	
    id_relacion int not null auto_increment,
	id_rutina int null,
    id_ejercicio int null,
    
    primary key(id_relacion)
);
select * from ejercicio_rutinas;

insert into ejercicio_rutinas (id_rutina, id_ejercicio) values (2, 4);
insert into ejercicio_rutinas (id_rutina, id_ejercicio) values (2, 5);
insert into ejercicio_rutinas (id_rutina, id_ejercicio) values (2, 6);


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


insert into relacion_dia_rutina (id_dia, id_rutina) values (0, 1);
insert into relacion_dia_rutina (id_dia, id_rutina) values (1, 2);
insert into relacion_dia_rutina (id_dia, id_rutina) values (4, 3);



-- creacion de las llaves foraneas para el id de la tabla DIA SEMANAS

ALTER TABLE relacion_dia_rutina 
ADD CONSTRAINT FK_relacion_dia_rutina_Dia
foreign key (id_dia) REFERENCES dias_semana(id_dia);

-- creacion de las llaves foraneas para el id de la tabla RELACION DE LAS RUTINAS CON EJERCICIOS

ALTER TABLE relacion_dia_rutina 
ADD CONSTRAINT FK_relacion_dia_rutina_RUTINAS_relacion
foreign key (id_rutina) REFERENCES rutinas(id_rutina);



select * from calendario_rutinario;

-- creacion llave foranea para la tabla CALENDARIO RUTINARIO con la tabla USUARIOS...
ALTER TABLE calendario_rutinario
ADD CONSTRAINT FK_calendarioR_usuarios
foreign key (id_usuario) REFERENCES usuarios(id_usuario);

-- creacion llave foranea para la tabla CALENDARIO RUTINARIO con la tabla RELACION DE DIAS CON RUTINAS...
ALTER TABLE calendario_rutinario
ADD CONSTRAINT FK_calendarioR_RUTINAxDIA
foreign key (id_relacion_d_r) REFERENCES relacion_dia_rutina(id_relacion_d_r);




-- PRUEBAS DE RELACIONES JOINS.

-- Join para ver los ejercicios de una rutina:

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

-- -------------------------------------------------------------

-- Join para que muestre el dia de la semana junto con la rutina y los ejercicios:

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



-- FUNCIONAA !!
-- ------------------------------------------------------------- conteo de datos 

SELECT 
count(*)
FROM dias_semana t4
JOIN relacion_dia_rutina t5 ON t4.id_dia = t5.id_dia
JOIN ejercicio_rutinas t1 ON t5.id_rutina = t1.id_rutina
JOIN ejercicios t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina;

-- ------------------ Mostrar todos los ejercicios registrados y la rutina a la que estan asociados ------

select t1.nombre, t1.fecha_registro, t1.tiempo_descanso, t3.nombreRutina, t4.direccion FROM ejercicios t1
JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina
JOIN media t4 ON t4.id_media = t1.id_media;



-- ------------------------------------------- State: Funcionando

select t1.id_ejercicio, t1.nombre, t1.fecha_registro, t1.tiempo_descanso, t3.nombreRutina, t4.direccion 
FROM ejercicios t1
JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina
JOIN media t4 ON t4.id_media = t1.id_media;

select * from usuarios;
-- Autenticacion ------------------------- 	
 
select count(*) from usuarios where correo = 'alfonso07amaya@gmail.com' and contraseña = '1234566910';

delete from ejercicios where id_ejercicio = 5;

-- --------------------------------------- State: Funciona

-- -------------------------------- Borrar Datos -----------------------------------

delete from ejercicio_rutinas where id_ejercicio = 2;
delete from ejercicios where id_ejercicio = 4;

delete from ejercicio_rutinas where id_ejercicio = 3; delete from ejercicios where id_ejercicio = 3;

-- -------------------------------Stete: funciona
insert into usuarios (nombre, correo, contraseña, peso_actual, altura_actual, id_genero) values ('Fernando Alfonso','alfonso07amaya@gmail.com','1234589pe!!',46, 1.70, 1);

select * from usuarios t1, genero t2 where t1.id_genero = t2.id_genero;