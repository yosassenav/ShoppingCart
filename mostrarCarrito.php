<?php

include 'ConexionBD/config.php';
include 'carrito.php';
include 'Plantillas/cabecera.php';
?>


<br>
<!-- Aquí muestran productos agreegados al carrito de compras -->
<h3> Lista de compras </h3>

<?php
    //Revisamos si ya existe algún producto en la sesión 'CARRITO'
if(!empty($_SESSION['CARRITO'])) {?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%"> Descripción </th>
            <th width="15%" class="text-center"> Cantidad </th>
            <th width="20%" class="text-center"> Precio </th>
            <th width="20%" class="text-center"> Total </th>
            <th width="5%"> -- </th>
        </tr>

        <!--              Desplegar los productos seleccionados guardados en la sesión carrito                            -->

        <?php $total=0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?> 
        <tr>
            <td width="40%"> <?php echo $producto['NOMBRE']; ?> </td>
            <td width="15%" class="text-center"> <?php echo $producto['CANTIDAD']; ?> </td>
            <td width="20%" class="text-center"> <?php echo $producto['PRECIO']; ?> </td>
            <td width="20%" class="text-center"> <?php echo number_format($producto['CANTIDAD']*$producto['PRECIO'],2); ?> </td>

            <!--   BOTÓN ELIMINAR PRODUCTO DEL CARRITO, para el cual se requiere el 'id' para eliminarlo -->
            <form action="" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY)?>">
                <td width="5%"> 
                    <button class="btn btn-danger" 
                    name="btnAccion" 
                    value="Eliminar" 
                    type="submit"> Eliminar </button> 
                </td>
            </form>
            
        </tr>
        <!--   actualizando la variable total    -->
        <?php $total = $total + ($producto['CANTIDAD']*$producto['PRECIO']); ?>
        <?php } ?>
        

        <tr>
            <td colspan="3" align="right"> <h2> Total </h2></td>
            <td align="right"> <h2> $ <?php  echo number_format($total,2) ?> </h2> </td>
            <td></td>
        </tr>
        
    </tbody>
</table>
<?php } 
// en caso de estar vacío el carrito se envía un mensaje
else{ ?>

    <div class="alert alert-success" role="alert">
        No hay productos en el carrito.
    </div> 
<?php }?>

<?php
include 'Plantillas/pie.php';
?>