CREATE DATABASE IF NOT EXISTS apexplanet_bookstore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE apexplanet_bookstore;
CREATE TABLE IF NOT EXISTS users(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(190) NOT NULL UNIQUE,password_hash VARCHAR(255) NOT NULL,role ENUM('user','admin') NOT NULL DEFAULT 'user',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS books(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,title VARCHAR(180) NOT NULL,author VARCHAR(120) NOT NULL,category VARCHAR(80) NOT NULL,price DECIMAL(10,2) NOT NULL DEFAULT 0,description TEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
INSERT INTO books(title,author,category,price,description) VALUES
('The Alchemist','Paulo Coelho','Fiction',399,'A young shepherd follows his dream.'),
('Wings of Fire','A. P. J. Abdul Kalam','Biography',299,'An inspiring story of learning and perseverance.'),
('Atomic Habits','James Clear','Self Help',499,'Practical ideas for building better habits.'),
('Pride and Prejudice','Jane Austen','Classic',249,'A classic novel about family and relationships.'),
('Clean Code','Robert C. Martin','Technology',650,'Principles for writing maintainable software.'),
('Ikigai','Hector Garcia and Francesc Miralles','Self Help',350,'Ideas about purpose and daily life.'),
('The Hobbit','J. R. R. Tolkien','Fantasy',425,'A hobbit is drawn into an unexpected adventure.'),
('Deep Work','Cal Newport','Productivity',450,'Strategies for focused work.'),
('Introduction to Algorithms','Thomas H. Cormen et al.','Technology',799,'A textbook on algorithms and problem solving.');
