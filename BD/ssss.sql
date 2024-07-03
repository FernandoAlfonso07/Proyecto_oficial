create schema worldfitsbd;
use worldfitsbd; 


SET sql_safe_updates = 0;	

 -- ESTA ES LA TABLA DE GENERO
create table genero(
	id_genero boolean not null,
    genero varchar(100) not null,
    
    primary key(id_genero)
);

insert into genero (id_genero, genero) values (1, "masculino");
insert into genero (id_genero, genero) values (0, "femenino");

 -- ESTA ES LA TABLA DE ROLES
CREATE TABLE roles (
	id_rol int not null,
    rol varchar(100) not null,
    
    primary key (id_rol)
);

INSERT INTO roles (id_rol, rol) VALUES (0, 'Invitado');
INSERT INTO roles (id_rol, rol) VALUES (1, 'Administrador');
INSERT INTO roles (id_rol, rol) VALUES (3, 'Super-Admin');

-- ESTA ES LA TABLA DE USUARIOS
create table usuarios(
	id_usuario int not null auto_increment,
    nombre varchar(100) not null,
    apellido varchar(100) null,
    correo varchar(100) not null,
	password varchar(100) not null,
    peso_actual float not null,
    altura_actual float not null,
    id_genero boolean null,
    telefono varchar(20) not null,
    pr int null,
    fecha_registro datetime null,
    id_rol int null,
    imgPerfil varchar(200) null,
    
    primary key (id_usuario),
    foreign key (id_genero) references genero(id_genero)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    foreign key (id_rol) references roles(id_rol)
    ON DELETE CASCADE
    ON UPDATE CASCADE
); 
-- delete from usuarios;

-- ingresar un usuario;

SELECT * FROM usuarios;


-- UPDATE usuarios SET id_rol = 1 WHERE id_usuario = 3;

select t1.id_usuario, t1.nombre, t1.apellido, t1.correo, t1.telefono, t2.genero, t1.fecha_registro, t3.rol from usuarios t1 
JOIN genero t2 ON t1.id_genero = t2.id_genero 
JOIN roles t3 ON t1.id_rol = t3.id_rol;


select count(*) from usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero;
select COUNT(*) FROM usuarios;
-- Creación llave foranea para id_rol en usuarios.
/*
ALTER TABLE usuarios 
ADD CONSTRAINT KF_id_rol_usuario
foreign key (id_rol) REFERENCES roles(id_rol); 
*/

-- ------------------------------------------------ Informacion de usurio;
-- select t1.nombre, t1.apellido, t1.correo, t1.contraseña, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero
-- FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = 3;


-- Esta es la tabla de GENERO



-- Creación llave foranea de la tabla USUARIOS y la tabla GENERO
/*
ALTER TABLE usuarios
ADD CONSTRAINT FK_usuario_genero
foreign key (id_genero) references genero(id_genero);
*/


-- ESTA ES LA TABLA DE EJERCICIOS
create table ejercicios(

	id_ejercicio int not null auto_increment,
    nombre varchar(100) not null,
    Instrucctiones varchar(200) not null,
    equipoNecesario varchar(300) null,
    repeticiones varchar(10) not null,
    seires varchar(10) not null,
    tiempo_descanso int null,
    fecha_registro datetime not null,
    direccion_media varchar(200) null,
    
    primary key(id_ejercicio)

); 
/*
select
t1.id_ejercicio, t1.nombre, t1.Instrucctiones, t1.equipoNecesario, t1.seires, t1.repeticiones, t1.tiempo_descanso, t1.fecha_registro, t3.nombreRutina, t3.id_rutina, t1.direccion_media
FROM ejercicios t1
LEFT JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
LEFT JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina;
*/

-- insert INTO ejercicios (nombre, Instrucctiones, equipoNecesario, repeticiones, seires, tiempo_descanso, fecha_registro, direccion_media) VALUES ('Curl de Martillo', 'Curl de Martillo', 'Curl de Martillo', '4', '2', '', now(), '');


