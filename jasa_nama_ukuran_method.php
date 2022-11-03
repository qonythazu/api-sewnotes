<?php
require_once "koneksi.php";
class JasaNamaUkuran
{
 
   public  function get_alljasanamaukuran()
   {
      global $mysqli;
      $query="SELECT * FROM jasa_nama_ukuran";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Semua Jasa Nama Ukuran',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_jasanamaukuran($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM jasa_nama_ukuran";
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
                     'message' =>'Berhasil Mendapatkan Jasa Nama Ukuran',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_jasanamaukuran()
      {
         global $mysqli;
         $arrcheckpost = array(
            'id_jasa' => '',
            'id_nama_ukuran' => '',
            );

         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
               $id_jasa = htmlspecialchars($_POST['id_jasa']);
               $id_nama_ukuran = htmlspecialchars($_POST['id_nama_ukuran']);

               $result = mysqli_query($mysqli, "INSERT INTO jasa_nama_ukuran VALUES(
               NULL,
               '$id_jasa',
               '$id_nama_ukuran'
               )");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Menambahkan Jasa Nama Ukuran'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal Menambahkan Jasa Nama Ukuran'
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
    
   function update_jasanamaukuran($id)
      {
        global $mysqli;
        $arrcheckpost = array(
            'id_jasa' => '',
            'id_nama_ukuran' => '',
        );

        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
             $id_jasa = htmlspecialchars($_POST['id_jasa']);
             $id_nama_ukuran = htmlspecialchars($_POST['id_nama_ukuran']);

             $result = mysqli_query($mysqli, "UPDATE jasa_nama_ukuran SET
             id_jasa = '$id_jasa',
             id_nama_ukuran = '$id_nama_ukuran'
             WHERE id='$id'");
         
           if($result)
           {
              $response=array(
                 'status' => 1,
                 'message' =>'Berhasil Mengedit Jasa Nama Ukuran'
              );
           }
           else
           {
              $response=array(
                 'status' => 0,
                 'message' =>'Gagal Mengedit Jasa Nama Ukuran'
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
 
   function delete_jasanamaukuran($id)
   {
      global $mysqli;
      $query="DELETE FROM jasa_nama_ukuran WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Berhasil Menghapus Jasa Nama Ukuran'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal Menghapus Jasa Nama Ukuran'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
?>