create database nombrebd
  default character set utf8
  collate utf8_general_ci;
  
create user usuariobd@localhost
  identified by 'clavebd';

grant all
  on nombrebd.*
  to usuariobd@localhost;

flush privileges; 

create table producto (
    id bigint not null auto_increment primary key,
    nombre varchar(30) not null,
    precio numeric(10, 3),
    observaciones text
) engine = innodb
  character set utf8
  collate utf8_general_ci;
  
/*Redefinnimos en la declaración de cada tabla el collate, para en caso de que */
  
create table usuario (
    id bigint not null auto_increment  primary key,
    correo varchar(60) not null unique,
    alias varchar(30) unique null,
    nombre varchar(30) not null,
    clave varchar(18) not null,
    activo bit(1) not null default 0,
    fechaalta timestamp default current_timestamp
) engine = innodb
  character set utf8
  collate utf8_general_ci;
  
create table fecha (
    id bigint not null auto_increment primary key,
    fecha date,
    fechahora datetime,
    marcatiempo timestamp default current_timestamp on update current_timestamp
) engine = innodb
  character set utf8
  collate utf8_general_ci;
  
/*on update current_timestamp --> Hace que cuando actualicemos nos guardemos la hora de actualización*/