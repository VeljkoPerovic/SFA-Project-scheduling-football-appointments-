<link rel="stylesheet" href='../styles/style.css' />
<form class="form-wrapper"  method="post" >
  <div class="form-container">
    <h2 class="form-title">Zakazivanje termina</h2>
    <div class="form-fields">
      <div class="form-field">
        <label for="teren">Izaberi teren:</label>
        <select name="teren" id="teren" onchange="prikaziOpcijeTeren()">
          <option value="">Izaberi teren</option> 
          <option value="Stadion(70m)">Stadion (70m)</option>
          <option value="Stadion(100m)">Stadion (100m)</option>
          <option value="Balon">Balon</option>

        </select>
      </div>
      <div class="form-field">
        <label for="izaberi-dan" >Izaberi datum:</label>
        <select name="izaberi-dan" id="izaberi-dan" onfocus="prikaziDatume()">
          <option value="">Izaberi datum</option>
        </select>        
      </div>
      <div class="form-field">
        <label for="izaberi-vreme" >Izaberi vreme:</label>
        <select name="izaberi-vreme" id="izaberi-vreme" onfocus="prikaziSate()">
          <option value="">Izaberi vreme</option>
        </select>
      </div>
    </div>
    <div class="form-button">
      <button type="button" id="zakaziBtn" name="zakazi" onclick="handleZakaziClick()">Zakazi</button>
    </div>
  </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // Promenljiva za pracenje statusa slanja zahteva
  var slanjeAktivno = false;

  document.querySelector('.hamburger-menu').addEventListener('click', function() {
    this.classList.toggle('open');
    document.querySelector('.menu').classList.toggle('open');
  });

  // Funkcija kojom prikazujemo datume za narednih sedam dana
  function prikaziDatume() {
    var select = document.getElementById("izaberi-dan");
    var danas = new Date();

    select.innerHTML = "";

    for (var i = 0; i < 7; i++) {
      var datum = new Date(danas);
      datum.setDate(danas.getDate() + i);

      var option = document.createElement("option");
      option.value = datum.toISOString();
      // Formariramo datu pomocu toLocaleDateString
      option.text = datum.toLocaleDateString("sr-RS", { day: 'numeric', month: 'numeric', year: 'numeric' }).replace(/ /g, "");

      select.appendChild(option);
    }
  }

  // Funkcija kojom mehanicki ubacujemo odabir sata od 09h do 23h.
  function prikaziSate() {
    var select = document.getElementById("izaberi-vreme");

    select.innerHTML = "";
    for (var i = 9; i <= 23; i++) {
      var option = document.createElement("option");
      var sati = i.toString().padStart(2, "0");
      option.value = sati + ":00"; // Dodajemo ":00" za sate
      option.text = sati + ":00";
      select.add(option);
    }
  }

  // Ovom funkcijom Teren 2 stavljamo da bude disable jer je jos u izradi.
  function prikaziOpcijeTeren() {
            var terenSelect = document.getElementById("teren");
            var selectedOption = terenSelect.options[terenSelect.selectedIndex];

            if (selectedOption.value === "Stadion(70m)") {
                selectedOption.textContent = "Stadion(70m)";
            } else if (selectedOption.value === "Stadion(100m)") {
                console.log("Teren 2 nije dostupan za rezervaciju.");
                alert("Trenutno Stadion(100m) nije dostupan za rezervaciju.");
                terenSelect.selectedIndex = 0;
            } else if (selectedOption.value === "Balon") {
                selectedOption.textContent = "Balon";
            }
        }

  // Event da se refreshovanjem stranice Izaberi teren vrati kao opcije i klikom na selekt ne bude u ponudi.
  document.addEventListener("DOMContentLoaded", function() {
    prikaziOpcijeTeren();
    

    // Uklanjanje opcije "Izaberi teren"
    var izaberiTerenOption = document.querySelector("#teren option[value='']");
    if (izaberiTerenOption) {
      izaberiTerenOption.style.display = "none";
    }
  });

  document.getElementById("teren").addEventListener("change", prikaziOpcijeTeren);

  
  function handleZakaziClick() {
    if (slanjeAktivno) {
      return;
    }

    slanjeAktivno = true; 

    var teren = document.getElementById("teren").value;
    var datum = document.getElementById("izaberi-dan").value;
    var vreme = document.getElementById("izaberi-vreme").value;


    var data = {
      'teren': teren,
      'izaberi-dan': datum,
      'izaberi-vreme': vreme
    };

    

    // Slanje AJAX zahteva
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../model/proveri-termin.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === "success") {
            // Termin uspesno dodat
            alert("Termin je uspesno zakazan!");
            window.location.reload(); 
          } else {
            // Greška pri dodavanju termina
            alert("Termin je zauzet, molim vas zakazite za neko drugo vreme.");
          }
        } else {
          // Greška u AJAX zahtevu
          alert("Doslo je do greske prilikom slanja zahteva. Status: " + xhr.status);
        }

        slanjeAktivno = false; // Postavi status slanja na false
      }
    };
    xhr.send(JSON.stringify(data));
  }



</script>