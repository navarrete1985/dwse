create database simple
  default character set utf8
  collate utf8_general_ci;
  
create user simple@localhost
  identified by 'simple';

grant all
  on simple.*
  to simple@localhost;

flush privileges;

use simple;/*para poner hacerlo del tirón*/

create table usuario (
    id bigint not null auto_increment primary key,
    correo varchar(60) not null unique,
    clave varchar(255) not null
) engine = innodb
  character set utf8
  collate utf8_general_ci;
  
  
id -> Autoincremento y primary key
    - correo -> (not null, uni)
    - alias -> (uni pero puede ser null)
    - nombre -> (not null)
    - clave -> (not null)
    - activo -> (bit(0,1) 0->no está activo, not null)
    - fechaalta -> (datetime, not null)
    
    
create table usuario (
    id bigint not null auto_increment primary key,
    correo varchar(60) not null unique,
    clave varchar(255) not null,
    alias varchar(50) not null unique,
    nombre varchar(50) not null,
    activo tinyint(1) not null default 0,
    administrador tinyint(1) not null default 0,
    fechaalta timestamp default current_timestamp
) engine = innodb
  character set utf8
  collate utf8_general_ci;
  
  
  create table usuario (
    id bigint not null auto_increment primary key,
    correo varchar(60) not null unique,
    alias varchar(50) not null unique,
    nombre varchar(50) not null,
    clave varchar(255) not null,
    activo tinyint(1) not null default 0,
    fechaalta timestamp default current_timestamp,
    administrador tinyint(1) not null default 0
) engine = innodb
  character set utf8
  collate utf8_general_ci;
  
  