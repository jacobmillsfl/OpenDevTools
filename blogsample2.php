<?php
/**
 * Description: This is a sample blog page
 */

session_start();

?>

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
                    <h2 class="card-title"><b>Go</b>, el mejor lenguaje de programación de código abierto creado
                        por Google</h2>

                    <p class="card-text">
                    <p style="text-align:justify;">

                        Go or más conocido como Golang ha ganado mucha fuerza, grandes empresas confían en golang, entre
                        ellas; Facebook, MongoDB, Mozilla, Netflix, Comcast, Twitter, Shutterfly, y  Dropbox.
                        Check la lista de compañías de todo el mundo que actualmente usan golang en el siguiente link
                        <a href="https://github.com/golang/go/wiki/GoUsers" ><span style="color:#1e90ff">
                                https://github.com/golang/go/wiki/GoUsers</span></a>


                    </p>
                    <p style="text-align:justify;">
                        Con golang puedes programar tu aplicación una sola vez y luego compilarla para cualquier sistema
                        operativo, esta característica es conocida como <b>cross compilation</b>
                        <br>
                        Puedes hacer tu primer programa con golang sin necesidad de instalar ningun programa en tu
                        computador. Ingresa a <b>Go Playground</b>: <a href="https://play.golang.org"><span style="color:#1e90ff">https://play.golang.org</span></a>

                        Verás el código de un sencillo <b>"Hello, playground"</b> que puedes correr haciendo click en el botón Run.
                    </p>



                    <a href="#" class="btn btn-primary">Read More &rarr;</a>
                </div>


                <div class="col-lg-12">

                    <p style="text-align:justify;">
                    <h4> Ejemplo: </h4>

                    <IMG SRC="/images/goPlay.cpp15d.png" WIDTH=827 HEIGHT=300 ALT="Consola de Go - Free Source">

                    <p style="text-align:justify;">
                    <h4> Ahora, comentemos el código </h4>

                    <b><span style="color:#1e90ff">package </span>main</b>

                    <p style="text-align:justify;">
                        Todos los archivos de golang deben pertenecer a un paquete (package), si nuestra aplicación va a
                        ejecutarse por sí misma el paquete debe ser <span style="color:#1e90ff">main</span>.</p>
                    <b><span style="color:#1e90ff">import</span> (<br>
                        <span style="color:green">"fmt"</span><br>
                        )</b>
                    <p style="text-align:justify;">
                        Cuando nuestro programa necesita usar la funcionalidad de otro paquete, como <span style="color:#1e90ff">
                            fmt</span>, usamos la instrucción <span style="color:#1e90ff">import</span>, si necesitáramos más de un
                        paquete colocaríamos el nombre de cada uno de ellos rodeados con comillas dobles en su propia
                        línea, dentro de un único par de paréntesis, por eso en nuestro ejemplo vemos tres líneas para
                        esta instrucción. </p>
                    <p style="text-align:justify;">
                        Las funciones en golang se declaran/definen con la palabra reservada <span style="color:#1e90ff">func</span>,
                        seguido del nombre de la función y paréntesis. Con golang estamos obligados a escribir la llave
                        de apertura en la misma línea en la que se declara/define la función. </p>
                    <p style="text-align:justify;">
                        La definición/declaración de la función se conoce en golang como la firma de la función, en
                        nuestro ejemplo, la firma de la función main es <span style="color:#1e90ff">func main()</span>
                        <br> </p>
                    <p style="text-align:justify;">
                        Cada paquete puede tener todas las funciones que necesitemos, pero sucede algo especial con el
                        paquete <span style="color:#1e90ff">main</span>, debe tener una función que se llame también <span style="color:#1e90ff">
                            main</span>, con esto indicamos por donde arranca nuestro programa; eso no quiere decir que el
                        paquete <span style="color:#1e90ff">main</span> sólo puede tener una función, puede tener muchas más
                        funciones con los nombres que decidamos darles.</p>
                    <b><span style="color:black">fmt.Println(</span><span style="color:green">"Hello, playground")</span> </b>
                    Golang nos obliga a usar cada paquete que importamos, golang nos dice:<br>
                    <p style="text-align:center;"> <b><i>" Si no vas a usar un paquete no lo importes " </i></b></p>

                    <p style="text-align:justify;">
                        En nuestro ejemplo hemos importado el paquete <span style="color:#1e90ff">fmt</span>, del cual usaremos la
                        función <span style="color:#1e90ff">Println</span> que sirve para mostrar un mensaje en pantalla, nota que
                        el nombre de la función empieza con una letra mayúscula.<br>

                    <p style="text-align:center;"> <b><i>" El nombre de todas las funciones que usamos de otros paquetes
                                inician con una letra mayúscula. " </b></i></p>
                    <p style="text-align:justify;">
                        Para golang la primera letra máyuscula significa que la "cosa" que estamos declarando podrá ser
                        usada por otros paquetes.</p>
                    <p style="text-align:justify;">
                        En nuestro ejemplo, la función <span style="color:#1e90ff">Println</span> recibe una cadena de caracteres
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
</div>


<!-- /.container -->

<?php include "footer.php" ?>

</body>

</html>
