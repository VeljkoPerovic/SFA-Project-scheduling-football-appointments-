
<head>
    <title>Prikaz zakazanih termina</title>
    <link rel="stylesheet" href='../styles/style.css' />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://t6limited.rs/wp-content/uploads/2019/12/galerija-balon-2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        h1 {
            text-align: center;
            color: #FFF;
            padding: 20px 0;
            position: relative;
            z-index: 2;
        }

        table {
            
            border-collapse: collapse;
            width: 100%;
            background-color: #FFF;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 100px auto;
            max-width: 1200px;
            border-radius: 15px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #88C070;
        }

        th {
            background-color: #88C070;
            color: #FFF;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .actions {
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
            
        }

        .actions a {
            margin-left: 10px;
            padding: 8px 12px;
            text-decoration: none;
            background-color: #88C070;
            color: #FFF;
            border-radius: 4px;
            transition: background-color 0.3s;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .actions a:hover {
            background-color: #5C8A4E;
        }

        .actions a:first-child {
            margin-left: 0;
        }

        .add-picture-btn {
            background-color: #88C070;
            color: #FFF;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            height: 30px;
            transition: background-color 0.3s;
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
    }

        .add-picture-btn:hover {
            background-color: #5C8A4E;
        }

        .hidden {
            display: none;
        }

        .uploaded-image {
            max-width: 500px;
            height: auto;
            display: block;
            margin: 10px auto;
            
        }
    </style>
    <script>
        function showPictureForm(rowId) {
            document.getElementById('picture-form-' + rowId).classList.remove('hidden');
        }
    </script>
</head>
<body>
    <table>
        <tr>
            <th>ID termina</th>
            <th>Teren termina</th>
            <th>Datum</th>
            <th>Vreme</th>
            <th>Slika</th>
            <th>Akcije nad terminima</th>
        </tr>
        <?php
           include_once '../core/dbConnection.php';

            if (!isset($_SESSION['user_id'])) {
                die('Niste prijavljeni.'); 
                }
            
            $user_id = $_SESSION['user_id'];
            $user_role = $_SESSION['user_role'];
            
            $sql = "SELECT termin_id, teren_termina, datum_termina, vreme_termina FROM termin";
            
            if ($user_role !== 'administrator') {
                $sql .= " WHERE user_id = '$user_id'";
            }

            $result = mysqli_query($conn, $sql);



            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["termin_id"] . "</td>";
                    echo "<td>" . $row["teren_termina"] . "</td>";
                    echo "<td>" . $row["datum_termina"] . "</td>";
                    echo "<td>" . $row["vreme_termina"] . "</td>";
                    echo "<td><img src='../uploads/" . $row["termin_id"] . ".jpg' alt='Slika termina' class='uploaded-image'></td>";
                    echo "<td class='actions'>";
                    echo "<button class='add-picture-btn' onclick='showPictureForm(" . $row["termin_id"] . ")'>Dodaj sliku</button>";
                    echo "<form id='picture-form-" . $row["termin_id"] . "' class='hidden' action='../model/upload.php' method='POST' enctype='multipart/form-data'>";
                    echo "<input type='hidden' name='termin_id' value='" . $row["termin_id"] . "'>";
                    echo "<input type='file' name='image' required>";
                    echo "<input type='submit' value='Dodaj'>";
                    echo "</form>";
                    if ($user_role === 'administrator') {
                        echo "<a href='../model/edit.php?id=" . $row["termin_id"] . "'>Izmeni</a>";
                    }
                    echo "<a href='../model/delete.php?id=" . $row["termin_id"] . "' onclick=\"return confirm('Da li zelite da otkazete termin?')\">Otkazi</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }

            mysqli_close($conn);
        ?>
    </table>
</body>

