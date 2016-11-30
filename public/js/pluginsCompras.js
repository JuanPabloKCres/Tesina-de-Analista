/*
 * $(document).ready...: Acá se instancia la tabla en la página.
 * Difiere del método común en que el "lengthMenu" está configurado para que no pagine la
 * tabla ya que de hacerlo, al momento de registrar el pedido/venta, dataTable solo tomará los renglones
 * que sean visibles al momento de registrar, excluyendo a los que estén paginados en otras páginas.
 * Ej: tengo 11 renglones y la tabla muestra solo 10 renglones y crea otra página para mostrar el 11º renglón,
 * si al registrar estoy en la pág 1, el 11º registro será ignorado.
 */


$(document).ready(function () {
    $('#tblListaInsumos').DataTable({
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
var pagarTotal = true;

/** Captura el evento de submit del formulario "Insumos" * y lanza el método que se encarga de crear un renglón en la tabla. */
$("#form-agregar").submit(function (e) {
    e.preventDefault();
    comprobar($('#insumo_select').val(), $('#cantidad_number').val(), $('#proveedor_select').val(), $('#costo_number').val(), $('#d4').val());
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

function comprobar(insumo_select, cantidad_number, proveedor_select, costo_number, d4)  //d4 es la casilla de costo neto
{
    if ((insumo_select !== '') && (cantidad_number !== '') && (proveedor_select !== '') && (costo_number !== '') && (d4 !== '')) {
        //var canti = obtenerCantidades(d1, d2);
        $.ajax({
            url: "/admin/insumos",
            data: {
                id: insumo_select,
                //cantidadSolicitada: canti
            },
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var d = JSON.parse(data);
                agregarContenido(insumo_select, proveedor_select, d.nombreInsumo, cantidad_number, costo_number, d4);
            }
        });
        //agregarContenido(insumo_select, d.nombreArticulo, proveedor_select, cantidad_number, d4);
    } else {
        $("#cantidad_number").select();
    }
}

/** agregarContenido: Este método recibe parámetros para crear renglones () y crea
 * una nueva linea en la tabla de insumos. También agrega otros valores útiles para otros métodos
 * como el número de fila que se inserta y un link que dispara el método para borrar esa fila.
 * También incrementa el valor del monto del pedido a partir del importe del renglón.
 * La tabla funciona como un array y el 1º registro ocupa la posición 0 (cero).
 * parseFloat: método de javascript para convertir a decimal la variable y usarla para el pertinente cálculo.
 */
function agregarContenido(insumo_select, proveedor_select, nombreInsumo, cantidad_number, costo_number, d4)
{
    var tPro = $('#tblListaInsumos').DataTable();
    cantFilas++;
    numFila++;
    nombreProveedor = $('#proveedor_select option:selected').text();
    valorItemTotal = parseFloat(d4); //valor neto (valor*cantidad)
    montoPedido = montoPedido + valorItemTotal;
    montoTotal = montoTotal + valorItemTotal;
    tPro.row.add([
        numFila,            //ok
        insumo_select,      //ok
        nombreInsumo,       //ok
        cantidad_number,    //ok
        nombreProveedor,    //ok
        costo_number,       //ok
        d4,                 //ok
        //valorItemTotal,
        ' <a href="javascript:borrarFila(' + numFila + ');" data-toggle="modal"><i class="fa fa-lg fa-trash-o"></i> Borrar</a>   '
    ]).draw();
    $('#mp').html(montoPedido);
    $('#mt').html(montoTotal);
    limpiar();
    $('#cantidad_select').select();
}



/* Este método es el que toma el valor total de un pedido o si por el contrario solo se quiere señar el mismo. */
$("#botonModalidad").click(function () {
        pagarTotal = true;
});



/** enviarPedido: Este método se encarga de recorrer los renglones de la tabla y empaquetar el contenido de
 interés de cada renglón en un objeto json y añadirlo a un array que se enviará a la controladora con otros datos
  requeridos para realizar el registro de pedido/compra.

 * El parámetro que ingresa "recibido" es un boolean que solo toma valor true si se trata de la confirmación de una
 * compra a través del momodal-confirmarVenta
 */
function enviarPedido(pagado, entregado, confirmado)
{
    //estas true tengo que sacar despues, estan solo parapruebas
    pagado = true;
    confirmado = true;
    recibido = true;
    //

    var numLi = 0;
    var lineas = [];
    /*
    var factura = {
        nro_doc: "",
        nombre_cliente: "",
        domicilio_cliente: "",
        imp_neto: "",
        tipo_cbre: "",
        items: []
    };
    */

    $('#tblListaInsumos tbody tr').each(function () {
        var dataFila = $('#tblListaInsumos').DataTable().row(this).data();
        var proveedor_id = $('#proveedor_select').val();
        var linea = {insumo_id: dataFila[1], cantidad: dataFila[3] /*, proveedor_select: dataFila[4]*/, proveedor_id, costo_unitario: dataFila[5], importe: dataFila[6]};

        lineas [numLi] = linea;
        console.log(lineas);
        //factura.items [numLi] = linea;
        numLi++;
    });

    alert(lineas[0].proveedor_id);

    //persistir venta o pedido
    $.ajax({
        dataType: 'JSON',
        url: "/admin/compras/create",
        data: {
            renglones: lineas,
            confirmado: confirmado,
            pagado: pagado,
            entregado: entregado,
            recibido: recibido,
            usuarioPedido: $('#usuarioPedido').val(),
            montoPedido: montoPedido
        },
        success: function (data) {
            alert('Los datos de la compra fueron exitosamente enviados a ComprasController@create');
            /* Una vez completado el proceso se muestra el mensaje de exito*/
            $('#mensajeExito').html(data);
            $('#botonExito').click();
        }
    });
}

/** Function borrarFila: Este método remueve un reglón de la tabla, adicionalmente actualiza los valores "cantFilas"
 * y montoPedido. Como parámetro recibe el número de la fila a ser borrada. El método recorre todos los renglones de la tabla
 * buscando el número de fila ingresado como parámetro.
 * Puede parecer contradictorio que ingrese el número de fila a borrar y busque esa fila recorriendo pero esto resuelve
 * un problema que se prensenta cuando ya hay varios renglones y empezamos a borrar renglones, y existen dos o mas renglones que poseen
 * prácticamente los mismos datos. O sea que en definitiva el número de fila (numFila) funciona a modo de id de renglón en la vista únicamente.
 */
function borrarFila(d)
{
    var numFilaBorrar = 0;
    var Filas = 0;
    $('#tblListaInsumos tbody tr').each(function () {
        var dataPla = $('#tblListaInsumos').DataTable().row(this).data();
        if (dataPla[0] === d) {
            numFilaBorrar = Filas;
            montoPedido = montoPedido - parseFloat(dataPla[5]);
            montoTotal = montoTotal - parseFloat(dataPla[6]);
        }
        Filas++;
    });
    $('#tblListaInsumos').dataTable().fnDeleteRow(numFilaBorrar);
    $('#mp').html(montoPedido);
    $('#mt').html(montoTotal);
    cantFilas--;
}

/******* La funcion valida que en el campo "Cantidad" de un Aticulo se ingresen SOLO NUMEROS ******/
$(document).ready(function () {
    $("#cantidad_number").keydown(function (e) {
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

/** limpiar campos **/
function limpiar()
{
    $('#cantidad_number').val("");
    $('#costo_number').val("");
    $('#d4').val("");
    $('#total').val("");
}

/** confirmar: Este método verifica que la tabla contenga al menos un renglón, de ser así
 * verifica si el valor de la seña es igual, menor o mayor al monto del pedido. Si es igual lanza un modal el
 * cual solicita la confirmación para registrar como pedido o venta. Si es menor solicita confirmación para registrar como pedido.
 * Si es mayor informa la exepción.
 */
function confirmar()
{
    if (cantFilas > 0) {
        $('#modal-confirmarCompra').modal('show');
    } else {
        $('#msjTblvacia').removeClass("hide");
    }
}

/** completarPrecio: Este método se encarga de completar el valor para un campo a partir de otros dos
 * campos. Generalmente el campo "Cantidad" está completo cada vez que se llama a este método y el otro campo
 * que se usa es el pasado como parámetro. Si es "Precio unitario" se calcula el importe y viceversa.
 * Si el campo "Cantidad" se encuentra vacío este se toma para el cálculo como valor 0 (cero).
 */
function completarPrecio(n)
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
            total = parseFloat(precio);
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

/**  captura el evento de cuando se suelta la tecla despues de presionarla sobre el campo "Precio unitario"
 * y lanza el método que se encarga de calcular el contenido para el campo "Importe". */
$("#costo_number").keypress(function () {
}).keyup(function () {
    completarPrecio("d4");
});

/** Este método jquery captura el evento de cuando se suelta la tecla despues de presionarla sobre
 * el campo "Importe" y lanza el método que se encarga de calcular el contenido para el campo "Costo unitario" */
$("#d4").keypress(function () {
}).keyup(function () {
    completarPrecio("costo_number");
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
        completarPrecio("d4");
    } else {
        completarPrecio("costo_number");
    }
});


