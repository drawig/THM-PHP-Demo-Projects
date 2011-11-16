<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Firescrum - Neues Projekt</title>
	</head>
	<body>
		<h2>Neues Projekt</h2>
		<form method="post" action="index.php">
			<h3>Titel:</h3>
			<input type="text" name="titel"/><br>
			<h3>Beschreibung:</h3>
			<textarea name="beschreibung" cols="100" rows="25"></textarea><br/>
			<input type="submit" name="neuesprojekt" value="Neues Projekt anlegen"/>
		</form>
	</body>
</html>
