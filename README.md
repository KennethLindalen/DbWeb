https://docs.google.com/document/d/1AHJw7SWDfhUWeON1HsGUfurbP1zkw4htr9dB7D1mLUA/edit?ts=5a665768

Foreløpig beskrivelse av applikasjon (Milepæl 2) Frist: 23.02 (teller 15%)

Krav: kort introduksjon
Forklarer hva web-applikasjonen skal gjøre, og hvem som er tenkt å bruke applikasjonen.
Tema: Nederlaget IK - en idrettsklubb med vikarierende motiv og tvilsomme resultater. Nederlaget IL har individuelle idretter som hovedfokus. forslag er bordtennis, bowling, minigolf, orientering  m.m. 

Det er tenkt at webapplikasjonen skal kunne gi primære brukere (Idrettsforeningens  medlemmer) mulighet til å logge inn for å reservere baner/anlegg. Dette i tillegg til å kunne sjekke terminlister, informasjon om oppmøtetider, andre arrangementer samt kontakte ledelsen av de respektive idrettene ved behov. Videre fungerer applikasjonen som en informasjonsside for sekundære brukere, som vi regner som ikke-medlemmer, der det er mulig å finne kontaktinformasjon om klubben og evt melde seg inn. 

Rent estetisk har vi valgt få farger i designet av av nettsiden, og satset hardt på funksjonalitet og Z-design så ikke-medlemmer og medlemmer skal få en rask oversikt over innholdet på siden.

Av rent praktiske årsaker ønsker vi også at noen av brukerne har mulighet til å endre sql databasen ved behov. 
//dette er typisk det jeg ser for meg ansvarlig person i pseudokoden nevnt i punkt 3. skal ha tilgang til. (se punkt 5. i krav til løsningen)


	2. Skisse av GUI 



//todo . bytte skjermbildet.

En rekke med informasjonsider. kontakt oss, innlogging osv. dette pluss admin admin(lagleder, oppmann, administrator) og vanlig bruker. Deretter mulighet for en portal som gir tilgang til *

Vi setter opp en side etter Z-design som gjør at det skal bli enkelt for brukere å se 

	3. Beskrivelse av databasen
*få med navn på tabeller, kolonner, primærnøkler og fremmednøkler. Man kan evt. lage et ER-diagram, men dette er ikke noe krav. 


MySQL-databasen skal inneholde minst 3 tabeller, definert med primærnøkler og koblet sammen med fremmednøkler. Tabellene skal inneholde forskjellige typer av data, både heltall, desimaltall, tekster og datoer. Minst én av primærnøklene skal være autonummerert. Det skal utvikles et SQL-skript som definerer alle tabellene og setter inn eksempeldata.

for eksempel 










4. Hver funksjon skal beskrives kort og presist

hvilke kontroller på inndata blir gjort, hva slags effekt har funksjonen på databasen og hva slags respons gir funksjonen til bruker? Om ønskelig kan man her gjerne legge ved bruksmønsterdiagrammer (use case).	

//bruksområder for brukerintersaksjon.

“bli medlem” 
Må fylle inn personalia som som sjekkes opp mot datatype og krav til lengde osv. Endstate: bruker får medlemsnummer

“leie anlegg” 
må fylle inn anleggsnummer, og tidspunkt (bane nummer og tid må ikke være opptatt) får tildelt anleggstid! 





5. Redegjør for bruk av programbiblioteker utover jQuery




Krav til løsningen
Web-applikasjonen skal utvikles ved hjelp av PHP, SQL, JavaScript, jQuery, HTML og CSS. Krav:
Applikasjonen skal kjøre på XAMPP (som installert på skolens maskiner). All bruk av "programbiblioteker" utover jQuery skal godkjennes innen milepæl 2 og også gjøres rede for i dokumentasjonen.
Godkjente programbiblioteker: Bootstrap
Applikasjonen skal ha "gjennomført design". Dette bør gjøres ved bruk av CSS og PHP include-filer. Bruk av HTML og CSS skal validere i henhold til de nyeste standardene. Nettsidene skal inneholde mulighet for enkel kontroll av dette.
MySQL-databasen skal inneholde minst 3 tabeller, definert med primærnøkler og koblet sammen med fremmednøkler. Tabellene skal inneholde forskjellige typer av data, både heltall, desimaltall, tekster og datoer. Minst én av primærnøklene skal være autonummerert. Det skal utvikles et SQL-skript som definerer alle tabellene og setter inn eksempeldata.
Applikasjonen skal bestå av en åpen del og en passordbeskyttet del. Den åpne delen skal gi innsyn og søkemuligheter i (deler av) databasen.
I den passordbeskyttede delen skal det være mulig å oppdatere (noen av tabellene i) databasen. Det er opp til gruppen å avgjøre detaljene i dette, men for minst én av tabellene skal det være mulig å sette inn nye rader, samt endre og slette eksisterende rader.
Applikasjonen skal ha minst én funksjon som krever mer enn én enkelt SQL-kommando (en sammensatt transaksjon), og minst én funksjon som presenterer flere rader fra en av tabellene i databasen.
Applikasjonen skal inneholde minst ett skjema (HTML Form) med inndatavalidering, og dette skal også være sikret mot SQL injection.
Applikasjonen skal definere minst 2 forretningsregler på databasen.
Applikasjonen skal definere og bruke minst én lagret rutine og minst én trigger.
Applikasjonen skal bruke sesjoner.
Applikasjonen skal inneholde minst ett eksempel på bruk av AJAX, gjerne jQuery, for å oppnå et mer interaktivt brukergrensesnitt.
Koden skal modulariseres med fornuftig bruk av egendefinerte klasser og funksjoner. PHP-koden kan gjerne lagres i include-filer. Velg logiske navn på funksjoner og variabler, og følg vanlige regler for innrykk.

