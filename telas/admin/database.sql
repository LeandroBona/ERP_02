create database IF NOT EXISTS erp_sesi;

use erp_sesi;
-- Criação tabelas Pais --
create table fornecedores(
fornecedor_id  int(11) auto_increment primary key,
nome varchar(100) not null,
telefone varchar(20) not null,
email varchar(100) not null,
endereco varchar (25)
);

create table setores(
setor_id  int(11) auto_increment primary key,
nome varchar(100) not null,
descricao text
);

create table categorias(
categoria_id  int(11) auto_increment primary key,
nome varchar(100) not null,
descricao text
);

-- Criação tabelas Filhos --
create table produtos(
produto_id  int(11) auto_increment primary key,
nome varchar(100) not null,
descricao text not null,
categoria_id int not null,
preco_venda decimal(10,2),
preco_custo decimal(10,2),
quantidade_estoque int,
unidade_medida varchar(200),
fornecedor_id int not null,
foreign key (categoria_id) references categorias(categoria_id),
foreign key (fornecedor_id) references fornecedores(fornecedor_id)
);

create table estoque(
estoque_id  int(11) auto_increment primary key,
produto_id int not null,
tipo_movimentacao enum ('entrada', 'saida', 'devolução') not null,
quantidade int not null,
data_movimentacao datetime,
foreign key (produto_id) references produtos(produto_id)
);

create table funcionarios(
funcionario_id  int(11) auto_increment primary key,
nome varchar(100) not null,
cargo varchar(50) not null,
setor_id int not null,
telefone varchar(20),
email varchar(100) not null,
data_admissao date not null,
salario decimal(10,2),
metodo_pagamento varchar(50),
foreign key (setor_id) references setores(setor_id)
);

create table manutencoes(
manutencao_id  int(11) auto_increment primary key,
equipamento varchar(100) not null,
descricao_problema text not null,
data_inicio datetime not null,
data_termino datetime not null,
tecnico_responsavel varchar(100),
status enum('quebrado','funcional'),
responsavel_id int not null,
foreign key (responsavel_id) references funcionarios(funcionario_id)
);

create table pedidos(
pedido_id  int(11) auto_increment primary key,
data_pedido datetime not null,
status enum('Ativo', 'Inativo', 'Suspenso') not null,
valor_total decimal(10,2),
funcionario_id int not null,
foreign key (funcionario_id) references funcionarios(funcionario_id)
);

create table itens_pedidos(
itempedido_id  int(11) auto_increment primary key,
pedido_id int not null,
produto_id int not null,
quantidade int not null,
foreign key (pedido_id) references pedidos(pedido_id),
foreign key (produto_id) references produtos(produto_id)
);


alter table estoque
add column tipo_movimentacao enum ('entrada', 'saida', 'devolução');

ALTER TABLE produtos ADD COLUMN quantidade INT DEFAULT 0;