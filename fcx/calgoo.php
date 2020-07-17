<?php

$client = new Google_Client();
$client->setApplicationName(Yii::app()->name);
//$client->setAuthConfigFile(getcwd().'/protected/vendors/google/client_secret.json');
$client->setAuthConfigFile(getcwd().'../googleCalendarApi/credentials.json');
 
$service = new Google_Service_Calendar($client);
 
// Crear un nuevo calendario
$calendar = new Google_Service_Calendar_Calendar();
$calendar->setSummary('TITULO CALENDARIO');
$calendar->setDescription('DESCRIPCION CALENDARIO');
$calendar->setTimeZone('America/Bogota');
$createdCalendar = $service->calendars->insert($calendar);
$calendarId = $createdCalendar->getId();
 
// Crear un nuevo evento
$event = new Google_Service_Calendar_Event();
$event->setSummary('TITULO EVENTO');
$event->setDescription('DESCRIPCION EVENTO');
 
// Fecha de inicio (del día actual a las 8am)
$date = new DateTime(date('Y-m-d'), new DateTimeZone('America/Bogota'));
$start = new Google_Service_Calendar_EventDateTime();
$start->setDateTime($date->format('Y-m-d').'T08:00:00');
$start->setTimeZone('America/Bogota');
$event->setStart($start);
 
// Fecha de cierre (del día actual a las 6pm)
$date = new DateTime(date('Y-m-d'), new DateTimeZone('America/Bogota'));
$end = new Google_Service_Calendar_EventDateTime();
$end->setDateTime($date->format('Y-m-d').'T18:00:00');
$end->setTimeZone('America/Bogota');
$event->setEnd($end);
 
$remindersArray = array();
 
// Crear recordatorios
$reminder = new Google_Service_Calendar_EventReminder();
$reminder->setMethod('email');
$reminder->setMinutes(25);
$remindersArray[] = $reminder;
 
$reminder = new Google_Service_Calendar_EventReminder();
$reminder->setMethod('popup');
$reminder->setMinutes(15);
$remindersArray[] = $reminder;
 
$reminders = new Google_Service_Calendar_EventReminders();
$reminders->setUseDefault(false);
$reminders->setOverrides($remindersArray);
$event->setReminders($reminders);
 
$attendees = array();
 
// Agregar los Participantes
$attendee = new Google_Service_Calendar_EventAttendee();
$attendee->setEmail('info@qbit.com.mx');
$attendees[] = $attendee;
 
$event->attendees = $attendees;
 
$createdEvent = $service->events->insert($calendarId, $event, array(
     'sendNotifications' => true
));
?>