<?php

function reset_session()
{
    // Unset all session variables
    $_SESSION = array();

    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Destroy the session data
    session_destroy();

    // Start a new session and regenerate the session ID if a session is active
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
        session_regenerate_id(true);
    }
}

?>
