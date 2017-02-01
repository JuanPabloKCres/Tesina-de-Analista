$('#tipo_id').on('change',function() {
    var tipo = $("#tipo_id option:selected").text();
    if (tipo == 'Libreria') {
        document.getElementById("talle_id").disabled = true;
    }
    if (tipo == 'Indumentaria') {
        document.getElementById("talle_id").disabled = false;
        document.getElementById("alto").disabled = true;
        document.getElementById("ancho").disabled = true;
    }
    if (tipo == 'Merchandising') {
        document.getElementById("talle_id").disabled = true;
        document.getElementById("alto").disabled = false;
        document.getElementById("ancho").disabled = false;
    }
});

/** Validar que solo se ingresen numeros en campo 'costo' **/
$(document).ready(function () {
    $("#costo_id").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});