<?php

/**
 * Aquest fitxer Eliminar.php inclou la classe Eliminar que permet eliminar
 * productes de la Bases de Dades
 *
 * @author Gabriel Alzina Alomar
 * @version 1.0
 * @date 28/04/2024
 */


require_once('Connexio.php');
require_once('Header.php');


/**
 * La classe Eliminar representa l’eliminació de productes en la BBDD
 *
 * Mitjançant aquesta classe i els seus mètodes es gestiona
 * l’eliminació d’un registre de la taula productes.
 * Es comprova l’existència del producte en la BBDD
 * Es demana confirmació a l’usuari per eliminar-lo 
 * Retorna el resultat de l’operació realitzada, 
 * tenint en compte els factors anteriors
 */


class Eliminar {
    
    
    /**
    * El mètode confirmarEliminacio($id) comprova l’existència 
    * del producte i demana confirmació a l’usuari
    * 
    * A partir del id del producte rebut per GET
    * es fa una consulta a la BBDD per verificar l’existència
    * del producte que es vol eliminar.
    * Si el producte no existeix, es genera codi HTML
    * en el que s’indica aquesta circumstància i un
    * enllaç per tornar a Principal.php
    * Si el producte existeix es llança codi javascript
    * demanant confirmació a l’usuari de l’eliminació
    * En funció de la resposta de l’usuari tornam
    * a executar aquest mateix script Eliminar.php,
    * enviant per GET la id del producte i la confirmació
    * de l’usuari, la qual pot ser positiva (true) o 
    * negativa (false), en funció de si accedeix
    * o no a l’eliminació del producte
    *  
    * @param string $id La id del producte que es vol eliminar 
    * @return string|javascript Codi HTML si el producte no existeix, 
    * script javascript que redirecciona el tràfic a Eliminar.php
    * amb id del producte i confirmació de l’eliminació true o false
    */

    
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
                    var confirmacion = confirm('¿Estàs segur de que vols eliminar el producte \"$nomProducto\"?');
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
    
    
    /**
    * El mètode procesarEliminacio($id) executa la consulta
    * d’eliminació del producte
    * 
    * Aquesta funció només s’executa si l’usuari 
    * ha confirmat l’eliminació.
    * A partir del id del producte es crea i executa 
    * la corresponent consulta d’eliminació 
    * del producte especificat.
    * En funció de si s’ha realitzat o no l’eliminació
    * es mostra un missatge d'èxit o errada
    *   
    * @param string $id La id del producte que es vol eliminar 
    * @return string Codi HTML amb el resultat de l’execució de la consulta
    */


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
