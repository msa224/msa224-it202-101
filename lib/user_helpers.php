<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . "/db.php");

if (!function_exists('has_role')) {
    function has_role($role) {
        if (is_logged_in() && isset($_SESSION["user"]["roles"])) {
            foreach ($_SESSION["user"]["roles"] as $r) {
                if ($r["name"] == $role) {
                    return true;
                }
            }
        }
        return false;
    }
}

if (!function_exists('get_username')) {
    function get_username() {
        if (is_logged_in() && isset($_SESSION["user"]["username"])) {
            return $_SESSION["user"]["username"];
        }
        return "";
    }

    // Rest of the functions in user_helpers.php remain unchanged
    // ...
}
?>
