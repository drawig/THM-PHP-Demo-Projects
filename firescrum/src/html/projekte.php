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
						'<input type="submit" value="Zeige Tickets"/><br/>
						<input type="submit" value="Ticket hinzufügen"/><br/>
						<input name="projekt" type="hidden" value="' . $id . '"/>';
				}
			}
		?>
	</body>
</html>
