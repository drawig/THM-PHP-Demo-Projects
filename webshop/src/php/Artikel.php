<?php

	/**
	 * Ein Objekt dieser Klasse repräsentiert einen Artikel im Webshop.
	 * Artikel werden charakterisiert durch eine Artikelnummer, einen Namen,
	 * eine Artikelbeschreibung und einen Preis.
	 * Die Objekte dieser Klasse sind wertorientiert, also zum halten von Daten
	 * und zum herauslesen derer gedacht.
	 */
	class Artikel {

		/** Die ArtNr, die zu diesem Artikel gehört. */
		private $mArtNr;
		/** Der Name des Artikels. */
		private $mTitel;
		/** Die Beschreibung des Artikels. */
		private $mBeschreibung;
		/** Der Preis des Artikels. */
		private $mPreis;

		/**
		 * Erstellt einen neuen Artikel mit den angegebenen Attributen.
		 *
		 * @param string Die Artikelnummer des erstellten Artikels.
		 * @param string Der Titel des erstellten Artikels.
		 * @param string Die beschreibung Die Beschreibung des erstellten Artikels.
		 * @param float Der Preis des erstellten Artikels.
		 */
		function __construct($artNr, $titel, $beschreibung, $preis) {
			$this->mArtNr = $artNr;
			$this->mTitel = $titel;
			$this->mBeschreibung = $beschreibung;
			$this->mPreis = $preis;
		}

		/**
		 * Gibt die Artikelnummer dieses Artikels zurück.
		 *
		 * @return string Die Artikelnummer dieses Artikels.
		 */
		function getArtNr() {
			return $this->mArtNr;
		}

		/**
		 * Gibt den Titel dieses Artikels zurück.
		 *
		 * @return string Den Titel dieses Artikels.
		 */
		function getTitel() {
			return $this->mTitel;
		}

		/**
		 * Gibt die Beschreibung dieses Artikels zurück.
		 *
		 * @return string Die Beschreibung dieses Artikels.
		 */
		function getBeschreibung() {
			return $this->mBeschreibung;
		}

		/**
		 * Gibt den Preis dieses Artikels zurück.
		 *
		 * @return float Den Preis dieses Artikels.
		 */
		function getPreis() {
			return $this->mPreis;
		}
	}
?>
