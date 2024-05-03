<?php

require_once('Connexio.php');
require_once('Header.php');

class Eliminar {
    
    // Metode per demanar confirmació de 'l'eliminació a l'usuari
    public function confirmarEliminacio($id){
        
        // Crea una instancia de la clase de conexión
        $conexionObj = new Connexio();
        // Obtiene la conexión a la base de datos
        $conexion = $conexionObj->obtenirConnexio();

        // Escapa las variables para prevenir SQL injection
        $id = $conexion->real_escape_string($id);

        // Construye la consulta SQL de selección
        $consulta = "SELECT nom FROM productes WHERE id = $id";

        $result = $conexion->query($consulta);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nomProducto = $row['nom'];

            // Confirmar la eliminación con el usuario
            echo "<script>
                    var confirmacion = confirm('¿Estàs segur de que vols eliminar el el producte \"$nomProducto\"?');
                    if (confirmacion) {
                        window.location.href = 'Eliminar.php?id=$id&confirmacion=true';
                    } else {
                        window.location.href = 'Eliminar.php?id=$id&confirmacion=false';
                    }
                  </script>";
        } else {
            // Muestra un mensaje de error si la consulta falla
                echo '<!DOCTYPE html>
                     <html lang="es">
                      <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                        <title>Eliminar producte</title>
                        <!-- Enlace a Bootstrap desde su repositorio remoto -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                        </head>
                         <body>
                        <div class="container mt-5" style="margin-bottom: 200px">
                            <div class="alert alert-danger" role="danger">
                                <h1>AQUEST PRODUCTE NO EXISTEIX EN LA BASE DE DADES</h1>
                            </div>
                            <br>
                            <div>
                                <a href="Principal.php" class="btn btn-primary">TORNAR A LA LLISTA DE PRODUCTES</a>
                            </div>
                         </div>';
                // Incluye el pie de página
                require_once('Footer.php');
        }
        // Cierra la conexión a la base de datos
        $conexion->close();        
    }

    // Método para actualizar un producto en la base de datos
    public function procesarEliminacion($id) {
        
        // Crea una instancia de la clase de conexión
        $conexionObj = new Connexio();
        // Obtiene la conexión a la base de datos
        $conexion = $conexionObj->obtenirConnexio();

        // Escapa las variables para prevenir SQL injection
        $id = $conexion->real_escape_string($id);
    
        // Construye la consulta SQL de eliminación
        $consulta = "DELETE FROM productes WHERE id = $id";
        
        // echo $consulta;

        // Ejecuta la consulta y redirige a la página principal si tiene éxito
        if ($conexion->query($consulta) === TRUE) {
            echo '<!DOCTYPE html>
                 <html lang="es">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Eliminar producte</title>
                    <!-- Enlace a Bootstrap desde su repositorio remoto -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <div class="alert alert-success" role="alert">
                            <h1>PRODUCTE ELIMINAT CORRECTAMENT</h1>
                        </div>
                        <br>
                        <div>
                            <a href="Principal.php" class="btn btn-primary">TORNAR A LA LLISTA DE PRODUCTES</a>
                        </div>
                     </div>';
            // Incluye el pie de página
            require_once('Footer.php');
        } else {
            // Muestra un mensaje de error si la consulta falla
            echo '<!DOCTYPE html>
                 <html lang="es">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Eliminar producte</title>
                    <!-- Enlace a Bootstrap desde su repositorio remoto -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                    </head>
                     <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <div class="alert alert-danger" role="danger">
                            <h1>NO S\'HA POGUT ELIMINAR EL PRODUCTE EN LA BASE DE DADES</h1>
                        </div>
                        <br>
                        <div>
                            <a href="Principal.php" class="btn btn-primary">TORNAR A LA LLISTA DE PRODUCTES</a>
                        </div>
                     </div>';
            // Incluye el pie de página
            require_once('Footer.php');
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
        
    }
}

// Obtenim ID del producte a eliminar
$id = $_GET['id'];

// Procesar la eliminación si se ha confirmado
if (isset($_GET['confirmacion'])) {
    $confirmacion = $_GET['confirmacion'];
    
    if ($confirmacion === "true") {
        // Crea una instancia de la clase Eliminar y llama al método procesarEliminacion
        $eliminarProducte = new Eliminar();
        $eliminarProducte->procesarEliminacion($id);
    } else {
        // Eliminació no confirmada
        // redireccionam a Principal.php
        echo "<script>
            window.location.href = 'Principal.php'
        </script>";
    }
} else {
    
    // Crea una instancia de la clase Eliminar y llama al método procesarEliminacion
    $confirmaEliminar = new Eliminar();
    $confirmaEliminar->confirmarEliminacio($id);
    
    
}

?>
