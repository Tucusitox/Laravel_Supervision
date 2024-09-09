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
        cajaPadre[index].classList.add("bg-black");
    });
});

// AGREGAR UN EVENTO A CADA UNO DE LOS ICONOS DE CERRAR QUE PUEDEN EXISTIR

iconCerrar.forEach((icon, index) => {
    icon.addEventListener("click", () => {
        lista[index].classList.add("d-none");
        iconAbrir[index].classList.remove("d-none");
        icon.classList.add("d-none");
        cajaPadre[index].classList.remove("bg-black");
        cajaPadre[index].classList.add("bg-black");
    });
});