<?php
require_once("controller.php");
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Issue Tracking System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<body>

<form method="post" action="">
<div class="container">
    <div class="row">
        <input type="hidden" name="idval" id="idval">
    </div>
    <div class="row" >
       <div class="col-md-12">
           <div class="row">
               <h4 class="text-center">
                   Issue Registration
               </h4>

           </div>

            <div class="row">
                 <div class="col-md-5">
                    <span class="pull-right">
                        Ticket No
                    </span>
                 </div>
                <div class="col-md-7" style="padding-left: 20px;">
                    <input  type="text" name="ticket" placeholder="Sys Generated" id="ticket">
                </div>
            </div>

       </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
                <table class="table table-responsive user-info">
                    <tr>
                        <th class="userFont">User</th>
                        <th>Division</th>
                        <th>Department</th>
                        <th>Section</th>
                        <th>Location</th>
                        <th>Supervisor</th>
                        <th class="userFont">Date</th>
                        <th class="userFont">Issue Of</th>
                        <th>Module</th>
                        <th>Page Name</th>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="name" class="auto"  id="user" cols="10" rows="1"></textarea>
                        </td>
                        <td>
                                <select class="" name="division" id="divi" >
                                    <option value="">Select</option>
                                    <?php
                                    foreach($dataDivision as $v){?>

                                    <option value="<?php echo $v["ID"] ?>"> <?php echo $v["DIVISION_NAME"] ?> </option> <?php }?>

                                </select>
                        </td>
                        <td>
                            <select class="" name="department" id="dept">
                                <option value="">Select</option>
                                <?php
                                foreach($dataDepartment as $v){?>

                                    <option value="<?php echo $v["ID"]?>"> <?php echo $v["DEPARTMENT_NAME"] ?> </option> <?php }?>


                            </select>
                        </td>
                        <td>
                            <select class="" name="section" id="section" >
                                <option value="">Select</option>
                                <?php
                                foreach($dataSection as $v){?>

                                    <option value="<?php echo $v["ID"]?>"> <?php echo $v["SECTION_NAME"] ?> </option> <?php }?>


                            </select>
                        </td>
                        <td>
                            <select class="" name="location" id="location" >
                                <option value="">Select</option>
                                <?php
                                foreach($dataLocation as $v){?>

                                    <option value="<?php echo $v["ID"]?>"> <?php echo $v["LOCATION_NAME"] ?> </option> <?php }?>

                            </select>
                        </td>
                        <td>
                            <textarea name="supervisor" id="supervisor" cols="23" rows="3"></textarea>
                        </td>
                        <td>
                            <input type="text" name="issueDate" class="dated" id="when_published">
                        </td>
                        <td> <select class="" name="issueOf" id="issueof" >
                                <option value="">Select</option>
                                <?php
                                foreach($IssueOf as $v){?>

                                    <option value="<?php echo $v?>"> <?php echo $v ?> </option> <?php }?>


                            </select>
                        </td>
                        <td>  <select class="" name="module" id="module"  >
                                <option value="">Select</option>
                                <?php
                                foreach($dataModule as $v){?>

                                    <option value=<?php echo $v["M_MOD_ID"]?> > <?php echo $v["MAIN_MODULE"] ?> </option> <?php }?>


                            </select>
                        </td>
                        <td> <select class="" id="menu" name="menu">
                                <option value="">Select</option>

                                    <option value="">-select- </option>

                            </select>
                        </td>


                    </tr>
                </table>
        </div>
    </div>
    <div class="row">
        <h4 class="userFont">Issue Details</h4>
        <textarea class="form-control"  name="issueDetails" id="details" cols="199" rows="3"></textarea>
        <br><br>
        </div>
    <div class="row">
        <div class="tbl-scroll">
            <table class="table table-bordered table-responsive register ">
                <tr>
                    <th class="userFont">Issue Date</th>
                    <th>Request To</th>
                    <th>Logic CRM Ref</th>
                    <th>Impact</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="dated" id="when_publishedxx" >
                    </td>
                    <td>
                        <textarea  class="auto" name="request" id="req" cols="23" rows="3"></textarea>
                    </td>
                    <td>
                        <textarea name="crm" id="crm" cols="23" rows="3"></textarea>
                    </td>
                    <td>
                        <textarea name="impact" id="impact" cols="60" rows="3"></textarea>
                    </td>
                </tr>

            </table>
        </div>
        <br>
        <div class="row">

            <table class="table table-bordered table-responsive " >
            <tr>
                <td>
                    <input type="submit" id="submit" name="submit" value="Save" class="btn btn-primary" onclick="BindTable()">
                </td>
                <td>
                    <input type="submit" id="update" name="update" value="update" class="btn btn-success" disabled>
                </td>
                <td>
                    <input type="submit" id="delete" name="delete" class="btn btn-danger"  value="Delete" disabled>
                </td>
                <td>
                    <button type="button" class="btn btn-default" id="refreshBtn" ">Refreash</button>
                </td>
            </tr>

            </table>


        </div>
        </div>

    </div>

</form>

