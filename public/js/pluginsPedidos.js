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

//alert(id_cliente_pedidosPendientes);

$('#iva_select').prop('disabled',true);

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
$('#btn-pagarConCheque').prop('disabled',true);
$('#btn-pagarConCheque').prop('color', 'grey');

/*
 * Variables para cuando se cargan artículos en la tabla.
 *  var numFila: Esta variable identifica a una fila dentro de la tabla. Este dato se utiliza cuando se quiere eliminar un renglón de la tabla.
 *  var cantFilas: Esta es una variable de control. Se utiliza cuando se va a poceder con la registración de un pedido o venta. Si esta es igual a 0 (cero) no puede realizarce una registración.
 *  var montoPedido: En esta variable se va almacenando de manera actualizada el valor total del pedido. Es modificada cada vez que se agrega o elimina un renglón.
 *                   Es calculada a partir de los importes de los renglones.
 */
$('#sena').val("0");
var numFila = 0;
var cantFilas = 0;
var montoPedido = 0;
var montoTotal = 0;
var montoTotal_Absoludo = 0;
var pagarTotal = true;
var datos_cheque = null;      //array con datos del cheque
//Datos del cheque (en blanco)
var pagoCheque = false;
var nro_serie;
var banco;
var sucursal_banco;
var fecha_emision;
var fecha_cobro;


