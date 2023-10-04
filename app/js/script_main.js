function gehiagoErakutsi(){
    current_taula = this.nextElementSibling;
    console.log(current_taula);
    if (current_taula.style.display === "none"){
        current_taula.style.display = "table";
    }
    else{
        current_taula.style.display = "none";
    }
}

function liburuaGehitu(){
    div_modal.style.display = "flex";
    div_modal_sub.style.display = "flex";
    div_opaku.style.display = "block";
}

function itxiLeihoa(){
    div_modal.style.display = "none";
    div_modal_sub.style.display = "none";
    div_opaku.style.display = "none";
}

function validarFormulario() {
    // Lortu formularioko eremuetako balioak
    var titulua = document.getElementById("input_izenburua").value;
    var autorea = document.getElementById("input_egilea").value;
    var generoa = document.getElementById("input_generoa").value;
    var prezioa = parseFloat(document.getElementById("input_prezioa").value);
    var isbn = document.getElementById("input_isbn").value;
    console.log(document.getElementById("izenburua"));
    console.log(titulua);

    // Balidazioak egiten ditu
    if (!titulua || !autorea || !generoa || !prezioa || !isbn) {
        alert("Algunos campos no se encuentran definidos o no tienen valor.");
        return false;
    }

    if (titulua.length > 30) {
        alert("El campo 'Titulua' debe tener como máximo 30 caracteres.");
        return false;
    }

    if (autorea.length > 20) {
        alert("El campo 'Autorea' debe tener como máximo 20 caracteres.");
        return false;
    }

    if (generoa.length > 20) {
        alert("El campo 'Generoa' debe tener como máximo 20 caracteres.");
        return false;
    }

    if (isNaN(prezioa) || prezioa <= 0) {
        alert("El campo 'Prezioa' debe ser un número mayor que cero.");
        return false;
    }

    if (isbn.length > 17) {
        alert("El campo 'ISBN' debe tener como máximo 17 caracteres.");
        return false;
    }
    // Balidazio guztiak pasatzen badira, formularioa bidali egingo da
    return true;
}

var current_taula = null;
const div_taulak = document.getElementsByClassName("div_taula");
for (let i = 0; i < div_taulak.length; i++) {
    div_taulak[i].addEventListener("click", gehiagoErakutsi);
  }

const botonMostrarRecuadro = document.getElementById("botoi_biribila");
botonMostrarRecuadro.addEventListener("click", liburuaGehitu);
const div_modal = document.getElementById("div_modal");
const div_modal_sub = document.getElementById("div_modal_sub");
const modal_itxi = document.getElementById("modal_itxi");
modal_itxi.addEventListener("click", itxiLeihoa);
const div_opaku = document.getElementById("div_opaku");