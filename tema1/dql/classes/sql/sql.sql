create database proyecto default character set utf8 collate utf8_unicode_ci;
create user proyecto@localhost identified by 'proyecto';
grant all on proyecto.* to proyecto@localhost;
flush privileges;

#esto en doctrine: cli
#doctrine orm:schema-tool:create
#doctrine orm:generate:entities ./src