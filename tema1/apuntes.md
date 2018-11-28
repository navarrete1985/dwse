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
## Notas:
    - .htaccess --> Para poner la politica de privacidad y no se tenga acceso a los archivos...directamente
    desde na ruta a la carpeta.<br>
    Pero tenemos que tener en cuenta de que si que podemos acceder al archivo si sabemos la ruta al archivo en sí
    y el nombre de este y lo insertamos desde el navegador<br>
    En caso de que accedamos a la carpeta y tengamos un index.html....esto si que lo mostramos<br>
    
    Para realmente tener privacidad con nuestros datos, tenemos 2 opciones.
        - Guardar los archivos en nuestra base de datos
        - Guardar los archivos en directorios privado por debajo de workspace...para que así no se tenga acceso
    - Lectura de Archivos fuera del workspace:
    ``` php
    <?php

    $archivo = $_GET['archivo'];
    header('Content-Type: image/jpeg');
    readfile('../../../../privado/' . $archivo);
    
    /*
    Con este script lo que hacemos es leer un archivo de un directorio privado, necesitamos
    el mimetype y ruta donde se ubica el archivo
    */
    ```
    - 

# Trabajos
- Upload múltiple<br>
    Realizar la clase upload múltiple<br>
    Entregar El jueves próximo<br>
    Que sea llamada sólamente con el nombre del campo de entrada input type"" name='esteNombre'<br>
    deberá tener al menos:
        1. Cuantos archivos vienen
        2. Cuantos se ha podido subir
        3. Get name -> arra()nombres de los archivos
        4. Con 1 solo target
        5. Set name...se le llama al archivo lo mismo a todos
        5. En tamaño comparamos cada uno de los archivos con el maxSize


 - Crear un formulario en el que nos podamos dar de alta, cada usuario que se de de alta, se creará un directorio
   en /home/ubuntu/private/nombreUsuario.
        - En caso de que el usuario exista...informamos de que el usuario ya existe.
        - En la lista de usuarios, tenemos los enlaces de cada uno de los usuarios que llevan hasta la foto
        - Esto se tiene que hacer en privado con ,htaccess
        - Una página para la lista de usuarios, y otra para registro...en esta última tiene que rellenar campo nombre y campo imagen
 


# Trabajo bases de datos
- Tenemos que crear una tabla de usuarios, los campos que tiene que tener son:
    - id -> Autoincremento y primary key
    - correo -> (not null, uni)
    - alias -> (uni pero puede ser null)
    - nombre -> (not null)
    - clave -> (not null)
    - activo -> (bit(0,1) 0->no está activo, not null)
    - fechaalta -> (datetime, not null)
    - https://curso1819-izvdamdaw.c9users.io/

# Transacciones

Las transacciones son la forma de hacer que una operación frente a la base de datos
sea atómica, con lo que si se falla algo al realizar la operación se podría realizar
rollback para que los datos se mantengan como antes, y no tengamos inconsistencia.


# Trabajo

Es el 80% de la nota
- Hacer una pequeña app con la tabla usuario:
    -   Añadir un campo administrador en la taba (0-1)
-   Si nos logueamos como admin podemos hacer todo...create/update/delete/edit
-   Si entramos sin login podemos sólamente el listado de usuarios(Nombre-Correo-Alias)
-   Si entramos como usuario no administrador (podemos ver nuestros datos, podemos editarnos, si cambiamos correo mandamos nuevo
-   mensaje de verificación, podemos cambiar la clave, hay que confirmar, y ponemos la opción de dar de baja...temporal o permanentemente)
-   Hacer todas las comprobaciones pertinentes para la verificación de los campos de insercción