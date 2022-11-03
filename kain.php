<?php
require_once "kain_method.php";
$cttn = new Kain();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->get_kain($id);
         }
         else
         {
            $cttn->get_kainkain();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->update_kain($id);
         }
         else
         {
            $cttn->insert_kain();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            $cttn->delete_kain($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}

?>