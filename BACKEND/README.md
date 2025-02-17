# Rescue Drive Backend

Dieses Verzeichnis enthält den Backend-Code für das Rescue Drive Projekt, ein selbstfahrendes Rettungsfahrzeug.

## Projektübersicht

Rescue Drive ist ein autonomes Fahrzeug, das für Rettungseinsätze konzipiert wurde. Das Backend verarbeitet Daten, steuert das Fahrzeug und stellt API-Endpunkte für das Frontend bereit.

## Funktionen

- Fahrzeugsteuerungssysteme
- Verarbeitung von Sensordaten
- API-Endpunkte für die Frontend-Kommunikation
- Datenbankverwaltung für Missionsprotokolle und Fahrzeugstatus

## Teammitglieder

- Florian Firler: Backend & Webdienste
- Alex Guarino: Hardware-Integration & Sensoren
- Ivan Federspieler: Fahrzeugmechanik & Aktuatoren
- Lorik Bajgora: Qualitätssicherung & Dokumentation
- [Robocoders (Lorik Bajgora's 2.Account): Spezifisch für GitHub zuständig]

## Technologie-Stack

- Python 3.x
- Flask für API-Entwicklung
- SQLAlchemy für Datenbank-ORM
- ROS (Robot Operating System) für Fahrzeugsteuerung
- OpenCV für Bildverarbeitung

## Erste Schritte

1. Virtuelle Umgebung einrichten: `python -m venv venv`
2. Virtuelle Umgebung aktivieren: `source venv/bin/activate` (Linux/Mac) oder `venv\Scripts\activate` (Windows)
3. Abhängigkeiten installieren: `pip install -r requirements.txt`
4. Server starten: `python app.py`

## Projektstruktur

- `/api`: API-Endpunkte und Routen
- `/models`: Datenbankmodelle
- `/services`: Geschäftslogik und Dienste
- `/utils`: Hilfsfunktionen und Helfer
- `/tests`: Unit- und Integrationstests

## Hardware-Integration

- Raspberry Pi 4 (2GB RAM) für Hauptverarbeitung
- Verschiedene Sensoren: Ultraschall, Farbe, Gyroskop, Laserentfernung
- DC-Motoren und Servomotoren für Bewegung und Betätigung

## Mitwirken

Bitte beachten Sie die Hauptprojekt-README für Richtlinien zur Mitarbeit.

## Lizenz

Dieses Projekt ist Teil von Rescue Drive und unterliegt der gleichen Lizenz wie das Hauptprojekt.
