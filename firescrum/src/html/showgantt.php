<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Firescrum - Gantt-Diagramm</title>
	</head>
	<body>
		<h1>Gantt-Diagramm zum Projekt</h1>
		<?php
			include('../php/DatabaseAdapter.php');

			if(isset($_POST['projekt'])) {
				$tickets = DatabaseAdapter::getTickets($_POST['projekt']);

				echo '<br><br><a href="projekte.php">Zurueck zur Projektuebersicht</a>';
			if ($tickets != NULL) {						
				foreach($tickets as $ticket) {
					$id = $ticket->getId();
					$titel = $ticket->getTitel();
					$stunden = $ticket->getStunden();
					$beschreibung = $ticket->getBeschreibung();
					$vorgaenger = $ticket->getVorgaenger();
					$nachfolger = $ticket->getNachfolger();
					
					echo "<table border='1'>";
					echo '  <colgroup>
					<col width="120">
					<col width="500">
					</colgroup>';
					echo "<tr>";
					echo "<td>ID:</td><td>$id</td><br/></tr>
						<tr><td>Titel:</td><td><h4>$titel</h4></td></tr>&nbsp;&nbsp;&nbsp;&nbsp;<tr><td>Stunden:</td><td>$stunden</td><br/></tr>
						<tr><td>Beschreibung:</td><td>$beschreibung<br/></td><tr>
						<tr><td><h4>Vorgaenger:</h4></td><td>";

					foreach($vorgaenger as $value)
						echo "$value&nbsp;";

					echo '</td></tr><br/>
						<tr><td><h4>Nachfolger:</h4></td><td>';

					foreach($nachfolger as $value)
						echo "$value&nbsp;";

					echo '</td></tr><br/>';
					echo "</table>";
					
				}
				
				echo '<br><br><a href="projekte.php">Zurueck zur Projektuebersicht</a>';
				
			}
			}
		?>
	</body>
</html>
