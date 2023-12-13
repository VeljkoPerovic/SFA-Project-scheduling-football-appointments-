<?php

include '../core/dbConnection.php';

$headers = getallheaders();
if (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/json') {
    $data = json_decode(file_get_contents('php://input'), true);
    $teren = isset($data['teren']) ? $data['teren'] : '';
    $datum = isset($data['izaberi-dan']) ? date('d.m.Y', strtotime($data['izaberi-dan'])) : '';
    $vreme = isset($data['izaberi-vreme']) ? $data['izaberi-vreme'] : '';
} else {
    $teren = isset($_POST['teren']) ? $_POST['teren'] : '';
    $datum = isset($_POST['izaberi-dan']) ? date('d.m.Y', strtotime($_POST['izaberi-dan'])) : '';
    $vreme = isset($_POST['izaberi-vreme']) ? $_POST['izaberi-vreme'] : '';
}

// Provera dostupnosti termina u bazi podataka
if (!empty($teren) && !empty($datum) && !empty($vreme)) {
 
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM termin WHERE teren_termina = '$teren' AND datum_termina = '$datum' AND vreme_termina = '$vreme'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $response = array('status' => 'error', 'message' => 'Greska pri izvrsavanju upita: ' . mysqli_error($conn));
            echo json_encode($response);
        } elseif (mysqli_num_rows($result) > 0) {
            $response = array('status' => 'error', 'message' => 'Termin je već zauzet.');
            echo json_encode($response);
        } else {
            // Termin je slobodan, može se zakazati
            $insertSql = "INSERT INTO termin (teren_termina, datum_termina, vreme_termina, user_id) VALUES ('$teren', '$datum', '$vreme', '$user_id')";
            if (mysqli_query($conn, $insertSql)) {
                // Termin uspešno dodat
                $response = array('status' => 'success');
                echo json_encode($response);
            } else {
                // Greška pri dodavanju termina
                $response = array('status' => 'error', 'message' => 'Greška pri dodavanju termina: ' . mysqli_error($conn));
                echo json_encode($response);
            }
        }
    } else {
        // Korisnik nije prijavljen
        $response = array('status' => 'error', 'message' => 'Korisnik nije prijavljen.');
        echo json_encode($response);
    }
} else {
    // Nedostaju podaci u zahtevu
    $response = array('status' => 'error', 'message' => 'Nedostaju podaci u zahtevu.');
    echo json_encode($response);
}

// Zatvaranje konekcije
mysqli_close($conn);
?>