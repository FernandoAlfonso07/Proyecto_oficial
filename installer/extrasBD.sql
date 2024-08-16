-- Eliminación y creación de funciones
-- funciones.sql
-- Función `calculate_BMI`
DROP FUNCTION IF EXISTS `calculate_BMI`;

CREATE FUNCTION `calculate_BMI`(weight FLOAT, height FLOAT) RETURNS FLOAT BEGIN RETURN weight / (height * height);

END;

-- Trigger `after_user_registration`
DROP TRIGGER IF EXISTS `after_user_registration`;

CREATE TRIGGER `after_user_registration`
AFTER
INSERT
    ON `usuarios` FOR EACH ROW BEGIN DECLARE bmi FLOAT;

IF NEW.peso_actual IS NOT NULL
AND NEW.altura_actual IS NOT NULL
AND NEW.peso_actual > 0
AND NEW.altura_actual > 0 THEN
SET
    bmi = calculate_BMI(NEW.peso_actual, NEW.altura_actual);

INSERT INTO
    `user_registration_indexes` (id_usuario, registration_date, IMC)
VALUES
    (NEW.id_usuario, NOW(), bmi);

ELSE
INSERT INTO
    `user_registration_indexes` (id_usuario, registration_date, IMC)
VALUES
    (NEW.id_usuario, NOW(), NULL);

END IF;

END;

-- Trigger `register_purchase_user`
DROP TRIGGER IF EXISTS `register_purchase_user`;

CREATE TRIGGER `register_purchase_user`
AFTER INSERT
ON `plan_registration` FOR EACH ROW
BEGIN
    INSERT INTO
        `purchase_history` (id_usuario, id_plan, date_register)
    VALUES
        (NEW.id_usuario, NEW.id_plan, NOW());
END;

-- Procedimiento almacenado `getInfoGyms`
DROP PROCEDURE IF EXISTS `getInfoGyms`;

CREATE PROCEDURE `getInfoGyms` (IN id_gym INT) BEGIN
SELECT
    t1.name AS nameGym,
    t1.description AS descriptionGym,
    t1.mission AS missionGym,
    t1.vision AS visionGym,
    t1.pathImage,
    t1.time_start_morning_DAY,
    t1.time_end_morning_DAY,
    t1.time_start_afternoon_DAY,
    t1.time_end_afternoon_DAY,
    t1.time_start_morning_END,
    t1.time_end_morning_END,
    t1.time_start_afternoon_END,
    t1.time_end_afternoon_END,
    t1.phone,
    t1.mail,
    t1.direction,
    t2.categoria AS id_categoria,
    t3.method AS id_pay,
    t4.nombre AS gerente_nombre,
    t4.apellido AS gerente_apellido,
    t4.correo AS gerente_correo,
    t4.telefono AS gerente_telefono
FROM
    infoGyms t1
    JOIN categorias_gyms t2 ON t2.id_categoria = t1.id_categoria
    JOIN payment_methods_gyms t3 ON t1.id_pay = t3.id
    JOIN usuarios t4 ON t1.id_gerente = t4.id_usuario
WHERE
    t1.id = id_gym;

END;

-- Procedimiento almacenado `Register_gym`
DROP PROCEDURE IF EXISTS `Register_gym`;

CREATE PROCEDURE `Register_gym` (
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
    IN id_gerente INT(11),
    IN monthly_payment INT(11)
) BEGIN
    INSERT INTO `infoGyms` (
        name,
        id_categoria,
        description,
        mission,
        vision,
        pathImage,
        time_start_morning_DAY,
        time_end_morning_DAY,
        time_start_afternoon_DAY,
        time_end_afternoon_DAY,
        time_start_morning_END,
        time_end_morning_END,
        time_start_afternoon_END,
        time_end_afternoon_END,
        phone,
        mail,
        direction,
        id_pay,
        id_gerente,
        status,
        monthly_payment
    )
    VALUES (
        name,
        id_categoria,
        description,
        mission,
        vision,
        pathImage,
        time_start_morning_DAY,
        time_end_morning_DAY,
        time_start_afternoon_DAY,
        time_end_afternoon_DAY,
        time_start_morning_END,
        time_end_morning_END,
        time_start_afternoon_END,
        time_end_afternoon_END,
        phone,
        mail,
        direction,
        id_pay,
        id_gerente,
        'activo',
        monthly_payment
    );
