DELIMITER $$

-- Stored procedure to insert a new user
CREATE PROCEDURE InsertUser(
    IN p_first_name VARCHAR(50),
    IN p_last_name VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_phone VARCHAR(15),
    IN p_password VARCHAR(255)
)
BEGIN
    INSERT INTO users (first_name, last_name, email, phone, password)
    VALUES (p_first_name, p_last_name, p_email, p_phone, p_password);
END$$

-- Stored procedure to retrieve a user by email
CREATE PROCEDURE GetUserByEmail(
    IN p_email VARCHAR(100)
)
BEGIN
    SELECT * FROM users WHERE email = p_email;
END$$

-- Stored procedure to update a user
CREATE PROCEDURE UpdateUser(
    IN p_id INT,
    IN p_first_name VARCHAR(50),
    IN p_last_name VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_phone VARCHAR(15)
)
BEGIN
    UPDATE users
    SET first_name = p_first_name, last_name = p_last_name, email = p_email, phone = p_phone
    WHERE id = p_id;
END$$

-- Stored procedure to delete a user
CREATE PROCEDURE DeleteUser(
    IN p_id INT
)
BEGIN
    DELETE FROM users WHERE id = p_id;
END$$

DELIMITER ;
