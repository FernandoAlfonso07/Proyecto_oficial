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
    telefono varchar(20) not null,
    pr int null,
    fecha_registro datetime null,
    id_rol int null,
    imgPerfil varchar(200) null,
    
    primary key (id_usuario)
);
-- delete from usuarios;
ALTER TABLE usuarios ADD imgPerfil varchar(200) null;


CREATE TABLE roles (
	id_rol int not null,
    rol varchar(100) not null,
    
    primary key (id_rol)
);

INSERT INTO roles (id_rol, rol) VALUES (0, 'Invitado');
INSERT INTO roles (id_rol, rol) VALUES (1, 'Administrador');
INSERT INTO roles (id_rol, rol) VALUES (3, 'Super-Admin');

-- Creación llave foranea para id_rol en usuarios.

ALTER TABLE usuarios 
ADD CONSTRAINT KF_id_rol_usuario
foreign key (id_rol) REFERENCES roles(id_rol); 


-- ------------------------------------------------ Informacion de usurio;
-- select t1.nombre, t1.apellido, t1.correo, t1.contraseña, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero
-- FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = 3;


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