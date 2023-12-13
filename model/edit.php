<!DOCTYPE html>
<html>
<head>
    <title>Edit Termin</title>
    <style>
        body {
            background-image: url('https://t6limited.rs/wp-content/uploads/2019/12/galerija-balon-2.jpg');
            background-repeat: no-repeat;
            background-size: 100% ;

            font-family: Arial, sans-serif;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="time"],
        select {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
            color: #333;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="center">
        <?php
            include_once '../core/dbConnection.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $termin_id = $_POST["termin_id"];
                $teren_termina = $_POST["teren_termina"];
                $datum_termina = $_POST["datum_termina"];
                $vreme_termina = $_POST["vreme_termina"];

                $sql = "UPDATE termin SET teren_termina='$teren_termina', datum_termina='$datum_termina', vreme_termina='$vreme_termina' WHERE termin_id='$termin_id'";

                if (mysqli_query($conn, $sql)) {
                    mysqli_close($conn);
                    header("Location: ../public/index.php?page=termins");
                    exit;
                } else {
                    echo "Error updating termin: " . mysqli_error($conn);
                }
            }

            // Fetch termin details
            if (isset($_GET["id"])) {
                $termin_id = $_GET["id"];
                $sql = "SELECT termin_id, teren_termina, datum_termina, vreme_termina FROM termin WHERE termin_id='$termin_id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            }

            mysqli_close($conn);
        ?>

        <form method="POST" action="edit.php?id=<?php echo $row['termin_id']; ?>">
            <h1>Edit termina</h1>
            <?php
                $today = date('d.m.Y');
                $nextSixDays = [];
                for ($i = 0; $i < 7; $i++) {
                    $nextSixDays[] = date('d.m.Y', strtotime('+' . $i . ' day'));
                }
            ?>
            <input type="hidden" name="termin_id" value="<?php echo $row['termin_id']; ?>">
            <label for="teren_termina">Teren termina:</label>
            <select name="teren_termina" id="teren_termina">
                <option value="Balon" <?php if ($row['teren_termina'] == 'Balon') echo 'selected'; ?>>Balon</option>
                <option value="Stadion(70m)" <?php if ($row['teren_termina'] == 'Stadion(70m)') echo 'selected'; ?>>Stadion(70m)</option>
            </select>
            <br>
            <label for="datum_termina">Datum:</label>
            <select name="datum_termina" id="datum_termina">
                <?php foreach ($nextSixDays as $day) { ?>
                    <option value="<?php echo $day; ?>" <?php if ($row['datum_termina'] == $day) echo 'selected'; ?>>
                        <?php echo $day; ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <label for="vreme_termina">Vreme:</label>
            <select name="vreme_termina" id="vreme_termina">
                <?php for ($i = 9; $i <= 23; $i++) { ?>
                    <option value="<?php echo sprintf('%02d', $i) . ':00'; ?>" <?php if ($row['vreme_termina'] == sprintf('%02d', $i) . ':00') echo 'selected'; ?>>
                        <?php echo sprintf('%02d', $i) . ':00'; ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>