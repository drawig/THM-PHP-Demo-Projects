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
	
	
	if (isset($_POST['update'])) {
		$artikel = DatabaseAdapter::getSingleArtikel($_POST['artikelid']);
		
		
			
	}	
	
	//wenn update
	if (isset($_POST['titel']) && isset($_POST['beschreibung']) && isset($_POST['preis']) && isset($_POST['sub2']) && isset($_POST['id'])) {
		$id = $_POST['id'];
		$titel =  $_POST['titel'];
		$beschreibung = $_POST['beschreibung'];
		$preis = $_POST['preis'];
		$bildpfad = "res/".$_FILES['bildpfad']['name'];
		
		$artikelN = new Artikel(-1, $titel, $beschreibung, $preis, $bildpfad);
		
		$return = DatabaseAdapter::updateArtikel($artikelN, $id);
		
	}
	
	
	if(isset($_POST['titel']) && isset($_POST['beschreibung']) && isset($_POST['preis']) && !isset($_POST['sub2']) ) {
		$titel =  $_POST['titel'];
		$beschreibung = $_POST['beschreibung'];
		$preis = $_POST['preis'];
		$bildpfad = "res/".$_FILES['bildpfad']['name'];
		

	//	echo "<pre>" .print_r( $_POST, true ). "</pre>";
	//	echo "<pre>" .print_r( $_FILES, true ). "</pre>";
		
		
		$dateityp = GetImageSize($_FILES['bildpfad']['tmp_name']);
		if($dateityp[2] != 0)
		{

		if($_FILES['bildpfad']['size'] <  1024000)
			{
			move_uploaded_file($_FILES['bildpfad']['tmp_name'], "../../res/".$_FILES['bildpfad']['name']);
			}

		else
			{
				echo "Das Bild darf nicht größer als 1 MB sein ";
			}

			}

		else
			{
			echo "Bitte nur Bilder im Gif bzw. jpg Format hochladen";
			}	
		
		
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
		<?php if (isset($_POST['update'])) {
					echo "Artikel aktualisieren";
				} else {
					echo "Neuen Artikel eintragen";
				}
				
		?>
			<div class="entry">
			
			<?php
				if (isset($_POST['sub'])) {
					echo "<b>Artikel >  $titel  < erfolgreich eingetragen!</b> Fuer weiteren Artikel bitte Formular erneut ausfuellen!<br>";
				}
				if (isset($_POST['sub2'])) {
					echo "<b>Artikel >  $titel  < erfolgreich aktualisiert!</b> Fuer neuen Artikel bitte Formular ausfuellen!<br>";
				}
			
			?>
			<?php
				if (!isset($_POST['update'])) {
					
					echo '				
			<br>
				<form name="insertform" method="post" action="addArt.php" enctype="multipart/form-data">
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
						<td><input name="bildpfad" type="file"  size="10" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input name="sub" type="submit" value="Artikel eintragen"/></td>
					</tr>
				</table>
				
				</form>';
				} else {
					$artikel = DatabaseAdapter::getSingleArtikel($_POST['artikelid']);
									echo '				
			<br>
				<form name="insertform2" method="post" action="addArt.php" enctype="multipart/form-data">
				<b>
				<table border="0">
					<tr>
						<td>Titel:</td>
						<td><input name="titel" type="text" value="' . $artikel->getTitel() . ' " size="40" /></td>
					</tr>
					<tr>
						<td>Beschreibung:</td>
						<td><textarea name="beschreibung" rows="5" cols="29" type="text">' . $artikel->getBeschreibung() . '</textarea></td>
					</tr>
					<tr>
						<td>Preis:</td>
						<td><input name="preis" type="text" value="' . $artikel->getPreis() . '" size="4" /></td>
					</tr>
					<tr>
						<td>Bild:</td>
						<td><input name="bildpfad" type="file" size="10" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input name="sub2" type="submit" value="Artikel eintragen"/></td>
						<input name="id" type="hidden" value="' . $artikel->getArtNr() . '"/>
					</tr>
				</table>
				
				</form>';
				}
				
				?>
			
			
			
			</div>
					
		</div>
		
		<div id="footer">
		
		</div>
		
		
	</div>
	
	</body>
</html>