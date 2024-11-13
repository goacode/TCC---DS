function openMenu() {
    document.getElementById("sideMenu").classList.add("active");
    document.getElementById("overlay").classList.add("active");
}

function closeMenu() {
    document.getElementById("sideMenu").classList.remove("active");
    document.getElementById("overlay").classList.remove("active");
};;


document.addEventListener("DOMContentLoaded", function() {
    const formulario = document.querySelector('.formularioo');
    formulario.classList.add('show');
});