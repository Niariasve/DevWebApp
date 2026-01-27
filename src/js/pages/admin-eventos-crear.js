const BUSQUEDA = {
  categoria_id: '',
  dia: '',
}

document.addEventListener('DOMContentLoaded', () => {
  inicializarFecha();
  eventListeners();
});

function inicializarFecha() {
  BUSQUEDA['categoria_id'] = document.querySelector('[name="categoria_id"]').value;
  BUSQUEDA['dia'] = document.querySelector('[name="dia_id"]').value;
}

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
  
  resetearFechas();
  
  if (Object.values(BUSQUEDA).includes('')) return;

  buscarEventos();
}

function resetearFechas() {
  document.querySelector('[name="hora_id"]').value = '';
  const horaPrevia = document.querySelector('.horas__hora--seleccionada');
  if (horaPrevia) horaPrevia.classList.remove('horas__hora--seleccionada');

  document.querySelector('[name="dia_id"]').value = '';
}

async function buscarEventos() {
  const { dia, categoria_id } = BUSQUEDA;

  const pathQuery = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`; 

  const resultado = await fetch(pathQuery);
  const eventos = await resultado.json();

  obtenerHorasDisponibles(eventos);
}

function obtenerHorasDisponibles(eventos) {
  const listadoHoras = Array.from(document.querySelectorAll('#horas li'));
  listadoHoras.forEach(li => li.classList.add('horas__hora--deshabilitada'));

  const horasTomadas = eventos.map(evento => evento.hora_id);
  const resultado = listadoHoras.filter(li => !horasTomadas.includes(li.dataset.horaId));

  resultado.forEach(li => li.classList.remove('horas__hora--deshabilitada'));

  const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');
  horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarFecha));
}

function seleccionarFecha(evento) {
  const horaPrevia = document.querySelector('.horas__hora--seleccionada');
  if (horaPrevia) horaPrevia.classList.remove('horas__hora--seleccionada');

  const inputHiddenHora = document.querySelector('[name="hora_id"]');
  evento.target.classList.add('horas__hora--seleccionada');
  inputHiddenHora.value = evento.target.dataset.horaId;

  const inputHiddenDia = document.querySelector('[name="dia_id"]');
  inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
}