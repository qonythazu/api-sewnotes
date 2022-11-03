<?php
require_once "koneksi.php";
class Jasa 
{
 
   public  function get_jasajasa()
   {
      global $mysqli;
      $query="SELECT * FROM jasa";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Semua Data Jasa',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_jasa($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM jasa";
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
                     'message' =>'Berhasil Mendapatkan Data Jasa',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_jasa()
      {
         global $mysqli;
         $arrcheckpost = array(
            'id_user' => '', 
            'nama_jasa' => '', 
            'harga_dewasa' => '',
            'harga_anak' => ''
            );

         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
               $id_user = htmlspecialchars($_POST['id_user']);
               $nama_jasa = htmlspecialchars($_POST['nama_jasa']);
               $harga_dewasa = htmlspecialchars($_POST['harga_dewasa']);
               $harga_anak = htmlspecialchars($_POST['harga_anak']);

               $result = mysqli_query($mysqli, "INSERT INTO jasa VALUES(
               NULL,
               '$id_user',
               '$nama_jasa',
               '$harga_dewasa',
               '$harga_anak'
               )");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Menambahkan Jasa'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal Menambahkan Jasa'
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
    
   function update_jasa($id)
      {
        global $mysqli;
        $arrcheckpost = array(
           'nama_jasa' => '',
           'harga_dewasa' => '',
           'harga_anak' => ''
       );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
             $nama_jasa = htmlspecialchars($_POST['nama_jasa']);
             $harga_dewasa = htmlspecialchars($_POST['harga_dewasa']);
             $harga_anak = htmlspecialchars($_POST['harga_anak']);

             $result = mysqli_query($mysqli, "UPDATE jasa SET
             nama_jasa = '$nama_jasa',
             harga_dewasa = '$harga_dewasa',
             harga_anak = '$harga_anak'
             WHERE id='$id'");
         
           if($result)
           {
              $response=array(
                 'status' => 1,
                 'message' =>'Berhasil Mengedit Jasa'
              );
           }
           else
           {
              $response=array(
                 'status' => 0,
                 'message' =>'Gagal Mengedit Jasa'
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
 
   function delete_jasa($id)
   {
      global $mysqli;
      $query="DELETE FROM jasa WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Berhasil Menghapus Jasa'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal Menghapus Jasa'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
 ?>