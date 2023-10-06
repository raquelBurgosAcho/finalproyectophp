// Obtén una referencia al ícono de menú y al menú
const menuIcon = document.getElementById("menu-icon");
const menu1 = document.getElementById("menu1");

// Establece una variable para rastrear el estado del menú
let menuVisible = false;

// Agrega un evento clic al ícono de menú
menuIcon.addEventListener("click", () => {
  // Si el menú está visible, ocúltalo; de lo contrario, muéstralo
  if (menuVisible) {
    menu1.style.display = "none";
    menuVisible = false;
  } else {
    menu1.style.display = "block";
    menuVisible = true;
  }
});
