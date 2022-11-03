<?php
require_once "koneksi.php";
class DetailCatatan 
{
 
   public  function get_detailnotes()
   {
      global $mysqli;
      $query="SELECT * FROM detail_catatan";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Mendapatkan Semua Data Detail Catatan',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_detailcatatan($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM detail_catatan";
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
                     'message' =>'Berhasil Mendapatkan Data Detail Catatan',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_detailcatatan()
      {
         global $mysqli;
         $arrcheckpost = array(
            'id_catatan' => '',
            'id_jasa' => '',
            'id_kain' => '',
            'kategori' => '', 
            'status_kain' => '',
            );

         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
               $id_catatan = htmlspecialchars($_POST['id_catatan']);
               $id_jasa = htmlspecialchars($_POST['id_jasa']);
               $id_kain = htmlspecialchars($_POST['id_kain']);
               $kategori = htmlspecialchars($_POST['kategori']);
               $status_kain = htmlspecialchars($_POST['status_kain']);

               $result = mysqli_query($mysqli, "INSERT INTO detail_catatan VALUES(
               NULL,
               '$id_catatan',
               '$id_jasa',
               '$id_kain',
               '$kategori',
               '$status_kain'
               )");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Berhasil Menambahkan Detail Catatan'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal Menambahkan Detail Catatan'
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
    
   function update_detailcatatan($id)
      {
        global $mysqli;
        $arrcheckpost = array(
            'id_catatan' => '',
            'id_jasa' => '',
            'id_kain' => '',
            'kategori' => '', 
            'status_kain' => '',
       );

        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if($hitung == count($arrcheckpost)){
             $id_jasa = htmlspecialchars($_POST['id_jasa']);
             $id_kain = htmlspecialchars($_POST['id_kain']);
             $kategori = htmlspecialchars($_POST['kategori']);
             $status_kain = htmlspecialchars($_POST['status_kain']);

             $result = mysqli_query($mysqli, "UPDATE detail_catatan SET
             id_jasa = '$id_jasa',
             id_kain = '$id_kain',
             kategori = '$kategori',
             status_kain = '$status_kain'
             WHERE id='$id'");
         
           if($result)
           {
              $response=array(
                 'status' => 1,
                 'message' =>'Berhasil Mengedit Detail Catatan'
              );
           }
           else
           {
              $response=array(
                 'status' => 0,
                 'message' =>'Gagal Mengedit Detail Catatab'
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
 
   function delete_detailcatatan($id)
   {
      global $mysqli;
      $query="DELETE FROM detail_catatan WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Berhasil Menghapus Detail Catatan'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal Menghapus Detail Catatan'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
?>