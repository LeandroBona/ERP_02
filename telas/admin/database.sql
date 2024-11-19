-- Copia o código e executa no banco 
CREATE SCHEMA IF NOT EXISTS `sesi_senai`;

USE `sesi_senai`;

CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NULL,
  PRIMARY KEY (`categoria_id`)
);

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `fornecedor_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `endereco` VARCHAR(25) NULL,
  PRIMARY KEY (`fornecedor_id`)
);

CREATE TABLE IF NOT EXISTS `produtos` (
  `produto_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NOT NULL,
  `categoria_id` INT NOT NULL,
  `preco_venda` DECIMAL(10,2),
  `preco_custo` DECIMAL(10,2),
  `unidade_medida` VARCHAR(200),
  `fornecedor_id` INT NOT NULL,
  `quantidade` INT DEFAULT 0,
  PRIMARY KEY (`produto_id`),
  FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`categoria_id`),
  FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`fornecedor_id`)
);

CREATE TABLE IF NOT EXISTS `estoque` (
  `estoque_id` INT NOT NULL AUTO_INCREMENT,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `data_movimentacao` DATETIME NULL,
  `tipo_movimentacao` ENUM('entrada', 'saida', 'devolução'),
  PRIMARY KEY (`estoque_id`),
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`produto_id`)
);

CREATE TABLE IF NOT EXISTS `setores` (
  `setor_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NULL,
  PRIMARY KEY (`setor_id`)
);

CREATE TABLE IF NOT EXISTS `funcionarios` (
  `funcionario_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `cargo` VARCHAR(50) NOT NULL,
  `setor_id` INT NOT NULL,
  `telefone` VARCHAR(20) NULL,
  `email` VARCHAR(100) NOT NULL,
  `data_admissao` DATE NOT NULL,
  `salario` DECIMAL(10,2),
  `metodo_pagamento` VARCHAR(50),
  PRIMARY KEY (`funcionario_id`),
  FOREIGN KEY (`setor_id`) REFERENCES `setores` (`setor_id`)
);

CREATE TABLE IF NOT EXISTS `pedidos` (
  `pedido_id` INT NOT NULL AUTO_INCREMENT,
  `data_pedido` DATETIME NOT NULL,
  `status` ENUM('Ativo', 'Inativo', 'Suspenso') NOT NULL,
  `valor_total` DECIMAL(10,2),
  `funcionario_id` INT NOT NULL,
  PRIMARY KEY (`pedido_id`),
  FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`funcionario_id`)
);

CREATE TABLE IF NOT EXISTS `itens_pedidos` (
  `itempedido_id` INT NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `produto_id` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`itempedido_id`),
  FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`),
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`produto_id`)
);

CREATE TABLE IF NOT EXISTS `manutencoes` (
  `manutencao_id` INT NOT NULL AUTO_INCREMENT,
  `equipamento` VARCHAR(100) NOT NULL,
  `descricao_problema` TEXT NOT NULL,
  `data_inicio` DATETIME NOT NULL,
  `data_termino` DATETIME NOT NULL,
  `tecnico_responsavel` VARCHAR(100) NULL,
  `status` ENUM('quebrado', 'funcional'),
  `responsavel_id` INT NOT NULL,
  PRIMARY KEY (`manutencao_id`),
  FOREIGN KEY (`responsavel_id`) REFERENCES `funcionarios` (`funcionario_id`)
);

-- precisa inserir manualmente no banco de dados os setores e categorias

insert into categorias(nome, descricao)
values
('smartphones', 'celulares saudáveis'),
('tablet', 'tablete saudável');

insert into setores(nome,descricao)
values
('t.i', 'esses caras manjam'),
('vendas', 'pessoal que vende coisa');