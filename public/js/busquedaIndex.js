//referenciamos a los elementos del DOM
const inputBuscar = document.getElementById("buscar");
const trFifo = document.getElementById("trFifo");
const celdasCedulas = document.getElementsByClassName("tdCedulas");
const celdasNombres = document.getElementsByClassName("tdNombres");

// FUNCION PARA OBVIAR ACENTOS Y ESPACIOS

const normalize = (text) => {
  return text
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .replace(/\s/g, "");
};

// BUSQUEDA
inputBuscar.addEventListener("keyup", (e) => {
  let texto = e.target.value;
  let textoSinAcentos = normalize(texto);
  let er = new RegExp(textoSinAcentos, "i");

  // RECORREO LOS ARREGLOS
  for (let i = 0; i < celdasCedulas.length && i < celdasNombres.length; i++) {
    let cedula = celdasCedulas[i];
    let nombre = celdasNombres[i];
    const casillas = celdasCedulas[i].parentNode

    // QUITANDO LOS ACENTOS DEL ARREGLO DONDE ESTA LOS NOMBRES
    let nombreSinAcentos = normalize(nombre.innerText);

    if(er.test(cedula.innerText) || er.test(nombreSinAcentos)){
      casillas.classList.remove("d-none")
      trFifo.classList.remove("d-none")
    }
    else{
      casillas.classList.add("d-none")  
    }
  }
});

