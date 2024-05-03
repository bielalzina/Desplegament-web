<?php

/**
 * Aquest fitxer Nou.php inclou la classe Afegir que permet introduir
 * nous productes en la Bases de Dades
 *
 * @author Gabriel Alzina Alomar
 * @version 1.0
 * @date 28/04/2024
 */


require_once('Connexio.php');
require_once('Header.php');


/**
 * La classe Afegir representa la inserció de nous productes en la BBDD
 *
 * Mitjançant aquesta classe i els seus mètodes es gestiona
 * la introducció d’un nou registre en la taula productes.
 * Inicialment es comprova si s’han rebut les dades del nou
 * producte per POST.
 * El primer cop que s’executa l’script, no s’han d’haver rebut les 
 * dades, per la qual cosa es crida el mètode que genera el 
 * formulari per introduir les dades del nou producte.
 * Un cop enviat el formulari a aquest mateix fitxer, i per tant,
 * rebuts els valors per POST, es procedeix a inserir el nou producte
 * en la BBDD, mostrant un missatge d'èxit o errada,
 * en funció de si s’ha realitzat o no la inserció
 */


class Afegir {

    
    /**
    * El mètode mostrarFormulari() genera el codi HTML del formulari
    * per inserir un nou producte en la taula productes
    *
    * El formulari inclou camps pel nom del producte, 
    * la descripció del producte, el preu del producte i 
    * la categoria a la que pertany.
    * Les categories existents s’obtenen a partir
    * d’una consulta a la BBDD
    * Tots els camps del formulari son obligatoris.
    * Els valors s’envien per POST a aquest mateix script Nou.php
    * 
    * @return string Codi HTML del formulari
    */

    
    // Metode per pintar el formaulari per afegir un nou producte
    public function mostrarFormulari() {
        
        // Obtenim Categories
        
        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        $consulta = "SELECT id, nom FROM categories";
        $resultado = $conexion->query($consulta);

        $categories = [];

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $categories[$fila['id']] = $fila['nom'];
            }
        }
        
        //Pintam HTML options
        $options='';
        foreach ($categories as $id => $nomCategoria) {
            $options .= "<option value=\"$id\">$nomCategoria</option>";
        }

        // Imprime la estructura HTML del formulario de nuevo producto
        echo '<!DOCTYPE html>
                 <html lang="es">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Modificar producte</title>
                    <!-- Enlace a Bootstrap desde su repositorio remoto -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <h2>AFEGIR PRODUCTE</h2>
                        <hr>
                        <form action="Nou.php" method="POST">
                            
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nombre:</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcio" class="form-label">Descripción:</label>
                                <input type="text" name="descripcio" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="preu" class="form-label">Precio:</label>
                                <input type="number" name="preu" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría:</label>
                                <select name="categoria" class="form-select" required>
                                    <!-- Opciones del selector de categorías con la opción seleccionada según la información actual -->
                                    <option value="">-- Selecciona una categoria --</option>'
                                    .$options.        
                                    '<!-- <option value="1">Electrónicos</option> -->
                                    <!-- <option value="2">Roba</option> -->
                                    <!-- Agrega más opciones según sea necesario -->
                                </select>
                            </div>

                            <!-- Agrega más campos según sea necesario -->

                            <hr>
                            <!-- Botones de guardar y cancelar -->
                            <input type="submit" value="Guardar" class="btn btn-primary">
                            <a href="Principal.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>';
            
            // Incluye el pie de página
            require_once('Footer.php');

    }
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $preu = $_POST['preu'];
    $categoria = $_POST['categoria'];

    // Crea una instancia de la clase de conexión
    $conexionObj = new Connexio();
    // Obtiene la conexión a la base de datos
    $conexion = $conexionObj->obtenirConnexio();

    // Escapa las variables para prevenir SQL injection
    $nom = $conexion->real_escape_string($nom);
    $descripcio = $conexion->real_escape_string($descripcio);
    $preu = $conexion->real_escape_string($preu);
    $categoria_id = $conexion->real_escape_string($categoria);

    // Construye la consulta SQL de inserción
    $consulta = "INSERT INTO productes (id, nom, descripció, preu, categoria_id) VALUES (null, '$nom', '$descripcio', '$preu', '$categoria_id')";

    // Ejecuta la consulta y redirige a la página principal si tiene éxito
    if ($conexion->query($consulta) === TRUE) {
        echo '<!DOCTYPE html>
                 <html lang="es">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Modificar producte</title>
                    <!-- Enlace a Bootstrap desde su repositorio remoto -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <div class="alert alert-success" role="alert">
                            <h1>PRODUCTE AFEGIT CORRECTAMENT</h1>
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
                    <title>Modificar producte</title>
                    <!-- Enlace a Bootstrap desde su repositorio remoto -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <div class="alert alert-danger" role="danger">
                            <h1>NO S\'HA POGUT AFEFGIR EL PRODUCTE EN LA BASE DE DADES</h1>
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

} else {
    // Crea una instancia de la clase Modificar y llama al método mostrarFormulari
    $afegirProducte = new Afegir();
    $afegirProducte->mostrarFormulari();
}

?>