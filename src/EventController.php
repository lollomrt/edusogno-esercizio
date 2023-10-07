<?php

class EventController
{
    private $conn; // Variabile di classe per memorizzare l'istanza di Connector
    public $events = [];

    public function __construct($connector)
    {
        $this->conn = $connector; // Memorizza l'istanza di Connector
    }
    // Restituzione di tutti gli eventi
    public function list($email = false)
    {
        try {

            $events = [];

            $dbEvents = $this->conn->getEvents($email);
            foreach ($dbEvents as $dbEvent) {

                $attendees = explode(',', $dbEvent['attendees']);
                $events[] = new Event($dbEvent['id'], $attendees, $dbEvent['nome_evento'], $dbEvent['data_evento']);
            }


            return $events;
        } catch (Exception $e) {
            echo "Errore nel recupero degli eventi: " . $e->getMessage();
            return [];
        }
    }

    // Aggiunta evento
    public function addEvent($attendees, $eventName, $eventDate, $user)
    {
        try {
            // Verifica se l'utente è amministratore
            if ($user['admin'] == 1) {
                // Converte l'array $attendees in una stringa separata da virgole
                $attendeesString = implode(',', $attendees);

                // Chiama il metodo di Connector per inserire l'evento nel database
                $success = $this->conn->insertEvent($attendeesString, $eventName, $eventDate);

                if ($success) {
                    // Se l'aggiunta è riuscita, ricarica la pagina
                    return true;
                } else {
                    throw new Exception("Errore nell'inserimento dell'evento nel database.");
                }
            } else {
                // L'utente non ha i permessi per aggiungere l'evento
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    // Modifica evento
    public function editEvent($id, $attendees, $eventName, $eventDate, $user)
    {
        try {
            // Verifica se l'utente è amministratore
            if ($user['admin'] == 1) {
                // Converte l'array $attendees in una stringa separata da virgole
                $attendeesString = implode(',', $attendees);

                // Chiama il metodo di Connector per inserire l'evento nel database
                $success = $this->conn->updateEvent($id, $attendeesString, $eventName, $eventDate);

                return $success;
            } else {
                // L'utente non ha i permessi per modificare l'evento
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    // Eliminazione evento
    function deleteEvent($eventId, $user)
    {
        // Controllo se l'utente ha i permessi per eliminare l'evento
        if ($user['admin'] == 1) {
            $connector = new Connector();
            $connector->setUpConnection();

            // Eseguo l'eliminazione dell'evento dal database
            $result = $connector->deleteEventById($eventId);

            // Restituisco true se l'eliminazione è riuscita, altrimenti false
            return $result;
        } else {
            // L'utente non ha i permessi per eliminare l'evento
            return false;
        }
    }
}
