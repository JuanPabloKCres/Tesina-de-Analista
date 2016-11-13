function constructorSelect(){
    $('.selectBoot').selectpicker({
		style: 'btn-white'
    });
}

function constructorTabla(){
    $('.dataTable').DataTable({
        responsive: true,
        "language": {
            "url": "/js/spanish.json"
        }
    });
}
