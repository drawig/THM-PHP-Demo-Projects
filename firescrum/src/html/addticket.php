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
			
			if (isset($_POST['submit']) && isset($_POST['projekt']) {
				$id = $_POST['projekt'];
				
				$projekt = DatabaseAdapter::getProjekt($id);
				
				$tickets = DatabaseAdapter::getTickets($projekt);
				
			}
			


		?>
	</body>
</html>
