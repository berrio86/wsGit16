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
	<title>Quizzes</title>
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
  <div id='page-wrap'>
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
		<a href='layout.php'><span>Hasiera</span></a>
		<a href='Quizzes.php'><span class="act-sel">Galderak</span></a>
	<?php
	if($_SESSION['eposta'] != "guest")
		echo'<a href="InsertQuestion.php"><span>Galdera Sortu</span></a>';
	?>
		<a href='credits.php'><span>Kredituak</span></a>
	</nav>
    <section class="main" id="s1">
		
	
	<div>
		
		
		
		<?php
			include 'dbkonexioak/dbOpen.php';

			//sesio informazioa gorde ekintzetan
			//session_start();
			$eposta=$_SESSION['eposta'];
			$konexioid = $_SESSION['konexioid'];
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    			$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
    			$ip = $_SERVER['REMOTE_ADDR'];
			}
			$ekintza = "xml galderak ikusi";
			date_default_timezone_set('Europe/Madrid');
			$data = date(DATE_RSS, time());
			$sqlekintza="INSERT INTO ekintzak(konexioa, postaElektronikoa, ekintzaMota, ekintzaData, IP) VALUES ('$konexioid', '$eposta', '$ekintza', '$data', '$ip')";
			$emaitza=$db->query($sqlekintza);
			if(!$emaitza) {
				echo("Errore bat egon da ekintza gehitzean: ".$db->error);
			}
		
			echo("<h1>XML fitxategiko galderak PHP erabiliz</h1></br></br>");
			$xml = new DOMDocument();
			$xml = simplexml_load_file('xml/galderak.xml') or die('Errore bat egon da xml fitxategia kargatzean.');
			//$root = $xml->documentElement;
			echo ('<table border="1">
					<tr>
						<th style="text-align:center"> Galdera </th>
						<th style="text-align:center"> Zailtasuna </th>
						<th style="text-align:center"> Arloa </th>
					</tr> ');
		
			foreach($xml->assessmentItem as $assessmentItem){
					echo ("<tr>");	
						echo ("<td>".$assessmentItem->itemBody->p."</td>");
						echo ("<td>".$assessmentItem['complexity']."</td>");
						echo ("<td>".$assessmentItem['subject']."</td>");
					echo("</tr>");
			}
		
			echo("</table></br></br>");
			
			
		
			echo("<h1>XML fitxategiko galderak XSL erabiliz</h1></br></br>");
			
			$xml2 = new DOMDocument();
			$xml2->load("xml/galderak.xml") or die('Errore bat egon da xml2 fitxategia kargatzean');
			$xsl = new DOMDocument();
			$xsl->load("xml/seeQuestions.xsl") or die('Errore bat egon da xsl fitxategia kargatzean');
			$proc = new XSLTProcessor();
			$proc-> importStyleSheet($xsl);
			echo ($proc->transformToXML($xml2));
			
			include 'dbkonexioak/dbClose.php';
		?>
	</div>
		
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank">What is a Quiz?</a></p>
		<a href='https://github.com/berrio86/wsGit16'><img style="width:3%" src="irudiak/github-icon.png"></a>
	</footer>
</div>
</body>
</html>