<?php
	session_start(); 
	echo '<?xml version="1.0" encoding="UTF-8"?>'; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	include('../php/User.php');

	if(!isset($_SESSION['user'])) {
		header("Location: noaccess.html");
	} else {
		$user = unserialize($_SESSION['user']);
		$userName = $user->getName();

		$warenkorb = $user->getWarenkorb();

		if(isset($_POST['anzahl'])) {
			$artikelNr = $_POST['artikelid'];
			$anzahl = $_POST['anzahl'];

			$warenkorb->editArtikelPosition($artikelNr, $anzahl);
		} else if(isset($_POST['artikeliddel'])) {
			$warenkorb->removeArtikelPosition($_POST['artikeliddel']);
		} else if(isset($_POST['abbrechen'])) {
			$user->leerWarenkorb();
			$warenkorb = $user->getWarenkorb();
		} else if(isset($_POST['bestellen'])) {
			$user->leerWarenkorb();
			$warenkorb = $user->getWarenkorb();
			header("Location: success.html");
		}

		$_SESSION['user'] = serialize($user);
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
			Warenkorb

			<?php

				foreach($warenkorb->getArtikelPositionen() as $value) {
					$artikel = $value->getArtikel();

					echo '<div class="entry">
						<div class="pic">
							<img src="../../' . $artikel->getBildpfad() . '" width="220" height="220">		
						</div>
			
						<div class="description">'
							. $artikel->getBeschreibung() .
						'</div>
				
						<div class="options">
							<b>Artikeloptionen:</b><br><br>
							<form name="optionform" method="post" action="korb.php">
								<form name="anzahlform" method="post" action="korb.php">
									<input name="anzahl" type="text" value="' . $value->getAnzahl() . '" size="2" />  
									<input name="update" type="submit" value="Anzahl aendern"/>
									<input name="artikelid" type="hidden" value="' . $value->getID() . '"/>
								</form> 
								<form name="deleteform" method="post" action="korb.php">
									<input name="del" type="submit" value="Entfernen"/>
									<input name="artikeliddel" type="hidden" value="' . $value->getID() . '"/>
								</form>
							</form>
						</div>
					</div>';
				}
			?>
						
			<div id="order">
				Bestellung abschicken?
				<form name="orderform" method="post" action="korb.php">
					<input name="bestellen" type="submit" value="Bestellung senden"/>
					<input name="abbrechen" type="submit" value="Bestellung abbrechen"/>
				</form>
			</div>
			
			
		</div>
		
		<div id="footer">
		
		</div>
		
		
	</div>
	
	</body>
</html>
