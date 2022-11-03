<?php
require_once "auth_method.php";
$usr = new Auth();
$request_method = $_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
      if (!empty($_GET["id"])) {
         $id = $_GET["id"];
         $usr->get_auth($id);
      }
      break;
   case 'POST':
      $usr->insert_auth();
      break;
   case 'DELETE':
      if (!empty($_GET["id"])) {
         $id = $_GET["id"];
         $usr->delete_auth($id);
      }
      break;
   default:
      // Invalid Request Method
      header("HTTP/1.0 405 Method Not Allowed");
      break;
      break;
}
