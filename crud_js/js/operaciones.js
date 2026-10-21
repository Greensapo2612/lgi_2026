///Carga en la tabla
const tabla = document.querySelector('#tablaEstudiantes');

async function cargarEstudiantes() {
    try {
        const respuesta = await fetch('php/lista.php');

        if (!respuesta.ok) {
            throw new Error(`Error HTTP: ${respuesta.status}`);
        }

        const estudiantes = await respuesta.json();

        console.log(estudiantes);

        tabla.innerHTML = '';

        estudiantes.forEach(estudiante => {
            const fila = document.createElement('tr');

            fila.innerHTML = `
                <td>${estudiante.ID}</td>
                <td>${estudiante.Nombre}</td>
                <td>${estudiante.Apellido}</td>
                <td>${estudiante.Email}</td>
                <td>${estudiante.Fecha_nacimiento}</td>
                <td>${estudiante.Activo}</td>
                <td>
                    <button
                        type="button"
                        class="btnEliminar"
                        data-id="${estudiante.ID}">
                        Eliminar
                    </button>
                </td>
                <td>
                    <button
                        type="button"
                        class="btnSeleccionar"
                        data-id="${estudiante.ID}">
                        Seleccionar
                    </button>
                </td>
            `;

            fila.dataset.id = estudiante.ID;
            tabla.appendChild(fila);
        });

    } catch (error) {
        console.error('Error al cargar estudiantes:', error);
    }
}

cargarEstudiantes();
///Busqueda
const formularioBusqueda = document.querySelector('#busqueda');
const campoNombre = document.querySelector('#nombreBuscar');

formularioBusqueda.addEventListener('submit', async (event) => {
    event.preventDefault();

    const letra = campoNombre.value.trim();

    try {
        console.log("esta pasando")
        const respuesta = await fetch(
            `php/buscar.php?letra=${encodeURIComponent(letra)}`
        );

        if (!respuesta.ok) {
            throw new Error('No se pudo realizar la búsqueda.');
        }

        const estudiantes = await respuesta.json();

        tabla.innerHTML = '';

        if (estudiantes.length === 0) {
            tabla.innerHTML = `
                <tr>
                    <td colspan="8">No se encontraron estudiantes.</td>
                </tr>
            `;
            return;
        }

        estudiantes.forEach(estudiante => {
            const fila = document.createElement('tr');

            fila.innerHTML = `
                <td>${estudiante.ID}</td>
                <td>${estudiante.Nombre}</td>
                <td>${estudiante.Apellido}</td>
                <td>${estudiante.Email}</td>
                <td>${estudiante.Fecha_nacimiento}</td>
                <td>${estudiante.Activo}</td>
                <td>
                    <button type="button"
                        class="btnEliminar"
                        data-id="${estudiante.ID}">
                        Eliminar
                    </button>
                </td>
                <td>
                    <button type="button"
                        class="btnSeleccionar"
                        data-id="${estudiante.ID}">
                        Seleccionar
                    </button>
                </td>
            `;

            fila.dataset.id = estudiante.ID;
            tabla.appendChild(fila);
        });

    } catch (error) {
        console.log("esta pasando")
        console.error('Error al buscar estudiantes:', error);
    }
});
///Selección
let estudianteSeleccionado = null;
tabla.addEventListener('click', (event) => {

    const boton = event.target.closest('.btnSeleccionar');
    estudianteSeleccionado = boton.dataset.id;

    if (!boton) return;

    const fila = boton.closest('tr');
    const celdas = fila.querySelectorAll('td');

    document.querySelector('#idSeleccionar').value =
        celdas[0].textContent;

    document.querySelector('#nombreAgregar').value =
        celdas[1].textContent;

    document.querySelector('#apellidoAgregar').value =
        celdas[2].textContent;

    document.querySelector('#emailAgregar').value =
        celdas[3].textContent;

    document.querySelector('#fechaAgregar').value =
        celdas[4].textContent;

    document.querySelector('#activoAgregar').value =
        celdas[5].textContent;

});
///Eliminar
tabla.addEventListener('click', async (event) => {
    const botonEliminar = event.target.closest('.btnEliminar');

    if (!botonEliminar) return;

    const id = botonEliminar.dataset.id;

    if (!confirm('¿Seguro que desea eliminar este estudiante?')) {
        return;
    }

    const respuesta = await fetch(
        `php/eliminar.php?id=${encodeURIComponent(id)}`
    );

    const resultado = await respuesta.json();

    if (resultado.ok) {
        const fila = botonEliminar.closest('tr');
        fila.remove();

        // limpiamos la selección.
        if (estudianteSeleccionado === id) {
            estudianteSeleccionado = null;
        }
    } else {
        alert(resultado.mensaje || 'No se pudo eliminar el estudiante');
    }
});
///agregar
const form = document.querySelector('#formAgregar');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const datos = {
        nombre: document.querySelector('#nombreAgregar').value.trim(),
        apellido: document.querySelector('#apellidoAgregar').value.trim(),
        email: document.querySelector('#emailAgregar').value.trim(),
        fecha_nacimiento: document.querySelector('#fechaAgregar').value,
        activo: document.querySelector('#activoAgregar').value
    };

    try {
        const response = await fetch('php/agregar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        });

        const resultado = await response.json();

        if (resultado.ok) {
            alert('Estudiante creado correctamente.');

            form.reset();

            // Actualizar la tabla sin recargar la página
            tabla.innerHTML = '';
            await cargarEstudiantes();
        } else {
            alert(resultado.mensaje || 'No se pudo crear el estudiante.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error de conexión o respuesta del servidor.');
    }
});

/// modificar
const btnActualizar = document.querySelector('#btnActualizar');

btnActualizar.addEventListener('click', async () => {

    const datos = {
        id: document.querySelector('#idSeleccionar').value.trim(),
        nombre: document.querySelector('#nombreAgregar').value.trim(),
        apellido: document.querySelector('#apellidoAgregar').value.trim(),
        email: document.querySelector('#emailAgregar').value.trim(),
        fecha_nacimiento: document.querySelector('#fechaAgregar').value,
        activo: document.querySelector('#activoAgregar').value
    };

    if (!datos.id) {
        alert('Primero seleccioná un estudiante para actualizar.');
        return;
    }

    try {
        const response = await fetch('php/actualizar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        });

        const resultado = await response.json();

        if (resultado.ok) {
            alert('Estudiante modificado correctamente.');

            form.reset();

            tabla.innerHTML = '';
            await cargarEstudiantes();
        } else {
            alert(resultado.mensaje || 'No se pudo modificar el estudiante.');
        }

    } catch (error) {
        console.error('Error al actualizar:', error);
        alert('Error de conexión o respuesta del servidor.');
    }
});
