# Contao RSS Import Bundle

RSS Nachrichten-Import für Contao ab Version 4.4 (getestet für die Manager Edition).  
Diese Erweiterung wird über den Composer unter **fipps/contao-rssimport-bundle** bereitgestellt.  
Dies ist der Nachfolger zum rssImport für Contao 3 (fipps/contao-rss-import).

## Hinweise
1. Beiträge können nur gelöscht werden, wenn diese auch im Feed nicht mehr existieren, ansonsten werden sie wieder neu bezogen. Besser ist des, den Beitrag zu deaktivieren.
1. Ein Import findet über den Command-Scheduler jede Stunde statt. 
1. Imports können auch über Cron aktiviert werden. Dazu muss folgende Datei per PHP ausgeführt werden: `system/modules/rssImport/classes/cron.php`
1. Die Einbettung von Bildern funktioniert nur dann, wenn diese als Anlage (enclosure) mitgeliefert werden.

## Unterstützung
Wir freuen und über jede Form der Unterstützung. 
