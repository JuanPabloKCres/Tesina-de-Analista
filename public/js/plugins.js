function constructorSelect(){
    $('.selectBoot').selectpicker({
		style: 'btn-white'
    });
}

function constructorTabla(){
    $('.dataTable').DataTable({
        responsive: true,
        "pageLength": 20,
        "language": {
            "url": "/js/spanish.json"
        }

    });
}
//Datatables - filtro individuales - instanciación de los filtros
$('#example tfoot th').each(function () {
    var title = $(this).text();
    if (title !== 'Acciones') { //ignoramos la columna de los botones
        $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
    }
});

//Datatables - filtro individuales - búsqueda
$('#example tbody tr').columns().every(function () {
    var that = this;
    $('input', this.footer()).on('keyup change', function () {
        if (that.search() !== this.value) {
            that.search(this.value).draw();
        }
    });
});

//Datatables - asocio el evento sobre el body de la tabla para que resalte fila y columna
$('#example tbody').on('mouseenter', 'td', function () {
    var colIdx = table.cell(this).index().column;
    $(table.cells().nodes()).removeClass('highlight');
    $(table.column(colIdx).nodes()).addClass('highlight');
});