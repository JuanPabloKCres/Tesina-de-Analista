<h3>Detalles del registro</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Nombre</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                     <input class="form-control" type="text" name="nombre" id="nombre_rol" required>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <input type="checkbox" data-toggle="toggle"  id="rol-usuarios_roles" data-on="Si" data-off="No">
                Usuarios y Roles
        </div>
        <br>
        <div class="row">
            <input type="checkbox" data-toggle="toggle"  id="rol-parametros" data-on="Si" data-off="No">
            Parametros Generales
        </div><br>
        <div class="row">
            <input type="checkbox" data-toggle="toggle"  id="rol-insumos-compras" data-on="Si" data-off="No">
            Gestión de Insumos
        </div><br>
        <div class="row">
            <input type="checkbox" data-toggle="toggle"  data-on="Si" data-off="No" id="rol-articulos">
            Diseño de Producciones
        </div><br>
        <div class="row">
            <input type="checkbox" data-toggle="toggle" data-on="Si" data-off="No" id="rol-proveedores">
            Rubros y Proveedores
        </div><br>
        <div class="row">
            <input type="checkbox" data-toggle="toggle"  data-on="Si" data-off="No" id="rol-clientes">
            Gestión de Clientes
        </div><br>

        <div class="row">
            <input type="checkbox" data-toggle="toggle"  data-on="Si" data-off="No" id="rol-ventas">
            Ventas
        </div><br>
        <div class="row">
            <input type="checkbox" data-toggle="toggle"  data-on="Si" data-off="No" id="rol-cajas">
            Registros de Caja
        </div><br>
        <div class="row">
            <input type="checkbox" data-toggle="toggle"  data-on="Si" data-off="No" id="rol-auditoria">
            Auditoria y Backup
        </div><br>
        <div class="row">
            <input type="checkbox" data-toggle="toggle"  data-on="Si" data-off="No" id="rol-administracion-web">
            Administracion de publicaciónes en la Web
        </div><br>
    </div>
</div>

<br>
<hr/>
<br>
<button type="button" data-dismiss="modal" id="btn-crear_rol" class="btn btn-green btn-block">Registrar Rol</button>
<button type="button" data-dismiss="modal" id="btn-crear_rol-cerrar"  class="btn btn-white btn-block">
    Cerrar</button>