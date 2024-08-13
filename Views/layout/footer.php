</div> <!-- /container -->

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div id="datoInutil" class="mt-4">
            <!-- El dato inútil del día se cargará aquí -->
        </div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Cargar datos de gatos
        $.get('https://meowfacts.herokuapp.com/', function(data) {
            const facts = data.data.slice(0, 2); // Obtener los primeros 2 datos

            // Traducir cada dato antes de mostrarlos
            const promesasDeTraduccion = facts.map(fact => traducirTexto(fact));

            Promise.all(promesasDeTraduccion)
                .then(factsTraducidos => {
                    $('#gatoModalBody').html(factsTraducidos.join("<br>")); // Mostrar en el modal
                    $('#gatoModal').modal('show'); // Mostrar el modal
                })
                .catch(error => {
                    console.error(error);
                    $('#gatoModalBody').html('Error al traducir los datos.');
                    $('#gatoModal').modal('show'); // Mostrar modal con error
                });
        });

        // Cargar dato inútil del día
        $.get('https://uselessfacts.jsph.pl/random.json?language=en', function(data) {
            $('#datoInutil').html('<h3>Dato inútil del día:</h3><p>' + data.text + '</p>');
        });

        // Manejar el envío del formulario para combinaciones
        $('#combinacionesForm').on('submit', function(event) {
            event.preventDefault(); // Prevenir el envío normal del formulario
            const valor = $('#valor').val();

            $.get('index.php?action=combinations&value=' + valor, function(data) {
                if (!Array.isArray(data)) {
                    $('#resultadoCombinaciones').html('<p class="text-danger">Error: Se esperaba un array.</p>');
                    $('#combinacionesModal').modal('show'); // Mostrar modal de error
                    return; // Salir si no es un array
                }

                if (data.length === 0) {
                    $('#resultadoCombinaciones').html('<p>No hay combinaciones disponibles con el valor ingresado.</p>');
                } else {
                    let html = '<h3>Combinaciones:</h3><ul>';
                    data.forEach(function(combinacion) {
                        html += '<li>' + combinacion.join(", ") + ' - Total: $' + combinacion[2] + '</li>';
                    });
                    html += '</ul>';
                    $('#resultadoCombinaciones').html(html);
                }

                $('#combinacionesModal').modal('show'); // Mostrar el modal con combinaciones
            }).fail(function() {
                $('#resultadoCombinaciones').html('<p class="text-danger">Error al obtener combinaciones.</p>');
                $('#combinacionesModal').modal('show'); // Mostrar modal de error
            });
        });

        // Recargar la página al cerrar el modal de combinaciones
        $('#combinacionesModal').on('hidden.bs.modal', function() {
            location.reload(); // Recargar la página
        });
    });

    // Función para traducir texto
    function traducirTexto(texto) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: 'https://api.mymemory.translated.net/get',
                method: 'GET',
                data: {
                    q: texto,
                    langpair: 'en|es'
                },
                success: function(data) {
                    if (data.responseData.translatedText) {
                        resolve(data.responseData.translatedText); // Resolver con el texto traducido
                    } else {
                        reject('No se pudo traducir el texto.');
                    }
                },
                error: function(error) {
                    reject('Error en la traducción: ' + error); // Manejar errores de traducción
                }
            });
        });
    }
</script>

<!-- Modal para gatos -->
<div class="modal fade" id="gatoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sabías que...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="gatoModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para combinaciones -->
<div class="modal fade" id="combinacionesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Combinaciones de Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="resultadoCombinaciones"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
