<?php
require_once "ukuran_detail_catatan_method.php";
$cttn = new UkuranDetailCatatan();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->get_ukurandetailcatatan($id);
         }
         else
         {
            $cttn->get_allukurandetailcatatan();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->update_ukurandetailcatatan($id);
         }
         else
         {
            $cttn->insert_ukurandetailcatatan();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            $cttn->delete_ukurandetailcatatan($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}

?>