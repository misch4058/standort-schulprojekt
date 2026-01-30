<?php
header('Content-Type: text/plain; charset=utf-8');

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'] ?? 'Anonym';
$lat  = $data['lat'] ?? '';
$lon  = $data['lon'] ?? '';
$acc  = $data['acc'] ?? '';
$time = $data['time'] ?? '';

$ip = $_SERVER['REMOTE_ADDR'] ?? 'Unbekannt';

$to = 'mschoepfer@lotsebasel.onmicrosoft.com';
$subject = 'Schulprojekt Standortanalyse (mit IP)';

$message = "Schulprojekt Standortanalyse\n\n";
$message .= "Name: $name\n\n";
$message .= "Ort:\n";
$message .= "Breitengrad: $lat\n";
$message .= "Längengrad: $lon\n";
$message .= "Genauigkeit: ±$acc Meter\n";
$message .= "Zeit: $time\n\n";
$message .= "IP-Adresse: $ip\n\n";
$message .= "Google Maps:\nhttps://www.google.com/maps?q=$lat,$lon\n\n";
$message .= "Analyse:\nTeilnehmer hat freiwillig Standortdaten bereitgestellt.";

$headers = "From: schulprojekt@server.local";

if(mail($to, $subject, $message, $headers)){
    echo "Analyse erfolgreich gesendet ✔️";
}else{
    echo "Fehler beim Senden ❌";
}
?>
