DELIMITER $$

# Lagret prosedyre for sletting av idrettsanlegg.
CREATE PROCEDURE slett_anlegg
(
	IN slett_anleggskode INT
)
BEGIN
	DELETE FROM anlegg
    WHERE anleggskode = slett_anleggskode;
END$$


# Lagret prosedyre for sletting av artikler.
CREATE PROCEDURE slett_artikkel
(
	IN slett_artikkelkode INT
)
BEGIN
	DELETE FROM artikkel
    WHERE artikkelkode = slett_artikkelkode;
END$$


# Lagret prosedyre for sletting av idretter.
CREATE PROCEDURE slett_idrett
(
	IN slett_idrettskode INT
)
BEGIN
	DELETE FROM idrett
    WHERE idrettskode = slett_idrettskode;
END$$


# Lagret prosedyre for sletting av medlemmer.
CREATE PROCEDURE slett_medlem
(
	IN slett_medlemsnummer INT
)
BEGIN

	# Dersom noe skulle feile, kjøres ROLLBACK, og transaksjonen stoppes.
	DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
	DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;

	START TRANSACTION;

		# Endrer medlemsnummeret på eventuelle artikler brukeren har skrevet til NULL.
		UPDATE artikkel
		SET medlemsnummer = NULL
		WHERE medlemsnummer = slett_medlemsnummer;

		# Deretter slettes alle reservasjonene gjort av medlemmet hvor fristen ennå ikke er utgått.
		DELETE FROM reservasjon
		WHERE
			medlemsnummer = slett_medlemsnummer AND
			NOW() < DATE_SUB(TIMESTAMP(dato, MAKETIME(time, 0, 0)), INTERVAL 1 HOUR);

		# Resterende reservasjoner gjort av medlemmet vil ha gått utover avbestillingsfristen og settes til NULL.
		UPDATE reservasjon
		SET medlemsnummer = NULL
		WHERE medlemsnummer = slett_medlemsnummer;

		# Til slutt slettes medlemmet fra medlemstabellen.
		DELETE FROM medlem
		WHERE medlemsnummer = slett_medlemsnummer;

	COMMIT;
END$$


# Lagret prosedyre for sletting av reservasjoner.
CREATE PROCEDURE slett_reservasjon
(
	IN slett_anleggskode INT,
	IN slett_dato DATE,
	IN slett_time INT
)
BEGIN
	DELETE FROM reservasjon
    WHERE
		anleggskode = slett_anleggskode AND
        dato = slett_dato AND
        time = slett_time;
END$$


# Trigger for å sjekke om kansellering kan gjøres i forhold til kanselleringsfristen.
CREATE TRIGGER valider_kansellering BEFORE DELETE ON reservasjon
FOR EACH ROW
BEGIN

  SET @klokkeslett = TIMESTAMP(OLD.dato, MAKETIME(OLD.time, 0, 0));
  SET @frist = DATE_SUB(@klokkeslett, INTERVAL 1 HOUR);

  IF (@frist < NOW()) THEN
    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Reservasjoner må kanselleres minst 1 time i forveien.";
  END IF;

END$$


# Trigger for å sjekke om reservasjonen kan legges inn på dette tidspunktet.
CREATE TRIGGER valider_reservasjon BEFORE INSERT ON reservasjon
FOR EACH ROW
BEGIN

  SELECT åpningstid, stengetid
  INTO @åpningstid, @stengetid
  FROM anlegg
  WHERE anleggskode = NEW.anleggskode;

  SET @klokkeslett = TIMESTAMP(NEW.dato, MAKETIME(NEW.time, 0, 0));

  IF (NEW.time NOT BETWEEN @åpningstid AND @stengetid - 1) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Du kan ikke reservere et anlegg utenfor åpningstiden.";
  ELSEIF (@klokkeslett < NOW()) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Du kan ikke reservere et anlegg i fortiden.";
  END IF;

END$$

DELIMITER ;
