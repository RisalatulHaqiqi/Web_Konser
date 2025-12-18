 <?php
header('content-type: application/json');
$request = $_SERVER['REQUEST_METHOD'];
switch ($request) {
    case 'GET':
        getmethod();
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        putmethod($data);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        postmethod($data);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        deletemethod($data);
        break;

    default:
        echo '{"name": "data not found"}';
        break;
}
//data read part are here
function getmethod()
{
    // Koneksi database
    include_once('../koneksi.php');
    $sql = "SELECT * FROM dosen order by nama";
    $result = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result) > 0) {
        // Jika data tidak kosong
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
            $rows["result"][] = $r;
        }
        echo json_encode($rows);
    } else {
        echo '{"result": "no data found"}';
    }
}

function postmethod()
{
    include_once('../koneksi.php');
    $nidn   = $_GET['nidn'];
    $nama   = $_GET['nama'];
    $gender = $_GET['gender'];
    $no_hp  = $_GET['no_hp'];

    $sql = "INSERT INTO dosen(nidn,nama,gender,no_hp)
    VALUES ('$nidn','$nama','$gender','$no_hp')";
    if (mysqli_query($mysqli, $sql)) {
        echo '{"result":"data inserted"';
    } else {
        echo '{"result": "data not inserted"';
    }
}

//data edit part are here
function putmethod($data)
{
    include_once('../koneksi.php');
    $id = $data["id"];
    $name = $data["name"];
    $email = $data["email"];

    $sql = "UPDATE dosen SET name='$name', email='$email', created_at=NOW() where id='$id'  ";

    if (mysqli_query($mysqli, $sql)) {
        echo '{"result": "Update Succesfully"}';
    } else {

        echo '{"result": "not updated"}';
    }
}
//delete method are here,,,,,,,,,,,,,,
function deletemethod($data)
{
    include_once('../koneksi.php');

    $id = $data["id"];


    $sql = "DELETE FROM dosenz where id=$id";

    if (mysqli_query($mysqli, $sql)) {
        echo '{"result": "delete Succesfully"}';
    } else {

        echo '{"result": "not deleted"}';
    }
}