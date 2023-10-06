
const closeArrow = document.querySelector("#flecha");
const modal = document.querySelector("#modal");

// Agregamos un solo "escuchador de eventos" al elemento con ID "flecha".
closeArrow.addEventListener("click", () => {
  // Cuando se hace clic en el elemento con ID "flecha", este bloque de código se ejecuta.

  // Cambiamos la visibilidad del elemento con ID "modal".
  modal.classList.toggle("hidden");

  // Verificamos y cambiamos el contenido de texto del elemento "flecha".
  closeArrow.textContent = closeArrow.textContent === "chevron_right" ? "expand_more" : "chevron_right";
});
