const BUSQUEDA = {
  categoria_id: '',
  dia: '',
}

const horaId = document.querySelector('[name="hora_id"]').value;
const diaId = document.querySelector('[name="dia_id"]').value;
const categoriaId = document.querySelector('[name="categoria_id"]').value;

document.addEventListener('DOMContentLoaded', () => {
  inicializarFecha();
  obtenerPonentes();
  eventListeners();
});

function inicializarFecha() {
  BUSQUEDA['categoria_id'] = document.querySelector('[name="categoria_id"]').value;
  BUSQUEDA['dia'] = document.querySelector('[name="dia_id"]').value;

  if (Object.values(BUSQUEDA).includes('')) return;

  buscarEventos();
}

function eventListeners() {
  horaEventListener();
  buscarPonenteEventListener();
}

function horaEventListener() {
  const dias = document.querySelectorAll('[name="dia"]');
  const categoria = document.getElementById('categoria');

  categoria.addEventListener('change', terminoBusqueda);
  dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));
}

function terminoBusqueda(event) {
  BUSQUEDA[event.target.name] = event.target.value;

  resetearFechas();

  if (Object.values(BUSQUEDA).includes('')) return;

  const inputHiddenDia = document.querySelector('[name="dia_id"]');
  inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;

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
  listadoHoras.forEach(li => {
    li.classList.add('horas__hora--deshabilitada');
    li.removeEventListener('click', seleccionarFecha);
  });

  const horasTomadas = eventos.map(evento => evento.hora_id);
  const inputHiddenHora = document.querySelector('[name="hora_id"]');
  const inputHiddenDia = document.querySelector('[name="dia_id"]');
  const inputHiddenCategoria = document.querySelector('[name="categoria_id"]');

  if (inputHiddenDia.value === diaId && inputHiddenCategoria.value === categoriaId) {
    const horaSeleccionadaLI = document.querySelector(`[data-hora-id='${horaId}']`);
    horaSeleccionadaLI.classList.remove('horas__hora--deshabilitada');
    horaSeleccionadaLI.classList.add('horas__hora--seleccionada');
    inputHiddenHora.value = horaId;
  }

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
}

let ponentes = [];
let ponentesFiltrados = [];
const listadoPonentes = document.getElementById('listado-ponentes');

function buscarPonenteEventListener() {

  const ponentesInput = document.querySelector('#ponentes');

  ponentesInput.addEventListener('input', buscarPonentes);
}

function buscarPonentes(event) {
  const busqueda = event.target.value;

  if (busqueda.length > 2) {
    const expresion = new RegExp(busqueda, "i");

    ponentesFiltrados = ponentes.filter(ponente => {
      if (ponente.nombre.toLowerCase().search(expresion) != -1) {
        return ponente;
      }
    });

  } else {
    ponentesFiltrados = [];
  }
  mostrarPonentes();
}

function mostrarPonentes() {
  while (listadoPonentes.firstChild) {
    listadoPonentes.removeChild(listadoPonentes.firstChild);
  }


  if (ponentesFiltrados.length > 0) {
    ponentesFiltrados.forEach(ponente => {
      const ponenteHTML = document.createElement('LI');
      ponenteHTML.classList.add('listado-ponentes__ponente');
      ponenteHTML.textContent = ponente.nombre;
      ponenteHTML.dataset.ponenteId = ponente.id;
      ponenteHTML.onclick = seleccionarPonente;

      listadoPonentes.appendChild(ponenteHTML);
    });
  } else {
    const noResultados = document.createElement('P');
    noResultados.classList.add('listado-ponentes__no-resultado');
    noResultados.textContent = 'No hay resultados para tu búsqueda';

    listadoPonentes.appendChild(noResultados);
  }
}

function seleccionarPonente(click) {
  const ponente = click.target;
  const ponentePrevio = document.querySelector('.listado-ponentes__ponente--seleccionado');
  if (ponentePrevio) ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado');
  ponente.classList.add('listado-ponentes__ponente--seleccionado');
  document.querySelector('[name="ponente_id"]').value = ponente.dataset.ponenteId;
}

async function obtenerPonentes() {
  const path = '/api/ponentes';
  const respuesta = await fetch(path);
  const resultado = await respuesta.json();

  formatearPonetnes(resultado);
}

function formatearPonetnes(arrayPonentes = []) {
  ponentes = arrayPonentes.map(ponente => {
    return {
      nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
      id: ponente.id,
    }
  });
}

