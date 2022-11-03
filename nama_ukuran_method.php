<?php
require_once "koneksi.php";
class NamaUkuran
{
 
   public  function get_allnamaukuran()
   {
      global $mysqli;
      $query="SELECT * FROM nama_ukuran";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Semua Nama Ukuran',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_namaukuran($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM nama_ukuran";
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
                     'message' =>'Berhasil Mendapatkan Nama Ukuran',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_namaukuran()
      {
         global $mysqli;
         $arrcheckpost = array(
            'nama_ukuran' => '',
            );

         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
               $nama_ukuran = htmlspecialchars($_POST['nama_ukuran']);

               $result = mysqli_query($mysqli, "INSERT INTO nama_ukuran VALUES(
               NULL,
               '$nama_ukuran'
               )");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Menambahkan Nama Ukuran'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal Menambahkan Nama Ukuran'
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
    
   function update_namaukuran($id)
      {
        global $mysqli;
        $arrcheckpost = array(
            'nama_ukuran' => '',
        );

        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
             $nama_ukuran = htmlspecialchars($_POST['nama_ukuran']);

             $result = mysqli_query($mysqli, "UPDATE nama_ukuran SET
             nama_ukuran = '$nama_ukuran'
             WHERE id='$id'");
         
           if($result)
           {
              $response=array(
                 'status' => 1,
                 'message' =>'Berhasil Mengedit Nama Ukuran'
              );
           }
           else
           {
              $response=array(
                 'status' => 0,
                 'message' =>'Gagal Mengedit Nama Ukuran'
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
 
   function delete_namaukuran($id)
   {
      global $mysqli;
      $query="DELETE FROM nama_ukuran WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Berhasil Menghapus Nama Ukuran'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal Menghapus Nama Ukuran'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
?>