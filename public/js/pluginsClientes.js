/*
 * Este método jquery valida el tipo de 'Responsabilidad ante Iva' del cliente
 * Si se selecciona "Responsable Inscripto" debe anular el campo de ingreso de DNI
 * Si se selecciona alguna otra anula campo CUIT y habilita solo DNI
 */

$('select#responiva_id').on('change',function(){
    var valor = $( "#responiva_id option:selected").text();
    //var valor = $(this).val();
    //if($('#responiva_id').text()=='Responsable Inscripto')        //como hago para no tener que poner el id que corresponde a "Responsable Inscripto"?
    if(valor=='Responsable Inscripto' || valor=='Monotributista' || valor=='Excento')
    {
        document.getElementById("dni").disabled=true;
        document.getElementById("cuit").disabled=false;
    }
    else {
        document.getElementById("cuit").disabled=true;
        document.getElementById("dni").disabled=false;
    }
    //alert(valor);
});

$(document).ready(function () {
    $("#d2").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
                // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
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
