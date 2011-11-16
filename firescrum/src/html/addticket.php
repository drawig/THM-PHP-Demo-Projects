<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Firescrum - Ticket hinzufügen</title>
	</head>
	<body>
		<h1>Ticket hinzuf&uuml;gen</h1>
		<form method="post" action="addticket.php">
			<h3>Titel:</h3>
			<input type="text" name="titel"/><br/>
			<h3>Beschreibung:</h3>
			<textarea name="beschreibung" cols="100" rows="25"></textarea><br/>
			<h3>Stunden:</h3>
			<input type="text" name="stunden"/><br/>
			<h3>Vorgaenger (mit Kommata getrennt):</h3>
			<input type="text" name="vorgaenger"/><br/>
			<input type="submit" name="addticket" value="Ticket hinzufuegen"/>
		</form>
	</body>
</html>
