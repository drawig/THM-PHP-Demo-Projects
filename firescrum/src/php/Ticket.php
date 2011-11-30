<?php

	/**
	 * Ein Objekt dieser Klasse repräsentiert ein Ticket in einem Projekt, also eine Aufgabe, die bearbeitet
	 * werden muss. Es hat eine ID, womit es eindeutig identifiziert werden kann, einen Titel, eine Aufgabenbeschreibung,
	 * eine Zeitabschätzung, wie lange die Aufgabe dauern wird, eventuell ein oder mehrere Vorgaenger Tickets und eventuell
	 * ein oder mehrere Nachfolger Tickets.
	 */
	class Ticket {

		private $mID;
		private $mTitel;
		private $mBeschreibung;
		private $mStunden;
		private $mVorgaenger;
		private $mNachfolger;

		/**
		 * Erzeugt ein neues Ticket mit der gegebenen ID, dem gegebenen Titel, der gegebenen Aufgabenbeschreibung,
		 * der gegebenen Zeitabschätzung und optionalen Arrays von Vorgaengern und Nachfolgern.
		 *
		 * @param int Die eindeutige ID dieses Tickets, generiert von der Datenbank.
		 * @param string Der Titel dieses Tickets.
		 * @param string Die Aufgabenbeschreibung zu diesem Ticket.
		 * @param int Die abgeschätzte Bearbeitungszeit in Stunden für dieses Ticket.
		 * @param array Ein Array von Vorgaenger Tickets. Leer wenn nichts anderes angegeben.
		 * @param array Ein Array von Nachfolger Tickets. Leer wenn nichts anderes angegeben.
		 */
		function __construct($id, $titel, $beschreibung, $stunden, $vorgaenger = array(), $nachfolger = array()) {
			$this->mID = $id;
			$this->mTitel = $titel;
			$this->mBeschreibung = $beschreibung;
			$this->mStunden = $stunden;
			$this->mVorgaenger = $vorgaenger;
			$this->mNachfolger = $nachfolger;
		}

		/**
		 * Fügt ein Vorgaenger Ticket diesem Ticket hinzu.
		 *
		 * @param Ticket Das Ticket, das als Vorgaenger zu diesem Ticket hinzugefügt werden soll.
		 */
		public function addVorgaenger($vorgaenger) {
			$key = $vorgaenger->getID();
			$this->mVorgaenger["$key"] = $vorgaenger;
		}

		/**
		 * Fügt ein Nachfolger Ticket diesem Ticket hinzu.
		 *
		 * @param Ticket Das Ticket, das als Nachfolger zu diesem Ticket hinzugefügt werden soll.
		 */
		public function addNachfolger($nachfolger) {
			$key = $nachfolger->getID();
			$this->mNachfolger["$key"] = $nachfolger;
		}

		/**
		 * Entfernt ein Vorgänger Ticket von diesem Ticket, falls es ein Vorgänger dieses Tickets ist.
		 *
		 * @param Ticket Das Ticket, das von der Vorgängerliste dieses Tickets entfernt werden soll.
		 */
		public function removeVorgaenger($vorgaenger) {
			$key = $vorgaenger->getID();

			if(isset($this->mVorgaenger["$key"]))
				unset($this->mVorgaenger["$key"]);
		}

		/**
		 * Entfernt ein Nachfolger Ticket von diesem Ticket, falls es ein Nachfolger dieses Tickets ist.
		 *
		 * @param Ticket Das Ticket, das von der Nachfolgerliste dieses Tickets entfernt werden soll.
		 */
		public function removeNachfolger($nachfolger) {
			$key = $nachfolger->getID();

			if(isset($this->mNachfolger["$key"]))
				unset($this->mNachfolger["$key"]);
		}

		/**
		 * Gibt die ID dieses Tickets zurück, welche von der Datenbank generiert wurde.
		 *
		 * @return int Die ID dieses Tickets, welche von der Datenbank generiert wurde.
		 */
		public function getID() {
			return $this->mID;
		}

		/**
		 * Gibt den Titel dieses Tickets zurück.
		 *
		 * @return string Den Titel dieses Tickets.
		 */
		public function getTitel() {
			return $this->mTitel;
		}

		/**
		 * Gibt die Beschreibung dieses Tickets zurück.
		 *
		 * @return string Die Beschreibung dieses Tickets.
		 */
		public function getBeschreibung() {
			return $this->mBeschreibung;
		}

		/**
		 * Gibt die Bearbeitungszeit in Stunden dieses Tickets zurück.
		 *
		 * @return int Die Bearbeitungszeit in Stunden dieses Tickets.
		 */
		public function getStunden() {
			return $this->mStunden;
		}

		/**
		 * Gibt alle Vorgänger dieses Tickets als Array zurück.
		 *
		 * @return array Alle Vorgänger dieses Tickets.
		 */
		public function getVorgaenger() {
			return $this->mVorgaenger;
		}

		/**
		 * Gibt alle Nachfolger dieses Tickets als Array zurück.
		 *
		 * @return array Alle Nachfolger dieses Tickets.
		 */
		public function getNachfolger() {
			$this->mNachfolger;
		}
	}
?>
