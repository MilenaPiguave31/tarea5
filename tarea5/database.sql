CREATE DATABASE IF NOT EXISTS biblioteca_online;
USE biblioteca_online;

CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL
);

INSERT INTO roles (name) VALUES ('Administrador'), ('Bibliotecario'), ('Lector');

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role_id INT NOT NULL,
  FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  author VARCHAR(100) NOT NULL,
  year INT,
  genre VARCHAR(50),
  quantity INT NOT NULL DEFAULT 0
);

CREATE TABLE transactions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  book_id INT NOT NULL,
  date_of_issue DATE,
  date_of_return DATE,
  status ENUM('Prestado', 'Devuelto') DEFAULT 'Prestado',
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (book_id) REFERENCES books(id)
);

INSERT INTO users (username, email, password, role_id) VALUES
('Administrador', 'admin@biblioteca.com', '$2y$10$r2X7n9I8D6g8s2f0j0C4YuQmU9P3h8HqP6Yx9X9lN1QJg0u9m8C1K', 1),
('Bibliotecario', 'biblio@biblioteca.com', '$2y$10$r2X7n9I8D6g8s2f0j0C4YuQmU9P3h8HqP6Yx9X9lN1QJg0u9m8C1K', 2),
('Lector', 'lector@biblioteca.com', '$2y$10$r2X7n9I8D6g8s2f0j0C4YuQmU9P3h8HqP6Yx9X9lN1QJg0u9m8C1K', 3);

INSERT INTO books (title, author, year, genre, quantity) VALUES
('Cien años de soledad', 'Gabriel García Márquez', 1967, 'Novela', 5),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 1605, 'Clásico', 3),
('La metamorfosis', 'Franz Kafka', 1915, 'Ficción', 4);
