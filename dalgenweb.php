<?php
/**
 * Author: Jacob Mills
 * Date: 12/19/2017
 * Description: Web version of DALGen
 */


// include code to track hits
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="DALGen - Data Access Layer Generator">
    <meta name="author" content="OpenDevTools">

    <title>DALGen - By OpenDevTools.Org</title>

    <link href="https://www.opendevtools.org/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://www.opendevtools.org/css/modern-business.css" rel="stylesheet">

    <style>
        .close-attribute{
            position:absolute;
            right:15px;
            z-index:999;
            cursor:pointer;
        }
    </style>

    <!-- Javascript -->
    <script src="https://www.opendevtools.org/vendor/jquery/jquery.min.js"></script>
    <script src="https://www.opendevtools.org/vendor/popper/popper.min.js"></script>
    <script src="https://www.opendevtools.org/vendor/bootstrap/js/bootstrap.min.js"></script>



    <script>
    /*
    * This section is dedicated to the scripting logic for generating the appropriate output files as indicated by user input
    */

    // ***************************************
    // Document Ready
    // ***************************************

    $(function() {
        // Page load

        $('#DivGeneratedContent').hide();

        // Reset page
        resetGrid();

        // DBType changed listener
        $('.dbtype').change(function(){
            var dbsizeID = this.value;

            if (enableDBSize(getDataTypeString(dbsizeID))) {
                $(this).parent().parent().find('.dbsize').prop("disabled", false);
            }
            else{
                $(this).parent().parent().find('.dbsize').prop("disabled", true);
            }
        });

        // DBTypePK changed listener
        $('.DBTypePK').change(function(){

            var AutoIncDiv = $(this).parent().parent().parent().find('.DBTypeAutoIncrement');

            if ($(this).prop('checked')) {
                AutoIncDiv.prop("disabled", false);
            }
            else {
                AutoIncDiv.prop('checked', false);
                AutoIncDiv.prop("disabled", true);
            }
        });

        // DBTypePK changed listener
        $('.DBTypeFK').change(function(){

            var DBEntity = $(this).parent().parent().parent().parent().parent().find('.DBReferencingEntity');
            var DBAttribute = $(this).parent().parent().parent().parent().parent().find('.DBReferencingAttribute');

            if ($(this).prop('checked')) {
                DBEntity.prop("disabled", false);
                DBAttribute.prop("disabled", false);
            }
            else {
                DBEntity.val("");
                DBAttribute.val("");
                DBEntity.prop('disabled', true);
                DBAttribute.prop("disabled", true);
            }
        });

        // DBTypePK changed listener
        $('.radioDBType').change(function(){

            // Reset attributes
            removeAllDBAttributes();
            addDBAttribute();
        });

    });

    // ***************************************
    // Manipulate page
    // ***************************************

    function resetGrid(){
        // Reset radio options
        $('input[type="radio"]').prop('checked',false);

        // Reset checkboxes
        $('input[type="checkbox"]').prop('checked',false);

        // Default radio selection to MySQL
        $('#RadioMySQL').prop('checked',true);

        // Reset attributes
        removeAllDBAttributes();
        addDBAttribute();

        // Clear generated content

        // Hide Content Div
        $('#DivOutputC').hide();
        $('#DivOutputCPP').hide();
        $('#DivOutputCS').hide();
        $('#DivOutputJava').hide();
        $('#DivOutputPython').hide();
        $('#DivOutputPHP').hide();
        $('#DivOutputMySQL').hide();
        $('#DivOutputTSQL').hide();
        $('#DivOutputOracle').hide();
        $('#DivGeneratedContent').hide();

    }

    // Adds a DB Attribute to the page
    function addDBAttribute(){
        // Create controls to define an entity property

        if ($('#RadioMySQL').prop('checked') === true)
            var sqlDropdown = getMySQLDropdown();
        else
            var sqlDropdown = getTSQLDropdown();

        // DivProperties
        $('#DivProperties').append("<div class=\"DALAttribute col-lg-12 mb-4 \">\n" +
            "<div class=\"row\"><a onclick=\"removeDBAttribute(this);\" class=\"close close-attribute\">&times;</a></div>\n" +
            "<div class=\"row\">\n" +
            "\t<div class=\"col-sm-9\">\n" +
            "\t\t<div class=\"row mb-2\">\n" +
            "\t\t\t<label for=\"attributeName\" class=\"col-sm-4\">Attribute Name:</label>\n" +
            "\t\t\t<div class=\"col-sm-8\">\n" +
            "\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"attributeName\">\n" +
            "\t\t\t</div>\n" +
            "\t\t</div>\n" +
            "\t\t<div class=\"row mb-2\">\n" +
            "\t\t\t<label for=\"attributeType\" class=\"col-sm-4\">Attribute Type:</label>\n" +
            "\t\t\t<div class=\"col-sm-4\">\n" +
            "\t\t\t\t<select class=\"form-control dbtype\" name=\"attributeType\">\n" +
            sqlDropdown +
            "\t\t\t\t</select>\n" +
            "\t\t\t</div>\n" +
            "\t\t\t<label for=\"attributeSize\" class=\"col-sm-2\">Attribute Size:</label>\n" +
            "\t\t\t<div class=\"col-sm-2\">\n" +
            "\t\t\t\t<input type=\"text\" class=\"form-control dbsize\" name=\"attributeSize\" disabled=\"disabled\">\n" +
            "\t\t\t</div>\n" +
            "\t\t</div>\n" +
            "\t</div>\n" +
            "\t<div class=\"col-sm-3\">\n" +
            "\t\t<div class=\"checkbox\">\n" +
            "\t\t\t<label><input type=\"checkbox\" value=\"\" class=\"DBTypePK\"> Is Primary Key</label>\n" +
            "\t\t</div>\n" +
            "\t\t<div class=\"checkbox\">\n" +
            "\t\t\t<label><input type=\"checkbox\" value=\"\" disabled=\"disabled\" class=\"DBTypeAutoIncrement\"> Auto Increment</label>\n" +
            "\t\t</div>\n" +
            "\t\t<div class=\"checkbox\">\n" +
            "\t\t\t<label><input type=\"checkbox\" value=\"\" class=\"DBTypeFK\"> Is Foreign Key</label>\n" +
            "\t\t</div>\n" +
            "\t</div>\n" +
            "</div>\n" +
            "<div class=\"row\">\n" +
            "\t<label for=\"referencingEntity\" class=\"col-sm-3\">Referencing Entity:</label>\n" +
            "\t<div class=\"col-sm-3\">\n" +
            "\t\t<input type=\"text\" class=\"form-control DBReferencingEntity\" name=\"referencingEntity\" disabled=\"disabled\">\n" +
            "\t</div>\n" +
            "\t<label for=\"referencingAttribute\" class=\"col-sm-3\">Referencing Attribute:</label>\n" +
            "\t<div class=\"col-sm-3\">\n" +
            "\t\t<input type=\"text\" class=\"form-control DBReferencingAttribute\" name=\"referencingAttribute\" disabled=\"disabled\">\n" +
            "\t</div>\n" +
            "</div>\n" +
            "<div class=\"col-lg-12\"><hr></div>\n" +
            "</div>\n");


    }

    // Removes all attributes from the page
    function removeAllDBAttributes(){
        $('.DALAttribute').remove();
    }


    // This function removes the HTML for a DB Attribute altogether
    function removeDBAttribute(attribute){

        // Remove attribute from page
        $(attribute).parent().parent().remove();
    }


    // ***************************************
    // Content generation
    // ***************************************

    // This function generates content for selected languages
    function generateContent(){
        // T-SQL
        if ($('#RadioTSQL').prop('checked')) {
            $('#DivOutputTSQL').show();
        } else {
            $('#DivOutputTSQL').hide();
        }

        // MySQL
        if ($('#RadioMySQL').prop('checked')) {
            $('#DivOutputMySQL').show();
        } else {
            $('#DivOutputMySQL').hide();
        }

        // Oracle
        if ($('#RadioOracle').prop('checked')) {
            $('#DivOutputOracle').show();
        } else {
            $('#DivOutputOracle').hide();
        }

        // C++
        if ($('#CheckCPP').prop('checked')) {
            $('#DivOutputCPP').show();
        } else {
            $('#DivOutputCPP').hide();
        }

        // C#
        if ($('#CheckCS').prop('checked')) {
            $('#DivOutputCS').show();
        } else {
            $('#DivOutputCS').hide();
        }

        // Java
        if ($('#CheckJava').prop('checked')) {
            $('#DivOutputJava').show();
        } else {
            $('#DivOutputJava').hide();
        }

        // Python
        if ($('#CheckPython').prop('checked')) {
            $('#DivOutputPython').show();
        } else {
            $('#DivOutputPython').hide();
        }

        // PHP
        if ($('#CheckPHP').prop('checked')) {
            $('#DivOutputPHP').show();
        } else {
            $('#DivOutputPHP').hide();
        }


        $('#DivGeneratedContent').show();
    }

    // ***************************************
    // Utilities
    // ***************************************

    // This function returns the HTML to build a MySQL dropdown selection
    function getMySQLDropdown(){
        return "<option value=\"0\">--Select One--</option>\n" +
            "<option value=\"1\">BIGINT</option>\n" +
            "<option value=\"2\">BLOB</option>\n" +
            "<option value=\"3\">CHAR</option>\n" +
            "<option value=\"4\">DATE</option>\n" +
            "<option value=\"5\">DATETIME</option>\n" +
            "<option value=\"6\">DECIMAL</option>\n" +
            "<option value=\"7\">DOUBLE</option>\n" +
            "<option value=\"8\">ENUM</option>\n" +
            "<option value=\"9\">FLOAT</option>\n" +
            "<option value=\"10\">INT</option>\n" +
            "<option value=\"11\">LONGBLOB</option>\n" +
            "<option value=\"12\">LONGTEXT</option>\n" +
            "<option value=\"13\">MEDIUMBLOB</option>\n" +
            "<option value=\"14\">MEDIUMINT</option>\n" +
            "<option value=\"15\">MEDIUMTEXT</option>\n" +
            "<option value=\"16\">SET</option>\n" +
            "<option value=\"17\">SMALLINT</option>\n" +
            "<option value=\"18\">TEXT</option>\n" +
            "<option value=\"19\">TIME</option>\n" +
            "<option value=\"20\">TIMESTAMP</option>\n" +
            "<option value=\"21\">TINYINT</option>\n" +
            "<option value=\"22\">TINYTEXT</option>\n" +
            "<option value=\"23\">VARCHAR</option>\n" +
            "<option value=\"24\">YEAR</option>";
    }

    // This function returns the HTML to build a TSQL dropdown selection
    function getTSQLDropdown(){

        // Note, TSQL still needs to be implemented
        return "<option value=\"0\">--Select One--</option>\n";
    }

    // Takes as input a DB Attribute dropdown value and returns the corresponding DateTypeString
    function getDataTypeString(dbsizeID){
        switch (dbsizeID) {
            case "1":
                return "BIGINT";
            case "2":
                return "BLOB";
            case "3":
                return "CHAR";
            case "4":
                return "DATE";
            case "5":
                return "DATETIME";
            case "6":
                return "DECIMAL";
            case "7":
                return "DOUBLE";
            case "8":
                return "ENUM";
            case "9":
                return "FLOAT";
            case "10":
                return "INT";
            case "11":
                return "LONGBLOB";
            case "12":
                return "LONGTEXT";
            case "13":
                return "MEDIUMBLOB";
            case "14":
                return "MEDIUMINT";
            case "15":
                return "MEDIUMTEXT";
            case "16":
                return "SET";
            case "17":
                return "SMALLINT";
            case "18":
                return "TEXT";
            case "19":
                return "TIME";
            case "20":
                return "TIMESTAMP";
            case "21":
                return "TINYINT";
            case "22":
                return "TINYTEXT";
            case "23":
                return "VARCHAR";
            case "24":
                return "YEAR";
            default:
                return "INVALID";
        }

    }

    function enableDBSize(input){

        switch (input){
            case "CHAR":
            case "VARCHAR":
            case "NCHAR":
            case "NVARCHAR":
            case "BINARY":
            case "VARBINARY":
            case "DECIMAL":
            case "NUMERIC":
            case "FLOAT":
                return true;
            default:
                return false;
        }
    }


    </script>

