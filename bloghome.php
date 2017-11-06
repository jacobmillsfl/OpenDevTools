<!DOCTYPE html>
<html lang="es">

<?php
/*
* Blog home page, Nov 2017
* Author: CarlaPastor cpp15d
*/
?>

<?php include "head.php" ?>

<body>


<?php include "header.php" ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Blog
            <small>- Spanish Section</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index">Home</a>
        </li>
        <li class="breadcrumb-item active">Blog - Spanish Section</li>
    </ol>



    <!-- Blog Post -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <a href="#">
                        <img class="img-fluid rounded" src="/images/go_lang_mascot_by_kirael_art-cpp15d.gif" alt="">
                    </a>
                </div>
                <div class="col-lg-6">
                    <h2 class="card-title"><b>Go</b>, el mejor lenguaje de programación de código abierto
                    creado por Google</h2>

                    <p class="card-text">
                    <p style="text-align:justify;">

                        Go or más conocido como Golang ha ganado mucha fuerza, grandes empresas confían en golang, entre
                        ellas; Facebook, MongoDB, Mozilla, Netflix, Comcast, Twitter, Shutterfly, y  Dropbox.
                        Check la lista de compañías de todo el mundo que actualmente usan golang en el siguiente link
                        <a href="https://github.com/golang/go/wiki/GoUsers" > <FONT COLOR="#1e90ff">
                         https://github.com/golang/go/wiki/GoUsers</FONT></a>


                    </p>
                    <p style="text-align:justify;">
                        Con golang puedes programar tu aplicación una sola vez y luego compilarla para cualquier sistema
                        operativo, esta característica es conocida como <b>cross compilation</b>
                        <br>
                        Puedes hacer tu primer programa con golang sin necesidad de instalar ningun programa en tu
                        computador. Ingresa a <b>Go Playground</b>: <a href= <FONT COLOR="#1e90ff"> https://play.golang.org</FONT></a>

                        Verás el código de un sencillo <b>"Hello, playground"</b> que puedes correr haciendo click en el botón Run.
                    </p>



                    <a href="#" class="btn btn-primary">Read More &rarr;</a>
                </div>


                 <div class="col-lg-12">

                    <p style="text-align:justify;">
                    <h4> Ejemplo: </h4></p>

                     <IMG SRC="/images/goPlay.cpp15d.png" WIDTH=827 HEIGHT=300 ALT="Consola de Go - Free Source"></p>

                     <p style="text-align:justify;">
                     <h4> Ahora, comentemos el código </h4></p>

                    <b><FONT COLOR="red">package </FONT>main</b>
                    </p>
                    <p style="text-align:justify;">
                        Todos los archivos de golang deben pertenecer a un paquete (package), si nuestra aplicación va a
                        ejecutarse por sí misma el paquete debe ser<FONT COLOR="red"> main</FONT>.</p>
                    <b><FONT COLOR="red">import</FONT> (<br>
                    <FONT COLOR="green">"fmt"</FONT><br>
                    )</b> </p>
                    <p style="text-align:justify;">
                        Cuando nuestro programa necesita usar la funcionalidad de otro paquete, como <FONT COLOR="red">
                        fmt</FONT>, usamos la instrucción <FONT COLOR="red">import</FONT>, si necesitáramos más de un
                        paquete colocaríamos el nombre de cada uno de ellos rodeados con comillas dobles en su propia
                        línea, dentro de un único par de paréntesis, por eso en nuestro ejemplo vemos tres líneas para
                        esta instrucción. </p>
                    <p style="text-align:justify;">
                        Las funciones en golang se declaran/definen con la palabra reservada <FONT COLOR="red">func</FONT>,
                        seguido del nombre de la función y paréntesis. Con golang estamos obligados a escribir la llave
                        de apertura en la misma línea en la que se declara/define la función. </p>
                    <p style="text-align:justify;">
                        La definición/declaración de la función se conoce en golang como la firma de la función, en
                        nuestro ejemplo, la firma de la función main es  <FONT COLOR="red"> func main()</FONT>
                        <br> </p>
                    <p style="text-align:justify;">
                        Cada paquete puede tener todas las funciones que necesitemos, pero sucede algo especial con el
                        paquete <FONT COLOR="red">main</FONT>, debe tener una función que se llame también <FONT COLOR="red">
                        main</FONT>, con esto indicamos por donde arranca nuestro programa; eso no quiere decir que el
                        paquete <FONT COLOR="red">main</FONT> sólo puede tener una función, puede tener muchas más
                        funciones con los nombres que decidamos darles.</p>
                    <b><FONT COLOR="black">fmt.Println(</FONT><FONT COLOR="green">"Hello, playground")</FONT> </b> </p>
                    Golang nos obliga a usar cada paquete que importamos, golang nos dice:<br>
                    <p style="text-align:center;"> <b><i>" Si no vas a usar un paquete no lo importes " </i></b></p>

                    <p style="text-align:justify;">
                        En nuestro ejemplo hemos importado el paquete <FONT COLOR="red">fmt</FONT>, del cual usaremos la
                        función <FONT COLOR="red">Println</FONT> que sirve para mostrar un mensaje en pantalla, nota que
                        el nombre de la función empieza con una letra mayúscula.<br>

                    <p style="text-align:center;"> <b><i>" El nombre de todas las funciones que usamos de otros paquetes
                     inician con una letra mayúscula. " </b></i></p>
                    <p style="text-align:justify;">
                        Para golang la primera letra máyuscula significa que la "cosa" que estamos declarando podrá ser
                        usada por otros paquetes.</p>
                    <p style="text-align:justify;">
                        En nuestro ejemplo, la función <FONT COLOR="red">Println</FONT> recibe una cadena de caracteres
                        que pintará en pantalla, mira detenidamente.
                        Golang usa comillas dobles para las cadenas de caracteres.</p>
                    <p style="text-align:justify;">
                        Si intentamos usar comillas simples tendremos un error de sintaxis y nuestro programa no compilará.</p>


                     Aqui les dejo la Guía de instalación de Golang en español.
                     <a href= "https://web.archive.org/web/20091118165016/http://groups.google.es/group/golang-spanish/web/instalacin"
                     >Link</a>


                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            Posted on Noviembre 5, 2017 by
            <a href="#"> Carla Pastor</a>
        </div>
    </div>

    <!-- Blog Post -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <a href="#">
                        <img class="img-fluid rounded" src="/images/opensource.Carla.png" alt="">
                    </a>
                </div>
                <div class="col-lg-6">

                    <h2 class="card-title">El éxito del Open Source</h2>
                    <p class="card-text">

                    <p style="text-align:justify;">
                        La definición básica de open source es aquella que dice que el código fuente de un programa puede
                        ser libremente descargado, utilizado, modificado y redistribuido por cualquiera. El modelo open
                        source podría y debería ser aplicado en todo tipo de investigación y desarrollo, no sólo en el de
                        software.
                        Muchas de las compañías más exitosas del mundo atribuyen al menos cierta parte de su
                        éxito a plataformas open source: Amazon utiliza Apache como servidor web, grandes partes de Yahoo!
                        están construidas sobre Linux, FreeBSD y Apache, escritas en PHP y Perl; Google ha basado completamente
                        en Linux su sistema operativo móvil Android; Mozilla ha desarrollado Firefox, uno de los navegadores
                        más usados por años en el mundo. Ahora además ha creado un nuevo sistema operativo para móviles
                        completamente abierto y con muchísimo potencial : Firefox OS, un gran proyecto open source que viene
                        a dar vida a terminales de gama media y baja que no habían recibido lo mejor del software actual.
                    </p>
                    <p style="text-align:justify;">
                        La flexibilidad del software libre permite abaratar costos en muchos sentidos, y acelerar el
                        desarrollo de los proyectos al tener menos restricciones que pueden presentarse usando modelos cerrados.
                        Las libertades terminan siendo importantes para los usuarios, para los desarrolladores y para las
                        compañías ; y a la vez la sociedad puede adaptar el modelo para hacer florecer la cultura, así como
                        la investigación científica puede obtener resultados de forma más rápida, que repercutirán en beneficio
                        del conjunto de la humanidad.

                    </p>
                    <a href="#" class="btn btn-primary">Read More &rarr;</a>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            Posted on Noviembre 4, 2017 by
            <a href="#">Carla Pasor</a>
        </div>
    </div>




    <!-- User CarlaPastor Pagination -->
    <ul class="pagination justify-content-center mb-4">
        <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
        </li>
        <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
        </li>
    </ul>

</div>

</div>
<!-- /.container -->

<?php include "footer.php" ?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
