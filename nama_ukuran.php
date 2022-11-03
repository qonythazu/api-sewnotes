<?php
require_once "nama_ukuran_method.php";
$cttn = new NamaUkuran();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->get_namaukuran($id);
         }
         else
         {
            $cttn->get_allnamaukuran();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->update_namaukuran($id);
         }
         else
         {
            $cttn->insert_namaukuran();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            $cttn->delete_namaukuran($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}

?>