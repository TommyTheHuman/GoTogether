create database if not exists NomeSito;
use NomeSito;
drop table if exists utente;
create table utente (
    id int not null auto_increment,
    nome varchar(50) not  null,
    cognome varchar(50) not null,
    email varchar(100) not null,
    password varchar(100) not null,
    datanascita date default null,
    image varchar(100) default 'placeholder.png',
    gender varchar(100) not null,
    primary key (id)
) engine=innodb;

drop table if exists proposte;
create table proposte(
    IdProposta int not null auto_increment,
    IdProponente int not null,
    Nazione varchar(100) not null,
    Citta varchar(100) not null,
    DataInizio date not null,
    DataFine date not null,
    Prezzo int not null,
    NumPersone int not null,
    PersoneOra int default 0,
    titoloViaggio varchar(50) not null,
    image varchar(100) not null,
    descrizione text not null,
    primary key(IdProposta),
    FOREIGN KEY (IdProponente) REFERENCES utente(id)
)engine = innodb;

drop table if exists propostedaaccettare;
create table propostedaaccettare(
    IdProposta int not null,
    IdRichiedente int not null,
    IdProponente int not null,
    Accettato bool not null default false,
    DataRichiesta timestamp not null,
    Visualizzato bool not null default false,
    primary key(IdProposta, IdRichiedente),
    FOREIGN KEY (IdRichiedente) REFERENCES utente(id),
    FOREIGN KEY (IdProponente) REFERENCES utente(id),
    FOREIGN KEY (IdProposta) REFERENCES proposte(IdProposta) ON DELETE CASCADE
)engine = innodb;

drop table if exists feedback;
create table feedback(
    IdRecensione int not null auto_increment,
    IdRecensore int not null,
    IdRecensito int not null,
    Voto int default null,
    Commento tinytext,
    primary key(IdRecensione),
    FOREIGN KEY (IdRecensore) REFERENCES utente(id),
    FOREIGN KEY (IdRecensito) REFERENCES utente(id)
)engine = innodb;

DROP TRIGGER IF EXISTS aggiorna_posti;
DELIMITER $$
CREATE TRIGGER aggiorna_posti
AFTER UPDATE ON propostedaaccettare
FOR EACH ROW
BEGIN

	IF((NEW.Accettato = 1) AND (NEW.Visualizzato = 1)) THEN
		UPDATE proposte SET PersoneOra = PersoneOra+1
        WHERE IdProposta = NEW.IdProposta;
	END IF;
    
END $$

DELIMITER ;