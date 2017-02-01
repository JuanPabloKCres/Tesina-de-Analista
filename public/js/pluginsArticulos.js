/*Este metodo solo valida que si el tipo elegido dentro del form de nuevo articulo no es 'Ropa' que deshabilite el campo "Talle"
 *Si el campo escigdo de tipo de articulo es "Libteria" se habilitan los campos 'ancho' y 'alto' (para tarjetas, carpetas, calendarios, etc)
 */

$(document).ready(function () {
    $('#tblListaProductos').DataTable({
        responsive: true,
        "language": {
            "url": "/js/spanish.json"
        },
        "lengthMenu": [[-1], ["Todos"]]
    });
});
/*Las variables que se usan en las funciones de este script*/
var numFila = 0;
var cantFilas = 0;
var montoPedido = 0;
var montoTotal = 0;
var costosTotales = 0;

//$('#unidad_text').prop( "disabled", true );
//alert('Estamos en pluginsArticulos');

$('select#tipo_id').on('change',function() {
    var tipo = $("#tipo_id option:selected").text();
    if (tipo == 'Libreria') {
        document.getElementById("ancho").disabled = false;
        document.getElementById("alto").disabled = false;
        document.getElementById("talle_id").disabled = true;
        document.getElementById("color_id").disabled = false;
    }
    else if(tipo=='Indumentaria'){
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
    else if(tipo=='Indumentaria'){
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
        document.getElementById("material_id").setAttribute('Otro','0');
        var element = document.getElementById("material_id");
        element.value = '5';
    }
});


/***************** 27/11/16 *******************/
/** al elegir un insumo, se ejecuta una funcion que busca el costo de el insumo seleccionado */
$('#insumo_select').on('change',function(){
    var insumo_id = $('#insumo_select option:selected').val();
    mostrarCostoInsumo(insumo_id);
    mostrarUnidadMedidaInsumo(insumo_id);
});
// Las funciones:
function mostrarCostoInsumo(insumo_id){
    $.ajax({
        url: "/admin/insumos",
        data: {
            id: insumo_id,
            confeccionArticulos:true,
            encontrarCosto:true,         //esta bandera se agrega para que entre al if correspondiente en InsumosControler
        },
        dataType: 'json',
        success: function (data) {
            var respuesta = JSON.parse(data);
            //alert('se deberia encontrar el costo...');
            $('#costo_number').val(respuesta.costo);
        }
    });
}
function mostrarUnidadMedidaInsumo(insumo_id){
    $.ajax({
        url: "/admin/insumos",
        data: {
            id: insumo_id,
            confeccionArticulos:true,
            encontrarUnidad:true,       //esta bandera se agrega para que entre al if correspondiente en InsumosControler
        },
        dataType: 'json',
        success: function (data) {
            var respuesta = JSON.parse(data);
            //alert(respuesta.unidad);
            $('#unidad_text').val(respuesta.unidad);
        }
    });
}

/** limpiar campos **/
function limpiar()
{
    $('#insumo_select').val("");
    $('#cantidad_number').val("");
    $('#unidad_text').val("");
    $('#costo_number').val("");
    $('#d4').val("");
}

/** completarCosto: Este método se encarga de completar el valor para un campo a partir de otros dos
 * campos. Generalmente el campo "Cantidad" está completo cada vez que se llama a este método y el otro campo
 * que se usa es el pasado como parámetro. Si es "Precio unitario" se calcula el importe y viceversa.
 * Si el campo "Cantidad" se encuentra vacío este se toma para el cálculo como valor 0 (cero).
 */
function completarCosto(n)
{
    cantidad = $('#cantidad_number').val();
    var total;

    if (n == "costo_number") {
        if ($('#d4').val() === "")
        {
            $('#costo_number').val("");
        } else {
            precio = $('#d4').val();
            importe = precio / cantidad;
            total = parseFloat(precio);         //HACER ALGO PARA REDONDEAR!!!!!
            $('#costo_number').val(importe);
            $('#total').val(total);
        }
    } else {
        if ($('#costo_number').val() === "") {
            $('#d4').val("");
        } else {
            importe = $('#costo_number').val();
            $('#d4').val((importe * cantidad));
            precio = $('#d4').val();
            total = parseFloat(precio);
            $('#total').val(total);
        }
    }
}

/** Completa el campo ganancia obtenida de articulo */
function completarGanancia()
{
    var costo = $('#costoArticulo_text').val();
    var margen = $('#gananciaPorcent_number').val();
    var ganancia_dinero = costo * (margen/100);
    $('#gananciaDinero_text').val(ganancia_dinero);
    var iva = $('#iva_select').val();
    var precioVtasinIva = parseFloat(costo) + parseFloat(ganancia_dinero);
    var montoIva =  (precioVtasinIva * (iva/100));
    //alert('el monto que representa el IVA: $'+montoIva);
    $('#montoIva_number').val(montoIva);
    var precio_venta = precioVtasinIva + montoIva;
    $('#precioVta_text').val(precio_venta);
}
/** Al seleccionar IVA, actualizar montoIva*/
$('#iva_select').on('change',function(){
    completarGanancia();
});

/**  captura el evento de cuando se suelta la tecla despues de presionarla sobre el campo "Precio unitario"
 * y lanza el método que se encarga de calcular el contenido para el campo "Importe". */
$("#costo_number").keypress(function () {
}).keyup(function () {
    completarCosto("d4");
});

/** Este método jquery captura el evento de cuando se suelta la tecla despues de presionarla sobre
 * el campo "Importe" y lanza el método que se encarga de calcular el contenido para el campo "Costo unitario" */
$("#d4").keypress(function () {
}).keyup(function () {
    completarCosto("costo_number");
});

/** Este método jquery captura el evento de cuando se suelta la tecla despues de presionarla sobre
 * el campo "Artículo" y verifica si alguno de los campos "Importe" o "Precio unitario" tienen algún
 * contenido y a partir de ello lanza el método que se encarga de calcular el contenido para el campo sobrante.
 * Este método verifica primero si el campo "Precio unitario" no está vacio. Otro cosa a saber de este método es que
 * si ambos campos a verificar se encuentran vacios no hace nada.
 */
$("#cantidad_number").keypress(function () {
}).keyup(function () {
    if ($('#costo_number').val() !== "")
    {
        completarCosto("d4");
    } else {
        completarCosto("costo_number");
    }
});

/** Actualiza la ganancia en $ cuando se cambia el % de ganancia esperada del articulo*/
$("#gananciaPorcent_number").keypress(function () {
}).keyup(function () {
    if ($('#costoArticulo_text').val() !== "")
    {
        completarGanancia();
    } else {
        $('#costoArticulo_text').select();
    }
});
/** Captura el evento de submit del formulario "Insumos" * y lanza el método que se encarga de crear un renglón en la tabla. */
$("#form-agregar").submit(function (e) {
    e.preventDefault();
    //alert('se presiono agregar!');
    comprobar($('#insumo_select').val(), $('#cantidad_number').val(), $('#unidad_text').val(), $('#costo_number').val(), $('#d4').val());
});
/**captura el evento de 'submit' del peuqeño formulario (invisible) que posee los campos seña y cliente y lanza el método que solicita confirmación de los datos ingresados */
$("#form-pedido").submit(function (e) {
    e.preventDefault();
    confirmar();
});

/**  comprobar: Este método devuelve true si detecta que algún valor (insumo_id, cantidad, importe, precio_unitario)
 * se encuentra sin completar. Este método comienza con verificaciones, prosigue solicitando
 * a la controladora a través de la id del artículo el nombre del mismo y si es suficiente el stock
 * para luego pasar el nombre al método que se encarga de agregar el contenido en la tabla.
 */
function comprobar(insumo_select, cantidad_number, unidad_text, costo_number, d4)  //d4 es la casilla de costo neto
{
    if ((insumo_select !== '') && (cantidad_number !== '') && (unidad_text !== '') && (costo_number !== '') && (d4 !== '')) {
        //var canti = obtenerCantidades(d1, d2);
        $.ajax({
            url: "/admin/insumos",
            data: {
                id: insumo_select,
                confeccionArticulos:true,   //esta bandera se agrega para que entre al if correspondiente en InsumosControler
            },
            //type: 'GET',
            dataType: 'json',
            success: function (data) {
                var d = JSON.parse(data);
                agregarContenido(insumo_select, d.nombre, cantidad_number, unidad_text, costo_number, d4);
            }
        });
        //agregarContenido(insumo_select, d.nombreArticulo, proveedor_select, cantidad_number, d4);
    } else {
        $("#cantidad_number").select();
    }
}


/** agregarContenido: Este método recibe parámetros para crear renglones y crea
 * una nueva linea en la tabla de insumos. También agrega otros valores útiles para otros métodos
 * como el número de fila que se inserta y un link que dispara el método para borrar esa fila.
 * También incrementa el valor del monto del pedido a partir del importe del renglón.
 * La tabla funciona como un array y el 1º registro ocupa la posición 0 (cero).
 * parseFloat: método de javascript para convertir a decimal la variable y usarla para el pertinente cálculo.
 */
function agregarContenido(insumo_select, nombreInsumo, cantidad_number, unidad_text, costo_number, d4)
{
    var tPro = $('#tblListaInsumos').DataTable();
    cantFilas++;
    numFila++;
    valorItemTotal = parseFloat(d4); //valor neto (valor*cantidad)
    montoPedido = montoPedido + valorItemTotal;
    montoTotal = montoTotal + valorItemTotal;
    tPro.row.add([
        numFila,            //ok
        insumo_select,      //ok
        nombreInsumo,       //ok
        cantidad_number,    //ok
        unidad_text,        //ok
        costo_number,       //ok
        d4,                 //ok
        //valorItemTotal,
        ' <a href="javascript:borrarFila(' + numFila + ');" data-toggle="modal"><i class="fa fa-lg fa-trash-o"></i> Borrar</a>   '
    ]).draw();
    $('#mp').html(montoPedido);
    $('#mt').html(montoTotal);
    limpiar();
    $('#cantidad_select').select();

    //actualizar el costo de produccion del articulo
    costosTotales = parseFloat(costosTotales) + parseFloat(d4);
    //parseInt(costosTotales, 10);
    //costosTotales = costosTotales.replace(/^0+/, '');
    $('#costoArticulo_text').val(costosTotales);

}

/** confirmar: Este método verifica que la tabla contenga al menos un renglón, de ser así
 * verifica si el valor de la seña es igual, menor o mayor al monto del pedido. Si es igual lanza un modal el
 * cual solicita la confirmación */
function confirmar()
{
    if (cantFilas > 0) {
        $('#modal-confirmarAltaArticulo').modal('show');
    } else {
        $('#msjTblvacia').removeClass("hide");
    }
}

/** enviarPedido: Este método se encarga de recorrer los renglones de la tabla y empaquetar el contenido de
 interés de cada renglón en un objeto json y añadirlo a un array que se enviará a la controladora con otros datos
 requeridos para realizar el registro de pedido/compra.

 * El parámetro que ingresa "recibido" es un boolean que solo toma valor true si se trata de la confirmación de una
 * compra a través del momodal-confirmarVenta
 */
function enviarPedido()
{
    //alert('se entra a enviarPedido()');
    var numLi = 0;
    var lineas = [];
    $('#tblListaInsumos tbody tr').each(function () {
        var dataFila = $('#tblListaInsumos').DataTable().row(this).data();
        var linea = {insumo_id: dataFila[1], cantidad: dataFila[3], costo_unitario: dataFila[5], importe: dataFila[6]};
        lineas [numLi] = linea;
        console.log(lineas);
        numLi++;
    });
    /////////// metemos en un array la info del articulo para persistirlo en ArticulosController
    var nombre= $('#nombreArticulo_text').val();     var alto= $('#alto').val();     var ancho= $('#ancho').val();
    var tipo_id= $('#tipo_id').val();       var talle_id= $('#talle_id').val();     var color_id= $('#color_id').val();
    var costoArticulo= $('#costoArticulo_text').val();      var margen= $('#gananciaPorcent_number').val();
    var gananciaArticulo= $('#gananciaDinero_text').val();      var precioVta= $('#precioVta_text').val();
    var iva= $('#iva_select').val();    var montoIva= $('#montoIva_number').val();

    $.ajax({
        dataType: 'JSON',
        url: "/admin/articulos/create",
        data: {
            renglones: lineas,
            nombre: nombre,
            alto: alto,
            ancho: ancho,
            tipo_id: tipo_id,
            talle_id: talle_id,
            color_id: color_id,
            costoArticulo: costoArticulo,
            margen: margen,
            gananciaArticulo: gananciaArticulo,
            iva: iva,
            montoIva: montoIva,
            precioVta: precioVta
            //articuloAjax: articulo
            //usuarioAltaArticulo: $('#usuarioAltaArticulo').val(),
            //montoPedido: montoPedido
        },
        success: function (data) {
            console.log(data);
            /* Una vez completado el proceso se muestra el mensaje de exito*/
            $('#mensajeExito').html(data);
            $('#botonExito').click();
        }
    });
}

/* Este método es el que toma el valor total de un pedido o si por el contrario solo se quiere señar el mismo. */
$("#botonModalidad").click(function () {

});


