<?php
require_once "koneksi.php";
class Catatan 
{
 
   public  function get_notes()
   {
      global $mysqli;
      $query="SELECT * FROM catatan";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Semua Catatan',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_catatan($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM catatan";
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
                     'message' =>'Berhasil Mendapatkan Catatan',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_catatan()
      {
         global $mysqli;
         $arrcheckpost = array(
            'id_user' => '', 
            'nama_pelanggan' => '', 
            'no_telp_pelanggan' => '',
            'status_catatan' => ''
            );

         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
               $id_user = htmlspecialchars($_POST['id_user']);
               $nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
               $no_telp_pelanggan = htmlspecialchars($_POST['no_telp_pelanggan']);
               $status_catatan = htmlspecialchars($_POST['status_catatan']);

               $result = mysqli_query($mysqli, "INSERT INTO catatan VALUES(
               NULL,
               '$id_user',
               '$nama_pelanggan',
               '$no_telp_pelanggan',
               '$status_catatan'
               )");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Menambahkan Catatan'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal Menambahkan Catatan'
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
    
   function update_catatan($id)
      {
        global $mysqli;
        $arrcheckpost = array(
           'nama_pelanggan' => '',
           'no_telp_pelanggan' => '',
           'status_catatan' => ''
       );
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
             $nama_pelanggan = htmlspecialchars($_POST['nama_pelanggan']);
             $no_telp_pelanggan = htmlspecialchars($_POST['no_telp_pelanggan']);
             $status_catatan = htmlspecialchars($_POST['status_catatan']);

             $result = mysqli_query($mysqli, "UPDATE catatan SET
             nama_pelanggan = '$nama_pelanggan',
             no_telp_pelanggan = '$no_telp_pelanggan',
             status_catatan = '$status_catatan'
             WHERE id='$id'");
         
           if($result)
           {
              $response=array(
                 'status' => 1,
                 'message' =>'Berhasil Mengedit Catatan'
              );
           }
           else
           {
              $response=array(
                 'status' => 0,
                 'message' =>'Gagal Mengedit Catatn'
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
 
   function delete_catatan($id)
   {
      global $mysqli;
      $query="DELETE FROM catatan WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Berhasil Menghapus Catatn'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal Menghapus Catatan'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
 ?>