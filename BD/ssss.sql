create schema worldfitsbd;
use worldfitsbd; 

SELECT * FROM USUARIOS;

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
    
	/* ASIGANACION DE LLAVES FORANEAS con formato ON DELETE CASCADE ON UPDATE CASCADE */
    
    foreign key (id_genero) references genero(id_genero)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    foreign key (id_rol) references roles(id_rol)
    ON DELETE CASCADE
    ON UPDATE CASCADE
); 
-- delete from usuarios;



-- Creación llave foranea para id_rol en usuarios.
/*
ALTER TABLE usuarios 
ADD CONSTRAINT KF_id_rol_usuario
foreign key (id_rol) REFERENCES roles(id_rol); 
*/

-- ------------------------------------------------ Informacion de usurio;
-- select t1.nombre, t1.apellido, t1.correo, t1.contraseña, t1.peso_actual, t1.altura_actual, t1.pr, t1.telefono, t2.genero
-- FROM usuarios t1 JOIN genero t2 ON t1.id_genero = t2.id_genero WHERE id_usuario = 3;


-- Creación llave foranea de la tabla USUARIOS y la tabla GENERO
/*
ALTER TABLE usuarios
ADD CONSTRAINT FK_usuario_genero
foreign key (id_genero) references genero(id_genero);
*/

-- CREACION DE LA TABLA DE CATEGORIAS

CREATE TABLE categorias_rutinas (
	
    id_categoria int not null auto_increment,
    categoria varchar(100) not null,
    
    primary key (id_categoria)

);
-- // Se Insertan las categorias por defecto del sistema.
INSERT INTO categorias_rutinas (id_categoria, categoria) VALUES (1, 'Tren Superior');

INSERT INTO categorias_rutinas (id_categoria, categoria) VALUES (2, 'Tren Inferiror');



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

-- ESTA ES LA TABLA DE LAS RUTINAS
create table rutinas(

	id_rutina int not null auto_increment,
    nombreRutina varchar(100) not null,
    descripcion varchar(200) not null,
    objetivo varchar(100) not null,
	fecha_registro datetime not null,
    id_categoria int null,
    
	primary key(id_rutina),
    
	/* ASIGANACION DE LLAVES FORANEAS con formato ON DELETE CASCADE ON UPDATE CASCADE */
    
	foreign key(id_categoria) references categorias_rutinas(id_categoria) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
    
);


-- ESTA ES LA TABLA QUE RELACIONA RUTINAS Y EJERCICIOS
create table ejercicio_rutinas(
	
    id_relacion int not null auto_increment,
	id_rutina int null,
    id_ejercicio int null,
    
    primary key(id_relacion),
    
	/* ASIGANACION DE LLAVES FORANEAS con formato ON DELETE CASCADE ON UPDATE CASCADE */
    
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
    
	/* ASIGANACION DE LLAVES FORANEAS con formato ON DELETE CASCADE ON UPDATE CASCADE */
    
    foreign key (id_dia) REFERENCES dias_semana(id_dia) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
    foreign key (id_rutina) REFERENCES rutinas(id_rutina) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE

);

