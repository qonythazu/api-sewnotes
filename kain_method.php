<?php
require_once "koneksi.php";
class Kain 
{
 
   public  function get_kainkain()
   {
      global $mysqli;
      $query="SELECT * FROM kain";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Semua Data Kain',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_kain($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM kain";
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
                     'message' =>'Berhasil Mendapatkan Data Kain',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }

   public function get_kain_user($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM kain";
      if($id != 0)
      {
         $query.=" WHERE id_user=".$id." LIMIT 1";
      }
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Data Kain User',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_kain()
      {
         global $mysqli;
         $arrcheckpost = array(
            'id_user' => '', 
            'nama_kain' => '', 
            'harga_kain' => '',
            );

         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
               $id_user = htmlspecialchars($_POST['id_user']);
               $nama_kain = htmlspecialchars($_POST['nama_kain']);
               $harga_kain = htmlspecialchars($_POST['harga_kain']);
               $result = mysqli_query($mysqli, "INSERT INTO kain VALUES(
               NULL,
               '$id_user',
               '$nama_kain',
               '$harga_kain'
               )");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Menambahkan Kain'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal Menambahkan Kain'
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
    
   function update_kain($id)
      {
        global $mysqli;
        $arrcheckpost = array(
           'nama_kain' => '',
           'harga_kain' => ''
       );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
             $nama_kain = htmlspecialchars($_POST['nama_kain']);
             $harga_kain = htmlspecialchars($_POST['harga_kain']);

             $result = mysqli_query($mysqli, "UPDATE kain SET
             nama_kain = '$nama_kain',
             harga_kain = '$harga_kain'
             WHERE id='$id'");
         
           if($result)
           {
              $response=array(
                 'status' => 1,
                 'message' =>'Berhasil Mengedit Kain'
              );
           }
           else
           {
              $response=array(
                 'status' => 0,
                 'message' =>'Gagal Mengedit Kain'
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
 
   function delete_kain($id)
   {
      global $mysqli;
      $query="DELETE FROM kain WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Berhasil Menghapus Kain'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal Menghapus Kain'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
 ?>