END;

DROP PROCEDURE IF EXISTS `getInfoGymsAll`;

CREATE PROCEDURE `getInfoGymsAll` () BEGIN
SELECT
    t1.id,
    t1.name AS nameGym,
    t1.description AS descriptionGym,
    t1.mission AS missionGym,
    t1.vision AS visionGym,
    t1.pathImage,
    t1.time_start_morning_DAY,
    t1.time_end_morning_DAY,
    t1.time_start_afternoon_DAY,
    t1.time_end_afternoon_DAY,
    t1.time_start_morning_END,
    t1.time_end_morning_END,
    t1.time_start_afternoon_END,
    t1.time_end_afternoon_END,
    t1.phone,
    t1.mail,
    t1.direction,
    t2.categoria AS id_categoria,
    t3.method AS id_pay,
    t4.nombre AS gerente_nombre,
    t4.apellido AS gerente_apellido,
    t4.correo AS gerente_correo,
    t4.telefono AS gerente_telefono,
    t1.status
FROM
    infoGyms t1
    JOIN categorias_gyms t2 ON t2.id_categoria = t1.id_categoria
    JOIN payment_methods_gyms t3 ON t1.id_pay = t3.id
    JOIN usuarios t4 ON t1.id_gerente = t4.id_usuario;

END;

DROP PROCEDURE IF EXISTS `SearchGyms`;

CREATE PROCEDURE `SearchGyms` (
    IN searchTerm VARCHAR(255)
)
BEGIN
    SELECT 
        t1.id,
        t1.name, 
        t2.categoria, 
        t1.description, 
        t1.mission, 
        t1.vision, 
        t1.time_start_morning_DAY, 
        t1.time_end_morning_DAY, 
        t1.time_start_afternoon_DAY, 
        t1.time_end_afternoon_DAY,
        t1.time_start_morning_END, 
        t1.time_end_morning_END, 
        t1.time_start_afternoon_END, 
        t1.time_end_afternoon_END, 
        t1.phone, 
        t1.mail, 
        t1.direction, 
        t3.method, 
        t1.monthly_payment, 
        t1.pathImage
    FROM infogyms t1 
    JOIN categorias_gyms t2 ON t2.id_categoria = t1.id_categoria 
    JOIN payment_methods_gyms t3 ON t3.id = t1.id_pay
    JOIN usuarios t4 ON t4.id_usuario = t1.id_gerente
    WHERE
        t1.name LIKE CONCAT('%', searchTerm, '%') OR
        t2.categoria LIKE CONCAT('%', searchTerm, '%') OR
        t1.description LIKE CONCAT('%', searchTerm, '%') OR
        t1.mission LIKE CONCAT('%', searchTerm, '%') OR
        t1.vision LIKE CONCAT('%', searchTerm, '%') OR
        t1.time_start_morning_DAY LIKE CONCAT('%', searchTerm, '%') OR
        t1.time_end_morning_DAY LIKE CONCAT('%', searchTerm, '%') OR
        t1.time_start_afternoon_DAY LIKE CONCAT('%', searchTerm, '%') OR
        t1.time_end_afternoon_DAY LIKE CONCAT('%', searchTerm, '%') OR
        t1.time_start_morning_END LIKE CONCAT('%', searchTerm, '%') OR
        t1.time_end_morning_END LIKE CONCAT('%', searchTerm, '%') OR
        t1.time_start_afternoon_END LIKE CONCAT('%', searchTerm, '%') OR
        t1.time_end_afternoon_END LIKE CONCAT('%', searchTerm, '%') OR
        t1.phone LIKE CONCAT('%', searchTerm, '%') OR
        t1.mail LIKE CONCAT('%', searchTerm, '%') OR
        t1.direction LIKE CONCAT('%', searchTerm, '%') OR
        t3.method LIKE CONCAT('%', searchTerm, '%') OR
        t1.monthly_payment LIKE CONCAT('%', searchTerm, '%');
END;