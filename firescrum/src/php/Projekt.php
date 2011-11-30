<?php

	/**
	 * Ein Objekt dieser Klasse repräsentiert ein Projekt. Ein Projekt hat einen Titel und eine Projektbeschreibung.
	 * Zu einem Projekt gehören auch Tickets, die in diesem Projekt abzuarbeiten sind.
	 */
	class Projekt {

		private $mID;
		private $mTitel;
		private $mBeschreibung;
		private $mStartTickets;

		/**
		 * Erzeugt ein neues Projekt mit der angegebenen ID, dem angegebenen Titel, der angegebenen Projektbeschreibung
		 * und mit keinen Tickets.
		 *
		 * @param int Die eindeutige ID dieses Projekts. Von der Datenbank generiert.
		 * @param string Der Titel dieses Projekts.
		 * @param string Die Projektbeschreibung.
		 */
		function __construct($id, $titel, $beschreibung) {
			$this->mID = $id;
			$this->mTitel = $titel;
			$this->mBeschreibung = $beschreibung;
			$this->mStartTickets = array();
		}

		/**
		 * Holt die eindeutige ID dieses Projekts, welche von der Datenbank generiert wurde.
		 *
		 * @return int Die eindeutige ID dieses Projekts, welche von der Datenbank generiert wurde.
		 */
		public function getId() {
			return $this->mID;
		}

		/**
		 * Gibt den Titel des Projekts zurück.
		 *
		 * @return string Den Titel dieses Projekts.
		 */
		public function getTitel() {
			return $this->mTitel;
		}

		/**
		 * Gibt die Beschreibung dieses Projekts zurück.
		 *
		 * @return string Die Beschreibung dieses Projekts.
		 */
		public function getBeschreibung() {
			return $this->mBeschreibung;
		}
	}
?>
