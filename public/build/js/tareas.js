// IIFE (Immediately Invoked Function Expression) Es una función que se ejecuta inmediatamente al ser creada e Impide que las Variables y funciones declaradas en este paréntesis no se mexclen con otras de otro archivo.

(function() {
  // Botón para mostrar el Modal de Agregar Tarea
  const nuevaTareaBtn = document.querySelector('#agregar-tarea');
  nuevaTareaBtn.addEventListener('click', mostrarFormulario)
  
  function mostrarFormulario() {
    const modal = document.createElement('DIV');
    modal.classList.add('modal');
    modal.innerHTML = `
      <form class="formulario nueva-tarea">
        <legend>Añade una Nueva Tarea</legend>
        <div class="campo">
          <label>Tarea</label>
          <input
            type="text"
            name="tarea"
            placeholder="Añadir Tarea al Proyecto Actual"
            id="tarea"
          />
        </div>

        <div class="opciones">
          <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea" />
          <button type="button" class="cerrar-modal">Cancelar</button>
        </div>
      </form>
      `;

      setTimeout(() => {
        const formulario = document.querySelector('.formulario');
        formulario.classList.add('animar');
      }, 0);

      modal.addEventListener('click', function(e) {
        e.preventDefault();

        if(e.target.classList.contains('cerrar-modal')) {
          const formulario = document.querySelector('.formulario');
          formulario.classList.add('cerrar');

          setTimeout(() => {
            modal.remove();
          }, 500);
        }

        if(e.target.classList.contains('submit-nueva-tarea')) {
          submitFormularioNuevaTarea();
          
        }
      });

    document.querySelector('body').appendChild(modal);
  }

  function submitFormularioNuevaTarea() {
    const tarea = document.querySelector('#tarea').value.trim();

    if(tarea === '') {
      // Mostrar una Alerta de Error
      console.log('La Tarea No Tiene Nombre');
      return;
    }
      
    }
    
  }
})();
