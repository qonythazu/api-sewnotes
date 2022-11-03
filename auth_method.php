<?php
require_once "koneksi.php";

function generateRandomString($length = 48)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

class Auth
{

    public function get_auth($id = 0)
    {
        global $mysqli;
        $query = "SELECT auth.id, auth.id_user, user.email FROM auth JOIN user ON user.id = auth.id_user";
        if ($id != 0) {
            $query .= " WHERE auth.token =" . $id . " LIMIT 1";
        }
        $data = array();
        $result = $mysqli->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' => 'Berhasil Mendapatkan Token',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function insert_auth()
    {
        global $mysqli;
        $arrcheckpost = array(
            'email' => '',
            'password' => '',
        );

        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $query = "SELECT id, email, password FROM user WHERE email = '$email' LIMIT 1";

            $result = $mysqli->query($query);

            if (mysqli_num_rows($result) == 1) {

                $data = mysqli_fetch_assoc($result);

                if ($data['email'] == $email && password_verify($password, $data['password'])) {
                    $id_user = $data['id'];
                    $random_string = generateRandomString();

                    $result = mysqli_query(
                        $mysqli,
                        "INSERT INTO auth VALUES(
                        NULL,
                        '$id_user',
                        '$random_string'
                        )"
                    );

                    if ($result) {
                        $response = array(
                            'status' => 1,
                            'message' => 'Login Berhasil'
                        );
                    } else {
                        $response = array(
                            'status' => 0,
                            'message' => 'Login Gagal'
                        );
                    }
                } else {
                    $response = array(
                        'status' => 0,
                        'message' => 'Login Gagal'
                    );
                }
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Login Gagal'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Parameter Tidak Sesuai'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function delete_auth($id)
    {
        global $mysqli;
        $query = "DELETE FROM auth WHERE token = '$id' ";
        if (mysqli_query($mysqli, $query)) {
            $response = array(
                'status' => 1,
                'message' => 'Berhasil Menghapus Auth'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Gagal Menghapus Auth'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
