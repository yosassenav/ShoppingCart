<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['CARRITO'])){
    $_SESSION['CARRITO']=array();
}

$mensaje=" ";

//Evaluar botón 'Agregar al carrito' por medio de su atributo 'name'

if(isset($_POST['btnAccion']))
{
    switch($_POST['btnAccion'])
    {
        // Evaluando el valor 'Agregar' del botón
        case 'Agregar':
            // Validar la información del producto que se esté enviando a través del formulario
            if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY)))
            {   
                //Obtenemos ID desencriptado
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje.= "ID correcto".$ID."</br>";
            }
            else
            {   // no se pudo descifrar ID
                $mensaje.= "ID incorrecto";
            }

            // nombre del producto
            if(is_string(openssl_decrypt($_POST['nombre'], COD, KEY)))
            {   
                $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                $mensaje.= "nombre correcto".$NOMBRE."</br>";
            }
            else
            {   
                $mensaje.= "nombre incorrecto";
            
            }

            // precio del producto
            if(is_numeric(openssl_decrypt($_POST['precio'], COD, KEY)))
            {   
                $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                $mensaje.= "precio correcto".$PRECIO."</br>";
            }
            else
            {   
                $mensaje.= "precio incorrecto";
            
            }


            // cantidad del producto            
            if(is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY)))
            {   
                $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
                $mensaje.= "cantidad correcta".$CANTIDAD."</br>"; 
            }
            else
            {   
                $mensaje.= "cantidad incorrecta";
            
            }

            // Una vez validada la información enviada a través del formulario se agrega al carrito de compras
            // Evaluando si la variable de sesión no tiene ningún elemento agregado
            if(!isset($_SESSION['CARRITO']))
            {
                $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'PRECIO'=>$PRECIO,
                    'CANTIDAD'=>$CANTIDAD,
                );
                //Se agrega a la sesión carrito
                $_SESSION['CARRITO'][0]=$producto;

            }else{  // Si existe algún elemento en la sesión 'CARRITO' se contabiliza y se va agregando a la sesión 'CARRITO'
                $NumeroProductos = count($_SESSION['CARRITO']);
                $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'PRECIO'=>$PRECIO,
                    'CANTIDAD'=>$CANTIDAD,
                );
                $_SESSION['CARRITO'][$NumeroProductos]=$producto;
            }
            // Mensaje de los elementos agregados a la sesión 'CARRITO'
            //$mensaje = print_r($_SESSION, true); 

        break;

        // Evaluando el valor 'Eliminar' del botón
        case 'Eliminar':
            
            if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY)))
            {   
                //Obtenemos ID desencriptado
                
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                
                foreach($_SESSION['CARRITO'] as $indice=>$producto)
                {

                    // verificamos si el ID del producto guardado en la sesión 'CARRITO' es el mismo ID recibido por el método POST (formulario)
                    if($producto['ID']==$ID)
                    {
                        // borramos el producto almacenado en la variable de sesión
                        //echo ($_SESSION['CARRITO'][$indice]);
                        unset($_SESSION['CARRITO'][$indice]);
                        //echo "<script>alert('Elemento borrado del carrito.')</script>";
                    }
                }
            }
            else
            {   // no se pudo descifrar ID
                $mensaje.= "ID incorrecto";
            }
        break;
    }
}

?>