$("#boton").on("click",mensaje);

function mensaje() {
  $.ajax({
    type: 'POST',
	url: 'ajax/ajax.php',
    success: function(respuesta) {
        var listaUsuarios = $("#mensaje");
        console.log("BUENA TITO");
    },
    error: function() {
      console.log("No se ha podido obtener la información");
    }
  });
}