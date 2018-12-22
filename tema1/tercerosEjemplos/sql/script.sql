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