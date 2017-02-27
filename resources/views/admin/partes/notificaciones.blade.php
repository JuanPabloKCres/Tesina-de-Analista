<?php
    $array_fecha = getdate();
    $año = $array_fecha['year'];
    $mes = $array_fecha['mon'];
    $dia = $array_fecha['mday'];

    if(strlen ($mes)==1){                       #si mes tiene un digito anteponer un 0 al mes
        if(strlen ($dia)==1){                       #si dia tambien tiene un digito anteponer un 0 al dia
            $fecha_hoy = $año.'-0'.$mes.'-0'.$dia;
        }else{
            $fecha_hoy = $año.'-0'.$mes.'-'.$dia;
        }
    }else{
        if(strlen ($dia)==1){                       #si dia tiene un digito anteponer un 0 al dia
            $fecha_hoy = $año.'-'.$mes.'-0'.$dia;
        }else{
            $fecha_hoy = $año.'-'.$mes.'-'.$dia;
        }
    }
?>


<li role="presentation" class="dropdown">
    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope-o"></i>
        <span class="badge bg-green">
            <?php $i=0; ?>
            @foreach($pedidos as $pedido)
                @if($pedido->fecha_entrega_estimada == $fecha_hoy)
                        <?php $i++; ?>
                @endif
            @endforeach
            {{ $i }}
        </span>
    </a>
    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
        @foreach($pedidos as $pedido)
          @if($pedido->fecha_entrega_estimada == $fecha_hoy)
            @if($pedido->entregado == 0)
                <li>
                    <a>
                        <span>
                            <span><h4 class="text-facebook">Hay clientes que podrian retirar sus pedidos</h4></span>
                        </span>
                            <span class="message">
                                  <h5 class="text-filter-box">Hoy se debe entregar el pedido de {{$pedido->cliente->nombre}} {{$pedido->cliente->apellido}}, n° de pedido {{$pedido->id}} del {{$pedido->fecha_pedido}}</h5>
                            </span>
                    </a>
                </li>
            @endif
          @endif
        @endforeach
        <li>
            <div class="text-center">
                <a href="inbox.html">
                    <strong>Ver todas</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>
    </ul>
</li>