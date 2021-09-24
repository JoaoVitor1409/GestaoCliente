#Create database Gestao;
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
	ClienteFoto varchar(50),
    ClienteAtivo boolean not null,
    BairroID int not null,
    Foreign key(BairroID) references Bairro(BairroID)
);

Select * from cidade;
Select * from bairro;
Select * from cliente;