function validarFormCheque(){
    nro_serie = document.forms["form-crear"]["nro_serie"].value;
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

function cargarDatosCheque(){                           //valida y carga los datos del modal-cheque
    nro_serie = $('#nro_serie').val();
    banco = $('#banco').val();
    sucursal_banco = $('#sucursal').val();
    fecha_emision = $('#fecha_emision').val();
    fecha_cobro = $('#fecha_cobro').val();
    alert('Se cargaron datos del cheque para el pago');
    pagoCheque = true;
}

//var nro_serie_cheque = $('#nro_serie').val();
//var banco_cheque = $('#banco').val();
//var sucursal_banco_cheque = $('#sucursal').val();
//var fecha_emision_cheque = $('#fecha_emision').val();
//var fecha_cobro_cheque = $('#fecha_cobro').val();


/*
 * Funtion agregarContenido: Este método recibe parámetros para crear renglones () y crea
 * una nueva linea en la tabla de artículos. También agrega otros valores útiles para otros métodos
 * como el número de fila que se inserta y un link que dispara el método para borrar esa fila.
 * También incrementa el valor del monto del pedido a partir del importe del renglón.
 * La tabla funciona como un array y el 1º registro ocupa la posición 0 (cero).
 *
 * parseFloat: método de javascript para convertir a decimal la variable y usarla para el pertinente cálculo.
 */
function agregarContenido(articulo_select, nombre, cantidad_number, precioU_number, importe_number)
{
    var tPro = $('#tblListaProductos').DataTable();
    cantFilas++;
    numFila++;
    valorItemNeto = parseFloat(importe_number); //valor neto (valor*cantidad)
    //valorItemTotal = valorItemNeto + valorItemNeto * parseFloat($('#iva').val()) / 100; //valor con iva incluido
    valorItemTotal = valorItemNeto;
    montoPedido = montoPedido + valorItemNeto;
    montoTotal = montoTotal + valorItemTotal;
    montoTotal_Absoludo = montoTotal_Absoludo + valorItemTotal;
    tPro.row.add([
        numFila,
        articulo_select,
        nombre,
        cantidad_number,
        precioU_number,
        importe_number,
        //valorItemTotal,       #comentado el 19/01 15:21
        ' <a href="javascript:borrarFila(' + numFila + ');" data-toggle="modal"><i class="fa fa-lg fa-trash-o"></i> Borrar</a>   '
    ]).draw();
    $('#mp').html(montoPedido);
    $('#mt').html(montoTotal);
    limpiar();
    $('#cantidad_number').select();
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
            montoTotal = montoTotal - parseFloat(dataPla[6]);
            montoTotal_Absoludo = montoTotal_Absoludo - parseFloat(dataPla[6]);
        }
        Filas++;
    });
    $('#tblListaProductos').dataTable().fnDeleteRow(numFilaBorrar);
    $('#mp').html(montoPedido);
    $('#mt').html(montoTotal);
    cantFilas--;
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
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var d = JSON.parse(data);
                console.log(d);
                if(d.permitir){
                    agregarContenido(articulo_select, $('#articulo_select option:selected').text(), cantidad_number, precioU_number, importe_number);
                }
                else{
                    alert(d.mensaje + d.faltante+" unidades de "+ d.insumo+")");
                    document.getElementById("cantidad_number").style.color = "red";
                    $('#msjStock').removeClass("hide");
                    $("#cantidad_number").select();
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
    $('#cantidad_number').val("");
    $('#precioU_number').val("");
    $('#importe_number').val("");
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
$("#form-agregar").submit(function (e) {
    e.preventDefault();
    comprobar($('#articulo_select').val(), $('#cantidad_number').val(), $('#precioU_number').val(), $('#importe_number').val());
});

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
        if (pagarTotal) {
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
            tipo_cbte: $('#factura').val(),
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
        numLi++;
    });
    if (!pagarTotal) {
        montoTotal = $('#sena').val();
    }
    /**factura electrónica */
    if ($('input:checkbox[name=factura]:checked').val()) {
        $.ajax({    //en esta peticion se busca obtener los datos del cliente para confecc. la factura
            dataType: 'json',
            url: "/admin/clientes",
            data: {
                id: $('#cliente').val()
            },
            success: function (data) {
                console.log("De ClientesController se obtuvieron estos datos para FE: "+data); console.log("El monto total que se manda a FE es =" + montoTotal);
                var data_2 = JSON.parse(data);

                informacion_de_cliente = data_2;

                factura.tipo_cbte = data_2.tipo_cbte;   //OK
                factura.nro_doc = data_2.dni;           //OK
                if(data_2.empresa==null){   /**Si el cliente no tiene empresa*/
                    factura.nombre_cliente = data_2.nombre;         //grabar su nombre para la factura
                }else{
                    factura.nombre_cliente = data_2.empresa;         //sino grabar nombre de la empresa para la factura, descartar nombre de representante
                }
                factura.provincia_cliente = data_2.provincia;   //OK
                factura.localidad_cliente = data_2.localidad;   //OK
                factura.domicilio_cliente = data_2.domicilio;   //OK
                factura.imp_total = montoTotal;                 //OK
                factura.items = lineas;
                var array = JSON.stringify(factura);
                var enlace_factura = 'http://localhost/factura/dinamico-factura.php?&datos_factura=' + encodeURIComponent(array);
                window.open(enlace_factura);
              }
        });
    }
    console.log(lineas);
    console.log("la seña es: "+montoPedido);

    if(entregado){
        fecha_entrega_estimada = fechahoy();
    }
    else{
        fecha_entrega_estimada = $('#fecha_entrega_date').val();
    }
    /** Si se cargaron datos del cheque*/
    if(pagoCheque==false){
        alert('Se paga en efectivo');
    }else{
        alert('Se paga con cheque');
        console.log( "nro_serie: "+nro_serie+", banco: "+banco+", sucursal: "+sucursal_banco+" fecha_emision: "+fecha_emision+" ,fecha_cobro: "+fecha_cobro);
    }
    /** persistir venta o pedido */
    $.ajax({
        dataType: 'json', url: "/admin/pedidos/create", type: 'get',
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
            sena: montoPedido
        },
        success: function (data) {
            /* Una vez completado el proceso se muestra el mensaje de exito */
            console.log(data);
            emitirTicket(informacion_de_cliente);                 /**llamar a emitir nota de pedido (comprobante de transaccion para el cliente)*/
            $('#mensajeExito').html(data);
            $('#botonExito').click();
            email_notificacion_stockBajo();       /**llamar a email stock bajo*/

            /*bardo con el email_info_pedido_cliente? */
            if(entregado == false){             /**si el pedido no fue entregado en el acto, llamara enviar email con info de compra*/
                email_info_pedido_cliente(lineas, montoPedido, montoTotal_Absoludo, $('#usuarioPedido').val());
            }
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
            localidad_id: $('#localidad_id').val(),
            direccion: $('input:text[name=direccion]').val(),
            telefono: $('input:text[name=telefono]').val(),
            email: $('input:text[name=email]').val(),
            descripcion: $('#descripcion').val()
        },
        success: function (data) {
            $("#divCliente").html(data);
            $('#modal-create').modal('hide');
        }
    });
}

/** Function generarFactura: Este método se encarga de recoger ciertos datos de la vista y
 * enviarlos al archivo php que se encarga de realizar la facturación electrónica. (al convertir un pedido en una venta)*/
