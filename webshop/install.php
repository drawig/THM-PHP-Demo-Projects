<?php
	//Hier die DB Daten eingeben
	$dbhost = "localhost";
	$dbusername = "root";
	$dbpassword = "";

	//Hier den Namen und PW des Users eingeben, den man einfügen möchte, um in den Webshop einloggen zu können.
	$username = "test";
	$password = "test";

	//Ab hier bitte nichts ändern.
	$dbschema = "webshop";
	$mySqlConnection = mysql_connect($dbhost, $dbusername, $dbpassword);

	if(!$mySqlConnection)
		die('Konnte Verbindung zur Datenbank nicht aufbauen: ' . mysql_error() . "<br/>");

	if(mysql_query("CREATE DATABASE $dbschema;", $mySqlConnection)) {
		if(mysql_select_db($dbschema, $mySqlConnection)) {
			$querystring = "CREATE TABLE users (
				id int AUTO_INCREMENT,
				username varchar(20) NOT NULL,
				password varchar(80) NOT NULL,
				PRIMARY KEY(id)
			);";

			mysql_query($querystring, $mySqlConnection);

			$querystring = "CREATE TABLE artikel (
				id int AUTO_INCREMENT,
				name varchar(40) NOT NULL,
				beschreibung varchar(255) NOT NULL,
				preis float NOT NULL,
				bildpfad text,
				PRIMARY KEY(id)	
			);";

			mysql_query($querystring, $mySqlConnection);

			$querystring = "INSERT INTO users(username, password) VALUES('$username', '$password');";
			mysql_query($querystring, $mySqlConnection);
			
			//Test-Artikel 1
			$querystring = "INSERT INTO artikel(id, name, beschreibung, preis, bildpfad) VALUES('1', 'Alienware Laptop', 'lorem ipsum bla', '2000', 'res/alienware.gif');";
			mysql_query($querystring, $mySqlConnection);
			
			//Test-Artikel 2
			$querystring = "INSERT INTO artikel(id, name, beschreibung, preis, bildpfad) VALUES('2', 'Apple iMac', 'lorem ipsum bla', '4000', 'res/imac_mac_archigraphs.png');";
			mysql_query($querystring, $mySqlConnection);
		} else {
			echo "Konnte Datenbank-Schema mit Namen $dbschema nicht auswählen: " . mysql_error() . "<br/>";
		}
	} else {
		echo "Konnte Datenbank-Schema mit Namen $dbschema nicht erzeugen: " . mysql_error() . "<br/>";
	}

	mysql_close($mySqlConnection);
?>
