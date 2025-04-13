
CREATE DATABASE TimeManager_DB;

USE TimeManager_DB;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO users (name, email) VALUES ('Testing', 'testing@prueba.com');
INSERT INTO users (name, email) VALUES ('Yojann', 'yojann@prueba.com');

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO projects (name, description) VALUES ('Time Manager Prueba', 'Prueba ingreso');
INSERT INTO projects (name, description) VALUES ('Time Manager', 'Desarrollo API');

CREATE TABLE user_project_rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    project_id INT,
    rate DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);
INSERT INTO user_project_rates (user_id, project_id, rate) VALUES (1, 1, 50000.00);
INSERT INTO user_project_rates (user_id, project_id, rate) VALUES (2, 1, 65000.00);
INSERT INTO user_project_rates (user_id, project_id, rate) VALUES (2, 2, 60000.00);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    project_id INT,
    title VARCHAR(255),
    description TEXT,
    hours_worked numeric (10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);
INSERT INTO tasks (user_id, project_id, title, description, hours_worked ) VALUES (1, 1, 'PRUEBA', 'Desc. prueba acceso', 20);
INSERT INTO tasks (user_id, project_id, title, description, hours_worked ) VALUES (2, 2, 'API', 'Desarrollo API Consulta', 35.5);
INSERT INTO tasks (user_id, project_id, title, description, hours_worked ) VALUES (2, 2, 'API', 'Desarrollo API Consulta', 40);

