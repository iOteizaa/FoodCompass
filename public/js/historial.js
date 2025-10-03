document.addEventListener('DOMContentLoaded', function () {
    // Modal y lógica de valoración
    function crearModalValoracion(restaurante, restauranteId) {
        if (document.getElementById('modal-valoracion')) return;
        const modal = document.createElement('div');
        modal.id = 'modal-valoracion';
        modal.innerHTML = `
<div class="modal-box">
    <h3>Valorar restaurante: <span style="color:#2a7">${restaurante}</span></h3>
    <form id="form-valoracion" autocomplete="off">
        <label>Reseña:
            <textarea name="resena" maxlength="500" required placeholder="Escribe tu opinión..."></textarea>
        </label>
        <label>Valoración (0-10):
            <input type="number" name="valoracion" min="0" max="10" step="0.1" required>
        </label>
        <div class="modal-actions">
            <button type="button" id="cerrar-modal-valoracion">Cancelar</button>
            <button type="submit">Enviar</button>
        </div>
    </form>
</div>
`;
        document.body.appendChild(modal);
        document.getElementById('cerrar-modal-valoracion').onclick = () => modal.remove();
        modal.onclick = (e) => {
            if (e.target === modal) modal.remove();
        };
        document.getElementById('form-valoracion').onsubmit = function (ev) {
            ev.preventDefault();
            const formData = new FormData(ev.target);
            const resena = formData.get('resena');
            const valoracion = formData.get('valoracion');
            fetch('valorar_restaurante.php', {
                method: 'POST',
                body: JSON.stringify({
                    id_restaurante: restauranteId,
                    resena: resena,
                    valoracion: valoracion
                }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(resp => resp.json())
                .then(data => {
                    modal.remove();
                    if (data.success) {
                        // Actualiza la tarjeta en el DOM
                        const btn = document.querySelector('.btn-valorar[data-restaurante-id="' + restauranteId + '"]');
                        if (btn) {
                            // Desactivar el botón
                            btn.disabled = true;
                            btn.textContent = 'Valorado';
                            btn.classList.add('btn-valorado');
                        }
                        // Actualizar la valoración
                        const card = btn.closest('.visita-card');
                        if (card) {
                            // Actualizar el bloque valoración
                            const valoracionDiv = card.querySelector('.valoracion');
                            if (valoracionDiv) {
                                let val = parseFloat(valoracion);
                                let colorClass = '';
                                if (val < 5) colorClass = 'bad';
                                else if (val <= 7) colorClass = 'medium';
                                else colorClass = 'good';
                                valoracionDiv.textContent = val + '/10';
                                valoracionDiv.className = 'valoracion ' + colorClass;
                            }
                            // Actualizar/insertar la reseña
                            let comentario = card.querySelector('.comentario');
                            if (comentario) {
                                comentario.textContent = resena;
                            } else {
                                // Insertar debajo de username
                                const usuarioInfo = card.querySelector('.usuario-info');
                                if (usuarioInfo) {
                                    const div = document.createElement('div');
                                    div.className = 'comentario';
                                    div.textContent = resena;
                                    usuarioInfo.insertAdjacentElement('afterend', div);
                                }
                            }
                        }
                        mostrarValoracionSuccess();
                    } else {
                        alert(data.message || 'Error al guardar la valoración');
                    }
                })
                .catch(() => {
                    modal.remove();
                    alert('Error de red al guardar la valoración');
                });
        };
    }

    function mostrarValoracionSuccess() {
        const notif = document.createElement('div');
        notif.className = 'valoracion-success';
        notif.textContent = '¡Has valorado el restaurante!';
        document.body.appendChild(notif);
        setTimeout(() => notif.remove(), 2500);
    }
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-valorar').forEach(btn => {
            btn.onclick = function () {
                crearModalValoracion(
                    btn.getAttribute('data-restaurante'),
                    btn.getAttribute('data-restaurante-id')
                );
            }
        });
    });
});