<?php
include_once '../core/dbConnection.php';

if (isset($_GET['id'])) {
    $termin_id = $_GET['id'];

    // Uzimamo detalje termina
    $sql = "SELECT * FROM termin WHERE termin_id = $termin_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $expiryDateTime = $row['datum_termina'] . ' ' . $row['vreme_termina'];
        $expiryTime = strtotime($expiryDateTime);
        $currentTime = time();

        if (($expiryTime - $currentTime) > 7 * 3600) {
            // Brisemo termin
            $deleteSql = "DELETE FROM termin WHERE termin_id = $termin_id";
            if (mysqli_query($conn, $deleteSql)) {
                echo "<script>alert('Termin je uspesno otkazan.');</script>";
                echo "<script>window.location.href = '../public/index.php?page=termins';</script>";
                exit();
            } else {
                echo "Greska prilikom otkazivanja: " . mysqli_error($conn);
            }
        } else {
            // Termin ne moze biti otkazan: 
            echo "<script>alert('Termin ne moze biti otkazan jer do njega imate manje od 7 sati.');</script>";
            echo "<script>window.location.href = '../public/index.php?page=termins';</script>";
        }
    } else {
        echo "Termin nije pronadjen.";
    }
}

mysqli_close($conn);
?>