<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Document</title>
</head>
<body>
<h1>Gracias por tu pedido !</h1>
<h2>{{$cliente}}, éste es el detalle de su pedido:</h2>
@foreach($items as $item)
    <p>{{ $item['articulo_nombre'] }} x {{ $item['cantidad'] }} unidades (precio unitario {{ $item['precio_unitario'] }}) }}</p>
@endforeach

    <p><strong>Monto del Pedido: ${{$total}} (ha abonado ${{$sena}})</strong></p>
    <p><strong>Fecha de retiro: {{$request->fecha_entrega}}</strong></p>
*Este mensaje es autogenerado. No requiere contestación.
</body>
</html>
