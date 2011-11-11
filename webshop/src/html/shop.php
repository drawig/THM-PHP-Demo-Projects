<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
			<li><a href="shop.php">Artikeluebersicht</a></li>
			<li><a href="korb.html">Warenkorb</a></li>
			<li><a href="shop.php">Test#1</a></li>
			<li><a href="shop.php">Test#2</a></li>
			</div>
			</ul>
			<div id="login">
				<form name="loginform" method="post" action="../php/shoLoginService.php">
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
					<input name="login" type="button" value="Log In"/>
				</div>				
					
				</form>

			</div>
			
		</div>
		
		<div id="content">
			Artikeluebersicht
			<div class="entry">
				<div class="pic">	
					<img src="http://images-5.findicons.com/files/icons/252/apples/512/imac_mac_archigraphs.png" width="220" height="220">
				</div>
			
				<div class="description">
					Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
					tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
					At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
					no sea takimata sanctus est Lorem ipsum dolor sit amet.
				</div>
			
				<div class="options">
				<b>Artikeloptionen:</b><br><br>
				<form name="addform1" method="post" action="../php/checkAdd.php">
					<input name="anzahl" type="text" size="2" />  
					<input name="add" type="button" value="Zum Warenkorb hinzufuegen"/>
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
				<form name="addform2" method="post" action="../php/checkAdd.php">
					<input name="anzahl" type="text" size="2" />  
					<input name="add" type="button" value="Zum Warenkorb hinzufuegen"/>
				</form>
				</div>
			</div>

			
		</div>
		
		<div id="footer">
		
		</div>
		
		
	</div>
	
	</body>
</html>
