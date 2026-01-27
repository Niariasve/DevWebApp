const BUSQUEDA = {
  categoria_id: '',
  dia: '',
}

document.addEventListener('DOMContentLoaded', () => {
  eventListeners();
});

function eventListeners() {
  busquedaEventListeners();
}

function busquedaEventListeners() {
  const dias = document.querySelectorAll('[name="dia"]');
  const categoria = document.getElementById('categoria');

  categoria.addEventListener('change', terminoBusqueda);
  dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));
}

function terminoBusqueda(event) {
  BUSQUEDA[event.target.name] = event.target.value; 
  buscarEventos();
}

async function buscarEventos() {
  
}