<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Firescrum - Tickets</title>
	</head>
	<body>
		<h1>Tickets zum Projekt</h1>
		<?php
			include('../php/DatabaseAdapter.php');

			if(isset($_POST['projekt'])) {
				$tickets = DatabaseAdapter::getTickets($_POST['projekt']);

				foreach($tickets as $ticket) {
					$id = $ticket->getId();
					$titel = $ticket->getTitel();
					$stunden = $ticket->getStunden();
					$beschreibung = $ticket->getBeschreibung();
					$vorgaenger = $ticket->getVorgaenger();
					$nachfolger = $ticket->getNachfolger();

					echo "$id<br/>
						<h4>$titel</h4>&nbsp;&nbsp;&nbsp;&nbsp;$stunden<br/>
						$beschreibung<br/>
						<h4>Vorgaenger:</h4>";

					foreach($vorgaenger as $value)
						echo "$value&nbsp;";

					echo '<br/>
						<h4>Nachfolger:</h4>';

					foreach($nachfolger as $value)
						echo "$value&nbsp;";

					echo '<br/>';
				}
			}
		?>
	</body>
</html>
