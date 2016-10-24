<?php

	session_start();
	//ikus ea sesio bat hasi den eta ez bada hala guest ezarri
	if((isset($_SESSION['eposta']) && !empty($_SESSION['eposta'])) && (isset($_SESSION['konexioid']) && !empty($_SESSION['konexioid'])) && (isset($_SESSION['erabiltzaileMota']) && !empty($_SESSION['erabiltzaileMota']))) {
   		null;
	} else {
		$_SESSION['eposta'] = "guest";
		$_SESSION['konexioid'] = -1;
		$_SESSION['erabiltzaileMota'] = "GUEST";
	}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Sign Up</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' type='text/css' media='only screen and (max-width: 480px)' href='stylesPWS/smartphone.css' />
	<script type="text/javascript">
	function aukeratuBesteak() {
		if(document.getElementById("esp").value=="besterik") { //ikusi ea aukera bestelakoa den
			
			if(document.getElementById("espezializazioa")==null){
				var p1 = document.createElement("P");
				var hitzak = document.createTextNode("(*) adierazi zein espezialitate egiten ari zaren: ");
				var input1 = document.createElement("input");
				input1.setAttribute("name","espezializazioa");
				input1.setAttribute("id","espezializazioa");
				input1.setAttribute("required","true");
				p1.setAttribute("id","esptext");
			
				p1.appendChild(hitzak);
				document.getElementById("div1").appendChild(p1);
				document.getElementById("div1").appendChild(input1);
			}
		}
	}
	</script>
	<script type="text/javascript">
	function argazkiaKargatu() {
		var preview = document.getElementById("argazkia");
		var file = document.getElementById("argazki-fitxategia").files[0];
		//alert(file);
		var reader = new FileReader();
		
		reader.onload = function (event){
			var dataUri = event.target.result;
			preview.src = dataUri; 
			tamainaAldatu();
		}
		
		if (file){
			reader.readAsDataURL(file);
		}else{
			preview.src="";
		}
	}
	//funtzio hau hobetu egin behar da	
	function tamainaAldatu(){
		var irudia = document.getElementById("argazkia");
		//alert("ona iristen da");
		if(irudia.clientHeight > "80"){
			irudia.style.height="80px";
			irudia.style.width = "auto";
			/*var zabalera = irudia.clientWidth;
			var altuera = irudia.clientHeight;
			alert(altuera + " " + zabalera);*/
		}
	}	
	</script>
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
	<?php
		echo "Erabiltzailea: " . $_SESSION['eposta'] . "   ";
		if($_SESSION['eposta']=="guest") {
      		echo'<span class="right"><a href="SignIn.php">Sign In</a> / <a href="signUp.php">Sign Up</a></span>';
		}else{
			echo '<span class="right"><a href="LogOut.php">Log Out</a> </span>';
		}
    ?>
      <!--<span class="right"><a href="SignIn.php">Sign In</a> / <a href="signUp.html">Sign Up</a></span>
      <span class="right" style="display:none;"><a href="/logout">Log Out</a> </span>-->
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Hasiera</a></span>
		<span><a href='Quizzes.php'>Galderak</a></span>
	<?php
	if($_SESSION['eposta'] != "guest")
		echo'<a href="InsertQuestion.php"><span>Galdera Sortu</span></a>';
	if($_SESSION['erabiltzaileMota'] == "IRAKASLEA")
		echo'<a href="getUserInform.php"><span>Ikasleak begiratu</span></a>';
	?>
		<span><a href='credits.php'>Kredituak</a></span>
	</nav>
    <section class="main" id="s1">
		
		<div id="gorputza">
		 <form id="erregistro" name="erregistro" method="POST" action="EnrollWithImage.php" enctype="multipart/form-data">
  			(*) Izen-Abizenak:
  			<input type="text" name="izen-abizenak" required pattern="([A-Z]{1}[a-z ]{1,})*" title="Izen-abizenak letra larriz hasita" oninvalid="this.setCustomValidity('Atal hau ezin da hutsik utzi')"><br>
			(*) Posta Elektronikoa:
 			<input type="email" name="eposta-helbidea" required pattern="^[a-z]+[0-9]{3}@ikasle\.ehu\.eu?s$" title="emailak unibertsitatekoa izan behar du." oninvalid="this.setCustomValidity('Atal hau ezin da hutsik utzi')"><br>
			(*) Pasahitza:
 			<input type="password" name="pasahitza" required pattern=".{6,}$" title="6 karaktereko luzeera izan behar du gutxienez." oninvalid="this.setCustomValidity('Atal hau ezin da hutsik utzi')"><br>
			(*) Telefono zenbakia:
 			<input type="text" name="telefono-zenbakia" required pattern="[0-9]{9}" title="9 zenbakiko telefono zenbakia idatzi mesedez." oninvalid="this.setCustomValidity('Atal hau ezin da hutsik utzi')"><br>
			(*) Espezialitatea:
 			<select id="esp" name="espezialitatea" onchange="aukeratuBesteak()" required>
  				<option value="software">Software Ingeniaritza</option>
  				<option value="hardware">Konputagailuen Ingeniaritza</option>
  				<option value="konputazioa">Konputazioa</option>
  				<option value="besterik">Besterik</option>
			</select><br>
			<div id="div1">
				<!-- espezialitatea definitzeko -->
			</div>	
			 
			<p id="parrafoa">Interesa duzun teknologiak eta erremintak:</p><br>
 			<textarea name="interesak" id="interesa" rows="3" cols="30"></textarea> <br><br>
			Sartu argazki bat:<br>
			<input id="argazki-fitxategia" type="file" name="argazki-fitxategia" accepts="image/*" onchange="return argazkiaKargatu()" value="Bidali">
			 <img id="argazkia" style="width:150px; height: 100px;" class="argazkia"/> <br>
			 <input type="submit" name="button" value="Bidali">
			<input type="reset" name="button" value="Ezeztatu"> <br><br>
		</form> 
		
		<p>(*) duten atalak bete beharrekoak dira, derrigor.</p>
		</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com/berrio86/wsGit16'><img style="width:3%" src="irudiak/github-icon.png"></a>
	</footer>
</div>
</body>
</html>