-- ESTA ES LA TABLA DE LAS RUTINAS
create table rutinas(

	id_rutina int not null auto_increment,
    nombreRutina varchar(100) not null,
    descripcion varchar(200) not null,
    objetivo varchar(100) not null,
	fecha_registro datetime not null,
	primary key(id_rutina)
    
);


-- ESTA ES LA TABLA QUE RELACIONA RUTINAS Y EJERCICIOS
create table ejercicio_rutinas(
	
    id_relacion int not null auto_increment,
	id_rutina int null,
    id_ejercicio int null,
    
    primary key(id_relacion),
    foreign key(id_rutina) references rutinas(id_rutina) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
    foreign key(id_ejercicio) references ejercicios(id_ejercicio) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
    
);

-- creacion llaves foraneas para la relacion M:M de las tablas ejercicio y relacion...
/*
ALTER TABLE ejercicio_rutinas
ADD constraint FK_ejercicio_rutinas_tb_ejerciciostb
foreign key (id_ejercicio) references ejercicios(id_ejercicio);

-- creacion llaves foraneas para la relacion M:M de las tablas rutinas y relacion...

ALTER TABLE ejercicio_rutinas
ADD constraint FK_ejercicio_rutinas_tb_rutinastb
foreign key (id_rutina) references rutinas(id_rutina);
*/


-- ESTA ES LA TABLA DE DIAS DE LA SEMANA que se trabajaran en worldfit
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


-- ESTA ES LA TABLA QUE RELACIONA DIAS Y RUTINAS
create table relacion_dia_rutina(

	id_relacion_d_r int not null auto_increment,
    id_dia int null,
    id_rutina int null,
    
    primary key(id_relacion_d_r),
    foreign key (id_dia) REFERENCES dias_semana(id_dia) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key (id_rutina) REFERENCES rutinas(id_rutina) ON DELETE CASCADE ON UPDATE CASCADE

);

-- select * from relacion_dia_rutina;

-- creacion de las llaves foraneas para el id de la tabla DIA SEMANAS
/*
ALTER TABLE relacion_dia_rutina 
ADD CONSTRAINT FK_relacion_dia_rutina_Dia
foreign key (id_dia) REFERENCES dias_semana(id_dia);

-- creacion de las llaves foraneas para el id de la tabla RELACION DE LAS RUTINAS CON EJERCICIOS

ALTER TABLE relacion_dia_rutina 
ADD CONSTRAINT FK_relacion_dia_rutina_RUTINAS_relacion
foreign key (id_rutina) REFERENCES rutinas(id_rutina);
*/
/* 
select
t1.id_ejercicio, t1.nombre, t1.fecha_registro, t1.tiempo_descanso, t3.nombreRutina, t4.direccion
FROM ejercicios t1
LEFT JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
LEFT JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina
LEFT JOIN media t4 ON t4.id_media = t1.id_media;
/* 
-- Ejercicios Joins.

-- Insertar datos-

-- INSERT INTO ejercicios (nombre, fecha_registro, tiempo_descanso) VALUES('Curl de martillo', now(), 2);
-- INSERT INTO rutinas (nombre, fecha_registro, tiempo_descanso) VALUES('Curl de martillo', now(), 2);
/* 
select count(*) FROM ejercicios t1 JOIN ejercicio_rutinas t2 ON t1.id_ejercicio = t2.id_ejercicio
LEFT JOIN rutinas t3 ON t2.id_rutina = t3.id_rutina 
LEFT JOIN media t4 ON t4.id_media = t1.id_media;


select count(*) FROM ejercicios;

select * from usuarios;
*/ 

/* CREACION TABLA DE GIMNASIOS */



