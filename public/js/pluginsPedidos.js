/*
 * $(document).ready...: Acá se instancia la tabla en la página.
 * Difiere del método común en que el "lengthMenu" está configurado para que no pagine la
 * tabla ya que de hacerlo, al momento de registrar el pedido/venta, dataTable solo tomará los renglones
 * que sean visibles al momento de registrar, excluyendo a los que estén paginados en otras páginas.
 * Ej: tengo 11 renglones y la tabla muestra solo 10 renglones y crea otra página para mostrar el 11º renglón,
 * si al registrar estoy en la pág 1, el 11º registro será ignorado.
 */
/*
 $('#fecha_entrega_date').on('click', function () {
 var fecha_entrega_estimada;
 fecha_entrega_estimada = $("#fecha_entrega_date").val();
 //alert(fecha_entrega_estimada);
 $('#fecha_entrega_date').datepicker({minDate: -7});
 });
 */
//$("#modal-ingresar-cae").modal();


/*** Instanciar variables Globales ***/
var horas_produccion = 0;

var numFila = 0;
var cantFilas = 0;
var montoPedido = 0;
var montoTotal = 0;
var montoTotal_Absoluto = 0;
var pagarTotal = true;
var datos_cheque = null;      //array con datos del cheque
//Datos del cheque (en blanco)
var pagoCheque = false;
var pagoEnCC = "no";
var nro_serie;
var banco;
var sucursal_banco;
var fecha_emision;
var fecha_cobro;

var tieneCC;
var este_pedido_id;
var cliente_es_cf;
/************************************ */
//$('#cantidad_number').val(iii.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]);

var miWizard = $("#example-basic").show();

$("#example-basic").steps({
    headerTag: "h2",
    bodyTag: "section",
    transitionEffect: "slide",
    autoFocus: true,
    /* Labels */
    labels: {
        cancel: "Cancelar",
        current: "current step:",
        pagination: "Pagination",
        next: 'Siguiente',
        previous: 'Anterior',
        finish: 'Confirmar'
    },

    /* validaicon de pagina de Cliente */
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // ASiempre permitir volver para atras
        if (currentIndex > newIndex)
        {
            return true;
        }
        if((currentIndex === 0) && ($("#responiva_select").val()!==""))
        {
            return true;
        }
        //Validacion de seccion "Articulos"
        if((currentIndex === 1) && (cantFilas>0))
        {
            return true;
        }
        /* validacion de pagina de Modo de Pago */
        if((currentIndex===2) && ($("#chkEfectivo").is(":checked") || $("#chkCheque").is(":checked")) || $("#chkCC").is(":checked")){
            if(($("#chkCheque").is(":checked"))){    //si paga con cheque
                if((cliente_es_cf == true) && ($("#pago_cheque_cf").val() !='1')) {       //si no se le permite el pago con cheque a este cliente
                    if ($('#btn-pagarConCheque').prop('disabled', true)) {
                        alert('A clientes en razón de Consumidor Final no se les permite abonar con cheques  ✋🏻');
                        alert('ℹ️ Puede modificar esta opción en la configuracion gral. (arriba-derecha) ℹ️');
                    } else {
                        $("#modal-create-cheque").modal();
                    }
                    pagoEnCC = "no";
                }
                else{
                    if(tieneCC == true){
                        //alert("El cliente tiene una CC activa");
                        rellenarModalCheque();
                        $("#modal-create-cheque").modal();
                        pagoEnCC = "si";
                        sugerirFechaDeEntrega();
                        return true;
                    }
                    else{
                        alert(" ✋🏻  El cliente NO tiene aún una CC  ✋🏻");
                        pagoEnCC = "no";
                        $("#modal-crearCC").modal();
                        return false;

                    }
                }
            }
            else if($("#chkCC").is(":checked")){     //si paga con Cuenta Corriente
                if(tieneCC == true){
                    alert("El cliente tiene una CC activa ✅ ");
                    pagoEnCC = "si";
                    sugerirFechaDeEntrega();
                    return true;
                }
                else{
                    alert(" ✋🏻  El cliente NO tiene aún una CC  ✋🏻");
                    pagoEnCC = "no";
                    $("#modal-crearCC").modal();
                    return false;
                }
            }
            else if($("#chkEfectivo").is(":checked")){
                sugerirFechaDeEntrega();
                return true;

            }
        }
        else{
            return false;
        }
    },
    onFinished: function (event, currentIndex)
    {
        //miWizard.hide();
        $('#volverWizard').removeClass("hide");
        confirmar();
    }
});

//$('#chkCheque').onclick($("#modal-create-cheque").modal());
/**Quitar el fondo gris en el wizard*/
$(document).ready(function () {
    $(".content .clearfix").css("background-color", "#FBFCFC");
});


$('#iva_select').prop('disabled',true);
$('#precioU_number').prop('disabled',true);
if($('#permitir_ingresar_precio').val() == 0){
    $('#importe_number').prop('disabled',true);
}


$(document).ready(function () {
    $('#tblListaProductos').DataTable({
        responsive: true,
        "language": {
            "url": "/js/spanish.json"
        },
        "lengthMenu": [[-1], ["Todos"]]
    });
});
/** Desactivar el boton 'pago con cheque' por defecto' */
if($("#pago_cheque_cf").val() == 0){
    $('#btn-pagarConCheque').prop('disabled',true);
    $('#btn-pagarConCheque').prop('color', 'grey');
}



/*
 * Variables para cuando se cargan artículos en la tabla.
 *  var numFila: Esta variable identifica a una fila dentro de la tabla. Este dato se utiliza cuando se quiere eliminar un renglón de la tabla.
 *  var cantFilas: Esta es una variable de control. Se utiliza cuando se va a poceder con la registración de un pedido o venta. Si esta es igual a 0 (cero) no puede realizarce una registración.
 *  var montoPedido: En esta variable se va almacenando de manera actualizada el valor total del pedido. Es modificada cada vez que se agrega o elimina un renglón.
 *                   Es calculada a partir de los importes de los renglones.
 */
$('#sena').val("0");

function validarFormCheque(){
    nro_serie = document.forms["form-crear"]['nro_serie'].value;
    banco = document.forms["form-crear"]["banco"].value;
    sucursal = document.forms["form-crear"]["sucursal"].value;
    fecha_emision = document.forms["form-crear"]["fecha_emision"].value;
    fecha_cobro = document.forms["form-crear"]["fecha_cobro"].value;
    if (nro_serie == "" && banco =='' && sucursal =='' && fecha_emision =='' && fecha_cobro =='') {
        alert("No se ha rellenado correctamente el cheque");
        pagoCheque = false;
    }
    else{
        cargarDatosCheque();
    }
}

