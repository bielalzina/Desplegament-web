# CRUD PRODUCTES

Aplicació PHP que permet crear, llegir, actualitzar i eliminar els productes en una BBDD MySql

## COM COMENÇAR

Pots descarregar una [còpia del projecte](https://github.com/bielalzina/Desplegament-web/archive/refs/heads/main.zip) i provar-lo en la teva màquina local 
amb finalitats de desenvolupament. 
Consulta les següents instruccions que te guiaran en el procés d'implementació

### REQUISITS PREVIS

Per poder executar el projecte necessites:

* Servidor WEB
* PHP
* Servidor MySQL

Tant si fas servir Windows com Linux, [XAMPP](https://www.apachefriends.org/es/index.html) és una bona opció.


### IMPLEMENTACIÓ DEL PROJECTE

1. Crea en el servidor MySQL la BBDD la_meva_botiga i dins aquesta les taules categories i productes. Fes servir les següents instruccions SQL:  


    ```CREATE DATABASE IF NOT EXISTS la_meva_botiga;
    USE la_meva_botiga;

    -- Crea la taula 'categories'
    CREATE TABLE IF NOT EXISTS categories (
         id INT AUTO_INCREMENT PRIMARY KEY,
         nom VARCHAR(50) NOT NULL
    );

    -- Insereix dades a la taula 'categories'
    INSERT INTO categories (nom) VALUES
         ('Electrònics'),
         ('Roba');

    -- Crea la taula 'productes'
    CREATE TABLE IF NOT EXISTS productes (
         id INT AUTO_INCREMENT PRIMARY KEY,
         nom VARCHAR(100) NOT NULL,
         descripció TEXT,
         preu DECIMAL(10, 2) NOT NULL,
         categoria_id INT NOT NULL,
         FOREIGN KEY (categoria_id) REFERENCES categories(id)
    );

    -- Insereix dades a la taula 'productes'
    INSERT INTO productes (nom, descripció, preu, categoria_id) VALUES
         ('Laptop', 'Portàtil d\'alta gamma', 1200.00, 1),
         ('Smartphone', 'Telèfon intel·ligent d\'última generació', 800.00, 1),
         ('Camisa', 'Camisa de vestir per a homes', 50.00, 2),
         ('Vestit', 'Vestit de nit per a dones', 80.00, 2),
         ('Sabates', 'Sabates esportives per córrer', 120.00, 2);```

2. Crea un directori, per exemple 'projecte_crud', en la carpeta root del servidor web i copia 
els arxius que has descarregat anteriorment. T'ha quedar una cosa semblant a:

    ![captura_estructura_arxius](https://github.com/bielalzina/Desplegament-web/blob/main/imatges/projecte_crud.png?raw=true)
  
3. Si escau, cal que modifiquis les dades de connexió a la BBDD en l'script Connexio.php:

    ```
    private $host = "localhost";
    private $usuario = "usuari_sql";
    private $contraseña = "password_usuari_sql";
    private $baseDatos = "la_meva_botiga";
    ```

## EXECUCIÓ

Inicia el servidor WEB i el servidor MySQL:

    ![xampp](https://github.com/bielalzina/Desplegament-web/blob/main/imatges/xampp.png?raw=true)

En el teu navegador WEB preferit, introdueix la URL següent: http://localhost/projecte_crud/Principal.php

### Desglossa en proves extrem a extrem

Explica què són aquestes proves i per què

```
Posa un exemple
```

### I proves d'estil de codificació

Explica què són aquestes proves i per què

```
Posa un exemple
```

## Desplegament

Afegiu notes addicionals sobre com implementar-ho en un sistema en directe

## Construït amb

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - El marc web utilitzat
* [Maven](https://maven.apache.org/) - Gestió de dependències
* [ROME](https://rometools.github.io/rome/) - S'utilitza per generar canals RSS

## Contribuint

Si us plau, llegiu [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) per obtenir més informació sobre el nostre codi de conducta i el procés per enviar-nos les sol·licituds d'extracció.

## Versions

Utilitzem [SemVer](http://semver.org/) per fer versions. Per a les versions disponibles, consulteu les [etiquetes d'aquest repositori](https://github.com/your/project/tags).

## Autors

* **Billie Thompson** - *Treball inicial* - [PurpleBooth](https://github.com/PurpleBooth)

Consulteu també la llista de [col·laboradors](https://github.com/your/project/contributors) que van participar en aquest projecte.

## Llicència

Aquest projecte té una llicència sota la llicència MIT; consulteu el fitxer [LICENSE.md](LICENSE.md) per obtenir més informació

## Agraïments

* Punta de barret a qualsevol persona el codi de qui s'hagi utilitzat
* Inspiració
* etc
