<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers
        ([
            'App\Http\ViewComposers\ConfiguracionComposer' => 'admin.configuracion.contenidoForm',
            'App\Http\ViewComposers\InterfazComposer' => 'admin.partes.navTop',

            'App\Http\ViewComposers\ArticuloComposer' => ['admin.articulos.contenidoForm', 'admin.articulos.cabeceraTabla', 'front.articulos.cabeceraTabla'],
            'App\Http\ViewComposers\ProveedorComposer' => ['admin.proveedores.contenidoForm', 'admin.proveedores.cabeceraTabla'],
            'App\Http\ViewComposers\ClienteComposer' => ['admin.clientes.contenidoForm', 'admin.clientes.cabeceraTabla'],
            'App\Http\ViewComposers\ClientesComposer' => ['admin.pedidos.clienteSelect'],
            'App\Http\ViewComposers\ArticulosComposer' => ['admin.articuloVenta.contenidoForm'],
            'App\Http\ViewComposers\ProductoComposer' => ['admin.productos.contenidoForm', 'admin.productos.cabeceraTabla', 'front.productos.cabeceraTabla'],
            'App\Http\ViewComposers\TipoComposer' => ['admin.publicacionesFront.productos.contenidoForm', 'admin.publicacionesFront.tipos.cabeceraTabla', 'front.tipos.cabeceraTabla'],

            'App\Http\ViewComposers\ProductoFrontComposer' => 'front.productos.cabeceraTabla',
            'App\Http\ViewComposers\ProductoFrontIndexComposer' => 'front.partes.productos',
            'App\Http\ViewComposers\TipoFrontIndexComposer' => 'front.partes.tipos',
            'App\Http\ViewComposers\TipoParaFrontComposer' => 'front.partes.tipos',

            /** Noviembre 19**/
            'App\Http\ViewComposers\InsumoComposer' => ['admin.insumos.contenidoForm', 'admin.insumos.cabeceraTabla', 'front.insumos.cabeceraTabla'],

            /** Noviembre 24 **/
            'App\Http\ViewComposers\ProveedoresComposer' => ['admin.compras.proveedorSelect' , 'admin.insumoCompra.contenidoForm', 'admin.insumoArticulo.contenidoForm'],
            'App\Http\ViewComposers\InsumosComposer' => ['admin.insumoCompra.contenidoForm' , 'admin.insumoArticulo.contenidoForm'],
        ]);
    }


    public function register()
    {
        //
    }
}
