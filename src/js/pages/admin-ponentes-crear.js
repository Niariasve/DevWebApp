let TAGS = [];

document.addEventListener('DOMContentLoaded', () => {
  cargarTags();
  eventListeners();
});

function eventListeners() {
  tagsInputEventListener();
}

function tagsInputEventListener() {
  const tagsInput = document.querySelector('#tags_input');
  tagsInput.addEventListener('keypress', guardarTag);
}

function guardarTag(event) {
  if (event.keyCode !== 44 || event.target.value.trim().length <= 1) {
    return;
  }
  event.preventDefault();
  TAGS = [...TAGS, event.target.value.trim()];
  event.target.value = '';
  
  mostrarTags();
}

function mostrarTags() {
  const listadoTags = document.querySelector('#tags');

  listadoTags.innerHTML = '';

  TAGS.forEach(tag => {
    const etiqueta = document.createElement('LI');
    etiqueta.classList.add('formulario__tag');
    etiqueta.textContent = tag;
    etiqueta.ondblclick = eliminarTag;
    listadoTags.appendChild(etiqueta);
  });

  actualizarInputHidden();
}

function actualizarInputHidden() {
  let tagsInputHidden = document.querySelector("[name='tags']");
  tagsInputHidden.value = TAGS.toString();
}

function cargarTags() {
  let tagsInputHidden = document.querySelector("[name='tags']");
  if (tagsInputHidden.value !== '') {
    TAGS = tagsInputHidden.value.split(',');
    mostrarTags();
  }
}

function eliminarTag(e) {
  e.target.remove();
  TAGS = TAGS.filter(tag => tag !== e.target.textContent);
  actualizarInputHidden();
}