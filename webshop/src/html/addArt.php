<?php 	session_start();
		echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	include('../php/DatabaseAdapter.php');

	if(!isset($_SESSION['user'])) {
		header("Location: noaccess.html");
	} else {
		$user = unserialize($_SESSION['user']);
		$userName = $user->getName();
	}
	
	//TODO Bildpfad einbauen
	if(isset($_POST['titel']) && isset($_POST['beschreibung']) && isset($_POST['preis']) ) {
		$titel =  $_POST['titel'];
		$beschreibung = $_POST['beschreibung'];
		$preis = $_POST['preis'];
		$bildpfad = "empty";
		
		$artikel = new Artikel(-1, $titel, $beschreibung, $preis, $bildpfad);
		
		$return = DatabaseAdapter::addArtikel($artikel);
		
		//Evtl. Check einbauen
		
/*		if(!LoginService::login($userName, $password))
			header("Location: shop.php");
			*/
	}

	
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
		<link rel="stylesheet" type="text/css" href="../style/styles.css"/>
		<title>WebShop - Warenkorb</title>
	</head>
	
	<body>
	
	<div id="wrapper">
	
		<div id="navigation">
			
			<div id="links">
			<ul>
			<li><a href="shop.php">Artikeluebersicht</a></li>
			<li><a href="korb.php">Warenkorb</a></li>
			<li><a href="addArt.php">Neuer Artikel</a></li>
			<li><a href="shop.php">Test#2</a></li>
			</div>
			</ul>
			<div id="login">
			<?php
				echo	"Willkommen, $userName" .
					'<form name="logoutform" method="post" action="shop.php">
						<div id="button">
							<br/>
							<input name="logout" type="submit" value="Log Out"/>
						</div>
						<input name="unset" type="hidden"/>
					</form>';
			?>
			</div>
			
		</div>
		
		<div id="content">
			Neuen Artikel eintragen
			<div class="entry">
			
			<?php
				if (isset($_POST['sub'])) {
					echo "<b>Artikel >  $titel  < erfolgreich eingetragen!</b> Fuer weiteren Artikel bitte Formular erneut ausfuellen!<br>";
				}
			
			?>
			<br>
				<form name="insertform" method="post" action="addArt.php">
				<b>
				<table border="0">
					<tr>
						<td>Titel:</td>
						<td><input name="titel" type="text" value="" size="40" /></td>
					</tr>
					<tr>
						<td>Beschreibung:</td>
						<td><textarea name="beschreibung" rows="5" cols="29" type="text" value=""> </textarea></td>
					</tr>
					<tr>
						<td>Preis:</td>
						<td><input name="preis" type="text" value="" size="4" /></td>
					</tr>
					<tr>
						<td>Bild:</td>
						<td><input name="bildpfad" type="text" value="" size="2" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input name="sub" type="submit" value="Artikel eintragen"/></td>
					</tr>
				</table>
				
				</form>

				
			
			
			
			</div>
					
		</div>
		
		<div id="footer">
		
		</div>
		
		
	</div>
	
	</body>
</html>