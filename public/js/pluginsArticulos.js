/*Este metodo solo valida que si el tipo elegido dentro del form de nuevo articulo no es 'Ropa' que deshabilite el campo "Talle"
 *Si el campo escigdo de tipo de articulo es "Libteria" se habilitan los campos 'ancho' y 'alto' (para tarjetas, carpetas, calendarios, etc)
 */
$('select#tipo_id').on('change',function() {
    var tipo = $("#tipo_id option:selected").text();
    if (tipo == 'Libreria') {
        document.getElementById("ancho").disabled = false;
        document.getElementById("alto").disabled = false;
        document.getElementById("talle_id").disabled = true;
        document.getElementById("color_id").disabled = false;
    }
    else if(tipo=='Ropa e Indumentaria'){
        document.getElementById("ancho").disabled = true;
        document.getElementById("alto").disabled = true;
        document.getElementById("talle_id").disabled = false;
        document.getElementById("color_id").disabled = false;
    }
    else if(tipo=='Merchandising'){
        document.getElementById("ancho").disabled = false;
        document.getElementById("alto").disabled = false;
        document.getElementById("talle_id").disabled = true;
        document.getElementById("color_id").disabled = true;
        document.getElementById("material_id").setAttribute('Otro','5');
        var element = document.getElementById("material_id");
            element.value = '5';
    }
});


$('#color_id').on('change',function() {
    var tipo = $("#tipo_id option:selected").text();
    if (tipo == 'Libreria') {
        document.getElementById("ancho").disabled = false;
        document.getElementById("alto").disabled = false;
        document.getElementById("talle_id").disabled = true;
        document.getElementById("color_id").disabled = false;
    }
    else if(tipo=='Ropa e Indumentaria'){
        document.getElementById("ancho").disabled = true;
        document.getElementById("alto").disabled = true;
        document.getElementById("talle_id").disabled = false;
        document.getElementById("color_id").disabled = false;
    }
    else if(tipo=='Merchandising'){
        document.getElementById("ancho").disabled = false;
        document.getElementById("alto").disabled = false;
        document.getElementById("talle_id").disabled = true;
        document.getElementById("color_id").disabled = true;
        document.getElementById("material_id").setAttribute('Otro','5');
        var element = document.getElementById("material_id");
        element.value = '5';
    }
});





