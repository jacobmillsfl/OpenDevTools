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
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            Posted on Noviembre 4, 2017 by
            <a href="#">Carla Pastor</a>
        </div>
    </div>


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
