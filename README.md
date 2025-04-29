# Protokoll zum Projekt „Selbstfahrendes Auto“

## Inhaltsverzeichnis
1. [Auto-Ideen und Konzept](#1-auto-ideen-und-konzept)
   - [Technische Ansätze](#11-technische-ansätze)
   - [Sensorik](#12-sensorik)
   - [Antriebskonzept](#13-antriebskonzept)
   - [Steuerungssystem](#14-steuerungssystem)
2. [Zieldefinition](#2-zieldefinition)
3. [Firmengründung](#3-firmengründung)
   - [Logo und Design](#31-logo-und-design)
   - [Rechtsform des Unternehmens](#32-rechtsform-des-unternehmens)
   - [Vor- und Nachteile](#33-vor--und-nachteile)
4. [Organisationseinheit und Rollenverteilung](#4-organisationseinheit-und-rollenverteilung)
5. [Arbeitsstruktur (WBS)](#5-arbeitsstruktur-wbs)
6. [Weitere Aufgaben](#6-weitere-aufgaben)
7. [Materialliste 1.0](#7-materialliste-10)
8. [Risikoanalyse](#8-risikoanalyse)
   - [Technische Risiken](#81-technische-risiken)
   - [Organisatorische Risiken](#82-organisatorische-risiken)
   - [Finanzielle Risiken](#83-finanzielle-risiken)
   - [Zeitliche Risiken](#84-zeitliche-risiken)
   - [Rechtliche und regulatorische Risiken](#85-rechtliche-und-regulatorische-risiken)
   - [Team-Risiken](#86-team-risiken)
9. [Meilensteine und Zeitplanung](#9-meilensteine-und-zeitplanung)
10. [Tagebuch](#10-tagebuch)

---

## 1. Auto-Ideen und Konzept

Um das Ziel eines selbstfahrenden Autos zu erreichen, wurden verschiedene technische Ansätze und Ideen für die Fahrzeugkonfiguration gesammelt:

### 1.1 Technische Ansätze
- **Koordinatensystem**: Ein 5×5-Koordinatensystem könnte zur Navigation genutzt werden.
- **Form des Fahrzeugs**: Eine rautenförmige Struktur könnte für Stabilität sorgen.
- **Schwerpunktverlagerung**: Das Fahrzeug sollte eine Gewichtsverlagerung nach unten haben, um ein Kippen zu verhindern.

### 1.2 Sensorik
- Einsatz eines Ultraschallsensors oder Lasersensors zur Entfernungsmessung und Erkennung von Hindernissen.
- **Sensorintegration**: Kombination von Sensoren zur Verbesserung der Genauigkeit.

### 1.3 Antriebskonzept
- Antrieb über Kolben oder ein Rad, das durch Reibung bewegt wird.

### 1.4 Steuerungssystem
- Verwendung eines Elektromagneten zur zusätzlichen Steuerung.
- Überlegungen zur stabilen und langlebigen Lagerung der Komponenten.

---

## 2. Zieldefinition

Ziel des Projekts: Entwicklung und Bau eines autonomen Fahrzeugs, das in der Lage ist, Hindernisse zu erkennen und selbstständig zu navigieren. Das Fahrzeug soll zudem ein Paket-Zustellsystem beinhalten.

---

## 3. Firmengründung

Im Rahmen des Projekts soll ein eigenes Unternehmen gegründet werden, um professionelle Strukturen zu schaffen und rechtliche Anforderungen zu erfüllen.

### 3.1 Logo und Design
- **Farben**: Schwarz/Weiß
- **Namensideen**:
  - Rescue Drive
  - ResQ Drive
  - Rescue Rover

### 3.2 Rechtsform des Unternehmens
- Die Wahl fiel auf die Unternehmensgesellschaft (haftungsbeschränkt) – UG (haftungsbeschränkt).

### 3.3 Vor- und Nachteile
- **Vorteile**:
  - Haftungsbeschränkung: Die Gesellschafter haften nur mit dem Gesellschaftsvermögen, nicht mit ihrem Privatvermögen.
  - Gründung mit einem Mindestkapital von 1 €, sodass die verfügbaren 500 € Startkapital ausreichen.
  - Geeignet für Projekte mit höherem Risiko, insbesondere bei einer möglichen zukünftigen Expansion oder Aufnahme von Investoren.
  - Relativ niedrige Gründungskosten (ca. 300–400 € für Notar und Handelsregistereintrag).
  
- **Nachteile**:
  - Höherer bürokratischer Aufwand als bei einer GbR (u.a. Notar, Eintragung ins Handelsregister).
  - Verpflichtung zur Bilanzierung und Buchführung nach HGB (Handelsgesetzbuch).

---

## 4. Organisationseinheit und Rollenverteilung

- **Projektleiter (Projektmanagement & Koordination)**: Fabian Leimegger
  - Verantwortlich für die Gesamtkoordination des Projekts.
  - Erstellt die Zieldefinition, eine WBS (Work Breakdown Structure), ein Gantt-Diagramm und einen Ressourcenplan.
  - Pflegt das Online-Dokumentationssystem mit Protokollen und Fortschrittsberichten.
  - Zuständig für die Stakeholder-Kommunikation und das Risikomanagement.
  - Überwacht die Einhaltung aller Meilensteine und Deadlines.

- **Hardware-Spezialist (Sensoren & Mechanik)**: Alex Guarino
  - Entwicklung und Integration von Hardware-Komponenten wie Helligkeits-, Distanz-, Farb- und Richtungssensoren.
  - Steuerung und Überwachung der Motoren und Handsteuerung über WLAN.
  - Testet die Hardware-Komponenten zur Sicherstellung der Grundfunktionen.

- **Mechanik & Aktuatoren (Fahrzeugsteuerung & Paketabgabe)**: Ivan Federspieler
  - Entwickelt Mechanismen zur Paketzustellung und zur Personen-Anhebung.
  - Integration und Test der Aktuatoren und Fahrzeugmechanik.

- **Backend & Webservices**: Florian Firler
  - Einrichtung und Betrieb eines Webservers, der aus dem Internet zugänglich ist.
  - Entwicklung von Webservices zur Anzeige von Telemetriedaten (z. B. Akkustand).
  - Verantwortlich für die Multi-Tier-Architektur und die Schnittstellendokumentation (Swagger).
  - Sicherstellung der Datenbankanbindung für das Projekttagebuch.

- **Frontend Webseite & Benutzerfreundlichkeit**: Felix Hinteregger
  - Erstellung der Webseite inkl. Mockup und responsivem Design.
  - Entwicklung der Benutzerverwaltung und geschützter Bereiche (z. B. Login-Funktion).
  - Optimierung der Benutzerfreundlichkeit und Gewährleistung eines fehlerfreien Layouts.

- **Qualitätssicherung & Dokumentation (Tests & Berichte)**: Lorik Bajgora
  - Durchführung von Unit-, Funktions- und Akzeptanztests für Fahrzeug und Webseite.
  - Tägliche Dokumentation der Arbeitsstunden im Online-Tagebuch.
  - Erstellung des ER-Diagramms und des abschließenden Projektberichts.
  - Abschlusspräsentation und Video-Dokumentation des Projektverlaufs.

---

## 5. Arbeitsstruktur (WBS)

- **Version 2**: Detaillierte Aufschlüsselung der Aufgaben und Verantwortlichkeiten.

---

## 6. Weitere Aufgaben

Zusätzliche Projektkomponenten, die geplant und organisiert werden, umfassen:
- Webseite, Datenbank und Server
- Fahrzeugsensorik (Farbsensor, Distanzsensor, Laser-Distanzsensor)
- Steuerung und Log-Funktionen
- Design, Logo und Elektromagneten
- Abwurfmechanismen und Lichttechnologie
- Einhaltung der Zeitplanung und detaillierte Rollenzuweisung

---

## 7. Materialliste 1.0 (Stand: 28.11.2024)

Eine vorläufige Materialliste für das Projekt enthält:

| Bauteil                     | Link     | Preis [€] | Info                          |
|-----------------------------|----------|-----------|-------------------------------|
| Raspberry Pi 5              | Link 1   | 55,04     | 4 GB RAM                      |
|                             | Link 2   | 103,86    | 8 GB RAM                      |
| Laserdistanzsensor          | Link 3   | 8,99      | 4 Stück, 2 Meter Distanz      |
|                             | Link 3B  | 1,61      |                               |
| Kupferkabel                 | Link 4   | 18,99     | 6 Farben, 30 Meter            |
| Räder                       | Link 5.2 | 9,68      | normale Reifen                |
| Motor                       | Link 6   | 18,00     | DC 12V-36V 3500-9000rpm, leiser Betrieb |
|                             | Link 6.2 | 10,00     | Stepper Motor                 |
| Elektromagnet               | Link 7   | 9,99      | 25mm Durchmesser, DC 5V       |
| Steckbrett & Kabel          | Link 8   | 16,00     |                               |
| Karosserie                  | ?        | ?         | 3D Druck                      |
| Farbsensor                  | Link     | 13,99     | 2 Stück                       |
| | Arduino                     | Link     | 30,00     |                               |
| Schrittmotor                | Link     | 36,34     |                               |
| Lenkrollen                  | Link     | 4,29      | 28mm x 27mm                  |
| Schienenräder               | Link     | 5,22      | 1.5 x 1.5 x 0.6              |
| Schiene                     | Link     | 6,29      | 182mm                         |
| Kugellager-Rad              | Link     | 7,99      |                               |
| Batterie für Mikrocontroller | Link     | 35,00     | 7,4 V, 2 Stück                |
| Batterie für Motoren        | Link     | 9,19      | -12 V                         |
| Lötplatine                  | Link     | 12,99     | 5 große, 2 kleine             |

---

## 8. Risikoanalyse

### 8.1 Technische Risiken
- **Probleme mit der Sensorik**:
  - Mögliche Situation: Sensoren könnten ungenaue Messwerte liefern oder ausfallen.
  - Auswirkungen: Fehlende oder falsche Hinderniserkennung kann das autonome Fahren gefährden.
  - Lösungen: Tests der Sensoren in verschiedenen Umgebungen und redundante Systeme zur Absicherung der Sensorik einbauen.

- **Fehler bei der Fahrzeugsteuerung**:
  - Mögliche Situation: Das Fahrzeug könnte aufgrund von Fehlern in der Steuerung nicht korrekt reagieren.
  - Auswirkungen: Fehlende Fahrzeugkontrolle oder fehlerhafte Paketabgabe.
  - Lösungen: Umfassende Tests der Fahrzeugmechanik und mehrfache Integrationsprüfungen der Aktuatoren.

### 8.2 Organisatorische Risiken
- **Unklare Verantwortlichkeiten**:
  - Mögliche Situation: Unklarheiten über die Aufgabenverteilung könnten zu Verzögerungen führen.
  - Lösungen: Präzise und regelmäßige Kommunikation innerhalb des Teams.

### 8.3 Finanzielle Risiken
- **Unterschätzung der Kosten**:
  - Mögliche Situation: Die Materialkosten überschreiten das geplante Budget.
  - Lösungen: Detaillierte Planung und kontinuierliche Überwachung der Ausgaben.

### 8.4 Zeitliche Risiken
- **Verzögerungen bei der Materialbeschaffung**:
  - Mögliche Situation: Lieferverzögerungen von Bauteilen.
  - Lösungen: Frühzeitige Bestellung und Überwachung des Lieferstatus.

### 8.5 Rechtliche und regulatorische Risiken
- **Verstöße gegen rechtliche Anforderungen**:
  - Mögliche Situation: Fehlende rechtliche Beratung.
  - Lösungen: Konsultation eines Rechtsanwalts.

### 8.6 Team-Risiken
- **Verlust von Schlüsselpersonen**:
  - Mögliche Situation: Ein Teammitglied könnte ausfallen.
  - Lösungen: Dokumentation des Wissens und Ausbildung von Ersatzpersonen.

---

## 9. Meilensteine und Zeitplanung

- **Bis 22.11.2024 (24:00 Uhr)**:
  - Zieldefinition für das Projekt Auto 2024-25 → Alle
  - Erstellung der WBS mit Verantwortlichkeiten → Alex Guarino, Florian Firler
  - Festlegung der Firmengründung → Fabian Leimegger, Lorik Bajgora

- **Bis 29.11.2024 (24:00 Uhr)**:
  - Fertigstellung der Materialliste → Ivan Federspieler, Felix Hinteregger

- **Bis 20.12.2024 (24:00 Uhr)**:
  - Erstellung des Gantt-Diagramms → Alex Guarino, Florian Firler

- **Nach der Woche vom 13.01.2025 – 17.01.2025**:
  - Überprüfung der Grundfunktionen der Webseite → Alex Guarino, Florian Firler

---

## 10. Tagebuch

### 10.1 19.11.2024
- **Schlussfolgerungen**: Das Team hat gut zusammengearbeitet.
- **Ziele**: Aufgaben klar verteilen.
- **MVP**: Lorik – hat sich mit der Dokumentation befasst.

### 10.2 21.11.2024
- **Schlussfolgerungen**: Wichtige organisatorische Themen besprochen.
- **Ziele**: Den aktuellen Stand besprechen.
- **MVP**: Fabian – hat das Logo erstellt.

### 10.3 26.11.2024
- **Schlussfolgerungen**: Projektfortschritt war produktiv.
- **Ziele**: Finalisierung der Risikoanalyse.
- **MVP**: Fabian – hat die Materialliste unter Zeitdruck abgeschlossen.

### 10.4 28.11.2024
- **Schlussfolgerungen**: Die Projektstruktur hat sich durch die Einrichtung eines zentralen GitHub-Repositories verbessert.
- **Ziele**: Frontend- und Backend-Teams organisieren erste Arbeitspakete.
- **MVP**: Lorik – hat eine essenzielle Grundlage für die Gruppe geschaffen.

---

