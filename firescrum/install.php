<?php
	//Hier die DB Daten eingeben
	$dbhost = "";
	$dbusername = "";
	$dbpassword = "";

	//Hier den Namen und PW des Users eingeben, den man einfügen möchte, um in den Webshop einloggen zu können.
	$username = "";
	$password = "";

	//Ab hier bitte nichts ändern.
	$dbschema = "firescrum";
	$mySqlConnection = mysql_connect($dbhost, $dbusername, $dbpassword);

	if(!$mySqlConnection)
		die('Konnte Verbindung zur Datenbank nicht aufbauen: ' . mysql_error() . "<br/>");

	if(mysql_query("CREATE DATABASE $dbschema;", $mySqlConnection)) {
		if(mysql_select_db($dbschema, $mySqlConnection)) {
			$querystring = "CREATE TABLE projekte (
				id int AUTO_INCREMENT,
				titel varchar(50) NOT NULL,
				beschreibung text,
				PRIMARY KEY(id)
			);";

			mysql_query($querystring, $mySqlConnection);
			
			$querystring = "CREATE TABLE ticket (
				id int AUTO_INCREMENT,
				pid int references projekte(id)
				titel varchar(50) NOT NULL,
				beschreibung text,
				stunden int,
				vorgaenger int references ticket(id),
				nachfolger int references ticket(id),
				PRIMARY KEY(id)
			);";
			
			mysql_query($querystring, $mySqlConnection);
		} else {
			echo "Konnte Datenbank-Schema mit Namen $dbschema nicht auswählen: " . mysql_error() . "<br/>";
		}
	} else {
		echo "Konnte Datenbank-Schema mit Namen $dbschema nicht erzeugen: " . mysql_error() . "<br/>";
	}

	mysql_close($mySqlConnection);
?>
