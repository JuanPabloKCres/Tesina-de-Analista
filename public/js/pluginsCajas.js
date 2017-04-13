/** Reporte parcial de caja */
function reporte_caja(){
    var numLi = 0;
    var lineas = [];
    var caja = {
        fecha_apertura:null, hora_apertura:null,
        fecha_cierre:null, hora_cierre:null,
        user_apertura:null,     user_cierre: $('#userCierre_id').val(),
        saldo_inicial:null, ingresos:null, egresos:null, saldo_cierre:null, saldo_actual:null,
        movimientos: [],
    };

    $('#tab-movimientos tbody tr').each(function () {
        var dataFila = $('#tab-movimientos').DataTable().row(this).data();
        var linea = {concepto: dataFila[0], fecha: dataFila[1], tipo: dataFila[2], monto: dataFila[3], usuario: dataFila[4]};
        lineas [numLi] = linea;
        caja.movimientos[numLi] = linea;
        numLi++;
    });

    $.ajax({
        dataType: 'json', url: "/admin/cajas",
        data: {
            caja_id: $('#caja_id').val(),
            userCierre_id: $('#userCierre_id').val(),
        },
        success: function (data) {
            console.log(data);
            var data_caja = JSON.parse(data);
            caja.fecha_apertura = data_caja.fecha_apertura;     caja.hora_apertura = data_caja.hora_apertura;
            caja.user_apertura = data_caja.user_apertura;                 //OK
            caja.fecha_cierre = data_caja.fecha_cierre;     caja.hora_cierre = data_caja.hora_cierre;

            caja.user_cierre = 'null';
            caja.saldo_inicial = data_caja.saldo_inicial;
            caja.ingresos = data_caja.ingresos;
            caja.egresos = data_caja.egresos;
            caja.saldo_cierre = data_caja.saldo_cierre;
            caja.saldo_actual = data_caja.saldo_actual;
            caja.movimientos= lineas;
            var array = JSON.stringify(caja);
            var enlace_caja = 'http://localhost/GN/EditableInvoice/reporte-caja.php?&datos_caja=' + encodeURIComponent(array);
            window.open(enlace_caja);
        }
    });
}

/** Reporte cierre de caja */
$("#form-actualizar").submit(function (e) {
    reporte_cierre_caja();
});






function reporte_cierre_caja(){
    var numLi = 0;
    var lineas = [];
    var caja = {
        fecha_apertura:null, hora_apertura:null,
        fecha_cierre:null, hora_cierre:null,
        user_apertura:null,     user_cierre: $('#userCierre_id').val(),
        saldo_inicial:null, ingresos:null, egresos:null, saldo_cierre:null, saldo_actual:null,
        movimientos: [],
    };

    $('#tab-movimientos tbody tr').each(function () {
        var dataFila = $('#tab-movimientos').DataTable().row(this).data();
        var linea = {concepto: dataFila[0], fecha: dataFila[1], tipo: dataFila[2], monto: dataFila[3], usuario: dataFila[4]};
        lineas [numLi] = linea;
        caja.movimientos[numLi] = linea;
        numLi++;
    });

    $.ajax({
        dataType: 'json', url: "/admin/cajas",
        data: {
            caja_id: $('#caja_id').val(),
            userCierre_id: $('#userCierre_id').val(),
        },
        success: function (data) {
            console.log(data);
            var data_caja = JSON.parse(data);
            caja.fecha_apertura = data_caja.fecha_apertura;     caja.hora_apertura = data_caja.hora_apertura;
            caja.user_apertura = data_caja.user_apertura;                 //OK
            caja.fecha_cierre = $('#fecha_cierre').val();     caja.hora_cierre = $('#hora_cierre').val();

            if($('#userCierre_id').val() == ''){
                caja.user_cierre = 'null';
            }else{
                caja.user_cierre = data_caja.user_cierre;
            }
            caja.saldo_inicial = data_caja.saldo_inicial;
            caja.ingresos = data_caja.ingresos;
            caja.egresos = data_caja.egresos;
            caja.saldo_cierre = data_caja.saldo_cierre;
            caja.saldo_actual = data_caja.saldo_actual;
            caja.movimientos= lineas;
            var array = JSON.stringify(caja);
            var enlace_caja = 'http://localhost/GN/EditableInvoice/reporte-caja.php?&datos_caja=' + encodeURIComponent(array);
            window.open(enlace_caja);
        }
    });
}