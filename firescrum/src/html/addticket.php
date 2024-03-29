<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Firescrum - Ticket hinzufügen</title>
	</head>
	
	<?php
		include('../php/DatabaseAdapter.php');
	//	include('../php/Ticket.php');
		
				
		if (isset($_POST['addticket']) && isset($_POST['projekt'])) {
			$id = $_POST['projekt'];	
			$projekt = DatabaseAdapter::getSingleProjekt($id);
			
			if (isset($_POST['titel']) && isset($_POST['beschreibung']) && isset($_POST['stunden'])) {
				$titel = $_POST['titel'];
				$beschreibung = $_POST['beschreibung'];
				$stunden = $_POST['stunden'];
				
				echo 'Ticket <b> '.$titel.' </b> wurde Projekt <b>'.$projekt->getTitel().'</b> mit der ID: <b>'.$projekt->getId().'</b>  hinzugefuegt';
				
			
				//String an addTicket
				$vorgaenger = $_POST['vorgaenger'];
			
				$ticket = new Ticket(-1, $titel, $beschreibung, $stunden, -1, -1); //erste -1 aendern
				
		/*		echo "<br>";
				echo "Titel: ".$ticket->getTitel();
				echo "Beschreibung: ".$ticket->getBeschreibung();
		*/		
				echo '<br><br><a href="projekte.php">Zurueck zur Projektuebersicht</a>';

				$result = DatabaseAdapter::addTicket($projekt, $ticket, $vorgaenger);
				
			}
		}
	
	?>
	
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
			<input type="hidden" name="projekt" value="<?php echo $id; ?>"/>
			<input type="submit" name="addticket" value="Ticket hinzufuegen"/>		
		</form>
		<a href="projekte.php">Zurueck zur Projektuebersicht</a>
	</body>
</html>
