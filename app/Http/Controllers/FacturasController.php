<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class FacturasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            //$infoCompra = $request->factura;    //array recibido via Ajax desde vista pedidos
            //se comento para probar estaticamente si funciona
            /*
            $tipo_cbte = $infoCompra['tipo_cbte'];
            $tipo_doc = $infoCompra['tipo_doc'];
            $nro_doc = $infoCompra['nro_doc'];
            $nombre_cliente = $infoCompra['nombre_cliente'];
            $domicilio_cliente = $infoCompra['domicilio_cliente'];
            $imp_neto = $infoCompra['imp_neto'];
            $imp_iva = $infoCompra['imp_iva'];
            $imp_total = $infoCompra['imp_total'];
            */

            /*
            $process = new Process('cd E:/Things');
            $process->start();
            */

            $tipo_cbte = 1;
            $tipo_doc = 80;
            $nro_doc = 20344783854;
            $nombre_cliente = "Sergio Caballero";
            $domicilio_cliente = "Bolivar 362";
            $imp_neto = $infoCompra = 1000;
            $imp_iva = $infoCompra = 210;
            $imp_total = $infoCompra = 1210;

            //if($tipo_cbte !=''&& $tipo_doc !=''&& $nro_doc !=''&& $nombre_cliente !='' && $domicilio_cliente !='' && $imp_neto !='' && $imp_iva !='' && $imp_total !='')
            //{
                try{
                    $factura = array(
                        //'id' => 0,                     // identificador único (no obligatorio WSFEv1, solo para exportacion)
                        'punto_vta' => 4000,           //no tocar para homologacion, para produccion poner el punto de venta autorizado para WSFEv1
                        'tipo_cbte' => $tipo_cbte,              // 1: FA, 2: NDebitoA, 3:NCreditoA, 6: FB, 11: FC
                        'cbte_nro' => 0,               // solicitar proximo con /ult
                        'tipo_doc' => $tipo_doc,              // 96: DNI, 80: CUIT, 99: Consumidor Final
                        'nro_doc' => $nro_doc,    // Nro. de CUIT o DNI
                        'fecha_cbte' => date('Ymd'),   // Formato AAAAMMDD
                        'concepto' => 1,               // 1: Productos, 2: Servicios, 3/4: Ambos ****Siempre usaremos Productos (1)
                        'fecha_venc_pago' => NULL,
                        'nombre_cliente' => $nombre_cliente,
                        'domicilio_cliente' => $domicilio_cliente,
                        'moneda_ctz' => 1,   // 1 para pesos
                        'moneda_id' => 'PES',  // 'PES': pesos, 'DOL': dolares (solo exportacion)
                        'obs_comerciales' => 'Observaciones Comerciales, texto libre',
                        'obs_generales' => 'Observaciones Generales, texto libre',
                        'forma_pago' => '30 dias',

                        // importes subtotales generales:
                        'imp_neto' => $imp_neto,            // neto gravado
                        'imp_iva' => $imp_iva,              // IVA liquidado
                        'imp_total' => $imp_total,           // total de la factura
                        'imp_tot_conc' => NULL,
                        'imp_op_ex' => 0,
                        // Datos devueltos por AFIP (completados luego al llamar al webservice):
                        'cae' => '',                       // ej. '61123022925855'
                        'fecha_vto' => '',                 // ej. '20110320'
                        'motivos_obs' => '',               // ej. '11'
                        'err_code' => '',                  // ej. 'OK'
                        'descuento' => 0,

                        'detalles' => array (
                            array(
                                'qty' => 1,                    // cantidad
                                'umed' => 7,                   // unidad de medida
                                'codigo' => NULL,
                                'ds' => 'Descripcion del producto P0001',
                                //'precio' => 100,
                                'precio' => NULL,
                                'importe' => 121,
                                //'imp_iva' => 21,
                                'imp_iva' => NULL,
                                'iva_id' => 5,                 // tasa de iva 5: 21%
                                'u_mtx' => NULL,             // unidad MTX (packaging)
                                'cod_mtx' => NULL,    // código de barras para MTX
                                'despacho' => NULL,
                                'dato_a' => NULL, 'dato_b' => NULL, 'dato_c' => NULL,
                                'dato_d' => NULL,'dato_e' => NULL,
                                'bonif' => 0,
                            ),
                        ),
                        'ivas' => array (
                            array(
                                'base_imp' => 100,
                                'importe' => 21,
                                'iva_id' => 5,
                            ),
                        ),
                        // Comprobantes asociados (solo notas de crédito y débito):
                        //'cbtes_asoc' => array (
                        //   array('cbte_nro' => 1234, 'cbte_punto_vta' => 2, 'cbte_tipo' => 91, ),
                        //   array('cbte_nro' => 1234, 'cbte_punto_vta' => 2, 'cbte_tipo' => 5, ),
                        // ),
                        'tributos' => array (
                            array(
                                'alic' => '0.00',
                                'base_imp' => '0',
                                'desc' => 'Impuesto Municipal Resistencia',
                                'importe' => '0.00',
                                'tributo_id' => 99,
                            ),
                        ),
                        'permisos' => array (),
                        'datos' => array (),
                    );

                } catch (Exception $e) {
                    echo $e;
                }

                // Guardar el archivo json para consultar la ultimo numero de factura:
                try {
                    $json = file_put_contents('./factura.json', json_encode(array($factura)));
                } catch (Exception $e) {
                    echo $e;
                }


                // Obtener el último número para este tipo de comprobante / punto de venta:
                try {
                    exec("C:\\xampp\\htdocs\\factura\\pyafipws\\python ./pyafipws/rece1.py ./pyafipws/rece.ini /json /ult 1 4000");
                } catch (Exception $e) {
                    echo $e;
                }

                try{
                    $json = file_get_contents('./salida.json');
                    $facturas = json_decode($json, True);
                }catch(Exception $e){
                    echo $e;
                }


                // leo el ultimo numero de factura del archivo procesado (salida)
                $cbte_nro = intval($facturas[0]['cbt_desde']) + 1;
                echo "Proximo Numero: ", $cbte_nro, "\n\r";

                // Vuelvo a guardar el archivo json para actualizar el número de factura:
                $factura['cbt_desde'] = $cbte_nro;  // para WSFEv1
                $factura['cbt_hasta'] = $cbte_nro;  // para WSFEv1
                $factura['cbte_nro'] = $cbte_nro;   // para PDF
                $json = file_put_contents('./factura.json', json_encode(array($factura)));

                // Obtención de CAE: llamo a la herramienta para WSFEv1
                try {
                    exec("C:\\xampp\\htdocs\\factura\\pyafipws\\python ./pyafipws/rece1.py ./pyafipws/rece.ini /json");
                } catch (Exception $e) {
                    echo $e;
                }


                // Ejemplo para levantar el archivo json con el CAE obtenido:
                try{
                    $json = file_get_contents('./salida.json');
                    $facturas = json_decode($json, True);
                }catch(Exception $e){
                    echo $e;
                }

                // leo el CAE del archivo procesado
                echo "CAE OBTENIDO: ", $facturas[0]['cae'], "\n\r";
                echo "\nObservaciones: ", $facturas[0]['motivos_obs'], "\n\r";
                echo "Errores: ", $facturas[0]['err_msg'], "\n\r";

                // Vuelvo a guardar el archivo json para actualizar el CAE y otros datos:
                $factura['cae'] = $facturas[0]['cae'];
                $factura['fecha_vto'] = $facturas[0]['fch_venc_cae'];
                $factura['motivos_obs'] = $facturas[0]['motivos_obs'];
                $factura['err_code'] = $facturas[0]['err_code'];
                $factura['err_msg'] = $facturas[0]['err_msg'];

                try{
                    $json = file_put_contents('./factura.json', json_encode(array($factura)));
                }catch(Exception $e){
                    echo $e;
                }

                // Genero la factura en PDF (agregar --mostrar si se tiene visor de PDF)
                try {
                    exec("C:\\xampp\\htdocs\\factura\\pyafipws\\python ./pyafipws/pyfepdf.py ./pyafipws/rece.ini --cargar --json --mostrar ");
                    // leer factura.pdf o similar para obtener el documento generado. TIP: --mostrar
                } catch (Exception $e) {
                    echo $e;
                }
            //}

        }
    }
}
