CREATE TABLE usuario
(
   email varchar(50) UNIQUE,
   hash_senha varchar(255)
) ENGINE=InnoDB;
