function validerRegForm(formNavn){

ikkeTilatteTegnBrukernavn = /^\w+$/;
passSjekkTall = /[0-9]/;
passSjekkStorBokstaver = /[A-ZÆØÅ]/;
passSjekkSmåBokstaver = /[a-zæøå]/;

/*
  Alle testene er klare, må bare få en måte til å få de til å funke med modal. Modal lukkes hele tiden.
*/

  if(formNavn.RegistrerBrukernavn.value == ""){
    alert("Brukernavn boksen kan ikke være tom.")
    formNavn.RegistrerBrukernavn.focus();
    return false;
  }
  if(!ikkeTilatteTegnBrukernavn.test(formNavn.RegistrerBrukernavn.value){
    alert("Brukernavnet kan bare inneholde bokstaver, tall, understreker og bindestreker.")
    formNavn.RegistrerBrukernavn.focus();
    return false;
  }
  if(!ikkeTilatteTegnBrukernavn.test(formNavn.RegistrerEpost.value){
    alert("Eposten kan bare inneholde bokstaver, tall, understreker og bindestreker.")
    formNavn.RegistrerBrukernavn.focus();
    return false;
  }
  if(formNavn.RegistrerPassord.value == formNavn.RegistrerBrukernavn.value){
    alert("Passord kan ikke være det samme som brukernavnet ditt.")
    formNavn.RegistrerPassord.focus();
    return false;
  }
  if(formNavn.RegistrerPassord.value != ""){
    if(formNavn.RegistrerPassord.value.length <= 6){
      alert("Passordet må være mer enn 6 tegn langt.")
      formNavn.RegistrerPassord.focus();
      return false;
    }
    if(formNavn.RegistrerPassord.value == formNavn.RegistrerBrukernavn.value){
      alert("Passord kan ikke være det samme som brukernavnet ditt.")
      formNavn.RegistrerPassord.focus();
      return false;
    }
    if(!passSjekkTall.test(formNavn.RegistrerPassord)){
      alert("Passord må innholde ett tall.")
      formNavn.RegistrerPassord.focus();
      return false;
    }
    if(!passSjekkStorBokstaver.test(formNavn.RegistrerPassord)){
      alert("Passord må innholde ett tall.")
      formNavn.RegistrerPassord.focus();
      return false;
    }
    if(!passSjekkSmåBokstaver.test(formNavn.RegistrerPassord)){
      alert("Passord må innholde ett tall.")
      formNavn.RegistrerPassord.focus();
      return false;
    }
    if(formNavn.RegistrerPassord.value == formNavn.RegistrerPassordIgjen.value){
      alert("Passordene må være like.")
        formNavn.RegistrerPassord.focus();
        return false;
    }
    alert("Passordet er ikke skrivd inn.");
    formNavn.RegistrerPassord.focus();
    return false;
  }
  return true;
}
