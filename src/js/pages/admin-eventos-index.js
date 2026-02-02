const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  customClass: {
    title: 'swal-text'
  },
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});

document.addEventListener('DOMContentLoaded', () => {
  eventListeners();
  mostrarMensaje();
});

function eventListeners() {
  eliminarEvento();
}

function eliminarEvento() {
  const formsEliminar = document.querySelectorAll('.table__formulario');

  formsEliminar.forEach((form) => {
    form.dataset.confirmed = "0";

    form.addEventListener('submit', (e) => {
      e.preventDefault();

      Swal.fire({
        title: "¿Estas seguro que quieres eliminar este ponente?",
        icon: "warning",
        heightAuto: false,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar",
        customClass: { popup: 'swal-text' }
      }).then((result) => {
        if (result.isConfirmed) {
          const btn = form.querySelector('button[type="submit"]');
          if (btn) btn.disabled = true;
          form.submit(); // envía directo al servidor
        }
      });
    });
  });
}

function mostrarMensaje() {
  const params = new URLSearchParams(window.location.search);
  const mensaje = params.get('mensaje'); // string o null

  if (!mensaje) return;

  if (mensaje == 'success') {
    Toast.fire({
      icon: `${mensaje}`,
      title: 'Evento eliminado correctamente',
    });
  } else if (mensaje == 'error') {
    Toast.fire({
      icon: `${mensaje}`,
      title: 'Error al eliminar evento',
    });
  }
}