create table calendario_rutinario(

	id_calendario int not null auto_increment,
    id_usuario int null,
    nombre_personalizado varchar(100) not null,
    descripcion varchar(200) not null,
    fecha_registro datetime not null,
    
    primary key(id_calendario),
    
    /* ASIGANACION DE LLAVES FORANEAS con formato ON DELETE CASCADE ON UPDATE CASCADE */
    
	foreign key (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE

);

/* CREACION DE LA TABLA 'relacion_Calendario_categorias' */

CREATE TABLE relacion_calendario_rutinas ( /* Aqui se va a relacionar las categorias a un solo calendario rutinario para que sea semanal */
id_relacion int not null auto_increment,

id_calendario int null,
id_dia int null,
id_rutina int null,

primary key (id_relacion),

    /* ASIGANACION DE LLAVES FORANEAS con formato ON DELETE CASCADE ON UPDATE CASCADE */

foreign key (id_calendario) references calendario_rutinario(id_calendario) 
ON UPDATE CASCADE 
ON DELETE CASCADE,

foreign key (id_dia) references dias_semana(id_dia) 
ON UPDATE CASCADE 
ON DELETE CASCADE,

foreign key (id_rutina) references rutinas(id_rutina) 
ON UPDATE CASCADE 
ON DELETE CASCADE

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


/* USADO EN EL PROYECTO */
/*
SELECT 
t2.nombre,
t5.direccion_media,
t5.nombre,
t5.Instrucctiones,
t5.equipoNecesario,
t5.seires,
t5.repeticiones,
t5.tiempo_descanso
FROM calendario_rutinario t1 
JOIN dias_semana t2 ON t1.id_dia = t2.id_dia
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina
JOIN ejercicio_rutinas t4 ON t4.id_rutina = t3.id_rutina
JOIN ejercicios t5 ON t4.id_ejercicio = t5.id_ejercicio
WHERE t1.id_dia = 3 LIMIT 1 , 1;

SELECT 
COUNT(*)
FROM calendario_rutinario t1 
JOIN dias_semana t2 ON t1.id_dia = t2.id_dia
JOIN rutinas t3 ON t1.id_rutina = t3.id_rutina
JOIN ejercicio_rutinas t4 ON t4.id_rutina = t3.id_rutina
JOIN ejercicios t5 ON t4.id_ejercicio = t5.id_ejercicio
WHERE t1.id_dia = 1;
*/
-- --------------------------------------------

SELECT * FROM categorias_rutinas;
SELECT * FROM calendario_rutinario;
SELECT * FROM relacion_calendario_categorias;
SELECT * FROM usuarios;



/* EL USUARIO CREAR UN CALENDARIO RUTINARIO */
-- INSERT INTO calendario_rutinario (id_usuario, nombre_personalizado, descripcion, fecha_registro) VALUES (1, 'nombre', 'descripcion', now()); 

/* EL USUARIO ASIGNA LAS RUTINAS AL DIA DESEADO */
/*
INSERT INTO relacion_calendario_rutinas (id_calendario, id_dia, id_rutina) VALUES (5, 1, 7);
INSERT INTO relacion_calendario_rutinas (id_calendario, id_dia, id_rutina) VALUES (5, 2, 1);
INSERT INTO relacion_calendario_rutinas (id_calendario, id_dia, id_rutina) VALUES (5, 3, 3);
INSERT INTO relacion_calendario_rutinas (id_calendario, id_dia, id_rutina) VALUES (5, 4, 1);
INSERT INTO relacion_calendario_rutinas (id_calendario, id_dia, id_rutina) VALUES (5, 5, 5);
INSERT INTO relacion_calendario_rutinas (id_calendario, id_dia, id_rutina) VALUES (5, 6, 4);



/* -------------------------- PARA IMPLEMENTAR ----------------------------------- */

SELECT 
t2.nombre_personalizado,
t4.nombreRutina,
t3.nombre,
t6.direccion_media,
t6.nombre,
t6.Instrucctiones,
t6.equipoNecesario,
t6.seires,
t6.repeticiones,
t6.tiempo_descanso
FROM relacion_calendario_rutinas t1 
JOIN calendario_rutinario t2 ON t1.id_calendario = t2.id_calendario 
JOIN dias_semana t3 ON t3.id_dia = t1.id_dia 
JOIN rutinas t4 ON t4.id_rutina = t1.id_rutina 
JOIN ejercicio_rutinas t5 ON t5.id_rutina = t4.id_rutina 
JOIN ejercicios t6 ON t6.id_ejercicio = t5.id_ejercicio 
WHERE t1.id_dia = 4 AND t2.id_calendario = '1'
LIMIT 0, 1;




SELECT id_rutina, nombreRutina FROM rutinas t1 JOIN categorias_rutinas t2  ON  t1.id_categoria = t2.id_categoria WHERE t2.id_categoria = 1;

select count(*) FROM relacion_calendario_rutinas t1 
JOIN calendario_rutinario t2 ON t1.id_calendario = t2.id_calendario 
JOIN dias_semana t3 ON t3.id_dia = t1.id_dia 
JOIN rutinas t4 ON t4.id_rutina = t1.id_rutina 
JOIN ejercicio_rutinas t5 ON t5.id_rutina = t4.id_rutina 
JOIN ejercicios t6 ON t6.id_ejercicio = t5.id_ejercicio WHERE t1.id_dia = '4' AND t2.id_calendario = '1' ;

SELECT id_rutina, nombreRutina FROM rutinas WHERE id_categoria = '1';
SELECT id_rutina, nombreRutina FROM rutinas WHERE id_categoria = '1';
SELECT nombre FROM dias_semana WHERE id_dia = '1';
-- // --------------------------------------------------------------------

SELECT * FROM rutinas t1 JOIN categorias_rutinas t2 ON t1.id_categoria = t2.id_categoria WHERE t2.id_categoria = 1; -- // Busqueda de las rutinas segun la categoria

INSERT INTO relacion_calendario_rutinas (id_calendario, id_dia, id_rutina) VALUES ('5', '1', '8');

DELETE FROM calendario_rutinario;

SELECT * FROM calendario_rutinario;
SELECT * FROM relacion_calendario_rutinas;
SELECT * FROM rutinas;
SELECT MAX(id_calendario) FROM calendario_rutinario;

SELECT * FROM usuarios;
