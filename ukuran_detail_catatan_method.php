<?php
require_once "koneksi.php";
class UkuranDetailCatatan
{
 
   public  function get_allukurandetailcatatan()
   {
      global $mysqli;
      $query="SELECT * FROM ukuran_detail_catatan";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Semua Ukuran Detail Catatan',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_ukurandetailcatatan($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM ukuran_detail_catatan";
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
                     'message' =>'Berhasil Mendapatkan Ukuran Detail Catatan',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_ukurandetailcatatan()
      {
         global $mysqli;
         $arrcheckpost = array(
            'id_nama_ukuran' => '',
            'ukuran' => '',
            );

         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
               $id_nama_ukuran = htmlspecialchars($_POST['id_nama_ukuran']);
               $id_detail_catatan = htmlspecialchars($_POST['id_detail_catatan']);
               $ukuran = htmlspecialchars($_POST['ukuran']);

               $result = mysqli_query($mysqli, "INSERT INTO ukuran_detail_catatan VALUES(
               NULL,
               '$id_nama_ukuran',
               '$id_detail_catatan',
               '$ukuran'
               )");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Menambahkan Ukuran Detail Catatan'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal Menambahkan Ukuran Detail Catatan'
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
    
   function update_ukurandetailcatatan($id)
      {
        global $mysqli;
        $arrcheckpost = array(
            'ukuran' => '',
        );

        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
             $ukuran = htmlspecialchars($_POST['ukuran']);

             $result = mysqli_query($mysqli, "UPDATE ukuran_detail_catatan SET
             ukuran = '$ukuran'
             WHERE id='$id'");
         
           if($result)
           {
              $response=array(
                 'status' => 1,
                 'message' =>'Berhasil Mengedit Ukuran Detail Catatan'
              );
           }
           else
           {
              $response=array(
                 'status' => 0,
                 'message' =>'Gagal Mengedit Ukuran Detail Catatan'
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
 
   function delete_ukurandetailcatatan($id)
   {
      global $mysqli;
      $query="DELETE FROM ukuran_detail_catatan WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Berhasil Menghapus Ukuran Detail Catatan'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal Menghapus Ukuran Detail Catatan'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
?>