INSERT INTO ejercicios (nombre, Instrucctiones, equipoNecesario, repeticiones, seires, tiempo_descanso, fecha_registro, direccion_media) 
values ('Curl con barra','De pie, sostén una barra con las manos a la anchura de los hombros, con las palmas hacia adelante.
Mantén los codos pegados al cuerpo y levanta la barra hacia los hombros contrayendo los bíceps.
Baja la barra de manera controlada hasta la posición inicial.'
,'Barra y discos de pesas'
,'12'
,'4' 
,'2'
, now()
,'');
INSERT INTO  ejercicios (nombre, Instrucctiones, equipoNecesario, repeticiones, seires, tiempo_descanso, fecha_registro, direccion_media) 
values ('Curl de martillo con mancuernas','De pie, sostén una mancuerna en cada mano con las palmas mirando hacia el cuerpo.
Levanta las mancuernas hacia los hombros manteniendo las palmas en la misma posición (como si estuvieras martillando).
Baja las mancuernas de manera controlada hasta la posición inicial.'
,'Mancuernas'
,'12'
,'3' 
,'1'
, now()
,'');

INSERT INTO  ejercicios (nombre, Instrucctiones, equipoNecesario, repeticiones, seires, tiempo_descanso, fecha_registro, direccion_media) 
values ('Curl concentrado','1. Siéntate en un banco con los pies firmemente plantados en el suelo.
2. Sostén una mancuerna con una mano y apoya el codo del brazo que sostiene la mancuerna en el interior del muslo.
3. Levanta la mancuerna hacia el hombro contrayendo el bíceps y luego bájala de manera controlada.'
,'Mancuernas'
,'8'
,'4' 
,'1'
, now()
,'');

/* INGRESO DE DOS NUEVAS  */

INSERT INTO rutinas (nombreRutina, descripcion, objetivo, fecha_registro) VALUES ('Fuerza y Masa para Bíceps',
 'Esta rutina se enfoca en ejercicios de fuerza para desarrollar masa muscular en los bíceps, combinando diferentes tipos de curls para trabajar el músculo desde distintos ángulos.'
 ,'Aumentar la fuerza y la masa muscular de los bíceps.',now());
 
 INSERT INTO rutinas (nombreRutina, descripcion, objetivo, fecha_registro) VALUES ('Definición y Tono de Bíceps',
 ' Esta rutina está diseñada para definir y tonificar los bíceps, utilizando ejercicios que permitan un mayor control y contracción del músculo.'
 ,'Definir y tonificar los bíceps.',now());
 
  /* SE ASOCIAN LOS EJERCICIOS A LAS RUTINAS */
 

 
 INSERT INTO ejercicio_rutinas (id_rutina, id_ejercicio) VALUES (2, 5);

/* SE ASOCIAN RUTINAS A LOS DIAS */

INSERT INTO relacion_dia_rutina (id_dia, id_rutina) VALUES ( 6, 1);
INSERT INTO relacion_dia_rutina (id_dia, id_rutina) VALUES ( 6,2);
 /* t4.id_dia,
t4.nombre AS dia,
t3.id_rutina,
t3.descripcion,
t3.nombreRutina AS nombre_rutina,
t3.fecha_registro,
t3.objetivo,
t2.nombre AS nombre_ejercicio,
t2.tiempo_descanso AS Descanso_min */


/*
t1 = ejercicio_rutinas
t2 = ejercicios
t3 = rutinas
t4 = dias_semana
t5 = relacion_dia_rutina
*/
SELECT 
t4.nombre,
t2.direccion_media,
t2.nombre,
t2.Instrucctiones,
t2.equipoNecesario,
t2.seires,
t2.repeticiones,
t2.tiempo_descanso
FROM dias_semana t4
JOIN relacion_dia_rutina t5 ON t4.id_dia = t5.id_dia
JOIN ejercicio_rutinas t1 ON t5.id_rutina = t1.id_rutina
JOIN ejercicios t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina WHERE t4.id_dia = '6';

-- CONTEO DE EJERCICIO PARA LA PAGINACION

select count(*)
FROM dias_semana t4
JOIN relacion_dia_rutina t5 ON t4.id_dia = t5.id_dia
JOIN ejercicio_rutinas t1 ON t5.id_rutina = t1.id_rutina
JOIN ejercicios t2 ON t1.id_ejercicio = t2.id_ejercicio
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina WHERE t4.id_dia = '6';

select * from usuarios;
select * from dias_semana;
select * from ejercicios;
select * from rutinas;
select * from ejercicio_rutinas; 
select * from relacion_dia_rutina;
