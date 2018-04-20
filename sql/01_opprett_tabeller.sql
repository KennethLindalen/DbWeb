CREATE TABLE IF NOT EXISTS poststed (
  postnummer  CHAR(4)     NOT NULL,
  poststed    VARCHAR(50) NOT NULL,
  PRIMARY KEY (postnummer)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS medlem (
  medlemsnummer INT(11)       NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fornavn       VARCHAR(100)  NOT NULL,
  etternavn     VARCHAR(100)  NOT NULL,
  adresse       VARCHAR(100)  NOT NULL,
  postnummer    CHAR(4)       NOT NULL,
  telefonnummer CHAR(8)       NOT NULL,
  epost         VARCHAR(100)  NOT NULL UNIQUE,
  passord       CHAR(60)      NOT NULL,
  INDEX (postnummer ASC),
  FOREIGN KEY (postnummer) REFERENCES poststed (postnummer)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS administrator (
  medlemsnummer INT(11) NOT NULL,
  PRIMARY KEY (medlemsnummer),
  FOREIGN KEY (medlemsnummer) REFERENCES medlem (medlemsnummer)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



CREATE TABLE IF NOT EXISTS idrett (
  idrettskode INT(11)      NOT NULL AUTO_INCREMENT,
  navn        VARCHAR(100) NOT NULL UNIQUE,
  PRIMARY KEY (idrettskode)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS anlegg (
  anleggskode INT(11)       NOT NULL AUTO_INCREMENT,
  idrettskode INT(11)       NOT NULL,
  navn        VARCHAR(100)  NOT NULL,
  åpningstid  INT(11)       NOT NULL,
  stengetid   INT(11)       NOT NULL,
  timepris    DECIMAL(10,0) NOT NULL,
  PRIMARY KEY (anleggskode),
  UNIQUE INDEX (navn ASC, idrettskode ASC),
  FOREIGN KEY (idrettskode) REFERENCES idrett (idrettskode)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS artikkel (
  artikkelkode  INT(11)       NOT NULL AUTO_INCREMENT,
  tittel        VARCHAR(100)  NOT NULL,
  undertittel   VARCHAR(100)  NOT NULL,
  innhold       VARCHAR(500)  NOT NULL,
  bildeUrl      VARCHAR(100)  NOT NULL,
  medlemsnummer INT(11)       NULL DEFAULT NULL,
  PRIMARY KEY (artikkelkode),
  FOREIGN KEY (medlemsnummer) REFERENCES medlem (medlemsnummer)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


CREATE TABLE IF NOT EXISTS reservasjon (
  medlemsnummer INT(11) NULL DEFAULT NULL,
  anleggskode   INT(11) NOT NULL,
  dato          DATE    NOT NULL,
  time          INT(11) NOT NULL,
  PRIMARY KEY (anleggskode, time, dato),
  FOREIGN KEY (medlemsnummer) REFERENCES medlem (medlemsnummer)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (anleggskode) REFERENCES anlegg (anleggskode)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
