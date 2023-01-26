create table anunciante(
	codigo integer auto_increment not null,
	nome varchar(50) not null,
	cpf varchar(11) not null,
	email varchar(50) not null
	senha varchar(128) not null,
	telefone varchar(13) not null,
	constraint primary key(codigo)
);

create table anuncio (
	codigo integer auto_increment not null,
	titulo varchar(255) not null,
	descricao varchar(512) not null,
	preco double not null,
	dataHora datetime not null,
	cep varchar(8) not null,
	bairro varchar(30) not null,
	cidade varchar(50) not null,
	estado char(2) not null,
	codCategoria integer not null,
	codAnunciante integer not null,
	constraint primary key(codigo),
	constraint foreign key(codCategoria) references categoria(codigo),
	constraint foreign key(codAnunciante) references anunciante(codigo)
);

create table categoria (
	codigo integer auto_increment not null,
	nome varchar(40) not null,
	descricao varchar(512) not null,
	constraint primary key(codigo)
);

create table interesse (
	codigo integer auto_increment not null,
	mensagem varchar(512) not null,
	dataHora datetime not null,
	contato varchar(50) not null,
	codAnuncio integer not null,
	constraint primary key(codigo),
	constraint foreign key(codAnuncio) references anuncio(codigo)
);

create table foto (
	codigo integer auto_increment not null,
	codigoAnuncio integer not null,
	NomeArqFoto varchar(255) not null,
	constraint primary key(codigo),
	constraint foreign key(codigoAnuncio) references anuncio(codigo)
);

create table baseEnderecosAjax (
	cep varchar(8) not null,
    bairro varchar(50) not null,
    cidade varchar(50) not null,
    estado varchar(2) not null
);