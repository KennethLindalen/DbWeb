// jQuery-kode som lastes på slutten av medlemmenes "min side".

// Henter verdiene fra feltene med klassenavn "dato" og
// skriver dem om fra MySQL-dataformat til norsk dataformat.
$(".dato").get().forEach(dato => {
  let [år, måned, dag] = dato.innerText.split("-");
  let datoobjekt = new Date(år, måned - 1, dag);
  dato.innerText = datoobjekt.toLocaleDateString("no-bok", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
    weekday: "long"
  });
});
