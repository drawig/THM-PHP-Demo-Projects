<?php

	include('ArtikelPosition.php');

	/**
	 * Ein Objekt dieser Klasse repräsentiert einen Warenkorb im Online-Shop. Ein Warenkorb besteht aus einer Liste
	 * von Artikelpositionen. In ihm können neue Artikelpositionen gelegt, entfernt oder editiert werden.
	 * Diese Klasse ist zustandsorientiert.
	 */
	class Warenkorb {

		private $mArtikelPositionen;

		/**
		 * Konstruiert einen leeren Warenkorb.
		 */
		function __construct() {
			$this->mArtikelPositionen = array();
		}

		/**
		 * Fügt dem Warenkorb die gegebene ArtikelPosition hinzu. Falls es schon eine ArtikelPosition
		 * mit der gleichen ID gibt, wird die alte überschrieben.
		 *
		 * @param ArtikelPosition Die ArtikelPosition, die dem Warenkorb hinzugefügt werden soll.
		 */
		public function addArtikelPosition($artikelPosition) {
			$artikelID = $artikelPosition->getID();
			$this->mArtikelPositionen["$artikelID"] = $artikelPosition;
		}

		/**
		 * Etfernt aus dem Warenkorb die ArtikelPosition mit der gegebenen ArtikelNummer, falls sie vorhanden ist.
		 *
		 * @param string Die ArtikelNummer der ArtikelPosition, die aus dem Warenkorb entfernt werden soll.
		 * @return boolean True, falls die ArtikelPosition im Warenkorb war und entfernt wurde.
		 */
		public function removeArtikelPosition($artikelNr) {
			if(isset($this->mArtikelPositionen["$artikelNr"])) {
				unset($this->mArtikelPositionen["$artikelNr"]);
				return true;
			}

			return false;
		}

		/**
		 * Ändert die Anzahl der ArtikelPosition mit der gegebenen ArtikelNr, falls sie im Warenkorb ist.
		 * Setzt die neue Anzahl der ArtikelPosition auf die gegebene Anzahl.
		 *
		 * @param string Die ArtikelNr der ArtikelPosition, dessen Anzahl geändert werden soll.
		 * @param int Der Wert auf den die Anzahl der ArtikelPosition geändert werden soll.
		 * @return boolean True, falls die ArtikelPosition im Warenkorb war und die Anzahl erfolgreich geändert wurde.
		 */
		public function editArtikelPosition($artikelNr, $neueAnzahl) {
			if(isset($this->mArtikelPositionen["$artikelNr"])) {
				$this->mArtikelPositionen["$artikelNr"]->setAnzahl($neueAnzahl);
				return true;
			}

			return false;
		}

		/**
		 * Gibt den Wert(Preis) aller im Warenkorb vorhandenen Artikelpositionen wieder.
		 *
		 * @return int Den Wert(Preis) aller im Warenkorb vorhandenen Artikelpositionen.
		 */
		public function getGesamtPreis() {
			$gesamtPreis = 0;

			foreach ($this->mArtikelPositionen as $value)
				$gesamtPreis += $value->getPreis();

			return $gesamtPreis;
		}
	}
?>