function generarFactura() {
    $('#form-crear').submit();
            $('#tblListaItems tbody tr').each(function () {
            var dataFila = $('#tblListaItems').DataTable().row(this).data();
            var item = {cantidad: dataFila[2], importe: dataFila[4], precio_unitario: dataFila[3], articulo: dataFila[1]};
            //factura.items [cantidadProductos] = item;
            cantidadProductos++;
        });
        var nada ="nada";
    $.ajax({    //en esta peticion se busca obtener los datos del cliente para confecc. la factura
        dataType: 'json', url: "/admin/clientes",
        data: {
            id: id_cliente_pedidosPendientes,
        },
        success: function (data) {
            console.log("De ClientesController se obtuvieron estos datos para FE: "+data);
            console.log("El monto total que se manda a la FE es =" + montoTotal);

            var factura = {
                iva: $('#iva').val(),
                tipo_cbte: $('#factura').val(),
                nro_doc: $('#cuit').val(),
                nombre_cliente: $('#nombreCliente').val(),
                domicilio_cliente: $('#direccion').val(),
                imp_total: $('#montoTotal').val(),
                items: []
            };

            console.log(factura);

            var data_2 = JSON.parse(data);
            factura.tipo_cbte = data_2.tipo_cbte;
            factura.nro_doc = data_2.dni;
            factura.nombre_cliente = data_2.nombre;
            factura.provincia_cliente = data_2.provincia;
            factura.localidad_cliente = data_2.localidad;
            factura.domicilio_cliente = data_2.domicilio;
            factura.imp_total = montoTotal;
            var array = JSON.stringify(factura);
            var enlace_factura = 'http://localhost/factura/dinamico-factura.php?&datos_factura=' + encodeURIComponent(array);
            window.open(enlace_factura);
        }
    });
    $('#form-crear').submit();      //actualiza el estado del pedido (pago completo, o entrega 'pedidos.update'
}
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
    mostrarPrecioArticulo(articulo_id);
    mostrarStockRemanente(articulo_id);
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
                option.text = "Insumo "+nro_item+": "+respuesta[i].insumo+" (stock: "+respuesta[i].cantidad_actual+ " "+respuesta[i].unidad+")"
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
function mostrarInfoTributaria(cliente_id){
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
            //$('#cliente').val($('#cliente').val() + respuesta.dni);
            $('#responiva_select').val(respuesta.responiva+" (Factura "+respuesta.tipo_cbte+")");
            if(respuesta.responiva == 'Consumidor Final'){
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
    if(pagarTotal == true){                       //si no se va a señar, permitir Pagar con Cheque
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
                    alert('No se permite el pago con cheque a clientes en carácter de "Consumidor Final"');
                }
                else{
                    $('#nombre_cheque').val(respuesta.n);
                    $('#apellido_cheque').val(respuesta.a);
                    $('#empresa_cheque').val(respuesta.empresa);
                    $('#cuit_cheque').val(respuesta.dni);
                    $('#monto_cheque').val(montoTotal);
                    $("#modal-create-cheque").modal();              //Abrir el modal de cheque
                }
            }
        });
    }
    else{
        alert('No se puede pagar con cheque una seña, solo totalidad');
    }
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
    var nro_comprobante = 0;
    var ticket = {                          /*El ticket es una 'nota de pedido'*/
        nro_comprobante: nro_comprobante,
        iva: $('#iva').val(),
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
            nro_comprobante = respuesta.comprobante_id;             //Funciona
        }
    });

    ticket.nro_comprobante = nro_comprobante;      //OK
    ticket.nro_doc = informacion_de_cliente.dni;                   //OK
    if(informacion_de_cliente.empresa==null){   /**Si el cliente no tiene empresa*/
        ticket.nombre_cliente = informacion_de_cliente.nombre;         //grabar su nombre para la factura
    }else{
        ticket.nombre_cliente = informacion_de_cliente.empresa;         //sino grabar nombre de la empresa para la factura, descartar nombre de representante
    }
    ticket.provincia_cliente = informacion_de_cliente.provincia;   //OK
    ticket.localidad_cliente = informacion_de_cliente.localidad;   //OK
    ticket.domicilio_cliente = informacion_de_cliente.domicilio;   //OK
    ticket.imp_total = montoTotal_Absoludo;
    ticket.items = lineas;
    var array = JSON.stringify(ticket);
    console.log(ticket);
    var enlace_ticket = 'http://localhost/factura/EditableInvoice/index.php?&datos_factura=' + encodeURIComponent(array);
    window.open(enlace_ticket);
}

/** Enviar email con datos de pedido al cliente despues de efectuado el pedido (solo si no se entrega el mismo en el acto) **/
function email_info_pedido_cliente(lineas, sena, total, user){
    var fecha_entrega_estimada = $('#fecha_entrega_date').val();
    var fecha_hoy = fechahoy();
    console.log('items: '+lineas);
    console.log(fecha_entrega_estimada, sena, total, user, fecha_hoy);
    $.ajax({
        url: "/admin/mail", dataType: 'json',
        data: {
            id_cliente: $('#cliente').val(),
            items:lineas,
            fecha_entrega:fecha_entrega_estimada,
            sena:sena, total:total,
            user:user ,
            fecha_hoy:fecha_hoy,
            email_info_pedido: true
        },
        success: function (data) {
            var recibido = JSON.parse(data);
            console.log(recibido);
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
    hoy = mm+'/'+dd+'/'+yyyy;
    return hoy;
}
