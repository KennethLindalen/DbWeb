DROP TRIGGER IF EXISTS valider_kansellering;

DELIMITER $$

CREATE TRIGGER valider_kansellering BEFORE DELETE ON reservasjon
FOR EACH ROW

BEGIN

  SET @klokkeslett = TIMESTAMP(OLD.dato, MAKETIME(OLD.time, 0, 0));
  SET @frist = DATE_SUB(@klokkeslett, INTERVAL 1 HOUR);

  IF (@frist < NOW()) THEN
    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "Reservasjoner må kanselleres minst 1 time i forveien.";
  END IF;

END$$

DELIMITER ;