function validarFormCheque_segundoPago(pedido_id){
    nro_serie = document.forms["form-crear"]['nro_serie'].value;
    banco = document.forms["form-crear"]["banco"].value;
    sucursal = document.forms["form-crear"]["sucursal"].value;
    fecha_emision = document.forms["form-crear"]["fecha_emision"].value;
    fecha_cobro = document.forms["form-crear"]["fecha_cobro"].value;
    if (nro_serie == "" && banco =='' && sucursal =='' && fecha_emision =='' && fecha_cobro =='') {
        alert("No se ha rellenado correctamente el cheque");
        pagoCheque = false;
    }
    else{
        /**Hacer Pago**/
        //cargarDatosCheque();
        $.ajax({
            dataType: 'json', url: "/admin/pedidos/create", //se manda a create porque update no me anda nunca
            data: {
                completar_pago_c_cheque: true,
                pedido_id: pedido_id,
                /****** Datos Cheque *****/
                nro_serie: nro_serie, banco: banco, sucursal_banco:  $('#sucursal').val(), fecha_emision: fecha_emision, fecha_cobro: fecha_cobro,
                cliente_id: $('#cliente_oculto_id').val(),
                monto: $('#restaAbonar_oculto').val(),
        /*********************** */
            },
            success: function (data) {
                var data_recibida = JSON.parse(data);
                console.log(data);
                //emitirTicket(informacion_de_cliente);       /**llamar a emitir nota de pedido (comprobante de transaccion para el cliente)*/
            }
        });

    }
}

function cargarDatosCheque(){                           //valida y carga los datos del modal-cheque
    nro_serie = $('#nro_serie').val();
    banco = $('#banco').val();
    sucursal_banco = $('#sucursal').val();
    fecha_emision = $('#fecha_emision').val();
    fecha_cobro = $('#fecha_cobro').val();
    alert('Se cargaron datos del cheque para el pago');
    $('#msjChequeCargado').removeClass("hide");
    pagoCheque = true;
}


//var nro_serie_cheque = $('#nro_serie').val();
//var banco_cheque = $('#banco').val();
//var sucursal_banco_cheque = $('#sucursal').val();
//var fecha_emision_cheque = $('#fecha_emision').val();
//var fecha_cobro_cheque = $('#fecha_cobro').val();


/**
 * Funtion agregarContenido: Este método recibe parámetros para crear renglones () y crea
 * una nueva linea en la tabla de artículos. También agrega otros valores útiles para otros métodos
 * como el número de fila que se inserta y un link que dispara el método para borrar esa fila.
 * También incrementa el valor del monto del pedido a partir del importe del renglón.
 * La tabla funciona como un array y el 1º registro ocupa la posición 0 (cero).
 *
 * parseFloat: método de javascript para convertir a decimal la variable y usarla para el pertinente cálculo.
 */
function agregarContenido(articulo_select, nombre, cantidad_number, precioU_number, importe_number, horas_produccion_articulo)
{
    var tPro = $('#tblListaProductos').DataTable();
    cantFilas++;
    numFila++;
    valorItemNeto = parseFloat(importe_number); //valor neto (valor*cantidad)
    //valorItemTotal = valorItemNeto + valorItemNeto * parseFloat($('#iva').val()) / 100; //valor con iva incluido
    valorItemTotal = valorItemNeto;
    montoPedido = montoPedido + valorItemNeto;
    montoPedido = montoPedido.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];  //quitando decimales
    montoPedido = parseFloat(montoPedido);
    montoTotal = montoTotal + valorItemTotal;
    montoTotal = montoTotal.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
    montoTotal = parseFloat(montoTotal);
    montoTotal_Absoluto = montoTotal_Absoluto + valorItemTotal;
    montoTotal_Absoluto = montoTotal_Absoluto.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
    montoTotal_Absoluto = parseFloat(montoTotal_Absoluto);

    horas_produccion = horas_produccion + (horas_produccion_articulo * cantidad_number);    //nuevo → 1 de Mayo

    tPro.row.add([
        numFila,
        articulo_select,
        nombre,
        cantidad_number,
        precioU_number,
        importe_number,
        horas_produccion_articulo*cantidad_number,
        ' <a href="javascript:borrarFila(' + numFila + ');" data-toggle="modal"><i class="fa fa-lg fa-trash-o"></i> Borrar</a>   ',
        //valorItemTotal,       #comentado el 19/01 15:21

    ]).draw();
    $('#mp').html(montoPedido);
    $('#mt').html(montoTotal);
    limpiar();
}

/*
 * Function borrarFila: Este método remueve un reglón de la tabla, adicionalmente actualiza los valores "cantFilas"
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
    $('#tblListaProductos tbody tr').each(function () {
        var dataPla = $('#tblListaProductos').DataTable().row(this).data();
        if (dataPla[0] === d) {
            numFilaBorrar = Filas;
            montoPedido = montoPedido - parseFloat(dataPla[5]);
            montoTotal = montoTotal - parseFloat(dataPla[5]);
            montoTotal_Absoluto = montoTotal_Absoluto - parseFloat(dataPla[5]);
            horas_produccion = horas_produccion - parseFloat(dataPla[6]);
        }
        Filas++;
    });
    $('#tblListaProductos').dataTable().fnDeleteRow(numFilaBorrar);
    $('#mp').html(montoPedido);
    $('#mt').html(montoTotal);
    cantFilas--;
    if($('#tblListaProductos tbody tr').length == 0) {
        montoTotal = 0;
        montoPedido = 0;
        monoTotal_Absoluto = 0;
        horas_produccion = 0;
    }
}

/*
 * Function obtenerCantidades: Este método devuelve las cantidades para un tipo de artículo
 * que ya fueron ingresados en la tabla. Recibe de parámetro el id del articulo a buscar y la cantidad
 * que intereza agregar.
 */
function obtenerCantidades(d, cant)
{
    var cantidad = parseFloat(cant);
    if (cantFilas > 0) {
        $('#tblListaProductos tbody tr').each(function () {
            var dataPla = $('#tblListaProductos').DataTable().row(this).data();
            if (dataPla[1] === d) {
                cantidad = cantidad + parseFloat(dataPla[3]);
            }
        });
    }
    return cantidad;
}

