#Create database Gestao;
#Drop database Gestao;
use Gestao;

Create table Cidade(
	CidadeID int not null primary key auto_increment,
    CidadeNome varchar(50) not null,
    CidadeUF varchar(50) not null
);

Create table Bairro(
	BairroID int not null primary key auto_increment,
    BairroNome varchar(50) not null,
    CidadeID int not null,
    Foreign key(CidadeID) references Cidade(CidadeID)
);

Create table Cliente(
	ClienteID int not null primary key auto_increment,
    ClienteNome varchar(100) not null,
    ClienteCPF varchar(11) not null,
    ClienteDataNasc date not null,
    ClienteSexo char(1) not null,
	ClienteFoto varchar(50) not null,
    ClienteAtivo boolean not null,
    BairroID int not null,
    Foreign key(BairroID) references Bairro(BairroID)
);

Create table Funcionario(
	FuncionarioID int not null primary key auto_increment,
    FuncionarioUsuario varchar(50) not null,
    FuncionarioSenha varchar(60) not null,
    FuncionarioNome varchar(100) not null,
    FuncionarioCPF varchar(11) not null,
    FuncionarioDataNasc date not null,
    FuncionarioSexo char(1) not null,
	FuncionarioFoto varchar(50) not null,
    FuncionarioAtivo boolean not null,
    BairroID int not null,
    Foreign key(BairroID) references Bairro(BairroID)
);

Create table Modulo(
	ModuloID int not null primary key auto_increment,
    ModuloNome varchar(50) not null
);

Create table FuncionarioModulo(
	FuncionarioId int not null,
    ModuloID int not null,
    primary key(CargoID, ModuloID),
    foreign key(CargoID) references Cargo(CargoID),
    foreign key(ModuloID) references Modulo(ModuloID)
);

Select * from cidade;
Select * from bairro;
Select * from cliente;
Select * from funcionario;
Select * from cargo;
Select * from modulo;
Select * from cargoModulo;