<?php
if (isset($_FILES['image']) && isset($_POST['termin_id'])) {
    $terminId = $_POST['termin_id'];
    $targetDirectory = "C:/xampp/htdocs/football/uploads/";
    $targetFile = $targetDirectory . $terminId . ".jpg";

    // Proveravamo da li je fajl koji ubacujemo slika
    $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Moguce je ubaciti slike u  JPG, JPEG, PNG i GIF formatu";
        exit;
    }

    // Upload slike
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $imageUrl = "C:/xampp/htdocs/football/uploads/" . $terminId . ".jpg";
        
        header("Location: ../public/index.php?page=termins");
        exit();
    } else {
        echo ".";
    }
}
?>
