DROP TRIGGER IF EXISTS valider_time;

DELIMITER $$

CREATE TRIGGER valider_time BEFORE INSERT ON reservasjon
FOR EACH ROW

BEGIN

    SELECT åpningstid, stengetid
    INTO @åpningstid, @stengetid
    FROM anlegg
    WHERE anleggskode = NEW.anleggskode;

    IF (NEW.time NOT BETWEEN @åpningstid AND @stengetid - 1)
    THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Kan ikke reservere utenfor åpningstiden.";
    END IF;


END$$

DELIMITER ;
