<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/28/2018
 * Time: 5:15 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 'On');
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.11.72)(PORT = 1521)))(CONNECT_DATA=(SERVER = DEDICATED)
      (SERVICE_NAME = test)))" ;
$conn=oci_connect('LOGIC3RDVERSION','LOGIC3RDVERSION',$db);

?>