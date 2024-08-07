create schema worldfitsbd;
use worldfitsbd; 

SET sql_safe_updates = 0;	

 -- ESTA ES LA TABLA DE GENERO
create table genero(
	id_genero boolean not null,
    genero varchar(100) not null,
    
    primary key(id_genero)
);

insert into genero (id_genero, genero) values (1, "Masculino");
insert into genero (id_genero, genero) values (2, "Femenino");
insert into genero (id_genero, genero) values (3, "Otro");
select * from genero;
 -- ESTA ES LA TABLA DE ROLES
CREATE TABLE roles (
	id_rol int not null,
    rol varchar(100) not null,
    
    primary key (id_rol)
);

INSERT INTO roles (id_rol, rol) VALUES (2, 'Invitado');
INSERT INTO roles (id_rol, rol) VALUES (1, 'Administrador');
INSERT INTO roles (id_rol, rol) VALUES (3, 'Super-Admin');
INSERT INTO roles (id_rol, rol) VALUES (4, 'Gerente de gimnasio');
select * from roles;
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

-- CREACION DE LA TABLA DE CATEGORIAS

CREATE TABLE categorias_rutinas (
	
    id_categoria int not null auto_increment,
    categoria varchar(100) not null,
    
    primary key (id_categoria)

);
-- // Se Insertan las categorias por defecto del sistema.
INSERT INTO categorias_rutinas (id_categoria, categoria) VALUES (1, 'Tren Superior');

INSERT INTO categorias_rutinas (id_categoria, categoria) VALUES (2, 'Tren Inferiror');

CREATE TABLE categorias_gyms (
	
    id_categoria int not null auto_increment,
    categoria varchar(100) not null,
    
    primary key (id_categoria)

);

INSERT INTO categorias_gyms (categoria) VALUES ('Categoria 1');
INSERT INTO categorias_gyms (categoria) VALUES ('Crossfit');
INSERT INTO categorias_gyms (categoria) VALUES ('Categoria 2');

SELECT * FROM categorias_gyms;

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
    dateLastUpdated datetime null,
    
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

CREATE TABLE Payment_Methods_Gyms (
	id int not null auto_increment,
    method varchar(100) not null,
    
    primary key(id)
);

INSERT INTO Payment_Methods_Gyms (id, method) VALUES (1, 'Transfierencia');
INSERT INTO Payment_Methods_Gyms (id, method) VALUES (2, 'Efectivo');

CREATE TABLE user_registration_indexes (
	id_registro int not null auto_increment,
    id_usuario int null, 
    registration_date datetime null,
    IMC int not null,
   
    
    primary key (id_registro),
    
    foreign key (id_usuario) references usuarios(id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE infoGyms (	
	id int not null auto_increment,
    name varchar(100) not null,
    id_categoria int null,
    description varchar(300) not null,
    mission varchar (300) not null,
    vision varchar (300) not null,
    pathImage varchar(200) not null,
    
    time_start_morning_DAY varchar(100) null,
    time_end_morning_DAY varchar(100) null,
    time_start_afternoon_DAY varchar(100) null,
    time_end_afternoon_DAY varchar(100) null,
    
    time_start_morning_END varchar(100) null,
    time_end_morning_END varchar(100) null,
    time_start_afternoon_END varchar(100) null,
    time_end_afternoon_END varchar(100) null,
    
    phone int null,
    mail varchar(200) null,
    direction varchar (200) null,
    id_pay int null,
    id_gerente int null,
    
    primary key (id),
    
    foreign key (id_categoria) references categorias_gyms(id_categoria)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    
    foreign key (id_gerente) references usuarios(id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
    
    foreign key (id_pay) references Payment_Methods_Gyms(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

insert into usuarios (nombre, apellido, telefono, correo, password, peso_actual, altura_actual, id_genero, fecha_registro, id_rol, imgPerfil) values ('Usuario' ,'Administrador', '3115963326', 'admin@gmail.com', '$2y$10$oVz5nr6qgn6yQ2aJ1bHGC.3GbjfSJ6hgtigA/d4brWmrcncLXj3Ru', 46 ,1.70, 1, now(), 1, '../view/user img/default_img.PNG');
SELECT * FROM usuarios;
-- **************************** F U N C T I O N S A D N T R I G G E R S **********************************
/*
DELIMITER //
CREATE FUNCTION calculate_BMI (weight FLOAT, height  FLOAT)
RETURNS FLOAT
BEGIN
	RETURN weight / (height * height);
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER after_user_registration
AFTER INSERT ON usuarios
FOR EACH ROW
BEGIN 	
	DECLARE calculate_BMI FLOAT;
    IF NEW.peso_actual IS NOT NULL AND NEW.altura_actual IS NOT NULL AND NEW.peso_actual > 0 AND NEW.altura_actual > 0 
    THEN
		SET calculate_BMI = calculate_BMI(NEW.peso_actual, NEW.altura_actual);
        
        INSERT INTO user_registration_indexes (id_usuario, registration_date, IMC) 
        VALUES (NEW.id_usuario, now(), calculate_BMI);
	ELSE	
		INSERT INTO user_registration_indexes (id_usuario, registration_date, IMC) 
        VALUES (NEW.id_usuario, now(), NULL);
    END IF;
END // 
DELIMITER ; 

DELIMITER // 
CREATE PROCEDURE getInfoGyms (IN id_gym INT)
BEGIN
	SELECT * FROM infogyms WHERE id = id_gym;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE Register_gym (
    IN name VARCHAR(100), 
    IN id_categoria INT, 
    IN description VARCHAR(100), 
    IN mission VARCHAR(300), 
    IN vision VARCHAR(300), 
    IN pathImage VARCHAR(200),
    IN time_start_morning_DAY VARCHAR(100),
    IN time_end_morning_DAY VARCHAR(100),
    IN time_start_afternoon_DAY VARCHAR(100),
    IN time_end_afternoon_DAY VARCHAR(100),
    IN time_start_morning_END VARCHAR(100),
    IN time_end_morning_END VARCHAR(100),
    IN time_start_afternoon_END VARCHAR(100),
    IN time_end_afternoon_END VARCHAR(100), 
    IN phone INT(11), 
    IN mail VARCHAR(200), 
    IN direction VARCHAR(200),
    IN id_pay INT(11),
    IN id_gerente INT(11)
)
BEGIN
    INSERT INTO infoGyms (
        name, id_categoria, description, mission, vision, pathImage,
        time_start_morning_DAY, time_end_morning_DAY, time_start_afternoon_DAY, time_end_afternoon_DAY,
        time_start_morning_END, time_end_morning_END, time_start_afternoon_END, time_end_afternoon_END,
        phone, mail, direction, id_pay, id_gerente
    ) VALUES (
        name, id_categoria, description, mission, vision, pathImage,
        time_start_morning_DAY, time_end_morning_DAY, time_start_afternoon_DAY, time_end_afternoon_DAY,
        time_start_morning_END, time_end_morning_END, time_start_afternoon_END, time_end_afternoon_END,
        phone, mail, direction, id_pay, id_gerente
    );
END //
DELIMITER ;
*/