<table id="tbDetails" class="table table-bordered table-responsive">
    <tr>

        <th>Username</th>
        <th>Division</th>
        <th>Department</th>
        <th>Section</th>
        <th>Location</th>
        <th>Supervisor</th>
        <th>Issue Of</th>
        <th>Module</th>
        <th>Page Name</th>
        <th>Issue Details</th>
        <th>Issue Date</th>
        <th>Request To</th>
        <th>Logic CRM Ref</th>
        <th>Impact</th>
    </tr>
    <tbody id="tableData" >

    </tbody>
</table>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>


<script>
    $('.dated').click(function(){
        $(this).datepicker({

            format: 'yyyy-mm-dd'
        });

    });

</script>



<script>

    $(function() {

        var availableTags = [];
        <?php

            if(isset($dataName) && !empty($dataName)){


        foreach($dataName as $userName){?>

        availableTags.push("<?php echo $userName; ?>")

        <?php
              }
             }

          ?>

        $('.auto').click(function () {


            var autoid = $(this).attr('id')

            $("#"+autoid).autocomplete({
                source: availableTags
            });

        });

        $('#refreshBtn').click(function(e){
            e.preventDefault();
          //  alert("clicked");
            location.reload();
        });
        })
</script>
<script>
    function Change(M_MODULE_ID)
    {
        $.ajax({
            url: 'controller.php',
            type: 'post',
            data: {LIB_MODULE:M_MODULE_ID},
            dataType: 'json',
            success:function(response){
                var len = response.length;
                $("#menu").empty();
                $.each(response, function(key, val) {
                    $("#menu").append('<option value="'+val.M_MENU_ID+'" >' +val.MENU_NAME +'</option>');
                    //console.log(val.M_MENU_ID+ " *** " + val.MENU_NAME);
                });
            }
        })
    }
    $(document).ready(function(){

        $("#module").on('change',function(){

            var M_MODULE_ID = $(this).val();

          Change(M_MODULE_ID);
        });

    });

</script>
<script>

    function BindTable()
    {

        $.ajax({
            type: "GET",
            url: "controller.php",
            data: {issue:"data"},
            dataType: "json",
            success: function (response) {

                $.each(response, function (index, obj) {
                    var row = '<tr class="joy" data-userid='+obj.ID +'> <td> ' + obj.USER_NAME + ' </td> <td>' + obj.DIVISION_NAME + '</td> <td>' + obj.DEPARTMENT_NAME + '</td> <td>' + obj.SECTION_NAME + '</td> <td>' + obj.LOCATION_NAME + '</td> <td>' + obj.SUPERVISOR + '</td><td>' + obj.ISSUE_OF + '</td> <td>' + obj.MAIN_MODULE + '</td> <td>' + obj.MENU_NAME + '</td> <td>' + obj.ISSUE_DETAILS + '</td> <td>' + obj.ISSUE_DATE + '</td> <td>' + obj.REQUEST_TO + '</td> <td>' + obj.CRM_REF + '</td> <td>' + obj.IMPACT + '</td> </tr>'
                    $("#tableData").append(row);
                });
                var firstelem = response.shift();
                $('#ticket').val(firstelem.ID);
            }




        });

    }


    $(document).ready(function () {
        BindTable();
    });
</script>
<script>

    $(document).ready(function () {
        $("#tableData").on('click','.joy',function(){
            $( "#submit" ).prop( "disabled", true );
            $( "#update" ).prop( "disabled", false );
            $( "#delete" ).prop( "disabled", false );
            var id1=$(this).data('userid');
            $.ajax({
                    type: "GET",
                    url: "controller.php",
                    data: {id: id1},

                    success: function (response) {
                        var firstelem = (JSON.parse(response)).shift();
                        // alert(firstelem.ISSUE_OF);
                        $("#idval").val(id1);
                        $("#user").val(firstelem.USER_NAME);
                        $("#divi").val(firstelem.DIVISION_ID);
                        $("#dept").val(firstelem.DEPARTMNT_ID);
                        $("#section").val(firstelem.SECTION_ID);
                        $("#location").val(firstelem.LOCATION_ID);
                        $("#supervisor").val(firstelem.SUPERVISOR);
                        $("#when_published").val(firstelem.ISSUE_DATE);
                        $("#issueof").val(firstelem.ISSUE_OF);
                        $("#module").val(firstelem.MODULE_ID);
                        //$("#menu").val(firstelem.MENU_ID);
                        $("#details").val(firstelem.ISSUE_DETAILS);
                        $("#when_publishedxx").val(firstelem.ISSUE_DATE);
                        $("#req").val(firstelem.REQUEST_TO);
                        $("#crm").val(firstelem.CRM_REF);
                        $("#impact").val(firstelem.IMPACT);
                        Change(firstelem.MODULE_ID);


                    }
                }

            )
        });
    });


</script>
<script>
    $(document).ready(function(){
        $("testarea").focus(function(){
            $(this).css("background-color", "#cccccc");
        });
        $("textarea").blur(function(){
            $(this).css("background-color", "#ffffff");
        });
    });
</script>

<style>
    .joy{
        cursor: pointer;
    }
</style>
</body>

</html>