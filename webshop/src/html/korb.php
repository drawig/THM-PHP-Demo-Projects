<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	include('../php/User.php');

	session_start();

	if(!isset($_SESSION['user'])) {
		header("Location: noaccess.html");
	} else {
		$user = unserialize($_SESSION['user']);
		$userName = $user->getName();
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
			<div class="entry">
				<div class="pic">
					<img src="http://mtvnrewards.com/images/product_images/alienware.gif" width="220" height="220">		
				</div>
			
				<div class="description">
					Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
					tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
					At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
					no sea takimata sanctus est Lorem ipsum dolor sit amet.
				</div>
			
				<div class="options">
					<b>Artikeloptionen:</b><br><br>
				<form name="optionform" method="post" action="../php/checkKorb.php">
					<input name="anzahl" type="text" value="3" size="2" />  
					<input name="update" type="button" value="Anzahl aendern"/>
					<input name="del" type="button" value="Entfernen"/>
				</form>
				</div>
			</div>
			
			<div class="entry">
				<div class="pic">
					<img src="http://mtvnrewards.com/images/product_images/alienware.gif" width="220" height="220">		
				</div>
			
				<div class="description">
					Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
					tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
					At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
					no sea takimata sanctus est Lorem ipsum dolor sit amet.
				</div>
			
				<div class="options">
					<b>Artikeloptionen:</b><br><br>
				<form name="optionform" method="post" action="../php/checkKorb.php">
					<input name="anzahl" type="text" value="1" size="2" />  
					<input name="update" type="button" value="Anzahl aendern"/>
					<input name="del" type="button" value="Entfernen"/>
				</form>
				</div>
			</div>
			
						
			<div id="order">
				Bestellung abschicken?
				<form name="orderform" method="post" action="../php/checkBestellung.php">
				<input name="bestellen" type="button" value="Bestellung senden"/>
				<input name="abbrechen" type="button" value="Bestellung abbrechen"/>
				</form>
			</div>
			
			
		</div>
		
		<div id="footer">
		
		</div>
		
		
	</div>
	
	</body>
</html>
