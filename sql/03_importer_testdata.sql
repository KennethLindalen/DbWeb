INSERT INTO
  medlem (medlemsnummer, fornavn, etternavn, adresse, postnummer, telefonnummer, epost, passord)
VALUES
  ('1', 'Kristian', 'Stang', 'Romnesvegen 81', '3830', '90096892', 'kristian.sta@gmail.com', '$2y$10$woM0dcAxcdJI.zRujWmTKeXThlSMSYtlx49tr06hfME8vV27VIJiy'),
  ('2', 'Kenneth', 'Lindalen', 'Strømodden 16', '3830', '41848379', 'kennethlindalen@gmail.com', '$2y$10$Ej8wXymFBoYcWJiMfi2/x.1R8z.4ClKkdI2eJqnDsoXf9DuszDAUa'),
  ('3', 'Hans ', 'Ødegaard', 'Vigdis Cordtsensvei 2 D', '3684', '41177545', 'hansodeg@gmail.com', '$2y$10$Ons8lXYvHbLi84RA1igGV.wz5KB0gbpnTxbg8av6p4.Fv6g5cJNyW'),
  ('4', 'Kolbjørn', 'Berggylte', 'Kabelgata RJ45', '3692', '81549300', 'medlem@nederlaget.no', '$2y$10$0KEqC/puCjcRUppIRiD8QOAOBNlNG.uAWOFLJrtK.w38ATVOTZPoq');


INSERT INTO
  administrator (medlemsnummer)
VALUES
  ('1'),
  ('2'),
  ('3');


INSERT INTO
  idrett (idrettskode, navn)
VALUES
  ('2', 'Bordtennis'),
  ('3', 'Dart'),
  ('1', 'Tennis');


INSERT INTO
  anlegg (anleggskode, idrettskode, navn, åpningstid, stengetid, timepris)
VALUES
  ('1', '2', 'Bord 1', '10', '20', '25'),
  ('2', '2', 'Bord 2', '10', '20', '25'),
  ('3', '1', 'Grusbanen', '8', '18', '50'),
  ('4', '1', 'Grassbanen', '8', '18', '50'),
  ('5', '3', 'Dartskive 1', '10', '22', '20'),
  ('6', '3', 'Dartskive 2', '10', '22', '20');


INSERT INTO
  reservasjon (medlemsnummer, anleggskode, dato, time)
VALUES
  ('1', '1', '2018-04-27', '14'),
  ('1', '1', '2018-04-27', '15'),
  ('1', '1', '2018-04-27', '16'),
  ('1', '2', '2018-04-27', '17'),
  ('1', '2', '2018-04-27', '18'),
  ('1', '2', '2018-04-27', '19'),
  ('4', '4', '2018-04-27', '8'),
  ('4', '4', '2018-04-27', '9'),
  ('4', '4', '2018-04-27', '10'),
  ('4', '4', '2018-04-27', '16'),
  ('4', '4', '2018-04-27', '17'),
  ('4', '5', '2018-04-27', '11'),
  ('4', '5', '2018-04-27', '12'),
  ('4', '5', '2018-04-27', '13'),
  ('4', '5', '2018-04-27', '14'),
  ('4', '5', '2018-04-27', '15');


INSERT INTO
  artikkel (artikkelkode, tittel, undertittel, innhold, bildeUrl, medlemsnummer)
VALUES
  ('1', 'Nytt nederlag', 'Tapte 4-0 mot Svenseid IL', 'Nederlaget IK tapte 4-0 for tabelljumbo Svenseid IL i gårsdagens kamp.\r\nNIK holdt lenge unna for tabelljumboen Svenseid, men måtte til slutt\r\ngi tapt for overmakten med scoringer i det 86, 87, 88 og 89. minutt.\r\nDagens nederlagsmann ble Bjartmar Olsen med sine 2 selvmål og rødt kort.', 'img/football.jpg', 3),
  ('2', 'Tennisbanen er åpen!', 'Sesongen er i gang', 'Tennisbanene er endelig åpnet for sesongen!\r\nMed god støtte fra Conrad Pløsen og hans elleville Lamborghinitraktor er endelig sneen\r\nborte fra tennisanlegget vårt. Dette feirer vi med \"serveoff\" neste lørdag klokka 12\r\npå tennisbanen med kanapeer. Det vil bli satt opp egne ladestasjoner for\r\nTeslaer i denne anledning. Antrekk: Lacoste.', 'img/tennis.jpg', 3),
  ('3', 'Orienteringsløpet avbrutt', 'Illsint elg angrep deltaker', 'Orienteringsløpet forrige søndag ble avbrutt etter at en løper ved en av postene\r\nløp på en fødende elgku. Hannen tok grep og kastet løperen buskimellom, og\r\nløpsadministrasjonen valgte derfor å avbryte løpet med hensyn til den fødende.\r\nDen skadde deltakerens tilstand meldes å være kritisk, men stabil.', 'img/moose.jpg', 3),
  ('4', 'Økonomisk krise', 'Årsrapporten viser dystre tall', 'I riktig nederlagsånd viser det seg at klubben er på kanten av av\r\nøkonomisk ruin. Utgifter til kanapeer og strøm til lading av elbiler\r\nviser seg å være klubbens aller største utgiftsposter. Klubben går nå\r\nen usikker fremtid i møte.', 'img/loss.jpg', 3);
