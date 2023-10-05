<?php

class Session
{
    public function __construct()
    {
        session_start();
    }

    /**
     * Undocumented function
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function setUserSession($email, $password)
    {
        // Crea un'istanza di Connector e imposta la connessione al database
        $connector = new Connector();
        $connector->setUpConnection();

        $user = $connector->getUser($email, $password);

        if ($user) {
            // Accesso riuscito, memorizza le informazioni dell'utente nella sessione
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            return true;
        }

        return false;
    }

    public function getUserSession()
    {
        $user = false;

        if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

            $user = [];
            // Crea un'istanza di Connector e imposta la connessione al database
            $connector = new Connector();
            $connector->setUpConnection();

            $user['id'] = $_SESSION['user_id'];
            $user['email'] = $_SESSION['user_email'];

            $user['name'] = $connector->getUserName($user['id']);
            $user['events'] = $connector->getUserEventsByEmail($user['email']);
        }

        return $user;
    }

    public function setErrorMessage($message)
    {
        $_SESSION['error_message'] = $message;
    }

    public function getErrorMessage()
    {
        if ($this->hasError()) {
            $error_message = $this->getSession()['error_message'];
            // Rimuovi la variabile di sessione dopo averla utilizzata
            unset($_SESSION['error_message']);
        } else {
            $error_message = "";
        }

        return $error_message;
    }

    public function getSession()
    {
        return $_SESSION;
    }

    public function sessionHas($key)
    {
        return array_key_exists($key, $this->getSession());
    }

    public function hasError()
    {
        return $this->sessionHas("error_message");
    }

    public function setSuccessMessage($message)
    {
        $_SESSION['success_message'] = $message;
    }

    public function hasSuccess()
    {
        return $this->sessionHas("success_message");
    }

    public function getSuccessMessage()
    {
        if ($this->hasSuccess()) {
            $success_message = $this->getSession()['success_message'];
            // Rimuovi la variabile di sessione dopo averla utilizzata
            unset($_SESSION['success_message']);
        } else {
            $success_message = "";
        }

        return $success_message;
    }
}
