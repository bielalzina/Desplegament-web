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

![captura_xampp](https://github.com/bielalzina/Desplegament-web/blob/a83eea17e8a55db1eb5ee4c002ce0f29c2b1a6ff/imatges/xampp.png?raw=true)

L'aplicació s'inicia des del script Principal.php. En el teu navegador WEB preferit, introdueix la URL següent: http://localhost/projecte_crud/Principal.php

Es carrega el CRUD, llistant tots els productes existents en la BBDD (READ):

![captura_crud](https://github.com/bielalzina/Desplegament-web/blob/7b8b96f48ebfd45d9531a4811ead19bcfc634adc/imatges/captura_crud.png)

En aquesta pantalla inicial, accedim a la funció de LECTURA del CRUD. 

### Nou producte (CREATE)

Si feim clic en el boto Nou producte, accedim al formulari que ens permet inserir 
els valors del nou registre. Confirmam les dades:

![nou_producte_1](https://github.com/bielalzina/Desplegament-web/blob/826db6e084c3edc4fd94649e97d958e9124d298c/imatges/nou_producte_1.png)

L'aplicació ens indica que el nou producte s'ha afegit correctament:

![nou_producte_2](https://github.com/bielalzina/Desplegament-web/blob/826db6e084c3edc4fd94649e97d958e9124d298c/imatges/nou_producte_2.png)

El nou producte apareix en la llista inicial:

![nou_producte_3](https://github.com/bielalzina/Desplegament-web/blob/826db6e084c3edc4fd94649e97d958e9124d298c/imatges/nou_producte_3.png)

### Modificar (UPDATE)

Per actualitzar els valors d'un producte, feim clic en Modificar en la fila corresponent. Accedim al formulari amb les dades del producte. 
Actualizam els valors que corresponguin i feim clic en Guardar:

![modificar_1](https://github.com/bielalzina/Desplegament-web/blob/826db6e084c3edc4fd94649e97d958e9124d298c/imatges/modificar_1.png)

Accedim a la pantalla inicial on podem comprovar com s'han actualitzat les dades del producte:

![modificar_2](https://github.com/bielalzina/Desplegament-web/blob/826db6e084c3edc4fd94649e97d958e9124d298c/imatges/modificar_2.png)

### Eliminar (DELETE)

Per eliminar un producte, feim clic en Eliminar en la fila corresponent. L'aplicació ens demana confirmació per dur a terme l'eliminació:

![eliminar_1](https://github.com/bielalzina/Desplegament-web/blob/616fca9b606e578ea1b372585c2c5902c0a44edb/imatges/eliminar_1.png)

L'aplicació ens indica que el producte s'ha eliminat correctament:

![eliminar_2](https://github.com/bielalzina/Desplegament-web/blob/616fca9b606e578ea1b372585c2c5902c0a44edb/imatges/eliminar_2.png)

En la pantalla principal podem observar com el producte ja no apareix:

![eliminar_3](https://github.com/bielalzina/Desplegament-web/blob/616fca9b606e578ea1b372585c2c5902c0a44edb/imatges/eliminar_3.png)


## DOCUMENTACIÓ DE L'APLICACIÓ

En la URL: http://localhost/projecte_crud/doc_app/

Tens a la teva disposció la documentació del projecte:

![doc_app](https://github.com/bielalzina/Desplegament-web/blob/1e2de4a509740388d214ad796b5010964ad93643/imatges/doc_app.png)

## EINES UTILIZADES

* IDE: [Apache NetBeans](https://netbeans.apache.org/front/main/index.html)
* CSS: [Bootstrap](https://getbootstrap.com/)

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
