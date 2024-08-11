// PARA ABRIR Y CERRAR EL SIDEBAR

// const btnAbrir = document.getElementById("btnAbrir");
// const btnCerrar = document.getElementById("btnCerrar"); 
// const contenedor = document.getElementById("contenedor"); 
// const sideBar = document.getElementById("sideBar");

// btnAbrir.addEventListener("click",() =>{
    

//     if (btnCerrar.style.display = "none") {

//         btnAbrir.style.display = "none";
//         btnCerrar.style.display = "block";
//         sideBar.classList.remove("sideBarCerrado");
//         contenedor.classList.add("margenCaja3");
//     }
// });

// btnCerrar.addEventListener("click",() =>{

//     if (btnCerrar.style.display = "block") {

//         btnAbrir.style.display = "block";
//         btnCerrar.style.display = "none";
//         sideBar.classList.add("sideBarCerrado");
//         contenedor.classList.remove("margenCaja3");
//     }
// });

// LISTA DESPLEGABLE PARA CADA SECCION DE LAS INTERFACEZ

const iconAbrir = document.querySelectorAll(".abrirLista");
const iconCerrar = document.querySelectorAll(".cerrarLista");
const lista = document.querySelectorAll(".opciones");
const cajaPadre = document.querySelectorAll(".cajaPadre");

// AGREGAR UN EVENTO A CADA UNO DE LOS ICONOS DE ABRIR QUE PUEDEN EXISTIR
iconAbrir.forEach((icon, index) => {
    icon.addEventListener("click", () => {
        lista[index].classList.remove("d-none");
        icon.classList.add("d-none");
        iconCerrar[index].classList.remove("d-none");
        cajaPadre[index].classList.remove("bg-black");
        cajaPadre[index].classList.add("bg-dark");
    });
});

// AGREGAR UN EVENTO A CADA UNO DE LOS ICONOS DE CERRAR QUE PUEDEN EXISTIR

iconCerrar.forEach((icon, index) => {
    icon.addEventListener("click", () => {
        lista[index].classList.add("d-none");
        iconAbrir[index].classList.remove("d-none");
        icon.classList.add("d-none");
        cajaPadre[index].classList.remove("bg-dark");
        cajaPadre[index].classList.add("bg-black");
    });
});