</head>

<body>


<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="https://www.opendevtools.org">OpenDevTools</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">DALGen
        <small>The Data Access Layer Generator</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="https://www.opendevtools.org/dalgen">About Dalgen</a></li>
    </ol>

    <div class="row">
        <div class="col-lg-4 col-sm-3"></div>
        <div class="col-lg-4 col-sm-6"><img class="card-img-top rounded mb-4" src="images/dalgenlogo.png" alt="DAL Gen">
        </div>
        <div class="col-lg-4 col-sm-3"></div>
    </div>

    <div class="row">



        <div class="col-lg-12 mb-4">
            <div id="AlertPK" class="alert alert-warning alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Welcome to DALGen - Web </strong><span class="font-italic"><p>DALGen, the Data Access Layer Generator, prepares a robust database access
                architecture by automatically generating database objects and code libraries tailored to
                secure data access. It can produce code for various DBMS platforms, including Microsoft SQL Server,
                MySQL, and Oracle. Additionally, DALGen can produce secure, object-oriented, data access layers for C++,
                C#, Java, Python, and PHP. To use the tool, you first design a database E/R diagram. Then, the schema
                for each entity in the E/R diagram is created via the DALGen graphical user interface. The result is
                a collection of SQL scripts to create an initial database schema along with stored procedures to
                perform basic SCRUD (search create read update delete) operations on each entity, as well as
                object-oriented code libraries for interacting with the generated schema in the programming
                languages of the user’s preference. Note, we currently only support MySQL and PHP DAL Generation.
                Additional languages will be supported in the future.
            </p>
            <p>
                DALGen is an open-source project developed by OpenDevTools. For more information regarding how to use DALGen, how to request support, how to submit bugs, or how to contribute to the DALGen project, please visit <a href="https://www.opendevtools.org">OpenDevTools</a>.
            </p></span>
            </div>

        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-12 mb-2">
            <h3 class="text-center font-italic">Desired Output Files</h3>
        </div>
        <div class="col-lg-6">
            <div class="form-group card">
                <div class="card-header">
                    <strong>DBMS Schema & Stored Procedures</strong>
                </div>
                <div class="card-body">
                    <div class="radio">
                        <label><input id="RadioMySQL" class="radioDBType" type="radio" name="radioDBType"> MySQL</label>
                    </div>
                    <div class="radio">
                        <label><input id="RadioTSQL" class="radioDBType" type="radio" name="radioDBType" disabled> MS SQL (T-SQL)</label>
                    </div>
                    <div class="radio">
                        <label><input id="RadioOracle" class="radioDBType" type="radio" name="radioDBType" disabled> Oracle</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group card">
                <div class="card-header">
                    <strong>Data Access Layer</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="checkbox">
                                <label><input id="CheckCPP" type="checkbox" value="" disabled> C++</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="CheckCS" type="checkbox" value="" disabled> C#</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="checkbox">
                                <label><input id="CheckJava" type="checkbox" value="" disabled> Java</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="CheckPython" type="checkbox" value="" disabled> Python</label>
                            </div>
                            <div class="checkbox">
                                <label><input id="CheckPHP" type="checkbox" value=""> PHP</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div id="AlertPK" class="alert alert-info alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Notice: </strong><span class="font-italic">The Schema Name and Namespace fields are optional and only used in the production content for certain languages.</span>
            </div>
        </div>



        <div class="col-lg-12 mb-2">
            <h3 class="text-center font-italic">Schema Design</h3>
        </div>
        <label for="DatabaseName" class="col-lg-2">Database Name: <span style="color:red">*</span></label>
        <div class="col-lg-10 mb-4">
            <input type="text" class="form-control" name="dbname" id="DatabaseName">
        </div>
        <label for="ERName" class="col-lg-2">Entity / Relation Name: <span style="color:red">*</span></label>
        <div class="col-lg-10 mb-4">
            <input type="text" class="form-control" name="erName" id="ERName">
        </div>
        <label for="SchemaName" class="col-lg-2">Schema Name:</label>
        <div class="col-lg-10 mb-4">
            <input type="text" class="form-control" name="schemaName" id="SchemaName">
        </div>
        <label for="Namespace" class="col-lg-2">Namespace:</label>
        <div class="col-lg-10 mb-4">
            <input type="text" class="form-control" name="namespace" id="Namespace">
        </div>
    </div>
    <hr>
    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <h3 class="text-center font-italic">Controls</h3>
        </div>
        <div class="col-lg-3">
        </div>
        <div class="col-lg-2">
            <input type="button" class="btn btn-block btn-warning" value="Reset" onclick="resetGrid();">
        </div>
        <div class="col-lg-2">
            <input type="button" class="btn btn-block btn-primary" value="Add Property" onclick="addDBAttribute();">
        </div>
        <div class="col-lg-2">
            <input type="button" class="btn btn-block btn-success" value="Generate" onclick="generateContent();">
        </div>
        <div class="col-lg-3">
        </div>
    </div>
    <hr>
    <div id="DivDesign" class="row">
        <div class="col-lg-12 mb-2">
            <h3 class="text-center font-italic">Entity Properties</h3>
            <div id="AlertPK" class="alert alert-info alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Notice: </strong><span class="font-italic">We strongly recommend that each generated entity have a integer primary key. This helps produce optimal code for Load, Update, and Delete stored procedures. If you are using DALGen to generate ViewModels for your Data Access Layer, this is not an issue.</span>
            </div>
        </div>
    </div>
    <div id="DivProperties" class="row">

        <!-- Generic Property Design -->
        <!--
        <div class="DALAttribute col-lg-12 mb-4">
            <div class="row"><a onclick="removeDBAttribute(this);" class="close close-attribute">&times;</a></div>

            <div class="row">
                <div class="col-sm-9">
                    <div class="row mb-2">
                        <label for="attributeName" class="col-sm-4">Attribute Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="attributeName">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="attributeType" class="col-sm-4">Attribute Type:</label>
                        <div class="col-sm-4">
                            <select class="form-control dbtype" name="attributeType">
                                <option value="0">--Select One--</option>
                                <option value="1">BIGINT</option>
                                <option value="2">BLOB</option>
                                <option value="3">CHAR</option>
                                <option value="4">DATE</option>
                                <option value="5">DATETIME</option>
                                <option value="6">DECIMAL</option>
                                <option value="7">DOUBLE</option>
                                <option value="8">ENUM</option>
                                <option value="9">FLOAT</option>
                                <option value="10">INT</option>
                                <option value="11">LONGBLOB</option>
                                <option value="12">LONGTEXT</option>
                                <option value="13">MEDIUMBLOB</option>
                                <option value="14">MEDIUMINT</option>
                                <option value="15">MEDIUMTEXT</option>
                                <option value="16">SET</option>
                                <option value="17">SMALLINT</option>
                                <option value="18">TEXT</option>
                                <option value="19">TIME</option>
                                <option value="20">TIMESTAMP</option>
                                <option value="21">TINYINT</option>
                                <option value="22">TINYTEXT</option>
                                <option value="23">VARCHAR</option>
                                <option value="24">YEAR</option>
                            </select>

                        </div>
                        <label for="attributeSize" class="col-sm-2">Attribute Size:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control dbsize" name="attributeSize" disabled="disabled">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox">
                        <label><input type="checkbox" value="" class="DBTypePK"> Is Primary Key</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" disabled="disabled" class="DBTypeAutoIncrement"> Auto Increment</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" class="DBTypeFK"> Is Foreign Key</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="referencingEntity" class="col-sm-3">Referencing Entity:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control DBReferencingEntity" name="referencingEntity" disabled="disabled">
                </div>
                <label for="referencingAttribute" class="col-sm-3">Referencing Attribute:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control DBReferencingAttribute" name="referencingAttribute" disabled="disabled">
                </div>
            </div>


        </div>
        -->
        <!-- End Generic Property Design -->
    </div>
    <div id="DivGeneratedContent" class="row">
        <div class="col-lg-12 mb-2">
            <h3 class="text-center font-italic">Generated Output</h3>
        </div>
        <!-- DBMS Section -->
        <div class="col-lg-12 mb-2" id="DivOutputMySQL">
            <div class="form-group">
                <label for="TextareaMySQL">MySQL:</label>
                <textarea class="form-control" rows="10" id="TextareaMySQL"></textarea>
            </div>
        </div>
        <div class="col-lg-12 mb-2" id="DivOutputTSQL">
            <div class="form-group">
                <label for="TextareaTSQL">T-SQL:</label>
                <textarea class="form-control" rows="10" id="TextareaTSQL"></textarea>
            </div>
        </div>
        <div class="col-lg-12 mb-2" id="DivOutputOracle">
            <div class="form-group">
                <label for="TextareaOracle">Oracle:</label>
                <textarea class="form-control" rows="10" id="TextareaOracle"></textarea>
            </div>
        </div>
        <!-- End DBMS Section -->

        <!-- DAL Section -->
        <div class="col-lg-12 mb-2" id="DivOutputC">
            <div class="form-group">
                <label for="TextareaC">C:</label>
                <textarea class="form-control" rows="10" id="TextareaC"></textarea>
            </div>
        </div>
        <div class="col-lg-12 mb-2" id="DivOutputCPP">
            <div class="form-group">
                <label for="TextareaCPP">C++:</label>
                <textarea class="form-control" rows="10" id="TextareaCPP"></textarea>
            </div>
        </div>
        <div class="col-lg-12 mb-2" id="DivOutputCS">
            <div class="form-group">
                <label for="TextareaCS">C#:</label>
                <textarea class="form-control" rows="10" id="TextareaCS"></textarea>
            </div>
        </div>
        <div class="col-lg-12 mb-2" id="DivOutputJava">
            <div class="form-group">
                <label for="TextareaJava">Java:</label>
                <textarea class="form-control" rows="10" id="TextareaJava"></textarea>
            </div>
        </div>
        <div class="col-lg-12 mb-2" id="DivOutputPython">
            <div class="form-group">
                <label for="TextareaPython">Python:</label>
                <textarea class="form-control" rows="10" id="TextareaPython"></textarea>
            </div>
        </div>
        <div class="col-lg-12 mb-2" id="DivOutputPHP">
            <div class="form-group">
                <label for="TextareaPHP">PHP:</label>
                <textarea class="form-control" rows="10" id="TextareaPHP"></textarea>
            </div>
        </div>

        <!-- End DAL Section -->

    </div>


</div>
<!-- /.container -->

<!-- Footer -->
<br/><br/><br/><br/><br/><br/>
<!--
<footer class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <form class="m-0 text-center" action="https://www.paypal.com/cgi-bin/webscr" method="post">

                    <input type="hidden" name="business"
                           value="opendevtools@gmail.com">


                    <input type="hidden" name="cmd" value="_donations">


                    <input type="hidden" name="item_name" value="Friends of Open Sources">
                    <input type="hidden" name="item_number" value="OpenDevTools Campaign">
                    <input type="hidden" name="currency_code" value="USD">


                    <input type="image" name="submit"
                           src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_donate_92x26.png"
                           alt="Donate">
                    <img alt="" width="1" height="1"
                         src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                </form>
            </div>
            <div class="col-lg-6 col-md-6">
                <p class="m-0 text-center text-white">Copyright &copy; opendevtools.org 2017 - <a href="https://www.opendevtools.org/policy.php"><b>Private
                            Policy</a></p></b>
            </div>
            <div class="col-lg-3 col-md-3">
            </div>
        </div>
    </div>
</footer>
-->


</body>

</html>
