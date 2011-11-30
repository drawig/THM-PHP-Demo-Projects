<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Firescrum - Projekte</title>
	</head>
	<body>
		<h1>Angelegte Projekte</h1>
		<?php
			include('../php/DatabaseAdapter.php');

			$projekte = DatabaseAdapter::getProjekte();

			if($projekte != NULL) {
				foreach($projekte as $value) {
					$titel = $value->getTitel();
					$beschreibung = $value->getBeschreibung();
					$id = $value->getId();

					echo "<h3>$titel</h3>
						$beschreibung<br/>" .
						'<form method="post">
							<form method="post" action="showtickets.php">
								<input type="submit" name="showtickets" value="Zeige Tickets"/><br/>
							</form>
							<form method="post" action="addticket.php">
								<input type="submit" name="addticket" value="Ticket hinzufügen"/><br/>
							</form>
							<input name="projekt" type="hidden" value="' . $id . '"/>
						</form>';
				}
			}
		?>
	</body>
</html>
