<?php
require_once "koneksi.php";
class User 
{
 
   public  function get_users()
   {
      global $mysqli;
      $query="SELECT * FROM user";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Semua Data User',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_user($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM user";
      if($id != 0)
      {
         $query.=" WHERE id=".$id." LIMIT 1";
      }
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Data User',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_user()
      {
         global $mysqli;
         $arrcheckpost = array(
            'email' => '', 
            'password' => '', 
            );

         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
               $email = htmlspecialchars($_POST['email']);
               $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
 
               $result = mysqli_query($mysqli, "INSERT INTO user VALUES(
               NULL,
               '$email',
               '$password'
               )");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Menambahkan User'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal Menambahkan User'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Tidak Sesuai'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
    
   function update_email($id)
      {
        global $mysqli;
        $arrcheckpost = array(
           'email' => ''
       );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
             $email = htmlspecialchars($_POST['email']);

             $result = mysqli_query($mysqli, "UPDATE user SET
             email = '$email'
             WHERE id='$id'");
         
           if($result)
           {
              $response=array(
                 'status' => 1,
                 'message' =>'Berhasil Mengubah Email'
              );
           }
           else
           {
              $response=array(
                 'status' => 0,
                 'message' =>'Gagal Mengubah Email'
              );
           }
        }else{
           $response=array(
                    'status' => 0,
                    'message' =>'Parameter Tidak Sesuai'
                 );
        }
        header('Content-Type: application/json');
        echo json_encode($response); 
      }
    
   function update_password($id)
      {
         global $mysqli;
         $arrcheckpost = array( 
            'password' => '', 
        );
         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
              $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

              $result = mysqli_query($mysqli, "UPDATE user SET
              password = '$password'
              WHERE id='$id'");
          
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Berhasil Mengubah Password'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Gagal Mengubah Password'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Tidak Sesuai'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete_user($id)
   {
      global $mysqli;
      $query="DELETE FROM user WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Berhasil Menghapus User'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal Menghapus User'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
 ?>