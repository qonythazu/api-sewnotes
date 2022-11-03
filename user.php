<?php
require_once "user_method.php";
$usr = new User();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"]))
         {
            $id=intval($_GET["id"]);
            $usr->get_user($id);
         }
         else
         {
            $usr->get_users();
         }
         break;
   case 'POST':
         if(!empty($_GET["id"]) && $_GET["action"] == 'email')
         {
            $id=intval($_GET["id"]);
            $usr->update_email($id);
         }
         else if (!empty($_GET["id"]) && $_GET["action"] == 'password')
         {
            $id=intval($_GET["id"]);
            $usr->update_password($id);
         }
         else
         {
            $usr->insert_user();
         }     
         break; 
   case 'DELETE':
          $id=intval($_GET["id"]);
            $usr->delete_user($id);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
}
 
 
 
 
?>