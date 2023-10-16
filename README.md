# Artikelverwaltung

## Übersicht
An dieser Stelle gibt es eine Auflistung aller bereits hinzugefügten Artikel.  
Diese werden als Tabelle dargestellt.

## Erstellen
An dieser Stelle wird ein Formular zum Erstellen eines neuen Artikels zur Verfügung gestellt.  
Die Artikelnummer ist Einzigartig und wird beim Absenden des Formulars geprüft.  
Falls die eingegebene Artikelnummer bereits vergeben ist, wird ein entsprechender Fehler angezeigt.  
Außerdem werden Tags etc. aus den Eingabefeldern entfernt, damit man dort kein JS, PHP, o.Ä. reinschmuggeln kann.

## Statistik
Hier wird eine Auflistung der Nummern-Bereiche mit der Anzahl der zugehörigen Artikel angezeigt.  
Über eine Schaltfläche kommt man direkt über die Suche zu den Artikeln dieses Nummernkreises.

## Suche
Hier werden die Artikel angezeigt entsprechend des Suchbegriffs.   
Der Suchbegriff wird im Artikelnamen sowie in der Artikelnummer gesucht.  
Zudem kann man von dieser Ansicht aus direkt auf die Bearbeitung und Löschung von Artikeln gelangen.

## Bearbeiten
Hier erhält man das gleiche Formular wie auf der "Erstellen"-Seite, nur dass die Daten des gewählten Artikels bereits befüllt sind.  
Sollte die gesuchte ID nicht existieren, kommt man zurück auf die Übersicht mit entsprechender Fehlermeldung.

## Löschen
Hier erhält man noch einmal die Daten zum gewählten Artikel zusammengefasst.  
Zudem wird explizit drauf hingewiesen, dass die Löschung eines Artikels **endgültig** ist.  
Sollte die gesuchte ID nicht existieren, gilt das Gleiche wie für die Bearbeitung.

## Konfiguration
Die Daten für die Datenbankverbindung können in der config.php im includes-Verzeichnis geändert werden.

## Datenbank
Die Datenbankverbindung wurde, wie gewünscht, mittels PDO realisiert.   
Hierfür existiert, in Verbindung mit der config.php, in der die Konfigurationen für die Datenbank liegen, die database.php.   
Diese liest über getenv die in der htaccess definierten Daten aus, alternativ können diese auch über die config.ini im Root definiert werden.
Die config.ini wird über die htaccess von Aufrufen im Browser geschützt.

## Artikel
Hier werden alle Methoden, die die Artikel betreffen, definiert.

## Seiten
Alle Seiten basieren auf der gleichen index.php. Es wird lediglich, je nach "Seitentyp" (eher Aktion), die genutzte PHP-Datei ausgetauscht.   
Der "Seitentyp" Übersicht nutzt beispielsweise die PHP-Datei "partials/uebersicht.php".   
Zudem wird anhand des Seitentyps auch der dargestellte Titel angepasst.

## CSS/SCSS
Die SCSS Dateien befinden sich unter resources/scss. Die main.scss ist der Einstiegspunkt und dort werden hauptsächlich die imports hinzugefügt.   
In den Dateien im Unterverzeichnis "imports" können Änderungen getätigt werden.  
Da Browser SCSS nicht interpretieren können, muss über den Befehlt "npm run scss" oder "npm run watch" das SCSS zu CSS Kompiliert werden.   
Die main.css im Verzeichnis resources/css wird bereits eingebunden, daher muss danach nichts weiter getan werden.   
Als Framework habe ich Bootstrap 5.3.2 eingebunden und die Variablen genutzt, um die Farben, etc. auf meine Zwecke anzupassen.

## JS
Ein Verzeichnis für JS und die bootstrap.bundle.min.js liegen im Ordner resources/js.   
Diese Dateien werden **nicht** genutzt, da für dieses Projekt zum jetzigen Zeitpunkt keine JavaScript-Funktionalität notwendig war.
