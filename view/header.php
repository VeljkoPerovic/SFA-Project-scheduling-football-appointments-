<style>
  .header-button {
    border: 1px solid white;
    border-radius: 5px;
    padding: 5px;
  
  }

  .header-button:hover{
    background-color: white;
    color: burlywood;
    border-color: white;
  }

  .header-link {
    padding: 5px;
  }

  .header-link:hover {
    background-color: white;
    color: burlywood;
    border-color: white;
    border-radius: 5px;
  }



</style>
<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Dohvatanje uloge korisnika iz sesije
    $user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';

    echo '<header>';
    echo '    <div class="left-section">';
    echo '      <nav class="navbar">';
    echo '        <ul class="menu menu1">';
    echo '          <li><a href="../public/index.php?page=home" class="header-link">Home</a></li>';
    echo '          <li><a href="../public/index.php?page=scheduling" class="header-link">Zakazi termin</a></li>';
    echo '          <li><a href="../public/index.php?page=termins" class="header-link">Tvoji termini</a></li>';
    echo '        </ul>';
    echo '      </nav>';
    echo '    </div>';
    echo '    <div class="center-section">';
    echo '      <div class="logo"  style="font-size: 60px; color: rgb(228, 210, 210);">TOP</div>';
    echo '      <div class="box-container">';
    echo '        <div class="box red"></div>';
    echo '        <div class="box green "></div>';
    echo '        <div class="box blue"></div>';
    echo '      </div>';
    echo '      <div class="logo" style="font-size: 30px; color: rgb(227, 218, 218);">KERAMIKA</div>';
    echo '    </div>';
    echo '    <div class="right-section">';
    echo '      <nav class="navbar">';
    echo '        <ul class="menu menu2">';
    echo '          <li><a href="#" class="header-link">Kontakt</a></li>';

    if ($user_role === 'administrator') {
        echo '          <li><a href="../public/index.php?page=admin" class="header-link">Admin Panel</a></li>';
    } else {
        echo '          <li><a href="#" class="header-link">Donacije</a></li>';
    }
    echo '          <li><a href="../model/logout.php" class="header-button">Logout</a></li>';
    echo '        </ul>';
    echo '      </nav>';
    echo '    </div>';
    echo '    <div class="hamburger-menu">';
    echo '      <div class="bar"></div>';
    echo '      <div class="bar"></div>';
    echo '      <div class="bar"></div>';
    echo '    </div>';
    echo '  </header>';
}

?>