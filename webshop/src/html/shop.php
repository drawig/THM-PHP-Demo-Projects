<?php 
	session_start();
	echo '<?xml version="1.0" encoding="UTF-8"?>'; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	
	include('../php/LoginService.php');

	if(isset($_POST['unset'])) {
		session_unset(); 
		session_destroy();
	}

	if(isset($_POST['name']) && isset($_POST['passwort'])) {
		$userName = $_POST['name'];
		$password = $_POST['passwort'];

		if(!LoginService::login($userName, $password))
			header("Location: shop.php");
	}

	$loggedIn = isset($_SESSION['user']);

	if($loggedIn) {
		$user = unserialize($_SESSION['user']);
		$userName = $user->getName();

		if(isset($_POST['artikelid']) && isset($_POST['anzahl'])) {
			$artikel = DatabaseAdapter::getSingleArtikel($_POST['artikelid']);

			if($artikel != NULL) {
				$warenkorb = $user->getWarenkorb();

				if($warenkorb->contains($artikel->getArtNr())) {
					$warenkorb->addAnzahl($artikel->getArtNr(), $_POST['anzahl']);
				} else {
					$artikelPosition = new ArtikelPosition($artikel, $_POST['anzahl']);
					$warenkorb->addArtikelPosition($artikelPosition);
				}

				$_SESSION['user'] = serialize($user);
			}
		}
		
		if (isset($_POST['delete'])) {
			if (DatabaseAdapter::deleteArtikel($_POST['artikelid']) == TRUE) {
				$artikelnr = $_POST['artikelid'];
				echo "Artikel mit der Artikelnr $artikelnr wurde entfernt!";
			}
		}
		
	} 
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
		<link rel="stylesheet" type="text/css" href="../style/styles.css"/>
		<title>WebShop</title>
	</head>
	
	<body>
	
	<div id="wrapper">
	
		<div id="navigation">
			
			<div id="links">
			<ul>
				<?php
					if($loggedIn) {
						$html = '<li><a href="shop.php">Artikeluebersicht</a></li>
							<li><a href="korb.php">Warenkorb</a></li>
							<li><a href="addArt.php">Neuer Artikel</a></li>';
					} else {
						$html = '<li><a href="shop.php">Artikeluebersicht</a></li>';
					}
					
					echo $html;	
				?>
			</div>
			</ul>
			<div id="login">
				<?php
					if(!$loggedIn) {
						$form = '<form name="loginform" method="post" action="shop.php">
							<div id="labels">
								Name:<br/>
								Passwort:<br/>
							</div>
				
							<div id="fields">
								<input name="name" type="text" size="18" /> <br/>
								<input name="passwort" type="password" size="18" /><br/>
							</div>
				
							<div id="button">
								<br>
								<input name="login" type="submit" value="Log In"/>
							</div>				
					
						</form>';
					} else {
						$form = "Willkommen, $userName" .
							'<form name="logoutform" method="post" action="shop.php">
								<div id="button">
									<br/>
									<input name="logout" type="submit" value="Log Out"/>
								</div>
								<input name="unset" type="hidden"/>
							</form>';
					}

					echo $form; 
				?>

			</div>
			
		</div>
		
		<div id="content">
			Artikeluebersicht
			
			<?php
				$artikel = DatabaseAdapter::getArtikel();
				
				foreach ($artikel as $entry) {
					echo '
					<div class="entry">
						<div class="pic">	
							<img src="../../';
							echo $entry->getBildpfad();
							echo '" width="220" height="220">
						</div>
			
						<div class="description">';
							echo '<b>';
							echo $entry->getTitel();
							echo '</b><br><br>';
							echo $entry->getBeschreibung();
							echo '<br><br>';
							echo '<b>Preis:</b>  ';
							echo $entry->getPreis();
							echo ' &euro;';
							
						echo '
						</div>';
		
							
							if($loggedIn) {
								$artikelId = $entry->getArtNr();

								echo 	'<div class="options">
										<b>Artikeloptionen:</b><br><br>
										<form name="addform" method="post" action="shop.php">
											<input name="anzahl" type="text" size="2" />  
											<input name="add" type="submit" value="Zum Warenkorb hinzufuegen"/>
											<input name="artikelid" type="hidden" value="' . "$artikelId" . '"/>
										</form>
										<br>
										<form name="updateform" method="post" action="addArt.php">
											<input name="update" type="submit" value="Artikel bearbeiten"/>
											<input name="artikelid" type="hidden" value="' . "$artikelId" . '"/>
										</form>
										<form name="delform" method="post" action="shop.php">
											<input name="delete" type="submit" value="Artikel löschen"/>
											<input name="artikelid" type="hidden" value="' . "$artikelId" . '"/>
										</form>
										</div>';
										
							}
						
					echo '	
					</div>';
					
				
				}
			
			
			
			?>
			


			
		</div>
		
		<div id="footer">
		
		</div>
		
		
	</div>
	
	</body>
</html>
