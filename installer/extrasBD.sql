-- Eliminación y creación de funciones
-- funciones.sql

-- Función `calculate_BMI`
DROP FUNCTION IF EXISTS `calculate_BMI`;
CREATE FUNCTION `calculate_BMI`(weight FLOAT, height FLOAT) RETURNS FLOAT
BEGIN
    RETURN weight / (height * height);
END;

-- Trigger `after_user_registration`
DROP TRIGGER IF EXISTS `after_user_registration`;
CREATE TRIGGER `after_user_registration`
AFTER INSERT ON `usuarios`
FOR EACH ROW
BEGIN
    DECLARE bmi FLOAT;
    IF NEW.peso_actual IS NOT NULL AND NEW.altura_actual IS NOT NULL AND NEW.peso_actual > 0 AND NEW.altura_actual > 0 THEN
        SET bmi = calculate_BMI(NEW.peso_actual, NEW.altura_actual);
        INSERT INTO `user_registration_indexes` (id_usuario, registration_date, IMC) 
        VALUES (NEW.id_usuario, NOW(), bmi);
    ELSE
        INSERT INTO `user_registration_indexes` (id_usuario, registration_date, IMC) 
        VALUES (NEW.id_usuario, NOW(), NULL);
    END IF;
END;

-- Procedimiento almacenado `getInfoGyms`
DROP PROCEDURE IF EXISTS `getInfoGyms`;
CREATE PROCEDURE `getInfoGyms` (IN id_gym INT)
BEGIN
    SELECT * FROM `infogyms` WHERE id = id_gym;
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
    IN id_gerente INT(11)
)
BEGIN
    INSERT INTO `infoGyms` (
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
END;
