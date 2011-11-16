<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
	include('../php/DatabaseAdapter.php');

	if(isset($_POST['titel'])) {
		$titel = $_POST['titel'];
		$beschreibung = $_POST['beschreibung'];

		DatabaseAdapter::addProjekt($titel, $beschreibung);
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Firescrum - Startseite</title>
	</head>
	<body>
		<h1>Willkommen bei Firescrum</h1>
		<a href="neuesprojekt.php">Neues Projekt hinzuf&uuml;gen</a><br/>
		<a href="projekte.php">Projekte</a>
	</body>
</html>
