$("#btn-crear_rol").click(function () {
    var usuarios_roles = false;
    var parametros = false;
    var insumos_compras = false;
    var articulos = false;
    var proveedores_rubros = false;
    var clientes = false;
    var ventas = false;
    var cajas = false;
    var auditorias = false;
    var adminweb = false;

    if ($('input:checkbox[id=rol-usuarios_roles]:checked').val()) {
        usuarios_roles = true;
    }
    if ($('input:checkbox[id=rol-parametros]:checked').val()) {
        parametros = true;
    }
    if ($('input:checkbox[id=rol-insumos-compras]:checked').val()) {
        insumos_compras = true;
    }
    if ($('input:checkbox[id=rol-articulos]:checked').val()) {
        articulos = true;
    }
    if ($('input:checkbox[id=rol-proveedores]:checked').val()) {
        proveedores_rubros = true;
    }
    if ($('input:checkbox[id=rol-clientes]:checked').val()) {
        clientes = true;
    }
    if ($('input:checkbox[id=rol-ventas]:checked').val()) {
        ventas = true;
    }
    if ($('input:checkbox[id=rol-cajas]:checked').val()) {
        cajas = true;
    }
    if ($('input:checkbox[id=rol-auditoria]:checked').val()) {
        auditorias = true;
    }
    if ($('input:checkbox[id=rol-administracion-web]:checked').val()) {
        adminweb = true;
    }

    console.log(usuarios_roles+parametros+insumos_compras+articulos+proveedores_rubros+clientes+ventas+cajas+auditorias+adminweb);
    /** Ajax Request --Crear Rol-->RolController */
    $.ajax({
        dataType: 'json', url: "/admin/roles/create",
        data: {
            nombre: $('#nombre_rol').val(),
            usuarios_roles: usuarios_roles,
            parametros: parametros,
            insumos_compras: insumos_compras,
            articulos: articulos,
            proveedores_rubros: proveedores_rubros,
            clientes: clientes,
            ventas: ventas,
            cajas: cajas,
            auditorias: auditorias,
            adminweb: adminweb
        },
        success: function (data) {
            console.log(data);
        }
    });
});




