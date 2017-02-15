<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<p><h1><strong>Gracias por confiar en nosotros! </strong></h1></p>

<p><h2><strong>Esta es la información de su pedido tomado el  {{$fecha_hoy}} a nombre de {{$cliente}} </strong></h2></p>
<br>

Productos:
<?php
    foreach($items as $item){
        echo $item['nombre'];
    }
?>

<p><strong>Monto del Pedido: ${{$total}}</strong></p>
<p><strong>Fecha de retiro: {{$fecha_entrega}}</strong></p>
</body>
</html>