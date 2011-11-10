<?php
	//Hier die DB Daten eingeben
	$dbhost = "";
	$dbusername = "";
	$dbpassword = "";

	//Ab hier bitte nichts ändern.
	$dbschema = "webshop";
	$mySqlConnection = mysql_connect($dbhost, $dbusername, $dbpassword);

	if(!$mySqlConnection)
		die('Konnte Verbindung zur Datenbank nicht aufbauen: ' . mysql_error());

	if(mysql_query("CREATE DATABASE $dbschema;", $mySqlConnection)) {
		if(mysql_select_db($dbschema, $mySqlConnection)) {
			$querystring = "CREATE TABLE users (
				id int AUTO_INCREMENT,
				username varchar(20) NOT NULL,
				password varchar(80) NOT NULL,
				PRIMARY KEY(id)
			);";

			if(!mysql_query($querystring, $mySqlConnection));
				echo "Konnte Datenbank-Tabelle users nicht erzeugen: " . mysql_error();
		} else {
			echo "Konnte Datenbank-Schema mit Namen $dbschema nicht auswählen: " . mysql_error();
		}
	} else {
		echo "Konnte Datenbank-Schema mit Namen $dbschema nicht erzeugen: " . mysql_error();
	}

	mysql_close($mySqlConnection);
?>
