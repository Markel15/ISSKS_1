function gehiagoErakutsi(){
    current_taula = this.nextElementSibling;
    // console.log(current_taula);
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
    document.getElementById("h2_izenburua").innerHTML = "Liburua gehitu";
    document.getElementById("hidden_akzioa").value = "gehitu";
}

function liburuaEditatuLeihoa(izenburua, egilea, generoa, prezioa, isbn){
    div_modal.style.display = "flex";
    div_modal_sub.style.display = "flex";
    div_opaku.style.display = "block";
    document.getElementById("h2_izenburua").innerHTML = "Liburua editatu";
    document.getElementById("hidden_akzioa").value = "editatu";
    document.getElementById("input_isbnAurrekoa").value = isbn;
    document.getElementById("input_izenburua").value = izenburua;
    document.getElementById("input_egilea").value = egilea;
    document.getElementById("input_generoa").value = generoa;
    document.getElementById("input_prezioa").value = prezioa;
    document.getElementById("input_isbn").value = isbn;
    console.log(isbn);

}

function itxiLeihoa(){
    div_modal.style.display = "none";
    div_modal_sub.style.display = "none";
    div_opaku.style.display = "none";
}


function formularioaBalioztatu() {
    // Lortu formularioko eremuetako balioak
    var titulua = document.getElementById("input_izenburua").value;
    var autorea = document.getElementById("input_egilea").value;
    var generoa = document.getElementById("input_generoa").value;
    var prezioa = parseFloat(document.getElementById("input_prezioa").value);
    var isbn = document.getElementById("input_isbn").value;
    // console.log(document.getElementById("izenburua"));
    // console.log(titulua);

    // Balidazioak egiten ditu
    if (!titulua || !autorea || !generoa || !prezioa || !isbn) {
        alert("Zenbait eremu ez dute baliorik.");
        return false;
    }

    if (titulua.length > 30) {
        alert("'Titulua' eremuak gehienez 30 karaktere izan behar ditu");
        return false;
    }

    if (autorea.length > 20) {
        alert("'Autorea' eremuak gehienez 20 karaktere izan behar ditu");
        return false;
    }

    if (generoa.length > 20) {
        alert("'Generoa' eremuak gehienez 20 karaktere izan behar ditu");
        return false;
    }

    if (isNaN(prezioa) || prezioa <= 0) {
        alert("'Prezioa' eremua 0 baino handiagoa izan behar da");
        return false;
    }

    if (isbn.length > 17) {
        alert("'ISBN' eremuak 17 karaktere izan behar ditu gehienez");
        return false;
    }
    // Balidazio guztiak pasatzen badira, formularioa bidali egingo da
    return true;
}

function liburuaEzabatu(isbn){
    if(confirm("Ziur zaude liburua ezabatu nahi duzula")){
    	var xhr = new XMLHttpRequest();
    
    	// URL del servidor PHP que maneja la eliminación
    	var url = `/functions_main.php?isbn=${isbn}`;

    	xhr.open('DELETE', url, true);

    	xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
            	if (xhr.status === 200) {
            	    // Éxito, el libro se eliminó correctamente
            	    console.log(`El libro con ISBN ${isbn} se ha eliminado.`);
            	    window.location.reload(true);
            	} else {
            	    // Manejar errores si es necesario
            	    console.error('Error al eliminar el libro.');
            	}
            }
    	};

    	xhr.send();
    }
}
function aldatuOrrira(){
	event.preventDefault();
	window.location.href = "index.html";
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
var aldatu_botoia = document.getElementById("datuak_aldatu");
if (aldatu_botoia) {
    aldatu_botoia.addEventListener("click", aldatuOrrira);
}