/*
 * Function comprobar: Este método devuelve true si detecta que algún valor (articulo_id, cantidad, importe, precio_unitario)
 * se encuentra sin completar. Este método comienza con verificaciones, prosigue solicitando
 * a la controladora a través de la id del artículo el nombre del mismo y si es suficiente el stock
 * para luego pasar el nombre al método que se encarga de agregar el contenido en la tabla.
 */

function comprobar(articulo_select, cantidad_number, precioU_number, importe_number)
{
    if ((articulo_select !== '') && (cantidad_number !== '') && (precioU_number !== '') && (importe_number !== '')) {
        var canti = obtenerCantidades(articulo_select, cantidad_number);
        $.ajax({
            url: "/admin/articulos",
            data: {
                id: articulo_select,
                comprobarSiHayInsumosSuficientes: true,
                cantidadArticuloSolicitado: canti
            },
            type: 'GET', dataType: 'json',
            success: function (data) {
                var d = JSON.parse(data);
                console.log(d);
                if(d.permitir /*|| ($("#ventas_sin_stock").val() == 1)*/){         //si el servidor devuelve que hay insumos para cubrir el pedido o si el cntrol de stock esta desactivado en configuracion
                    agregarContenido(articulo_select, $('#articulo_select option:selected').text(), cantidad_number, precioU_number, importe_number, d.horas_produccion);
                }
                else{
                    document.getElementById("cantidad_number").style.color = "red";
                    $('#msjStock').removeClass("hide");
                    $("#cantidad_number").select();
                    for(var i=0; i<d.length; i++) {
                        //alert(d[i].mensaje + d[i].faltante+" "+d[i].unidad+" de "+ d[i].insumo+")");
                        $('#insumo'+i).removeClass("hide");
                        bootstrap_alert('#insumo'+i, d[i].mensaje + d[i].faltante+" "+d[i].unidad+" de "+ d[i].insumo+")", 10000)
                    }
                }
            }
        });
    } else {
        $("#cantidad_number").select();
    }
}

/*
 * Function limpiar: Este método resetea los campos cantidad, precio_unitario e importe.
 * cantidad_number: campo "Cantidad".
 * precioU_number: campo "Precio unitario".
 * importe_number: campo "Importe".
 */
function limpiar()
{
    $('#cantidad_number').val(""); $('#precioU_number').val(""); $('#importe_number').val("");
}
/*
 * Este método jquery captura el evento de cuando se suelta la tecla despues de presionarla sobre
 * el campo "Precio unitario" y lanza el método que se encarga de calcular el contenido para el campo "Importe".
 */
$("#precioU_number").keypress(function () {
}).keyup(function () {
    var iva = $("#iva option:selected").val();
    completarPrecio("importe_number", iva);
});
/*
 * Este método jquery captura el evento de cuando se suelta la tecla despues de presionarla sobre
 * el campo "Importe" y lanza el método que se encarga de calcular el contenido para el campo "Precio unitario".
 */
$("#importe_number").keypress(function () {
}).keyup(function () {
    var iva = $("#iva option:selected").val();
    completarPrecio("precioU_number", iva);
});
/*
 * Este método jquery captura el evento de cuando se suelta la tecla despues de presionarla sobre
 * el campo "Artículo" y verifica si alguno de los campos "Importe" o "Precio unitario" tienen algún
 * contenido y a partir de ello lanza el método que se encarga de calcular el contenido para el campo sobrante.
 * Este método verifica primero si el campo "Precio unitario" no está vacio. Otro cosa a saber de este método es que
 * si ambos campos a verificar se encuentran vacios no hace nada.
 */
$("#cantidad_number").keypress(function () {
}).keyup(function () {
    var iva = $("#iva option:selected").val();
    if ($('#precioU_number').val() !== "")
    {
        completarPrecio("importe_number", iva);
    } else {
        completarPrecio("precioU_number", iva);
    }
});
/*
 * Function completarPrecio: Este método se encarga de completar el valor para un campo a partir de otros dos
 * campos. Generalmente el campo "Cantidad" está completo cada vez que se llama a este método y el otro campo
 * que se usa es el pasado como parámetro. Si es "Precio unitario" se calcula el importe y viceversa.
 * Si el campo "Cantidad" se encuentra vacío este se toma para el cálculo como valor 0 (cero).
 */
function completarPrecio(n, iva)
{
    cantidad = $('#cantidad_number').val();
    var impuesto;
    var total;

    if (n == "precioU_number") {
        if ($('#importe_number').val() === "")
        {
            $('#precioU_number').val("");
        } else {
            precio = $('#importe_number').val();
            importe = precio / cantidad;
            impuesto = ((precio * iva) / 100);
            total = parseFloat(precio) + parseFloat(impuesto);
            $('#precioU_number').val(importe);
            $('#total').val(total);
        }
    } else {
        if ($('#precioU_number').val() === "") {
            $('#importe_number').val("");
        } else {
            importe = $('#precioU_number').val();
            var importe_x_cantidad = importe * cantidad;
            importe_x_cantidad = importe_x_cantidad.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
            importe_x_cantidad = parseFloat(importe_x_cantidad);
            $('#importe_number').val((importe_x_cantidad));
            precio = $('#importe_number').val();
            impuesto = ((precio * iva) / 100);
            total = parseFloat(precio) + parseFloat(impuesto);
            $('#total').val(total);
        }
    }
}

/*
 * Este método jquery captura el evento de submit del formulario "Artículos"
 * y lanza el método que se encarga de crear un renglón en la tabla.
 */
function comprobarYagregar() {
    comprobar($('#articulo_select').val(), $('#cantidad_number').val(), $('#precioU_number').val(), $('#importe_number').val());
}
/*
$("#form-agregar").submit(function (e) {
    e.preventDefault();
    comprobar($('#articulo_select').val(), $('#cantidad_number').val(), $('#precioU_number').val(), $('#importe_number').val());
});
*/

/** Este método jquery captura el evento de submit del peuqeño formulario que posee los campos
 * seña y cliente y lanza el método que solicita confirmación de los datos ingresados.*/
$("#form-pedido").submit(function (e) {
    e.preventDefault();
    confirmar();
});

/*
 * Function confirmar: Este método verifica que la tabla contenga al menos un renglón, de ser así
 * verifica si el valor de la seña es igual, menor o mayor al monto del pedido. Si es igual lanza un modal el
 * cual solicita la confirmación para registrar como pedido o venta. Si es menor solicita confirmación para registrar como pedido.
 * Si es mayor informa la exepción.
 */
