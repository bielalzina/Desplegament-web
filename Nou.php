<?php

require_once('Connexio.php');
require_once('Header.php');

class Afegir {

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