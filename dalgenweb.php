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

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">

    <style>
        .close-attribute{
            position:absolute;
            right:15px;
            z-index:999;
            cursor:pointer;
        }
    </style>

    <!-- Javascript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>



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



        // DBTypePK changed listener
        $('.radioDBType').change(function(){

            // Reset attributes
            removeAllDBAttributes();
            addDBAttribute();
        });

    });

    // ******************************
    // Listeners
    // ******************************

    $(document).on('change', ".DBtype", function() {
        var dbsizeID = this.value;

        if (enableDBSize(getDataTypeString(dbsizeID))) {
            $(this).parent().parent().find('.DBsize').prop("disabled", false);
        }
        else{
            $(this).parent().parent().find('.DBsize').val(""); // reset
            $(this).parent().parent().find('.DBsize').prop("disabled", true);
        }
    });

   $(document).on('click', ".DBTypePK", function() {
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
    $(document).on('click', ".DBTypeFK", function() {

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
        $('#TextareaMySQL').empty();
        $('#TextareaTSQL').empty();
        $('#TextareaOracle').empty();
        $('#TextareaC').empty();
        $('#TextareaCPP').empty();
        $('#TextareaCS').empty();
        $('#TextareaJava').empty();
        $('#TextareaPython').empty();
        $('#TextareaPHP').empty();


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

        // Build appropriate SQL DBType Dropdown list (TODO: Add Oracle)
        if ($('#RadioMySQL').prop('checked') === true)
            var sqlDropdown = getMySQLDropdown();
        else
            var sqlDropdown = getTSQLDropdown();

        // DivProperties
        $('#DivProperties').append("<div class=\"DALAttribute col-lg-12 mb-4\">\n" +
            "            <div class=\"row\"><a onclick=\"removeDBAttribute(this);\" class=\"close close-attribute\">&times;</a></div>\n" +
            "\n" +
            "            <div class=\"row\">\n" +
            "                <div class=\"col-sm-9\">\n" +
            "                    <div class=\"row mb-2\">\n" +
            "                        <label for=\"attributeName\" class=\"col-sm-4\">Attribute Name:</label>\n" +
            "                        <div class=\"col-sm-8\">\n" +
            "                            <input type=\"text\" class=\"form-control DBattributeName\" name=\"attributeName\">\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row mb-2\">\n" +
            "                        <label for=\"attributeType\" class=\"col-sm-4\">Attribute Type:</label>\n" +
            "                        <div class=\"col-sm-4\">\n" +
            "                            <select class=\"form-control DBtype\" name=\"attributeType\">\n" + sqlDropdown +
            "                            </select>\n" +
            "\n" +
            "                        </div>\n" +
            "                        <label for=\"attributeSize\" class=\"col-sm-2\">Attribute Size:</label>\n" +
            "                        <div class=\"col-sm-2\">\n" +
            "                            <input type=\"text\" class=\"form-control DBsize\" name=\"attributeSize\" disabled=\"disabled\">\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "                <div class=\"col-sm-3\">\n" +
            "                    <div class=\"checkbox\">\n" +
            "                        <label><input type=\"checkbox\" value=\"\" class=\"DBTypePK\"> Is Primary Key</label>\n" +
            "                    </div>\n" +
            "                    <div class=\"checkbox\">\n" +
            "                        <label><input type=\"checkbox\" value=\"\" disabled=\"disabled\" class=\"DBTypeAutoIncrement\"> Auto Increment</label>\n" +
            "                    </div>\n" +
            "                    <div class=\"checkbox\">\n" +
            "                        <label><input type=\"checkbox\" value=\"\" class=\"DBTypeFK\"> Is Foreign Key</label>\n" +
            "                    </div>\n" +
            "                </div>\n" +
            "            </div>\n" +
            "            <div class=\"row\">\n" +
            "                <label for=\"referencingEntity\" class=\"col-sm-3\">Referencing Entity:</label>\n" +
            "                <div class=\"col-sm-3\">\n" +
            "                    <input type=\"text\" class=\"form-control DBReferencingEntity\" name=\"referencingEntity\" disabled=\"disabled\">\n" +
            "                </div>\n" +
            "                <label for=\"referencingAttribute\" class=\"col-sm-3\">Referencing Attribute:</label>\n" +
            "                <div class=\"col-sm-3\">\n" +
            "                    <input type=\"text\" class=\"form-control DBReferencingAttribute\" name=\"referencingAttribute\" disabled=\"disabled\">\n" +
            "                </div>\n" +
            "            </div>\n" +
            "            <div class=\"col-lg-12\"><hr></div>\n" +
            "        </div>");


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


        // Validate form
        // Requirements:
        // 1) DatabaseName must exist
        // 2) EntityName must exist
        // 3) Attributes must be formatted correctly (DB Type selection


        // Build DALEntity objects
        var dbName = $('#DatabaseName').val();
        var entityName = $('#ERName').val();
        var schemaName = $('#SchemaName').val();
        var namespaceName = $('#Namespace').val();

        // If schemaName is not provided, use "usp" (User Stored Procedure)
        if (schemaName.toString() === "") {
            schemaName = "usp";
        }

        // Build DALAttribute objects
        var attributeCount = 0;
        var attributeCountPK = 0;
        var attributeCountFK = 0;
        var dalAttributes = [];
        var $this, input, text, obj;
        $('.DALAttribute').each(function() {
            var attribute = new Object();
            $this = $(this);

            // Name
            $input = $this.find(".DBattributeName");
            text = $input.val();
            attribute.name = text;

            // Type
            $input = $this.find(".DBtype option:selected");
            text = $input.text();
            attribute.type = text;

            // Size
            $input = $this.find(".DBsize");
            text = $input;
            attribute.size = text.val();

            // PK
            $input = $this.find(".DBTypePK");
            if ($input.prop('checked') === true)
                attribute.PK = true;
            else
                attribute.PK = false;

            // AutoIncrement
            $input = $this.find(".DBTypeAutoIncrement");
            if ($input.prop('checked') === true)
                attribute.autoincrement = true;
            else
                attribute.autoincrement = false;

            // FK
            $input = $this.find(".DBTypeFK");
            if ($input.prop('checked') === true)
                attribute.FK = true;
            else
                attribute.FK = false;

            // Referencing Entity
            $input = $this.find(".DBReferencingEntity");
            text = $input.val();
            attribute.refEntity = text;

            // Referencing Atrribute
            $input = $this.find(".DBReferencingAttribute");
            text = $input.val();
            attribute.refAttribute = text;

            // Add attribute to the list
            dalAttributes.push(attribute);
            attributeCount++;
            if (attribute.PK) {
                attributeCountPK++;
            }
            if (attribute.FK) {
                attributeCountFK++;
            }

        });



        // Get date
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10) {
            dd = '0'+dd
        }
        if(mm<10) {
            mm = '0'+mm
        }
        today = mm + '/' + dd + '/' + yyyy;



        $('#DivGeneratedContent').show();


        // T-SQL
        if ($('#RadioTSQL').prop('checked')) {
            $('#DivOutputTSQL').show();
        } else {
            $('#DivOutputTSQL').hide();
        }

        // MySQL
        if ($('#RadioMySQL').prop('checked')) {
            $('#DivOutputMySQL').show();
            $('#TextareaMySQL').empty();

            // Comments
            $('#TextareaMySQL').append("/*\n");
            $('#TextareaMySQL').append("Author:\t\t\tThis code was generated by DALGen Web available at https://dalgen.opendevtools.org\n");
            $('#TextareaMySQL').append("Date:\t\t\t" + today + "\n");
            $('#TextareaMySQL').append("Description:\t\tCreates the " + entityName + " table and respective stored procedures\n");
            $('#TextareaMySQL').append("\n*/\n\n");

            // Use database statement
            $('#TextareaMySQL').append("USE " + dbName + ";");
            $('#TextareaMySQL').append("\n\n");

            // Drop existing objects with the same names
            $('#TextareaMySQL').append("-- Overwrite existing objects that conflict. \n-- WARNING: To avoid loss of data please prepare a backup if necessary\n\n")
            $('#TextareaMySQL').append("DROP TABLE IF EXISTS `" + dbName + "`.`" + entityName + "`;\n");
            $('#TextareaMySQL').append("DROP PROCEDURE IF EXISTS `" + dbName + "`.`usp_" + entityName + "_LoadAll`;\n");
            $('#TextareaMySQL').append("DROP PROCEDURE IF EXISTS `" + dbName + "`.`usp_" + entityName + "_Search`;\n");
            $('#TextareaMySQL').append("DROP PROCEDURE IF EXISTS `" + dbName + "`.`usp_" + entityName + "_Add`;\n");
            $('#TextareaMySQL').append("DROP PROCEDURE IF EXISTS `" + dbName + "`.`usp_" + entityName + "_Load`;\n");
            $('#TextareaMySQL').append("DROP PROCEDURE IF EXISTS `" + dbName + "`.`usp_" + entityName + "_Delete`;\n");
            $('#TextareaMySQL').append("DROP PROCEDURE IF EXISTS `" + dbName + "`.`usp_" + entityName + "_Update`;\n");
            $('#TextareaMySQL').append("\n\n");

            // ********************************
            // Create table
            // ********************************

            $('#TextareaMySQL').append("-- Create Table \n");
            $('#TextareaMySQL').append("\nCREATE TABLE `" + dbName + "`.`" + entityName + "` (\n");
            // Add attributes
            for (var i = 0; i < attributeCount; i++){
                $('#TextareaMySQL').append(dalAttributes[i].name);
                $('#TextareaMySQL').append(" " + dalAttributes[i].type);
                if (enableDBSize(dalAttributes[i].type)) {
                    $('#TextareaMySQL').append("(" + dalAttributes[i].size + ")");
                }

                if (dalAttributes[i].autoincrement) {
                    $('#TextareaMySQL').append(" AUTO_INCREMENT");
                }

                if (i !== attributeCount - 1) {
                    $('#TextareaMySQL').append(",\n");
                }
            }
            // Add constraints
            var count = 0;
            for (var i = 0; i < attributeCount; i++){
                if (dalAttributes[i].PK || dalAttributes[i].FK ) {

                    if (count++ < attributeCountPK + attributeCountFK) {
                        $('#TextareaMySQL').append(",");
                    }
                    $('#TextareaMySQL').append("\n");

                    if (dalAttributes[i].PK) {
                        $('#TextareaMySQL').append("CONSTRAINT pk_" + entityName + "_" + dalAttributes[i].name + " PRIMARY KEY (" + dalAttributes[i].name + ")");
                    }

                    if (dalAttributes[i].FK) {
                        $('#TextareaMySQL').append("CONSTRAINT fk_" + entityName + "_" + dalAttributes[i].name + " FOREIGN KEY (" + dalAttributes[i].name + ") REFERENCES " + dalAttributes[i].refEntity + " (" + dalAttributes[i].refEntity + ")");
                    }
                }
            }

            $('#TextareaMySQL').append("\n);\n");
            $('#TextareaMySQL').append("\n\n");

            // ********************************
            // Create default SCRUD sprocs for this table
            // ********************************

            // Load

            $('#TextareaMySQL').append("DELIMITER //\n");
            $('#TextareaMySQL').append("CREATE PROCEDURE `" + dbName + "`.`" + schemaName + "_" + entityName + "_Load`\n");
            $('#TextareaMySQL').append("(\n");

            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (dalAttributes[i].PK) {
                    $('#TextareaMySQL').append("\tIN param" + dalAttributes[i].name + " " + dalAttributes[i].type);

                    if (enableDBSize(dalAttributes[i].type)) {
                        $('#TextareaMySQL').append("(" + dalAttributes[i].size + ")");
                    }

                    if(++count < attributeCountPK) {
                        $('#TextareaMySQL').append(",");
                    }
                    $('#TextareaMySQL').append("\n");
                }
            }

            $('#TextareaMySQL').append(")\n");
            $('#TextareaMySQL').append("BEGIN\n");
            $('#TextareaMySQL').append("\tSELECT\n");
            for (var i = 0; i < attributeCount; i++) {

                $('#TextareaMySQL').append("\t\t`" + entityName + "`.`" + dalAttributes[i].name + "` AS `" + dalAttributes[i].name + "`");

                if(++i < attributeCount) {
                    $('#TextareaMySQL').append(",");
                }
                $('#TextareaMySQL').append("\n");
            }
            $('#TextareaMySQL').append("\tFROM `" + entityName + "`\n");
            $('#TextareaMySQL').append("\tWHERE ");

            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (dalAttributes[i].PK) {
                    $('#TextareaMySQL').append("`" + entityName + "`.`" + dalAttributes[i].name + "` = param" + dalAttributes[i].name);

                    if(++count < attributeCountPK) {
                        $('#TextareaMySQL').append("\n\t\tAND ");
                    } else {
                        $('#TextareaMySQL').append(";");
                    }
                    $('#TextareaMySQL').append("\n");
                }
            }
            $('#TextareaMySQL').append("END //\n");
            $('#TextareaMySQL').append("DELIMITER ;\n");
            $('#TextareaMySQL').append("\n\n");

            // LoadAll

            $('#TextareaMySQL').append("DELIMITER //\n");
            $('#TextareaMySQL').append("CREATE PROCEDURE `" + dbName + "`.`" + schemaName + "_" + entityName + "_LoadAll`\n");
            $('#TextareaMySQL').append("(\n");
            $('#TextareaMySQL').append(")\n");
            $('#TextareaMySQL').append("BEGIN\n");
            $('#TextareaMySQL').append("\tSELECT\n");
            for (var i = 0; i < attributeCount; i++) {

                $('#TextareaMySQL').append("\t\t`" + entityName + "`.`" + dalAttributes[i].name + "` AS `" + dalAttributes[i].name + "`");

                if(++i < attributeCount) {
                    $('#TextareaMySQL').append(",");
                }
                $('#TextareaMySQL').append("\n");
            }
            $('#TextareaMySQL').append("\tFROM `" + entityName + "`;\n");
            $('#TextareaMySQL').append("END //\n");
            $('#TextareaMySQL').append("DELIMITER ;\n");
            $('#TextareaMySQL').append("\n\n");


            // Add

            $('#TextareaMySQL').append("DELIMITER //\n");
            $('#TextareaMySQL').append("CREATE PROCEDURE `" + dbName + "`.`" + schemaName + "_" + entityName + "_Add`\n");
            $('#TextareaMySQL').append("(\n");

            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (!dalAttributes[i].PK) {
                    $('#TextareaMySQL').append("\tIN param" + dalAttributes[i].name + " " + dalAttributes[i].type);

                    if (enableDBSize(dalAttributes[i].type)) {
                        $('#TextareaMySQL').append("(" + dalAttributes[i].size + ")");
                    }

                    if(++count < attributeCount - attributeCountPK) {
                        $('#TextareaMySQL').append(",");
                    }
                    $('#TextareaMySQL').append("\n");
                }
            }

            $('#TextareaMySQL').append(")\n");
            $('#TextareaMySQL').append("BEGIN\n");
            $('#TextareaMySQL').append("\tINSERT INTO `" + entityName + "` (");
            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (!dalAttributes[i].PK) {
                    $('#TextareaMySQL').append(dalAttributes[i].name);

                    if(++count < attributeCount - attributeCountPK) {
                        $('#TextareaMySQL').append(",");
                    }
                }
            }
            $('#TextareaMySQL').append(")\n");

            $('#TextareaMySQL').append("\tVALUES (");

            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (!dalAttributes[i].PK) {
                    $('#TextareaMySQL').append("param" + dalAttributes[i].name);

                    if(++count < attributeCount - attributeCountPK) {
                        $('#TextareaMySQL').append(",");
                    }
                }
            }
            $('#TextareaMySQL').append(");\n");

            $('#TextareaMySQL').append("\t-- Return last inserted ID as result\n");
            $('#TextareaMySQL').append("\tSELECT LAST_INSERT_ID() as id;\n");

            $('#TextareaMySQL').append("END //\n");
            $('#TextareaMySQL').append("DELIMITER ;\n");
            $('#TextareaMySQL').append("\n\n");

            // Update

            $('#TextareaMySQL').append("DELIMITER //\n");
            $('#TextareaMySQL').append("CREATE PROCEDURE `" + dbName + "`.`" + schemaName + "_" + entityName + "_Update`\n");
            $('#TextareaMySQL').append("(\n");

            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                $('#TextareaMySQL').append("\tIN param" + dalAttributes[i].name + " " + dalAttributes[i].type);

                if (enableDBSize(dalAttributes[i].type)) {
                    $('#TextareaMySQL').append("(" + dalAttributes[i].size + ")");
                }

                if(++count < attributeCount - attributeCountPK) {
                    $('#TextareaMySQL').append(",");
                }
                $('#TextareaMySQL').append("\n");
            }

            $('#TextareaMySQL').append(")\n");
            $('#TextareaMySQL').append("BEGIN\n");
            $('#TextareaMySQL').append("\tUPDATE `" + entityName + "`\n");

            $('#TextareaMySQL').append("\tSET\n");
            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (!dalAttributes[i].PK) {
                    $('#TextareaMySQL').append("\t\t" + dalAttributes[i].name + " = param" + dalAttributes[i].name);

                    if(++count < attributeCount - attributeCountPK) {
                        $('#TextareaMySQL').append(",");
                    }
                    $('#TextareaMySQL').append("\n");
                }
            }

            $('#TextareaMySQL').append("\tWHERE \n");
            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (dalAttributes[i].PK) {
                    $('#TextareaMySQL').append("\t\t" + dalAttributes[i].name + " = param" + dalAttributes[i].name);
                    if (++count <  attributeCountPK) {
                        $('#TextareaMySQL').append(" AND ")
                    } else {
                        $('#TextareaMySQL').append(";")
                    }
                    $('#TextareaMySQL').append("\n");
                }
            }

            $('#TextareaMySQL').append("END //\n");
            $('#TextareaMySQL').append("DELIMITER ;\n");
            $('#TextareaMySQL').append("\n\n");

            // Delete

            $('#TextareaMySQL').append("DELIMITER //\n");
            $('#TextareaMySQL').append("CREATE PROCEDURE `" + dbName + "`.`" + schemaName + "_" + entityName + "_Delete`\n");
            $('#TextareaMySQL').append("(\n");

            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (dalAttributes[i].PK) {
                    $('#TextareaMySQL').append("\tIN param" + dalAttributes[i].name + " " + dalAttributes[i].type);

                    if (enableDBSize(dalAttributes[i].type)) {
                        $('#TextareaMySQL').append("(" + dalAttributes[i].size + ")");
                    }

                    if(++count < attributeCountPK) {
                        $('#TextareaMySQL').append(",");
                    }
                    $('#TextareaMySQL').append("\n");
                }
            }

            $('#TextareaMySQL').append(")\n");
            $('#TextareaMySQL').append("BEGIN\n");
            $('#TextareaMySQL').append("\tDELETE FROM `" + entityName + "`\n");
            $('#TextareaMySQL').append("\tWHERE ");

            count = 0;
            for (var i = 0; i < attributeCount; i++) {
                if (dalAttributes[i].PK) {
                    $('#TextareaMySQL').append("`" + entityName + "`.`" + dalAttributes[i].name + "` = param" + dalAttributes[i].name);

                    if(++count < attributeCountPK) {
                        $('#TextareaMySQL').append("\n\t\tAND ");
                    } else {
                        $('#TextareaMySQL').append(";");
                    }
                    $('#TextareaMySQL').append("\n");
                }
            }
            $('#TextareaMySQL').append("END //\n");
            $('#TextareaMySQL').append("DELIMITER ;\n");
            $('#TextareaMySQL').append("\n\n");


            // Search


        } else {
            $('#TextareaMySQL').empty();
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
        return "<option value=\"0\">--Select One--</option>\n" +
            "<option value=\"1\">BIGINT</option>\n" +
            "<option value=\"25\">BINARY</option>\n" +
            "<option value=\"26\">BIT</option>\n" +
            "<option value=\"3\">CHAR</option>\n" +
            "<option value=\"4\">DATE</option>\n" +
            "<option value=\"5\">DATETIME</option>\n" +
            "<option value=\"27\">DATETIME2</option>\n" +
            "<option value=\"28\">DATETIMEOFFSET</option>\n" +
            "<option value=\"29\">DECIMAL</option>\n" +
            "<option value=\"9\">FLOAT</option>\n" +
            "<option value=\"30\">IMAGE</option>\n" +
            "<option value=\"10\">INT</option>\n" +
            "<option value=\"31\">MONEY</option>\n" +
            "<option value=\"32\">NCHAR</option>\n" +
            "<option value=\"33\">NTEXT</option>\n" +
            "<option value=\"34\">NUMERIC</option>\n" +
            "<option value=\"35\">NVARCHAR</option>\n" +
            "<option value=\"36\">REAL</option>\n" +
            "<option value=\"37\">SMALLDATETIME</option>\n" +
            "<option value=\"17\">SMALLINT</option>\n" +
            "<option value=\"38\">SMALLMONEY</option>\n" +
            "<option value=\"18\">TEXT</option>\n" +
            "<option value=\"21\">TINYINT</option>\n" +
            "<option value=\"39\">VARBINARY</option>\n" +
            "<option value=\"23\">VARCHAR</option>\n";
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
            case "25":
                return "BINARY";
            case "26":
                return "BIT";
            case "27":
                return "DATETIME2";
            case "28":
                return "DATETIMEOFFSET";
            case "29":
                return "DECIMAL";
            case "30":
                return "IMAGE";
            case "31":
                return "MONEY";
            case "32":
                return "NCHAR";
            case "33":
                return "NTEXT";
            case "34":
                return "NUMERIC";
            case "35":
                return "NVARCHAR";
            case "36":
                return "REAL";
            case "37":
                return "SMALLDATETIME";
            case "38":
                return "SMALLMONEY";
            case "39":
                return "VARBINARY";


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
                            <input type="text" class="form-control DBattributeName" name="attributeName">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="attributeType" class="col-sm-4">Attribute Type:</label>
                        <div class="col-sm-4">
                            <select class="form-control DBtype" name="attributeType">
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
                            <input type="text" class="form-control DBsize" name="attributeSize" disabled="disabled">
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
            <div class="col-lg-12"><hr></div>
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