function confirmar()
{
    if (cantFilas > 0) {
        if (pagarTotal) {   //si se paga el total, abrir el modal de pago total "confirmarVenta.blade.php"
            $('#modal-confirmarVenta').modal('show');
        } else if (!pagarTotal) {
            if ($('#sena').val() == montoTotal) {
                $('#modal-confirmarVenta').modal('show');
            } else if ($('#sena').val() < montoTotal) {
                $('#modal-confirmarPedido').modal('show');
            } else {
                $('#msjSena').removeClass("hide");
                $('#sena').select();
            }
        }
    } else {
        $('#msjTblvacia').removeClass("hide");
    }
}

/** Function enviarPedido: Este método se encarga de recorrer los renglones de la tabla y empaquetar el contenido de
 * interés de cada renglón en un objeto json y añadirlo a un array que se enviará a la controladora con otros datos
 * requeridos para realizar el registro de pedido/venta.
 * El parámetro que ingresa "entregado" es un boolean que solo toma valor true si se trata de la confirmación de una
 * venta a través del momodal-confirmarVenta
 */
function enviarPedido(pagado, entregado)
{
    var informacion_de_cliente;
    console.log('pagado: '+pagado+" entregado: "+entregado+" pagoCheque: "+pagoCheque);
    var numLi = 0;
    var lineas = [];
    var factura = {
        iva: $('#iva').val(),
        tipo_cbte: 'B',
        nro_doc: $('#cuit').val(),
        nombre_cliente: $('#nombreCliente').val(),
        domicilio_cliente: $('#direccion').val(),
        imp_total: $('#montoTotal').val(),
        items: [],
    };
    $('#tblListaProductos tbody tr').each(function () {
        var dataFila = $('#tblListaProductos').DataTable().row(this).data();
        var linea = {articulo_id: dataFila[1], articulo_nombre: dataFila[2], cantidad: dataFila[3], precio_unitario: dataFila[4], importe: dataFila[5]};
        lineas [numLi] = linea;
        factura.items [numLi] = linea;
        console.log("Se agrego un item para la factura: "+linea.articulo_nombre);
        console.log("pagarTotal: "+pagarTotal);
        numLi++;
    });
    if (!pagarTotal) {
        montoTotal = $('#sena').val();
    }

    $.ajax({    //en esta peticion se busca obtener los datos del cliente para confecc los comprobantes
        dataType: 'json',
        url: "/admin/clientes",
        data: {
            id: $('#cliente').val()
        },
        success: function (data) {
            console.log("De ClientesController se obtuvieron estos datos para FE: "+data); console.log("El monto total que se manda a FE es =" + montoTotal);
            var data_cliente = JSON.parse(data);
            informacion_de_cliente = data_cliente;
            /**factura electrónica --> (desde pantalla de 'tomar pedido')*/
            if ($('input:checkbox[name=factura]:checked').val()) {
                factura.tipo_cbte = informacion_de_cliente.tipo_cbte;   //OK
                factura.nro_doc = informacion_de_cliente.dni;           //OK
                if(informacion_de_cliente.empresa ==''){   /**Si el cliente no tiene empresa*/
                    factura.nombre_cliente = informacion_de_cliente.nombre;         //grabar su nombre para la factura
                }else{
                    factura.nombre_cliente = informacion_de_cliente.empresa;         //sino grabar nombre de la empresa para la factura, descartar nombre de representante
                }
                factura.provincia_cliente = informacion_de_cliente.provincia;   //OK
                factura.localidad_cliente = informacion_de_cliente.localidad;   //OK
                factura.domicilio_cliente = informacion_de_cliente.domicilio;   //OK
                factura.imp_total = montoTotal;                 //OK
                factura.items = lineas;
                var array = JSON.stringify(factura);
                var enlace_factura = 'http://localhost/factura/dinamico-factura.php?&datos_factura=' + encodeURIComponent(array);
                window.open(enlace_factura);
                //$("#modal-ingresar-cae").modal();   //**Abrir ventana para que se ingresen datos fe Factura Electronica

            }
        }
    });

    console.log("la seña es: "+montoPedido);
    if(entregado){
        fecha_entrega_estimada = fechahoy();
    }
    else{
        fecha_entrega_estimada = $('#fecha_entrega_date').val();
    }
    /** Si se cargaron datos del cheque*/
    if(pagoCheque==false){
        //alert('Se paga en efectivo');
    }else{
        //alert('Se paga con cheque');
        console.log( "nro_serie: "+nro_serie+", banco: "+banco+", sucursal: "+sucursal_banco+" fecha_emision: "+fecha_emision+" ,fecha_cobro: "+fecha_cobro);
    }
    /** persistir venta o pedido */
    $.ajax({
        dataType: 'json', url: "/admin/pedidos/create",
        data: {
            renglones: lineas,
            pagado: pagado,
            pagoCheque: pagoCheque,
            /****** Datos Cheque *****/
            nro_serie: nro_serie, banco: banco, sucursal_banco: sucursal_banco, fecha_emision: fecha_emision, fecha_cobro: fecha_cobro,
            /*********************** */
            fecha_entrega_estimada: fecha_entrega_estimada,
            entregado: entregado,
            usuarioPedido: $('#usuarioPedido').val(),
            cliente: $('#cliente').val(),
            sena: montoTotal,
            horas_produccion: horas_produccion,
            paga_en_cuentacorriente: pagoEnCC,
        },
        success: function (data) {
            var data_recibida = JSON.parse(data);
            este_pedido_id = data_recibida.pedido_id;
            if ($('input:checkbox[name=factura]:checked').val()) {
                $("#modal-ingresar-cae").modal();
            }else{
                $('#mensajeExito').html();
                $('#botonExito').click();
            }
            console.log(data);
            emitirTicket(informacion_de_cliente);       /**llamar a emitir nota de pedido (comprobante de transaccion para el cliente)*/
            //$('#mensajeExito').html();
            //$('#botonExito').click();
            /*bardo con el email_info_pedido_cliente? */
            if(entregado == false){             /**si el pedido no fue entregado en el acto, llamara enviar email con info de compra*/
                email_info_pedido_cliente(lineas, montoPedido, montoTotal_Absoluto);
            }
            email_notificacion_stockBajo();       /**llamar a email stock bajo*/


        }
    });
}

