<?php

//Si no está definida alguna variable de tipo $_SESSION se inicializa
if(!isset($_SESSION)) {
    session_start();
}


include 'ConexionBD/config.php';
include 'ConexionBD/bdConexion.php';
include 'carrito.php';
include 'Plantillas/cabecera.php';


?>
        <br>
        <div class="alert alert-info" role="alert">
              
            <!--  Comprobamos con el método POST que la información del formulario se esté enviando     -->
            <?php //print_r($_POST); 
                echo $mensaje;
            ?>

            <a href="#" class="badge badge-info">Ver Carrito</a> 
        </div>
        
        <div class="row">

            <!-- Consulta a la BD -->
            <?php
                //Consulta a la tabla productos
                $consulta = $pdo->prepare("SELECT * FROM `productos`");
                //Ejecuta consulta
                $consulta->execute();
                $listaProductos = $consulta->fetchAll(PDO::FETCH_ASSOC);
                //print_r($listaProductos);
            ?>

            <!-- Mostrar Productos en el índice de la página de la tienda -->
        
            <?php foreach($listaProductos as $producto){?>
                <div class="col-3">
                    <div class="card">
                        <img  title=<?php echo $producto['nombre'] ?> alt=<?php echo $producto['nombre'] ?> class="card-img-top" 
                        src="<?php echo $producto['imagen'] ?>" data-toggle="popover"
                        data-trigger="hover" 
                        data-content="<?php echo $producto['descripcion']?>"
                        height="270px"
                        width="200px"
                        >

                        <div class="card-body">
                            <span><?php echo $producto['nombre'] ?></span>
                            <h5 class="card-title">$<?php echo $producto['precio']  ?></h5>
                            <p class="card-text"><?php echo $producto['descripcion']?></p>

                            <!-- Formulario para enviar info (encriptada) utilizando el método 'openssl_ecrypt', sobre los productos ingresados al carrito -->
                            <form action="" method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['id'], COD, KEY)?>">
                                <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['nombre'], COD, KEY)?>">
                                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['precio'], COD, KEY) ?>">
                                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY) ?>">

                                <button class="btn btn-primary" 
                                name="btnAccion" 
                                value="Agregar" 
                                type="submit">Agregar al carrito
                                </button>

                            </form>
                            
                        </div>
                    </div>
                </div>

            <?php }?>
            
        </div> 

    <script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    </script>
    

    <?php
        include 'Plantillas/pie.php';
    ?>