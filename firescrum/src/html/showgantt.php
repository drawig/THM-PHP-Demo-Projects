<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
	<head>
		<title>Firescrum - Gantt-Diagramm</title> 
		<script src="../libraries/RGraph.common.core.js"></script>
		<script src="../libraries/RGraph.gantt.js"></script>
		<script src="../libraries/RGraph.common.tooltips.js"></script>
	</head>
	<body>
		<h1>Gantt-Diagramm zum Projekt</h1>
		<?php
			include('../php/DatabaseAdapter.php');
			
		echo	'<canvas id="gantt1" height="300" width="850" style="cursor: default;">[No canvas support]</canvas>';


	/* Example Project 	*/
	
	/* 								Duration		Start	End
		1. GUIs erstellen				6h			0		6
		2. Database Kram				5h			0		5
		3. Testing						10h			6		16
		4. Moar Testing					5h			16		21
		5. Moar GUIs erstellen			5h			21		26
		6. Last Testing + Release		15h			26		41
	
	/* Max Stunden */
	$max = 41;

	$task1start = 0;	
	$task2start = 0;	
	$task3start = 6;	
	$task4start = 16;	
	$task5start = 21;	
	$task6start = 26;

	$task1dur = 6;
	$task2dur = 5;
	$task3dur = 10;
	$task4dur = 5;
	$task5dur = 5;
	$task6dur = 15;
	
	
	?>
	
	<script>
    window.onload = function ()
    {
        // Create the Gantt chart. Note that unlike other RGraph charts the actual data is NOT
        // given as part of the constructor.
        var gantt = new RGraph.Gantt('gantt1');
        
        // Configure the chart to appear as you want.
        gantt.Set('chart.xmax', <? echo $max; ?>);
        gantt.Set('chart.gutter.left', 75);
 //       gantt.Set('chart.labels', ['1.Tag', '2.Tag', '3.Tag', '4.Tag', '5.Tag', '6.Tag', '7.Tag', '8.Tag', '9.Tag', '10.Tag', '11.Tag', '12.Tag']);
        gantt.Set('chart.title', 'Project schedule for Project  X');
        gantt.Set('chart.defaultcolor', 'rgba(255,0,0,1)');
        gantt.Set('chart.tooltips', ["<b>Task1</b><br />GUI",
                                     "<b>Task2</b><br />Database",
                                     "<b>Task3</b><br />Testing",
                                     "<b>Task4</b><br />Moar testing",
                                     "<b>Task5</b><br /> Moar GUIs",
                                     "<b>Task6</b><br />Last testing + release"]);  
        
        // This is where the events that appear on the Gantt chart are given. You can read about the
        // format below.
        gantt.Set('chart.events', [
                                 [<? echo $task1start; ?>, <? echo $task1dur; ?>, null, 'Task1'],
                                 [<? echo $task2start; ?>, <? echo $task2dur; ?>, null, 'Task2'],
                                 [<? echo $task3start; ?>, <? echo $task3dur; ?>, null, 'Task3'],
                                 [<? echo $task4start; ?>, <? echo $task4dur; ?>, null, 'Task4'],
                                 [<? echo $task5start; ?>, <? echo $task5dur; ?>, null, 'Task5'],
                                 [<? echo $task6start; ?>, <? echo $task6dur; ?>, null, 'Task6']
                                ]);

 /*       gantt.Set('chart.vbars', [
                                  [0, 31, 'rgba(192,255,255,0.5)'],
                                  [59, 31, 'rgba(192,255,192,0.5)'],
                                  [120, 31, 'rgba(192,255,255,0.5)'],
                                  [181, 31, 'rgba(192,255,192,0.5)'],
                                  [243, 30, 'rgba(192,255,192,0.5)'],
                                  [304, 30, 'rgba(192,255,192,0.5)']
                                 ]);
*/
        // Now call the .Draw() method to draw the chart.
        gantt.Draw();
    }
</script> 
	



<?php

//-------------------------------------------------------------------------------------------------

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
