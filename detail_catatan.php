<?php
require_once "detail_catatan_method.php";
$cttn = new DetailCatatan();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->get_detailcatatan($id);
         }
         else
         {
            $cttn->get_detailnotes();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->update_detailcatatan($id);
         }
         else
         {
            $cttn->insert_detailcatatan();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            $cttn->delete_detailcatatan($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}

?>