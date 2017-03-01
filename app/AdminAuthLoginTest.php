<?php
/**
 * Created by PhpStorm.
 * User: Juampy
 * Date: 01/03/2017
 * Time: 14:59
 */

namespace App;



class AdminAuthLoginTest extends TestCase
{
    /**
     * @var FakerGenerator
     */
    protected $faker;

    /**
     * Setup faker
     */
    public function setUp()
    {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
    }
    /**
     * My test implementation
     */
    public function testMiddlewareIsErgonomic()
    {
        $this->visit('/admin/auth/login');
        $this->type($this->faker->email, 'email');
        $this->type($this->faker->firstname, 'password');
        $this->press('Ingresar');
        $this->seePageIs('/admin/auth/login');
        $this->type('jpaulnava@gmail.com', 'email');
        $this->type('456456', 'password');
        $this->press('Ingresar');
        $this->seePageIs('/admin/pedidos');
        $this->press('Clientes');
        $this->seePageIs('/admin/pedidos');
        $this->visit('/admin/clientes');
        $this->press('Registrar nuevo cliente');
        $this->type($this->faker->name, 'apellido');
        $this->type($this->faker->email, 'apellido');
        $this->type($this->faker->name, 'apellido');
        $this->type('Kasey Lebsack', 'apellido');
        $this->type($this->faker->name, 'nombre');
        $this->type($this->faker->firstname, 'nombre');
        $this->press('campo requerido');
        $this->select('3', 'responiva_id');
        $this->type($this->faker->name, 'dni');
        $this->type($this->faker->email, 'dni');
        $this->type('36019985', 'dni');
        $this->press('seleccione un pais..');
        $this->select('1', 'pais_id');
        $this->select('9', 'provincia_id');
        $this->select('5', 'provincia_id');
        $this->select('6', 'provincia_id');
        $this->type($this->faker->name, 'direccion');
        $this->type('Deshaun Kuhlman 554', 'direccion');
        $this->type($this->faker->name, 'telefono');
        $this->type($this->faker->name, 'email');
        $this->type($this->faker->email, 'email');
        $this->press('Crear registro');
        $this->seePageIs('/admin/clientes');
        $this->visit('/admin/articulos');
        $this->visit('/admin/articulos/create');
        $this->press('Aromatizante \"lavanda\" liquido');
        $this->press('Aromatizante \"lavanda\" liquido');
        $this->select('18', 'insumo_id');
        $this->type($this->faker->email, 'number');
        $this->type('1', 'number');
        $this->press('Agregar');
        $this->press('Agregar');
        $this->type($this->faker->email, 'nombre');
        $this->type('Llavero personalizado 44mm', 'nombre');
        $this->press('Seleccione un tipo de articulo..');
        $this->select('1', 'tipo_id');
        $this->type('300', 'margen');
        $this->press('0');
        $this->select('1', 'iva');
        $this->press('Submit');
        $this->press('Registrar Articulo, estoy seguro.');
        $this->seePageIs('/admin/articulos');
        $this->visit('/admin/pedidos');
        $this->visit('/admin/pedidos/create');
        $this->press('Seleccione un cliente registrado...');
        $this->select('11', 'null');
        $this->type($this->faker->name, 'fecha_entrega_tentativa');
        $this->type($this->faker->email, 'fecha_entrega_tentativa');
        $this->type('2017-03-03', 'fecha_entrega_tentativa');
        $this->press('Calendario A3 full color');
        $this->press('Llavero personalizado 44mm');
        $this->select('20', 'articulo_id');
        $this->type('15', 'number');
        $this->press('Agregar');
        $this->press('Submit');
        $this->press('Registrar como pedido');
        $this->press('');
        $this->press('Cerrar');
    }
}
