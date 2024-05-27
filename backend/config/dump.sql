CREATE TABLE peoples (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    second_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE organizations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    organization_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (organization_id) REFERENCES organizations(id)
);

CREATE TABLE people_phones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    people_id INT NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (people_id) REFERENCES peoples(id)
);

CREATE TABLE department_phones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_id INT NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

INSERT INTO peoples (first_name, second_name, last_name)
VALUES
    ('John', 'Doe', 'Doe'),
    ('Jane', 'Smith', 'Smith'),
    ('Michael', 'Johnson', 'Johnson'),
    ('Sarah', 'Lee', 'Lee'),
    ('David', 'Brown', 'Brown');

INSERT INTO organizations (name, address) VALUES
    ('Acme Corp', '123 Main St, Anytown USA'),
    ('Globex Inc', '456 Oak Rd, Somewhere Else'),
    ('Stark Industries', '789 Maple Ave, Elsewhere');

INSERT INTO departments (name, organization_id) VALUES
    ('Sales', 1),
    ('Marketing', 1),
    ('IT', 1),
    ('HR', 2),
    ('Engineering', 2),
    ('R&D', 3);

INSERT INTO people_phones (people_id, phone_number) VALUES
    (1, '+7 (913) 560-95-90'),
    (1, '+7 (800) 555-35-35'),
    (2, '+7 (801) 650-78-12'),
    (3, '+7 (673) 432-88-77'),
    (4, '+7 (931) 561-65-09'),
    (5, '+7 (876) 554-45-55');

INSERT INTO department_phones (department_id, phone_number) VALUES
    (1, '555-11-11'),
    (2, '555-22-22'),
    (3, '555-33-33'),
    (4, '555-44-44'),
    (5, '555-55-55'),
    (6, '555-66-66');