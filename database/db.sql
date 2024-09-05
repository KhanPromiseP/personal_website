CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(25) NOT NULL,
    details TEXT NOT NULL
);


CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    icon_class VARCHAR(25) NOT NULL,
    details TEXT NOT NULL
);


CREATE TABLE about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL
);


CREATE TABLE information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('education', 'experience') NOT NULL,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(25) NOT NULL
);

CREATE TABLE contact_form_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    subject VARCHAR(100),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
