/*
 * $(document).ready...: Acá se instancia la tabla en la página.
 * Difiere del método común en que el "lengthMenu" está configurado para que no pagine la
 * tabla ya que de hacerlo, al momento de registrar el pedido/venta, dataTable solo tomará los renglones
 * que sean visibles al momento de registrar, excluyendo a los que estén paginados en otras páginas.
 * Ej: tengo 11 renglones y la tabla muestra solo 10 renglones y crea otra página para mostrar el 11º renglón,
 * si al registrar estoy en la pág 1, el 11º registro será ignorado.
 */

//alert('Se entra a pluginsCompras.js, el User es: '+$('#usuarioCompra').val());

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
                agregarContenido(insumo_select, proveedor_select, d.nombre, cantidad_number, costo_number, d4);
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
    montoPedido = montoPedido.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
    montoPedido = parseFloat(montoPedido);
    montoTotal = montoTotal + valorItemTotal;
    montoTotal = montoTotal.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
    montoTotal = parseFloat(montoTotal);
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

    var usuario_id = $('#usuarioCompra').val();
    var numLi = 0;
    var lineas = [];
    $('#tblListaInsumos tbody tr').each(function () {
        var dataFila = $('#tblListaInsumos').DataTable().row(this).data();
        var proveedor_id = $('#proveedor_select').val();
        var linea = {insumo_id: dataFila[1], cantidad: dataFila[3]/*, proveedor_select: dataFila[4]*/, proveedor_id: proveedor_id, costo_unitario: dataFila[5], importe: dataFila[6].toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]};
        lineas [numLi] = linea;
        console.log(lineas);
        //factura.items [numLi] = linea;
        numLi++;
    });

    var proveedor_id = $('#proveedor_select').val();
    var costo_envio = $('#costo_envio').val();
    /*persistir compra o pedido*/
    $.ajax({
        dataType: 'JSON',
        url: "/admin/compras/create",
        data: {
            proveedor_id: proveedor_id,
            renglones: lineas,
            confirmado: confirmado,
            pagado: pagado,
            entregado: entregado,
            recibido: recibido,
            usuarioPedido: usuario_id,
            costo_envio: costo_envio,
            montoPedido: montoPedido

        },
        success: function (data) {
            $('#mensajeExito').html(data);      /* Una vez completado el proceso se muestra el mensaje de exito*/
            $('#botonExito').click();
            /* 1# Proveedor 2# DetalledeInsumos 3--6# Estados #7 UsuarioQueOrdenoCompra #8 $Envio #9TOTAL*/
            recibo_compra_insumos(proveedor_id, lineas, confirmado, pagado, entregado, recibido,  usuario_id, costo_envio, montoPedido);
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
    $('#mt').html(montoTotal+$('#mt').html);
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
    $('#cantidad_number').val("");    $('#costo_number').val("");    $('#d4').val("");    $('#total').val("");
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

/******* La funcion valida que en el campo "costo_envio" de una Compra se ingresen SOLO NUMEROS ******/
$(document).ready(function () {
    $("#costo_envio").keydown(function (e) {
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

$('#costo_envio').keypress(function () {
}).keyup(function () {
        sumaraTotal();});
function sumaraTotal(){
    var costo_envio = $('#costo_envio').val();
    costo_envio = parseFloat(costo_envio);
    $('#mt').html(parseFloat(montoTotal+costo_envio));
}

/** Al elegir un insumo, se ejecuta una funcion que busca el costo de el insumo seleccionado */
$('#insumo_select').on('change',function(){
    var insumo_id = $('#insumo_select').val();
    mostrarPrecioInsumo(insumo_id);
    //mostrarStockRemanente(insumo_id);
});
// Las funciones:
function mostrarPrecioInsumo(insumo_id){

    $.ajax({
        url: "/admin/insumos",
        data: {
            id:insumo_id,
            encontrarCosto:true,
        },
        dataType: 'json',
        success: function (data) {
            var respuesta = JSON.parse(data);
            //console.log(respuesta);
            $('#costo_number').val(respuesta.costo);
            alert(respuesta.nombre+(' (Actualmente '+respuesta.stock+' unidades en Stock)'));
        }
    });
}

/*
 function mostrarStockRemanente(articulo_id){
 $.ajax({
 url: "/admin/articulos",
 data: {
 id:articulo_id,
 informarStockRestante:true,
 },
 dataType: 'json',
 success: function (data) {
 var respuesta = JSON.parse(data);
 console.log(respuesta);
 alert("(Stock remanente)"+respuesta.insumo+": "+respuesta.cantidad_actual);
 }
 });
 }
 */

function recibo_compra_insumos(proveedor_id, lineas, confirmado, pagado, entregado, recibido, usuario_id, costo_envio, montoPedido)
{
    var proveedor = null; proveedor_email= null; proveedor_telefono = null;
    var nro_comprobante;
    var recibo = {                          /*El ticket es una 'nota de pedido'*/
        nro_comprobante: null,
        proveedor: proveedor, proveedor_email: proveedor_email, proveedor_telefono: proveedor_telefono,
        costo_envio: costo_envio,
        imp_total: montoPedido,
        items: lineas,
    };
    /* Dentro se persiste un nuevo comprobante */
    $.ajax({
        url: "/admin/comprobantes", dataType: 'json',
        data: {
            usuario_id: usuario_id,
            proveedor_id: proveedor_id,
            recibo_compra_insumos: true,
        },
        success: function (data) {
            var respuesta = JSON.parse(data);
            console.log("La respuesta de ComprobantesController es: ");
            console.log(respuesta);
            nro_comprobante = respuesta.comprobante_id;             //Funciona
            proveedor = respuesta.proveedor;
            proveedor_email = respuesta.proveedor_email;
            proveedor_telefono = respuesta.proveedor_telefono;
            /*Una vez que se obtiene el id de comprobante grabado arriba, se rellena el recibo por pantalla */
            recibo.nro_comprobante = nro_comprobante;      //OK
            recibo.proveedor = proveedor;
            recibo.proveedor_email = proveedor_email;
            recibo.proveedor_telefono = proveedor_telefono;
            //recibo.imp_total = montoTotal_Absoludo;
            console.log("El contenido del array 'recibo' es:");
            console.log(recibo);
            var array = JSON.stringify(recibo);
            console.log(array);
            var enlace_recibo = 'http://localhost/factura/EditableInvoice/recibo_compra_insumos.php?&datos_comprobante=' + encodeURIComponent(array);
            window.open(enlace_recibo);
        }
    });
}

/**Buscar y mosrar la cantidad de Insumos que hay */
/** Al elegir un articulo, se ejecuta una funcion que busca el precio de venta y disponibilidad de insumos*/
$('#insumo_select').on('change',function(){
    var insumo_id = $('#insumo_select').val();
    mostrarStockRemanente(insumo_id);
});
function mostrarStockRemanente(insumo_id){        //devuelve los insumos que quedan
    $.ajax({
        url: "/admin/insumos", dataType: 'json',
        data: {
            id:insumo_id,
        },
        success: function (data) {
            var respuesta = JSON.parse(data);
            console.log(respuesta);
        }
    });
}