/** Este método jquery es el que toma el valor total de un pedido o si por el contrario solo se quiere señar el mismo*/
$("#botonModalidad").click(function () {
    if ($('#divSena').hasClass('hide')) {
        $('#botonModalidad').html("Pagar totalidad del pedido");
        $('#botonModalidad').removeClass("btn-primary");
        $('#botonModalidad').addClass("btn-success");
        pagarTotal = false;
        $('#divSena').removeClass("hide");
    } else {
        $('#divSena').addClass("hide");
        pagarTotal = true;
        $('#botonModalidad').removeClass("btn-success");
        //$('#botonModalidad').removeClass("btn-pagarConCheque");
        $('#botonModalidad').addClass("btn-primary");
        $('#botonModalidad').html("Señar el pedido");
        generarFactura();
    }
});
/*
 * Function registrarCliente: Este método se encarga de enviar al servidor los datos para registrar a un nuevo cliente
 * y lo selecciona; todo esto durante el proceso de carga de un nuevo pedido.
 */
function registrarCliente()
{
    $.ajax({
        dataType: 'json',
        url: "/admin/clientes/create",
        data: {
            apellido: $('input:text[name=apellido]').val(),
            nombre: $('input:text[name=nombre]').val(),
            empresa: $('input:text[name=empresa]').val(),
            responiva_id: $('#responiva_id').val(),
            cuit: $('input:text[name=cuit]').val(),
            dni: $('input:text[name=dni]').val(),
            localidad_id: $('#localidad_select').val(),
            direccion: $('input:text[name=direccion]').val(),
            telefono: $('input:text[name=telefono]').val(),
            email: $('input:text[name=email]').val(),
            descripcion: $('#descripcion').val()
        },
        success: function (data) {

            var data_cliente = JSON.parse(data);
            console.log(data_cliente);
            $('#modal-create-cliente').modal('hide');
            alert('se añadio el nuevo cliente satisfactoriamente ✅ ');
            var cliente_select = document.getElementById("cliente");
            var option = document.createElement("option");
            option.value = data_cliente.id;
            option.text = ""+data_cliente.apellido+", "+data_cliente.nombre+" (Registrado recientemente)";
            cliente_select.add(option);
            cliente_select.appendChild(option);
        }
    });
}
/**** Cuando se selecciona un pais, desplegar las provincias que le corresponden ****/
$('select#pais_select').on('change',function () {
    $('select#provincia_select').empty();
    $('select#localidad_select').empty();
    $.ajax({
        dataType: 'json',
        url: "/admin/paises",         //ruta que contendra el metodo para obtener lo que necesitamos, dentro del contolador
        data: {
            id: $('#pais_select').val()
        },
        success: function (data) {
            //factura.tipo_cbre = data.tipo_cbre;
            for(i=0; i<data.length; i++){
                $('select#provincia_select').append("<option value='"+data[i].id+"'> "+data[i].nombre+"</option>");
            }
        }
    });
    buscarLocalidades();
});

$('select#provincia_select').on('change',function () {
    $('select#localidad_select').empty();
    buscarLocalidades();
});

/**** Cuando se selecciona una provincia, desplegar las localidades que le corresponden ****/
function buscarLocalidades(){
    $('select#localidad_select').empty();
    $.ajax({
        dataType: 'json',
        url: "/admin/provincias",         //ruta que contendra el metodo para obtener lo que necesitamos, dentro del contolador
        data: {
            id: $('#provincia_select').val()
        },
        success: function (data) {
            console.log(data);
            //factura.tipo_cbre = data.tipo_cbre;
            for(i=0; i<data.length; i++){
                $('select#localidad_select').append("<option value='"+data[i].id+"'> "+data[i].nombre+"</option>");
            }
        }
    });
}

/** Function generarFactura: Este método se encarga de recoger ciertos datos de la vista y
 * enviarlos al archivo php que se encarga de realizar la facturación electrónica. (al convertir un pedido en una venta)*/
function generarFactura(id_cliente, monto_factura) {    //Funciono OK desde pedidos → entregados
    var factura = {
        iva: null,
        tipo_cbte: 'B',
        nro_doc: $('#cuit').val(),
        nombre_cliente: $('#nombreCliente').val(),
        domicilio_cliente: $('#direccion').val(),
        imp_total: $('#montoTotal').val(),
        items: [],
    };

    $.ajax({    //en esta peticion se busca obtener los datos del cliente para confecc los comprobantes
        dataType: 'json',
        url: "/admin/clientes",
        data: {
            id: id_cliente
        },
        success: function (data) {
            var data_cliente = JSON.parse(data);
            console.log(data_cliente);
            informacion_de_cliente = data_cliente;
            factura.tipo_cbte = informacion_de_cliente.tipo_cbte;
            factura.nro_doc = informacion_de_cliente.dni;
            if(informacion_de_cliente.empresa =='' || informacion_de_cliente.empresa == null){   /**Si el cliente no tiene empresa*/
                factura.nombre_cliente = informacion_de_cliente.nombre;         //grabar su nombre para la factura
            }else{
                factura.nombre_cliente = informacion_de_cliente.empresa;         //sino grabar nombre de la empresa para la factura, descartar nombre de representante
            }
            factura.provincia_cliente = informacion_de_cliente.provincia;
            factura.localidad_cliente = informacion_de_cliente.localidad;
            factura.domicilio_cliente = informacion_de_cliente.domicilio;
            factura.imp_total = monto_factura;
            var array = JSON.stringify(factura);
            var enlace_factura = 'http://localhost/factura/dinamico-factura.php?&datos_factura=' + encodeURIComponent(array);
            window.open(enlace_factura);
            $("#modal-ingresar-cae-despues").modal();
        }

    });
}




