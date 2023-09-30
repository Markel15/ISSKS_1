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

var current_taula = null;
const div_taulak = document.getElementsByClassName("div_taula");
for (let i = 0; i < div_taulak.length; i++) {
    div_taulak[i].addEventListener("click", gehiagoErakutsi);
  }


