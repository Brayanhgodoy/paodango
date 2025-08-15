CREATE DATABASE IF NOT EXISTS padaria;
USE padaria;

CREATE TABLE IF NOT EXISTS categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT
);

CREATE TABLE IF NOT EXISTS produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  categoria_id INT,
  preco DECIMAL(10,2) NOT NULL,
  estoque INT NOT NULL,
  descricao TEXT,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);