<?php
require_once("connectionDB.php");
 //die(print_r($_POST));



if (isset($_POST['submit']))
{
  //die(print_r($_POST));
    //$ticket = $_POST["ticket"];
    $username = $_POST["name"];
    $division = $_POST["division"];
    $Department = $_POST["department"];
    $section = $_POST["section"];
    $location = $_POST["location"];
    $supervisor = $_POST["supervisor"];
    $issueOf = $_POST["issueOf"];
    $issueDate = $_POST["issueDate"];
    $issueDetails = $_POST["issueDetails"];
    $module = $_POST["module"];
    $menu = $_POST["menu"];
    $request = $_POST["request"];
    $crm = $_POST["crm"];
    $impact = $_POST["impact"];

    if ($_POST["name"] != ""  && $_POST["issueDate"] != "" && $_POST["issueDetails"]!="" && $_POST["issueOf"]!="" ) {
        $insert = oci_parse($conn,"INSERT INTO ISSUE_REGISTRATION(USER_NAME,DIVISION_ID,DEPARTMENT_ID,SECTIONS_ID,LOCATIONS_ID,SUPERVISOR,ISSUE_DATE,ISSUE_DETAILS,ISSUE_OF,MODULES_ID,MENU_ID,REQUEST_TO,CRM_REF,IMPACT) VALUES ('$username','$division','$Department','$section','$location','$supervisor','$issueDate','$issueDetails','$issueOf','$module','$menu','$request','$crm','$impact')");
        //$sql="INSERT INTO ISSUE_REGISTRATION(USER_NAME,DIVISION,DEPARTMENT,SECTIONS,LOCATIONS,SUPERVISOR,ISSUE_DATE,MODULES,MENU,REQUEST_TO,CRM_REF,IMPACT) VALUES ('$username','$division','$Department','$section','$location','$supervisor','$issueDate','$module','$menu','$request','$crm','$impact')";
        //die(print_r($sql,true));

        oci_execute($insert);
        header('Location:index.php');
        echo '<script language="javascript">';
        //echo 'alert("Success!!!")';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo 'alert("Please fill up the blue labeled fields!!")';
        echo '</script>';
    }
}
if (isset($_POST['update']))
{

    //$ticket = $_POST["ticket"];
    $username = $_POST["name"];
    $division = $_POST["division"];
    $Department = $_POST["department"];
    $section = $_POST["section"];
    $location = $_POST["location"];
    $supervisor = $_POST["supervisor"];
    $issueOf = $_POST["issueOf"];
    $issueDate = $_POST["issueDate"];
    $issueDetails = $_POST["issueDetails"];
    $module = $_POST["module"];
    $menu = $_POST["menu"];
    $request = $_POST["request"];
    $crm = $_POST["crm"];
    $impact = $_POST["impact"];
    $tableId=$_POST["idval"];
    //die(print ($tableId));
    $update=oci_parse($conn,"UPDATE ISSUE_REGISTRATION
                            SET USER_NAME='$username',
                              DIVISION_ID='$division',
                              DEPARTMENT_ID='$Department',
                              SECTIONS_ID= '$section',
                              LOCATIONS_ID='$location',
                              SUPERVISOR='$supervisor',
                              ISSUE_OF='$issueOf',
                              ISSUE_DATE='$issueDate',
                              ISSUE_DETAILS='$issueDetails',
                              MODULES_ID='$module',
                              MENU_ID='$menu',
                              REQUEST_TO='$request',
                              CRM_REF='$crm',
                              IMPACT='$impact'
                              WHERE ID='$tableId'");

    //die(print ($update));

    oci_execute($update);
    echo '<script language="javascript">';
    echo 'alert("Updated")';
    echo '</script>';
    header('Location:index.php');



}
if(isset($_POST['delete']))
{
    $tableId1=$_POST['idval'];
    $delete=oci_parse($conn,"DELETE FROM ISSUE_REGISTRATION WHERE ID='$tableId1'");
    oci_execute($delete);
    echo '<script language="javascript">';
    echo 'alert("Deleted!!!")';
    echo '</script>';
    header('Location:index.php');
}

if (array_key_exists('issue',$_GET)) {
    $showQuery=oci_parse($conn,"SELECT e.USER_NAME,e.ID,divi.DIVISION_NAME,dept.DEPARTMENT_NAME,sec.SECTION_NAME,e.ISSUE_DATE,mod.MAIN_MODULE,menu.MENU_NAME,e.SUPERVISOR,e.ISSUE_OF,e.ISSUE_DETAILS,e.REQUEST_TO,e.CRM_REF,e.IMPACT,loc.LOCATION_NAME FROM ISSUE_REGISTRATION e
                            JOIN LIB_DIVISION divi ON e.DIVISION_ID=divi.ID
                            JOIN LIB_DEPARTMENT dept ON e.DEPARTMENT_ID=dept.ID
                            JOIN LIB_SECTION sec ON e.SECTIONS_ID=sec.ID
                            JOIN MAIN_MODULE mod ON e.MODULES_ID=mod.M_MOD_ID
                            JOIN MAIN_MENU menu ON e.MENU_ID=menu.M_MENU_ID
                            JOIN LIB_LOCATION loc ON e.LOCATIONS_ID=loc.ID
                            ORDER BY e.ID DESC

                      ");
    oci_execute($showQuery);
    while($row=oci_fetch_array($showQuery, OCI_ASSOC+OCI_RETURN_NULLS))
    {
        $dataShow[]=$row;
    }
    echo json_encode($dataShow);
//    die(print $dataShow[0]);
    //die(print_r(json_encode($dataShow)));
}
if (array_key_exists('id',$_GET))
{

    $id=$_GET['id'];
    //die(print_r($id));

    $upQuery=oci_parse($conn,"SELECT e.USER_NAME,e.ID,divi.ID as DIVISION_ID,divi.DIVISION_NAME,
                            dept.ID as DEPARTMNT_ID,dept.DEPARTMENT_NAME,
                            sec.ID as SECTION_ID,sec.SECTION_NAME,
                            e.ISSUE_DATE,mod.M_MOD_ID as MODULE_ID,mod.MAIN_MODULE, MENU_ID, menu.MENU_NAME,e.SUPERVISOR,e.ISSUE_OF,e.ISSUE_DETAILS,e.REQUEST_TO,e.CRM_REF,e.IMPACT,loc.ID as LOCATION_ID,loc.LOCATION_NAME FROM ISSUE_REGISTRATION e

                            JOIN LIB_DIVISION divi ON e.DIVISION_ID=divi.ID
                            JOIN LIB_DEPARTMENT dept ON e.DEPARTMENT_ID=dept.ID
                            JOIN LIB_SECTION sec ON e.SECTIONS_ID=sec.ID
                            JOIN MAIN_MODULE mod ON e.MODULES_ID=mod.M_MOD_ID
                            JOIN MAIN_MENU menu ON e.MENU_ID=menu.M_MENU_ID
                            JOIN LIB_LOCATION loc ON e.LOCATIONS_ID=loc.ID WHERE e.ID=$id

                      ");
    oci_execute($upQuery);
    while($row=oci_fetch_array($upQuery, OCI_ASSOC+OCI_RETURN_NULLS))
    {
        $dataUp[]=$row;
    }
    echo json_encode($dataUp);
   // die('<pre>'.print_r($dataUp,true));
}



$queryName=oci_parse($conn,"SELECT USER_NAME FROM USER_PASSWD");
oci_execute($queryName);
while($row=oci_fetch_array($queryName, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $dataName[]=$row["USER_NAME"];
}

$name=json_encode($dataName);

$queryDivision=oci_parse($conn,"SELECT * FROM LIB_DIVISION");
oci_execute($queryDivision);
while($row1=oci_fetch_array($queryDivision, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $dataDivision[]=$row1;
}

$queryDepartment=oci_parse($conn,"SELECT * FROM LIB_DEPARTMENT");
oci_execute($queryDepartment);
while($row2=oci_fetch_array($queryDepartment, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $dataDepartment[]=$row2;
}

$querySection=oci_parse($conn,"SELECT * FROM LIB_SECTION");
oci_execute($querySection);
while($row3=oci_fetch_array($querySection, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $dataSection[]=$row3;
}
$queryLocation=oci_parse($conn,"SELECT * FROM LIB_LOCATION");
oci_execute($queryLocation);
while($row3=oci_fetch_array($queryLocation, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $dataLocation[]=$row3;
}
$IssueOf=array("ERP", "EMAIL", "NETWORK", "DESCIPLIN","ICT","DAYCARE","HEALTHCARE","SECURITY SERVICE","TRANSPORT","HRM","OTHERS");

$queryModule=oci_parse($conn,"SELECT * FROM MAIN_MODULE");
oci_execute($queryModule);
while($row3=oci_fetch_array($queryModule, OCI_ASSOC+OCI_RETURN_NULLS))
{
    $dataModule[]=$row3;
}

if(array_key_exists('LIB_MODULE',$_POST))
{
    $dataMenu=array();
    $M_id=$_POST['LIB_MODULE'];
    $queryMenu=oci_parse($conn,"SELECT * FROM MAIN_MENU where M_MODULE_ID=$M_id");
    oci_execute($queryMenu);
    while($row3=oci_fetch_array($queryMenu, OCI_ASSOC+OCI_RETURN_NULLS))
    {
        $dataMenu[]=$row3;
    }
    echo json_encode($dataMenu);
}
?>