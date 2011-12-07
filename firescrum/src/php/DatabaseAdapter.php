<?php

	include('Projekt.php');
	include('Ticket.php');

	/**
	 * Diese Klasse bietet Funktionen, mit denen von Firescrum häufig durchgeführte Datenbank-Zugriffe
	 * abstrahiert werden.
	 */
	class DatabaseAdapter {

		//Hier richtige Daten eingeben.
		private static $mDBHost = "localhost";
		private static $mDBUser = "root";
		private static $mDBPassword = "";

		/**
		* Erstellt aus dem uebergebenen Titel und der Beschreibung ein neues Projekt bzw. erstellt einen Eintrag
		* in der Datenbank mit diesen Daten.
		*
		* @param String  Titel des Projekts
		* @param String Beschreibung des Projekts
		*/
		public static function addProjekt($titel, $beschreibung) {
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 
		
				$sth = $dbh->prepare("INSERT INTO projekte(titel, beschreibung) VALUES(?, ?);");

				$sth->bindParam(1, $titel);
				$sth->bindParam(2, $beschreibung);
				
							
				$sth->execute();

				$return = $sth->fetch();

				if(!$return)
					return NULL;

				$dbh = NULL;

			} catch (Exception $e) {}

			return NULL;
		}
		
		
		/**
		* Fuegt dem uebergebenen Projekt das uebergebene Ticket hinzu und speichert dieses in der Datenbank.
		*
		* @param Projekt das Projekt, zu dem ein Ticket hinzugefuegt werden soll
		* @param Ticket das Ticket, welches zum Projekt hinzugefuegt werden soll
		* @param String Die Vorgaenger mit Kommata getrennt
		*/
		public static function addTicket($projekt, $ticket, $vorgaenger) {
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 
					
				$projektId = $projekt->getId();
				
		//		$ticketId = $ticket->getID(); //hier noch -1
				$ticketTitel = $ticket->getTitel();
				$ticketBeschreibung = $ticket->getBeschreibung();
				$ticketStunden = $ticket->getStunden();
				
				$ticketVorgaenger = array();			
				$ticketNachfolger = array();
				
				
				//erstmal neues Ticket in DB eintragen und direkt wieder auslesen um die ID zu bekommen
				$sth = $dbh->prepare("INSERT INTO tickets(pid, titel, beschreibung, stunden) VALUES(?, ?, ?, ?);");
				
				$sth->bindParam(1, $projektId);
				$sth->bindParam(2, $ticketTitel);
				$sth->bindParam(3, $ticketBeschreibung);
				$sth->bindParam(4, $ticketStunden);
				
				$sth->execute();
				
				$sth = $dbh->prepare("SELECT * FROM tickets ORDER BY id DESC;"); 
				$sth->execute();
				
				$returnTicket = $sth->fetchAll();
				$i = 0;
				
				$ticketID = 0;
				
				//Durchlaeuft das aeußere Array (welches Arrays enthaelt)
				foreach ($returnTicket as $entry) {
					$tempArray = array();
					
					//Durchlaeuft das innere Array (welches key-value-paare enthaelt)
					foreach($entry as $key => $value) {
						
						if($i == 0) {
							$tempArray[$key] = $value;
							//Aktuelle ID vom neuen Ticket
							$ticketID = $tempArray['id'];
						}
						$i = 1;
					}
				}
					
				
				if (count($vorgaenger) != 0) {
				//String auslesen und zahlen im array speichern 	
				$zahlen = split('[,]', $vorgaenger);


				//Zahlen stehen korrekt im Array 
				
				foreach ($zahlen as $id) {
					$sth = $dbh->prepare("INSERT INTO graphknoten(vorgaenger, nachfolger) VALUES(?, ?);");
				
					$sth->bindParam(1, $id);
					$sth->bindParam(2, $ticketID);
			
					$sth->execute();
					
					$return = $sth->fetch(); //No need o_O
					
				}
				
				}
				
				if(!$returnTicket) {
					$dbh = NULL;
					return NULL;
				}

				
				$dbh = NULL;
				
			} catch (Exception $e) {}

			return NULL;
		}

		
		
		/**
		* Liest saemtliche in der Datenbank vorhanden Projekteintraege aus, speichert diese in einem
		* array und liefert dieses zurueck
		*
		* @return array mit allen Projekten
		*/
		public static function getProjekte() {
			
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 

				$sth = $dbh->prepare("SELECT * FROM projekte;");

				$sth->execute();

				//Liefert ein Array welches wiederrum weitere Arrays beeinhaltet, welche die key + value paare beeinhalten
				$return = $sth->fetchAll();

				if(!$return)
					return NULL;

				
				//Durchlaeuft das aeußere Array (welches Arrays enthaelt)
				foreach ($return as $entry) {
					$tempArray = array();
					
					//Durchlaeuft das innere Array (welches key-value-paare enthaelt)
					foreach($entry as $key => $value) {
						$tempArray[$key] = $value;
					}
					
					//Neue Projekte erstellen und dem returnArray hinzufuegen
					$projekt = new Projekt($tempArray['id'], $tempArray['titel'], $tempArray['beschreibung']);
					$returnArray[] = $projekt;
					
				}
				
				/* Debug
				echo '<br><br>';
				print_r($returnArray); */
				
				$dbh = NULL;
				
				return $returnArray;
				
			} catch (Exception $e) {}

			return NULL;
		}
		
		/**
		* Liest ein einzelnes Projekt anhand der ubergebenen id aus der Datenbank aus und gibt dieses zurueck
		* 
		* @param int eindeutige id des Projekts
		* @return Projekt das zur ID zugehoerige Projekt
		*/
		public static function getSingleProjekt($id) {
			$result = NULL;

			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 
		
				$sth = $dbh->prepare("SELECT * FROM projekte WHERE id=?;");

				$sth->bindParam(1, $id);

				$sth->execute();

				$return = $sth->fetch();

				if(!$return) {
					$dbh = NULL;
					return NULL;
				}

				$id = $return['id'];
				$titel = $return['titel'];
				$beschreibung = $return['beschreibung'];
				

				$result = new Projekt($id, $titel, $beschreibung);
				
			} catch (Exception $e) {}

			return $result;
		}
		
		
		/**
		* Liefert alle zum uebergebenen Projekt alle in der Datenbank vorhanden Tickets als array
		*
		* @param string Projekt ID des Projekts zu dem die Tickets geliefert werden sollen
		* @return array enthaelt alle Tickets zum Projekt
		*/
		public static function getTickets($projektId) {
			
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 
				$tickets = array();

		
				$sth = $dbh->prepare("SELECT * FROM tickets WHERE pid=?;");
				$sth->bindParam(1, $projektId);

				$sth->execute();

				//Liefert ein Array welches wiederrum weitere Arrays beeinhaltet, welche die key + value paare beeinhalten
				$return = $sth->fetchAll();

				if(!$return) {
					$dbh = NULL;
					return NULL;
				}

				//Durchlaeuft das aeußere Array (welches Arrays enthaelt)
				foreach ($return as $entry) {
					$tempArray = array();
					
					//Durchlaeuft das innere Array (welches key-value-paare enthaelt)
					foreach($entry as $key => $value) {
						$tempArray[$key] = $value;
					}
					
					//Nachfolger raussuchen
					$sth = $dbh->prepare("SELECT * FROM graphknoten WHERE nachfolger=?;");
					$sth->bindParam(1, $tempArray['id']);
					
					$sth->execute();

					$ergebnis = $sth->fetchAll();
					$vorgaengerIds = array();

					foreach($ergebnis as $entry)
						$vorgaengerIds[] = $entry['vorgaenger'];

						
					
	/*				$nachfolgerIds = array();
					
					$sth = $dbh->prepare("SELECT * FROM graphknoten;");
					
					$sth->execute();
						
					$returnn = $sth->fetchAll(); //hier weiter .....
						
					foreach($returnn as $entry) {


						echo $entry.' '.$returnn['nachfolger'].' <br>';
						$nachfolgerIds[] = $returnn['nachfolger'];
						
						print_r($nachfolgerIds);
						
					}
						
	*/					
					
					$sth = $dbh->prepare("SELECT * FROM graphknoten WHERE vorgaenger=?;");
					$sth->bindParam(1, $tempArray['id']);
					
					$sth->execute();

					$ergebnis = $sth->fetchAll();
					$nachfolgerIds = array();
		
					foreach($ergebnis as $entry)
						$nachfolgerIds[] = $entry['nachfolger']; 
				
			//		echo "teeeeeeeest";
	
					$ticket = new Ticket($tempArray['id'], $tempArray['titel'], $tempArray['beschreibung'], $tempArray['stunden'], $vorgaengerIds, $nachfolgerIds);
					$tickets[] = $ticket;
					
				}
				
				/* Debug
				echo '<br><br>';
				print_r($returnArray); */
				
				$dbh = NULL;
				
				return $tickets;
				
			} catch (Exception $e) {}

			return NULL;
		}
		
		/**
		* Liefert das Ticket zu der uebergenen ID (Zahl)
		*
		* @param int ID (Zahl) des benoetigten Tickets
		* @return Ticket das Ticket zu der ID
		*/
		public static function getTicket($id) {
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 

				$sth = $dbh->prepare("SELECT * FROM tickets WHERE id =?;");
				
				$sth->bindParam(1, $id);

				$sth->execute();

				$return = $sth->fetch();

				if(!$return) {
					$dbh = NULL;
					return NULL;
				}


				$id = $return['id'];
				$pid = $return['pid']; //TODO pid?
				$titel = $return['titel'];
				$beschreibung = $return['beschreibung'];
				$stunden = $return['stunden'];
				
 
				$result = new Ticket($id, $titel, $beschreibung, $stunden); //TODO pid?
				
			} catch (Exception $e) {}

			return $result;
		}
		
	}
?>
