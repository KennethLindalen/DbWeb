DROP TRIGGER IF EXISTS valider_time;

DELIMITER $$

CREATE TRIGGER valider_time BEFORE INSERT ON reservasjon
FOR EACH ROW

BEGIN

  SELECT åpningstid, stengetid
  INTO @åpningstid, @stengetid
  FROM anlegg
  WHERE anleggskode = NEW.anleggskode;

  SET @klokkeslett = TIMESTAMP(NEW.dato, MAKETIME(NEW.time, 0, 0));

  IF (NEW.time NOT BETWEEN @åpningstid AND @stengetid - 1) THEN
    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Du kan ikke reservere et anlegg utenfor  åpningstiden.";
  ELSEIF (@klokkeslett < NOW()) THEN
    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Du kan ikke reservere et anlegg i fortiden.";
  END IF;

END$$

DELIMITER ;
