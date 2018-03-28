// Modul for validering av brukerinput på klientsiden ved registrering.
// Bruker jQuery for å knytte event-handlere til de ulike input-feltene
// og utfører valideringsfunksjonene når bruker klikker vekk fra dem.


// Validering for fornavnfeltet.
$("#fornavn").focusout(e => {

  // Validerer ikke tomme felter - fjerner css-klasser og returnerer.
  if (e.target.value.length == 0) {
    $(e.target).removeClass("is-valid").removeClass("is-invalid");
    return;
  }

  // Validerer fornavn etter samme regler som i medlemsklassen i PHP.
  let regex = /^[\p{L}\s'.-]{1,100}$/u;
  if (regex.test(e.target.value)) {
    $(e.target).addClass("is-valid").removeClass("is-invalid");
  }
  else {
    $(e.target).addClass("is-invalid").removeClass("is-valid");
    e.target.nextElementSibling.innerText = "Ugyldig fornavn.";
  }

});


// Validering for etternavnfeltet.
$("#etternavn").focusout(e => {

  // Validerer ikke tomme felter - fjerner css-klasser og returnerer.
  if (e.target.value.length == 0) {
    $(e.target).removeClass("is-valid").removeClass("is-invalid");
    return;
  }

  // Validerer etternavn etter samme regler som i medlemsklassen i PHP.
  let regex = /^[\p{L}\s'.-]{1,100}$/u;
  if (regex.test(e.target.value)) {
    $(e.target).addClass("is-valid").removeClass("is-invalid");
  }
  else {
    $(e.target).addClass("is-invalid").removeClass("is-valid");
    e.target.nextElementSibling.innerText = "Ugyldig etternavn.";
  }

});


// Validering for adressefeltet.
$("#adresse").focusout(e => {

  // Validerer ikke tomme felter - fjerner css-klasser og returnerer.
  if (e.target.value.length == 0) {
    $(e.target).removeClass("is-valid").removeClass("is-invalid");
    return;
  }

  // Validerer adresse etter samme regler som i medlemsklassen i PHP.
  let regex = /^[\p{L}\s\d'.,-]{1,100}$/u;
  if (regex.test(e.target.value)) {
    $(e.target).addClass("is-valid").removeClass("is-invalid");
  }
  else {
    $(e.target).addClass("is-invalid").removeClass("is-valid");
    e.target.nextElementSibling.innerText = "Ugyldig adresse.";
  }

});


// Validering for postnummerfeltet.
$("#postnummer").focusout(e => {

  // Validerer ikke tomme felter - fjerner css-klasser og returnerer.
  if (e.target.value.length == 0) {
    $(e.target).removeClass("is-valid").removeClass("is-invalid");
    $("#poststed").val("");
    return;
  }

  // Dersom brukerinput ikke er et firesifret tall, betraktes den som ugyldig.
  if (e.target.value.length != 4 || isNaN(e.target.value)) {
    $(e.target).addClass("is-invalid").removeClass("is-valid");
    $("#poststed").val("");
    e.target.nextElementSibling.innerText = "Ugyldig postnummer.";
    return;
  }

  // Gjør en ajax-forespørsel til APIet til Bring og behandler resultatet.
  $.ajax({
    url: `https://api.bring.com/shippingguide/api/postalCode.json?clientUrl=http://itfag.usn.no/~113049/&pnr=${e.target.value}`,
    success: data => {
      if (data.valid) {
        $(e.target).addClass("is-valid").removeClass("is-invalid");
        $("#poststed").val(data.result);
      } else {
        $(e.target).addClass("is-invalid").removeClass("is-valid");
        $("#poststed").val("");
        e.target.nextElementSibling.innerText = "Ugyldig postnummer.";
      }
    }
  });

});


// Validering for telefonnummerfeltet.
$("#telefonnummer").focusout(e => {

  // Validerer ikke tomme felter - fjerner css-klasser og returnerer.
  if (e.target.value.length == 0) {
    $(e.target).removeClass("is-valid").removeClass("is-invalid");
    return;
  }

  // Validerer telefonnummer etter samme regler som i medlemsklassen i PHP.
  let regex = /^\d{8}$/;
  if (regex.test(e.target.value)) {
    $(e.target).addClass("is-valid").removeClass("is-invalid");
  }
  else {
    $(e.target).addClass("is-invalid").removeClass("is-valid");
    e.target.nextElementSibling.innerText = "Ugyldig telefonnummer.";
  }

});


// Validering for e-postadressefeltet.
$("#epost").focusout(e => {

  // Validerer ikke tomme felter - fjerner css-klasser og returnerer.
  if (e.target.value.length == 0) {
    $(e.target).removeClass("is-valid").removeClass("is-invalid");
    return;
  }

  // Validerer e-postadresse ved hjelp av et regulært uttrykk.
  // Avviker fra valideringen i PHP, som har et innebygd filter for e-postadresser.
  let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;
  if (regex.test(e.target.value)) {
    $(e.target).addClass("is-valid").removeClass("is-invalid");
  }
  else {
    $(e.target).addClass("is-invalid").removeClass("is-valid");
    e.target.nextElementSibling.innerText = "Ugyldig e-postadresse.";
  }

});


// Validering for passordfeltet.
$("#passord").focusout(e => {

  // Validerer ikke tomme felter - fjerner css-klasser og returnerer.
  if (e.target.value.length == 0) {
    $(e.target).removeClass("is-valid").removeClass("is-invalid");
    return;
  }

  // Validerer passord etter samme regler som i medlemsklassen i PHP.
  let regex = /(?=.*\d)(?=.*[a-zæøå])(?=.*[A-ZÆØÅ]).{8,}/;
  if (regex.test(e.target.value)) {
    $(e.target).addClass("is-valid").removeClass("is-invalid");
  }
  else {
    $(e.target).addClass("is-invalid").removeClass("is-valid");
    e.target.nextElementSibling.innerText = "Passordet må bestå av minst 8 tegn og inneholde både tall, store-, og små bokstaver.";
  }

});


// Validering av det andre passordfeltet.
$("#passord2").focusout(e => {

  // Validerer ikke tomme felter - fjerner css-klasser og returnerer.
  if (e.target.value.length == 0) {
    $(e.target).removeClass("is-valid").removeClass("is-invalid");
    return;
  }

  // Sjekker om passordet er identisk med passordet i det første passordfeltet.
  if (e.target.value == $("#passord").val()) {
    $(e.target).addClass("is-valid").removeClass("is-invalid");
  } else {
    $(e.target).addClass("is-invalid").removeClass("is-valid");
    e.target.nextElementSibling.innerText = "Passordene må være like.";
  }

});


// Utføres når bruker klikker på submit-knappen.
// Dersom det finnes færre enn 8 input-felter med "is-valid"-klassen,
// vil knappetrykket avbrytes og bruker vil få tilbakemelding.
$("#submit").click(e => {
  if ($(".is-valid").length < 8){
    e.preventDefault();
    $(e.target.nextElementSibling).addClass("d-block");
  }
});
