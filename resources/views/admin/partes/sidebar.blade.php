
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll" id="side-la">
                <ul id="side-menu" class="nav">
                    <div class="clearfix"></div>


                        <li id="li1" ><a data-toggle="tooltip" data-placement="right" title="Visualizar los Registros de Usuario" href="{{ route('admin.usuarios.index') }}">
                            <i class="fa fa-users fa-fw">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Usuarios</span></a>
                        </li>
                        <li id="li98" ><a data-toggle="tooltip" data-placement="right" title="Visualizar los Roles de Usuario" href="{{ route('admin.roles.index') }}">
                                <i class="fa fa-credit-card fa-fw">
                                    <div class="icon-bg bg-orange"></div>
                                </i>
                                <span class="menu-title">Roles</span></a>
                        </li>


                        <!--
                        <li id="li3">
                            <a data-toggle="tooltip" data-placement="right" title="Visualizar los registros de rubros de proveedores" >
                                <i class="fa fa-industry">
                                    <div class="icon-bg bg-orange"></div>
                                </i>
                                <span class="menu-title">Rubros de Proveedores</span>
                            </a>
                        </li>
                        -->


                    <li id="li4">
                        <a data-toggle="tooltip" data-placement="right" title="Editar parámetros de la gráfica" href="{{ route('admin.materiales.index') }}">
                            <i class="fa fa-cogs">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Parámetros generales</span>
                        </a>
                    </li>



                    <li id="li99">
                        <a data-toggle="tooltip" data-placement="right" title="Localidades, Provincias, Paises" href="{{ route('admin.paises.index') }}">
                            <i class="fa fa-map-marker">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Localidades</span>
                        </a>
                    </li>



                    <li id="li5">
                        <a data-toggle="tooltip" data-placement="right" title="Visualizar los registros de proveedores" href="{{ route('admin.proveedores.index') }}">
                            <i class="fa fa-truck">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Proveedores</span>
                        </a>
                    </li>


                    <li id="li6">
                        <a data-toggle="tooltip" data-placement="right" title="Ver Articulos listos para la venta, o diseñar nuevos" href="{{ route('admin.articulos.index') }}">
                            <i class="fa fa-tags">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Articulos Diseñados</span>
                        </a>
                    </li>



                    <li id="li14">
                        <a data-toggle="collapse" href="#dropdown-Insumos" data-placement="right" title="Visualizar los registros de artículos" >
                            <i class="fa fa-puzzle-piece">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Stock Insumos</span>
                        </a>
                        <div id="dropdown-Insumos" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="{{ route('admin.insumos.index') }}">
                                            <span class="menu-title">Gestión de Insumos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.compras.index') }}">
                                            <span class="menu-title">Compra de Insumos</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>



                    <li id="li7">
                        <a data-toggle="tooltip" data-placement="right" title="Ir a los registros de nuestros clientes" href="{{ route('admin.clientes.index') }}">
                            <i class="fa fa-child">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Clientes</span>
                        </a>
                    </li>


                    <li id="li8">
                        <a data-toggle="tooltip" data-placement="right" title="Visualizar los registros de pedidos" href="{{ route('admin.pedidos.index') }}">
                            <i class="fa fa-pencil-square-o">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Pedidos</span>
                        </a>
                    </li>
                    <li id="li9">
                        <a data-toggle="tooltip" data-placement="right" title="Visualizar el historial de ventas" href="{{ route('admin.estadisticas.index') }}">
                            <i class="fa fa-archive">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Información de Ventas</span>
                        </a>
                    </li>



                        <li id="li10">
                        <a data-toggle="tooltip" data-placement="right" title="Visualizar los registros de caja" href="{{ route('admin.cajas.registrosCajas') }}">
                            <i class="fa fa-money">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Registros de cajas</span>
                        </a>
                    </li>
                    <li id="li11">
                        <a data-toggle="tooltip" data-placement="right" title="Abrir Caja" href="{{ route('admin.cajas.index') }}">
                            <i class="fa fa-calculator">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Caja</span>
                        </a>
                    </li>


                    <li id="li13">
                        <a data-toggle="collapse" href="#dropdown-administrarFront" data-placement="right" title="Gestión de contenido de la web de GN Soluciones">
                            <i class="fa fa-mixcloud">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Administrar Sitio Web</span>
                        </a>
                        <!-- Dropdown level 1 -->
                        <div id="dropdown-administrarFront" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="nav navbar-nav">
                                    <li>
                                        <a href="{{ route('admin.tipos.index') }}">
                                            <span class="menu-title">Tipos de Producciones</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.productos.index') }}">
                                            <span class="menu-title">Publicar Producto</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li id="li12">
                        <a data-toggle="tooltip" data-placement="right" title="Controlar uso del sistema y accciones realizadas" href="{{ route('admin.auditorias.index') }}">
                            <i class="fa fa-eye">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Auditoria</span>
                        </a>
                    </li>

                    <li id="li14">
                        <a data-toggle="tooltip" data-placement="right" title="Controlar uso del sistema y backup de la información almacenada" onclick="backup()"  href="{{--  route('admin.backup.index') --}}">
                            <i class="fa fa-database">
                                <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Respaldo de datos</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>




<script type="text/javascript">
        function backup(){
            var enlace_factura = 'http://localhost/backupGN/hacer_backup.php';
            window.open(enlace_factura);
        }
</script>
