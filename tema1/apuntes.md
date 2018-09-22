# Apuntes Tema 1

- ## Conceptos básicos
    * ### Sintaxis de apertura php:<br>
        Cuando estemos trabajando en un archivo php, tenemos que abrir el documento como se muestra a continuación, y no hace falta que cerremos este con ```?>```.<br>
        Esto se hace para evitar que en la respuesta se nos envie basura, y si nosotros cerramos nuestro documento y por algúna razón hemos insertado algún espacio, salto de línea, tabulación o algo, esto lo que hará es generarnos basura en la respuesta, con lo que podemos encontrarnos con errores inesperados.<br>
        Esto mismo puede suceder con los espacios, saltos de línea y demás que insertemos antes de la apertura de nuestra etiqueta php, por lo que tenemos que tener cuidado con esto.(aunque hoy en día, este tipo de errores es corregido en los servidores, pero puede darse el caso de que no, y nos volvamos locos).
        ```php
        <?php>
        echo 'Hola mundo';
        //Apertura para documento php
        /*
        Comentario multilínea
        */
        ```

        ```html
        <!--Apertura y cierre para insercción en línea-->
        <a href="pagina3.php?nombre=pepe">enlace 2</a>
        <?php
        $valor = urlencode('pepe % & lopez');
        ?>
        <a href="pagina3.php?nombre=<?= $valor ?>">enlace 3</a>
        ```
    * ### Declaración de variables y String:
        ```php
        //Los string puede ser con comillas simples o dobles
        $variable = 'valor'; //No hay que especificar el típo de dato en la declaración de variables
        echo "Este es el valor de mi variable: $variable";
        //Para concatenar un string en una salida, podemos o realizarlo como en el ejemplo anterior o con comillas simples
        echo 'Este es el valor de mi variable: ' . $variable;
        ```
    * ### Constantes:
        ```php
        //Forma antigua y en desuso
        define('CTE1', 'constante');
        //1 parámetro nombre de la constante, 2 valor de esta.
        
        //Forma común de declaración de contanstes.
        const CTE2 = 'Valor de la constante';
        echo CTE1;
        echo CTE2;
        ```
    * ### Rescatar valores de html:
        Para poder **rescatar** un valor de un formulario, este input debe de tener la etiqueta ```name```, puesto que sino no lo podremos recuperar en nuestro archivo php.
        ```php
        <?php
        //vamos a leer los parámetros tenemos que tener en cuenta si se nos envían por POST o GET, y asegurarnos de que los inputs tengan la etiqueta name establecida.

        //problema: GET y POST se leen de forma diferente

        //problema 2: no siempre llegan parámetros

        $nombre = '';//Declaramos variable vacía, para que encaso de no obtener parámetros no se nos de error.

        //Si llega parámetro [nombre] del parámetro leelo
        if (isset($_GET['nombre'])){
            $nombre = $_GET['nombre'];
        }

        //Si llega parámetro post [nombre] del parámetro leelo
        if (isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];
        }

        echo 'El nombre es: ' . $nombre;
        ```

    