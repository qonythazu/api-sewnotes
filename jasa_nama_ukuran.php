<?php
require_once "jasa_nama_ukuran_method.php";
$cttn = new JasaNamaUkuran();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->get_jasanamaukuran($id);
         }
         else
         {
            $cttn->get_alljasanamaukuran();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $cttn->update_jasanamaukuran($id);
         }
         else
         {
            $cttn->insert_jasanamaukuran();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            $cttn->delete_jasanamaukuran($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}

?>