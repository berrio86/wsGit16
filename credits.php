<?php

	session_start();
	//ikus ea sesio bat hasi den eta ez bada hala guest ezarri
	if(isset($_SESSION['konexioid']) && !empty($_SESSION['konexioid'])) {
   		null;
	} else {
		$_SESSION['eposta'] = "guest";
		$_SESSION['konexioid'] = -1;
	}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Credits</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
  </head>
  <body>
  <div id='page-wrap' class="kredituak">
	<header class='main' id='h1'>
	<?php
	echo "Erabiltzailea: " . $_SESSION['eposta'] . "   ";
	if($_SESSION['eposta']=="guest") {
      	echo'<span class="right"><a href="SignIn.php">Sign In</a> / <a href="signUp.html">Sign Up</a></span>';
	} else {
		echo '<span class="right"><a href="LogOut.php">Log Out</a> </span>';
	}
    ?>
      
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Hasiera</a></span>
		<span><a href='Quizzes.php'>Galderak</a></span>
	<?php
	if($_SESSION['eposta'] != "guest")
		echo'<span><a href="InsertQuestion.php">Galdera Sortu</a></span>';
	?>
		<span><a href='credits.php'>Kredituak</a></span>
	</nav>
    <section class="main" id="s1">
	<div>
		<h2><a style="text-decoration: none" href="https://www.linkedin.com/in/jon-arzelus-rodriguez-63306b128">Jon Arzelus</a> eta <a style="text-decoration: none" href='inaki.html'>Iñaki Berriotxoa</a></h2><br>
		<h3>Software Ingeniaritza espezialitatea</h3><br>
		<img src="irudiak/index.jpeg" alt="computer_software"><br>
		Web Sistemak ikasgaieko lehen laborategiko lana da hau, pixkanaka osatzen joango gara
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com/berrio86/wsGit16'><img style="width:3%" src="irudiak/github-icon.png"></a>
	</footer>
</div>
</body>
</html>