/** validar que se ingresen solo numeros en cantidad y en nro_cheque */
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
$(document).ready(function () {
    $("#nro_serie").keydown(function (e) {
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

$(document).ready(function () {
    $("#fecha_entrega_date").keydown(function (e) {
        e.preventDefault();
    });
});


/** Este eveto se dispara al cambiar el valor del iva en la venta y actualiza el valor del iva
 * en todos los importes incluyendo a los de los items. */  //NO VA EN LA TESIS, SOLO PARA LA GRAFICA
/*
 $('#iva').on('change', function () {
 if (montoTotal > 0) {
 montoTotal = montoPedido + montoPedido * parseFloat($('#iva').val()) / 100; //valor con iva incluido
 var impNetoFila = 0;
 var Filas = 0;
 $('#tblListaProductos tbody tr').each(function () {
 impNetoFila = 0;
 var dataPla = $('#tblListaProductos').DataTable().row(this).data();
 impNetoFila = parseFloat(dataPla[5]) + parseFloat(dataPla[5]) * parseFloat($('#iva').val()) / 100;
 $('#tblListaProductos').DataTable().cell(Filas, 6).data(impNetoFila);
 Filas++;
 });
 $('#mt').html(montoTotal);
 }
 });
 $("#modal-exito").on("hidden.bs.modal", function () {
 generarFactura();
 //window.location = "/admin/pedidos";
 });
 */
/** Al elegir un articulo, se ejecuta una funcion que busca el precio de venta y disponibilidad de insumos*/
$('#articulo_select').on('change',function(){
    $('#insumos_necesarios').empty();
    var articulo_id = $('#articulo_select').val();
    if(cantFilas == 0){
        mostrarPrecioArticulo(articulo_id);
        mostrarStockRemanente(articulo_id);
    }
    else {
        if(articuloYaEstabaEnLaTabla(articulo_id) == 'si'){
            alert('El articulo seleccionado ya se encuentra en el carro de Pedidos');
        }
        else{
            mostrarPrecioArticulo(articulo_id);
            mostrarStockRemanente(articulo_id);
        }
    }
});
// Las funciones:
function mostrarPrecioArticulo(articulo_id){        //devuelve el precio de venta del articulo elegido
    $.ajax({
        url: "/admin/articulos",
        data: {
            id:articulo_id,
            encontrarPrecio: true,
        },
        dataType: 'json',
        success: function (data) {
            var respuesta = JSON.parse(data);
            $('#precioU_number').val(respuesta);
        }
    });
}
function mostrarStockRemanente(articulo_id){        //devuelve los insumos que quedan para armar el producto elegido
    $.ajax({
        url: "/admin/articulos",
        data: {
            id:articulo_id,
            informarStockRestante: true,
        },
        dataType: 'json',
        success: function (data) {
            var respuesta = JSON.parse(data);
            var i = 1;
            var nro_item = 1;
            console.log(respuesta);
            for(i in respuesta) {
                var x = document.getElementById("insumos_necesarios");
                var option = document.createElement("option");
                option.text = "Insumo "+nro_item+": "+respuesta[i].insumo+" x"+respuesta[i].cantidad_insumo+" (stock: "+respuesta[i].cantidad_actual+ " "+respuesta[i].unidad+")"
                x.add(option);
                nro_item++;
            }
        }
    });
}
/** Al seleccionar cliente devolver su responsabilidad ante iva y porcentaje de iba a abonar*/
$('#cliente').on('change',function(){
    var cliente_id = $('#cliente').val();
    mostrarInfoTributaria(cliente_id);      //obtener responsabilidad IVA y % IVA
});

/** mostrarInfoTributaria devuelve todos los datos de CLIENTE, tambien si tiene una Cuenta Corriente para poder usarla */
function mostrarInfoTributaria(cliente_id){
    $.ajax({
        url: "/admin/clientes",
        data: {
            id: cliente_id,
        },
        dataType: 'json',
        success: function (data) {
            var respuesta = JSON.parse(data);
            console.log(respuesta);
            tieneCC = respuesta.tieneCC;
            if(respuesta.responiva == 'Consumidor Final'){
                cliente_es_cf = true;
            }
            else{
                cliente_es_cf = false;
            }
            $('#responiva_select').val(respuesta.responiva+" (Factura "+respuesta.tipo_cbte+")");
            if((respuesta.responiva == 'Consumidor Final') && ($("#pago_cheque_cf").val() == 0)){
                $('#btn-pagarConCheque').prop('disabled',true);
            }else{
                $('#btn-pagarConCheque').prop('disabled',false);
            }
            $('#iva_select').val(respuesta.iva);
        }
    });
}
/** Al presionar 'Pagar con Cheque' cargar el cheque con la info del cliente y el pedido si no paga con seña ni es "Consumidor Final"*/
function rellenarModalCheque(){
    var cliente_id = $('#cliente').val();
    $.ajax({
        url: "/admin/clientes",
        data: {
            id:cliente_id,
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var respuesta = JSON.parse(data);
            console.log(respuesta);
            if(respuesta.responiva == 'Consumidor Final'){
                alert('✋ No se permite el pago con cheque a clientes en carácter de "Consumidor Final" ✋');
                alert('ℹ️ Puede modificar esta opción en la configuracion gral. (arriba-derecha) ℹ️');
            }
            else{
                $('#nombre_cheque').val(respuesta.n);
                $('#apellido_cheque').val(respuesta.a);
                $('#empresa_cheque').val(respuesta.empresa);
                $('#cuit_cheque').val(respuesta.dni);
                if(($('#sena').val()>0) && ($('#sena').is(':visible')) && ($('#sena').val()<montoTotal)){
                    $('#monto_cheque').val($('#sena').val());
                }else{
                    $('#monto_cheque').val(montoTotal);
                }
                $("#modal-create-cheque").modal();              //Abrir el modal de cheque
            }
        }
    });
    //}
    //else{
    //  alert('No se puede pagar con cheque una seña, solo totalidad');
    //}
}

/** Envia el email de notificacion de stock bajo **/
function email_notificacion_stockBajo(){
    var articulo_id = $('#articulo_select').val();      //con esto solo notificara el ultimo articulo, despues hay que hacer que recorra la tabla de pedido
    var mensaje;
    $.ajax({
        url: "/admin/articulos",
        data: {
            id:articulo_id,
            informarStockRestante: true,
        },
        dataType: 'json',
        success: function (data) {
            var hayStockBajo = false;       /*bandera para verificar si hay insumo en stock bajo en la lista*/
            var respuesta = JSON.parse(data);
            var i = 1;
            console.log(respuesta);
            for(i in respuesta) {
                mensaje = "El stock de "+respuesta[i].insumo+" esta muy bajo, solo quedan  "+respuesta[i].cantidad_actual+ " "+respuesta[i].unidad+" (stock minimo: "+respuesta[i].minimo+")\n";
                if(respuesta[i].cantidad_actual < respuesta[i].minimo){
                    hayStockBajo = true;
                }
            }
            if(hayStockBajo == true){       /**Si hay stock bajo de cualquier insumo del articulo, enviar email notificando*/
            $.ajax({
                url: "/admin/mail", dataType: 'json',
                data: {
                    mensaje:mensaje,
                    email_stockBajo:true,
                },
                success: function(data) {
                    var respuesta = JSON.parse(data);
                    alert(respuesta);
                }
            })
            }
        }
    });
}

/** Esta fucnion genera un comprobante 'nota de pedido' para el cliente. Crea un objeto Comprobante y lo persiste*/
function emitirTicket(informacion_de_cliente){
    var comprobante = '55';
    var ticket = {                          /*El ticket es una 'nota de pedido'*/
        nro_comprobante: comprobante,
        iva: $('#iva').val(),
        usuario:null,
        nro_doc: $('#cuit').val(),
        nombre_cliente: $('#nombreCliente').val(),
        domicilio_cliente: $('#direccion').val(),
        sena: $('#sena').val(),
        imp_total: montoPedido,
        items: [],
    };
    if(pagarTotal){
        ticket.sena = montoPedido;
    }
    var numLi = 0;
    var lineas = [];
    $('#tblListaProductos tbody tr').each(function () {
        var dataFila = $('#tblListaProductos').DataTable().row(this).data();
        var linea = {articulo_id: dataFila[1], articulo_nombre: dataFila[2], cantidad: dataFila[3], precio_unitario: dataFila[4], importe: dataFila[5]};
        lineas [numLi] = linea;
        ticket.items [numLi] = linea;
        console.log("Se agrego un item para el ticket: "+linea.articulo_nombre);
        numLi++;
    });
    $.ajax({
        url: "/admin/comprobantes",
        data: {
            cliente_id: $('#cliente').val(),
            usuario_id: $('#usuarioPedido').val(),
            nota_pedido: true,
        },
        dataType: 'json',
        success: function (data) {
            var respuesta = JSON.parse(data);
            console.log(respuesta);
            comprobante = respuesta.comprobante_id;             //Funciona
            ticket.nro_comprobante = comprobante;

            if(informacion_de_cliente.empresa=="" || informacion_de_cliente.empresa==null){   /**Si el cliente no tiene empresa*/
            ticket.nombre_cliente = informacion_de_cliente.nombre;         //grabar su nombre para la factura
            }else{
                ticket.nombre_cliente = informacion_de_cliente.empresa;         //sino grabar nombre de la empresa para la factura, descartar nombre de representante
            }

            ticket.usuario = respuesta.usuario; // !!!!
            ticket.provincia_cliente = informacion_de_cliente.provincia;   //OK
            ticket.localidad_cliente = informacion_de_cliente.localidad;   //OK
            ticket.domicilio_cliente = informacion_de_cliente.domicilio;   //OK
            ticket.nro_doc = informacion_de_cliente.dni;                   //OK
            ticket.imp_total = montoTotal_Absoluto;
            ticket.items = lineas;
            var array = JSON.stringify(ticket);
            console.log(ticket);
            var enlace_ticket = 'http://localhost/factura/EditableInvoice/index.php?&datos_factura=' + encodeURIComponent(array);
            window.open(enlace_ticket);
        }
    });


}

/** Enviar email con datos de pedido al cliente despues de efectuado el pedido (solo si no se entrega el mismo en el acto) **/
function email_info_pedido_cliente(lineas, sena, total){
    var fecha_entrega_estimada = $('#fecha_entrega_date').val();
    var fecha_hoy = fechahoy();
    console.log('items:');
    console.log(lineas);
    if(fecha_entrega_estimada==null){
        fecha_entrega_estimada = 'no se determino';
    }
    //console.log("cliente: "+$('#cliente').val()+"fecha entrega estimada"+fecha_entrega_estimada+" seña: "+sena+" total: "+total+" user: "+ user+ "fecha de hoy: "+ fecha_hoy);
    $.ajax({
        url: "/admin/mail", dataType: 'json',
        data: {
            id_cliente: $('#cliente').val(),
            items:lineas,
            fecha_entrega: fecha_entrega_estimada,
            sena:sena, total:total,
            fecha_hoy:fecha_hoy,
            email_info: true
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log("Fallo al enviar el mail con datos de pedido: "+recibido.excepcion);
        }
    })
}

/** Devuelve la fecha de HOY */
function fechahoy(){
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1;      //Enero seria 1
    var yyyy = hoy.getFullYear();
    if(dd<10) {dd='0'+dd}   if(mm<10) {mm='0'+mm}
    hoy = dd+'/'+mm+'/'+yyyy;
    return hoy;
}

/** Al hacer click en 'seleccionar articulo', se ejecuta una funcion que se fija que el articulo no este en una tabla, recorriendola*/
function articuloYaEstabaEnLaTabla(articulo_id){
    var articuloYaEsta = 'no';
    var numLi = 0;
    var lineas = [];
    $('#tblListaProductos tbody tr').each(function () {
        var dataFila = $('#tblListaProductos').DataTable().row(this).data();
        var linea = { articulo_id: dataFila[1] };
        lineas [numLi] = linea;
        numLi++;
        if(linea.articulo_id == articulo_id){
            articuloYaEsta = 'si';
        }
    });
    return articuloYaEsta;
}

/**validar si la tabla Articulos esta vacia*/
function laTablaArticulosEstaVacia(){
    if($('#tblListaProductos tbody tr').length == 0) {
        return true;
    }
    else{

        return false;
    }
};

/**Evento Creado para la fecha de entrega*/
/*
var Event = function(text, className) {
    this.text = text;
    this.className = className;
};
var events = {};    //array de eventos que se cargan debajo
events[new Date("04/04/2017")] = new Event("Cita con tu hermana", "pink");
events[new Date("04/05/2017")] = new Event("Entrega de TP", "green");
console.dir(events);

// DatePicker para fecha de entrega
$("#fecha_entrega_tentativa").datepicker({
    dateFormat: 'dd/mm/yy',   //formato de la fecha que necesito adquirir
    beforeShowDay: function(date) {
        var event = events[date];
        if (event) {
            return [true, event.className, event.text];
        }
        else {
            return [true, '', ''];
        }
    }
});
*/
    //instancio DatePicker
/*
jQuery(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['es']);
});*/

$("#fecha_entrega_date").datepicker({

});


// Setter
$("#fecha_entrega_date").datepicker( "option", "monthNamesShort", ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'] );
$("#fecha_entrega_date").datepicker( "option", "monthNames", ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']);
$("#fecha_entrega_date").datepicker( "option", "dayNames", ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']);
$("#fecha_entrega_date").datepicker( "option", "dayNamesMin", ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb']);
$("#fecha_entrega_date").datepicker( "option", "minDate", 0);
$("#fecha_entrega_date").datepicker( "option", "dateFormat", 'dd/mm/yy');
$("#fecha_entrega_date").datepicker( "option", "theme", 'customTheme');
$("#fecha_entrega_date").datepicker( "option", "onSelect", function buscarCantidadPedidos() {
    var dia_a_revisar = $("#fecha_entrega_date").val();
    $.ajax({
        url: "/admin/pedidos/create", dataType: 'json',
        data: {
            buscar_datepicker: true,
            dia: dia_a_revisar
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
            //mi magia para que aparezca el popup con los datos del pedido
            bootstrap_alert('#alertBox', 'Tiene pendientes ' + recibido.cantidad + ' pedidos, con un total de '+recibido.articulos+' articulos que entregar para el '+ dia_a_revisar, 9000)
        }
    })
});

//$("#fecha_entrega_date").datepicker( "option", "onSelect", function(dateText){ alert(dateText);

//$("#fecha_entrega_date" ).datepicker( "setDate", "10/12/2017" );
/**Buscar pedidos para el Calentario (el mismo ya se llama cuando se selecciona una fecha en el calendario)**/

function buscarCantidadPedidos() {
    var dia_a_revisar = $("#fecha_entrega_date").val();
    $.ajax({
        url: "/admin/pedidos/create", dataType: 'json',
        data: {
            buscar_datepicker: true,
            dia: dia_a_revisar
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
            //mi magia para que aparezca el popup con los datos del pedido
            bootstrap_alert('#alertBox', 'Tiene pendientes ' + recibido.cantidad + ' pedidos, con un total de '+recibido.articulos+' articulos que entregar para el '+ dia_a_revisar, 9000)
        }
    })
}

$('#item-publish').click(function () {
    buscarCantidadPedidos();
});

/**si radio button de cheque se selecciona..*/
if($("#chkCheque").is(":checked")){

    alert('se eligio cheque');
    $("#modal-create-cheque").modal();
}

/**Al pasar al llegar al step de Fecha Entrega → sugerir una fecha para entregar pedidos **/
function sugerirFechaDeEntrega() {
    var dia_a_revisar = fechahoy();//$("#fecha_entrega_date").val();
    $.ajax({
        url: "/admin/pedidos/create", dataType: 'json',
        data: {
            sugerir_fecha_entrega: true,
            horas_produccion: horas_produccion,
            dia: dia_a_revisar
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
            //mi magia para que aparezca el popup con los datos del pedido
            if (recibido.dias == 0) {
                bootstrap_alert('#recomendacion', "Casi no hay entregas en lista de espera, el pedido puede encargarse para ser entregado hoy o mañana.", 9000)
            }
            else {
                bootstrap_alert('#recomendacion', "Se sugiere un plazo de entrega minimo de acá a " + recibido.dias + " días habiles", 9000)

            }
        }
    })
}

function cancelarPedido(id){
    $.ajax({
        url: "/admin/pedidos/update", dataType: 'json',
        data: {
            pedido_id: id,
            cancelarPedido: true,
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
        }
    })
}

//** esta funcion revisa si el cliente seleccionado tiene una CC actualmente activa */
/*
function tieneCCactiva(){
    var tieneCC = false;
    $.ajax({
        url: "/admin/clientes", dataType: 'json',
        data: {
            revisar_CC_cliente: true,
            id : $('#cliente').val(),
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
            tieneCC = recibido.tieneCC;
            alert(tieneCC);
            return tieneCC;
        }
    })
}
    */

function guardar_data_afip(){  /** #1   Para usar desde tomar pedido*/
    var cae = $('#cae').val();
    var fecha_vencimiento_cae = $('#fecha_vencimiento_cae').val();
    console.log(cae+", "+fecha_vencimiento_cae+", id_pedido:"+este_pedido_id);
    $.ajax({
        dataType: 'json', url: "/admin/pedidos/create",
        data: {
            ingresar_cae:true,
            cae: cae,
            fecha_vencimiento_cae: fecha_vencimiento_cae,
            pedido_id: este_pedido_id,
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
            if(recibido!=null){
                $('#modal-ingresar-cae').modal('hide');
                $('#mensajeExito').html();
                $('#botonExito').click();
            }
        }
    })
}

function guardar_data_afip_posteriormente(id_pedido){   /** #2   Para usar desde confirmar entrega pedido (pedido pasa a ser eregado)*/
    var cae = $('#cae').val();
    var fecha_vencimiento_cae = $('#fecha_vencimiento_cae').val();
    console.log(cae+", "+fecha_vencimiento_cae+", id_pedido:"+id_pedido);
    $.ajax({
        dataType: 'json', url: "/admin/pedidos/create",
        data: {
            ingresar_cae:true,
            cae: cae,
            fecha_vencimiento_cae: fecha_vencimiento_cae,
            pedido_id: id_pedido,
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
            if(recibido!=null){
                $('#modal-ingresar-cae-despues').modal('hide');
                $('#mensajeExito').html();
                $('#botonExito').click();
            }
        }
    })
}

var token = $("#token-edit").val();
function actualizarProgreso(){
    $.ajax({
        dataType: 'JSON', url: "/admin/pedidos/create", /*no se como enviar a edit o update y que ande :(*/
        data: {
            headers: {"X-CSRF-TOKEN": token},
            progreso: $('#progreso').val(),
            pedido_id: $('#pedido_id').val(),
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
            window.location.reload(false);

        }
    })
}

/** Al presionar 'Abonar restante con Cheque' cargar el cheque con la info del cliente y el pedido*/
function rellenarModalCheque_2(){
    $('#modal-confirmar').modal('hide');
    var cliente_id = $('#cliente_oculto_id').val();    //campo invisible en 'showPedido.blade'
    var restaAbonar_oculto = $('#restaAbonar_oculto').val();
    $.ajax({
        url: "/admin/clientes",
        data: {
            id:cliente_id,
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var respuesta = JSON.parse(data);
            console.log(respuesta);
            if(respuesta.responiva == 'Consumidor Final'){
                alert('No se permite el pago con cheque a clientes en carácter de "Consumidor Final"');
            }
            else{
                $('#nombre_cheque').val(respuesta.n);
                $('#apellido_cheque').val(respuesta.a);
                $('#empresa_cheque').val(respuesta.empresa);
                $('#cuit_cheque').val(respuesta.dni);
                $('#monto_cheque').val(restaAbonar_oculto);
                $("#modal-create-cheque-2").modal();              //Abrir el modal de cheque
            }
        }
    });
    //}
    //else{
    //  alert('No se puede pagar con cheque una seña, solo totalidad');
    //}
}

/**** Actualizar hora constantemente****/
setInterval(function() {
    var currentTime = new Date ( );
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
    document.getElementById("hora_actual").innerHTML = currentTimeString;
}, 1000);




