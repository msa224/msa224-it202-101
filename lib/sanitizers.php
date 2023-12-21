<?php

// Start session if not already started
session_start();

// Function to check if a user is logged in
if (!function_exists('is_logged_in')) {
    function is_logged_in($redirect = false, $destination = "login.php")
    {
        $isLoggedIn = isset($_SESSION["user"]);
        if ($redirect && !$isLoggedIn) {
            flash("You must be logged in to view this page", "warning");
            die(header("Location: $destination"));
        }
        return $isLoggedIn;
    }
}

// Function to check if a user has a specific role
if (!function_exists('has_role')) {
    function has_role($role)
    {
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

// Function to get the username of the logged-in user
if (!function_exists('get_username')) {
    function get_username()
    {
        if (is_logged_in() && isset($_SESSION["user"]["username"])) {
            return $_SESSION["user"]["username"];
        }
        return "";
    }
}

// Function to get the email of the logged-in user
if (!function_exists('get_user_email')) {
    function get_user_email()
    {
        if (is_logged_in() && isset($_SESSION["user"]["email"])) {
            return $_SESSION["user"]["email"];
        }
        return "";
    }
}

// Function to get the user ID of the logged-in user
if (!function_exists('get_user_id')) {
    function get_user_id()
    {
        if (is_logged_in() && isset($_SESSION["user"]["id"])) {
            return $_SESSION["user"]["id"];
        }
        return false;
    }
}

// Validate email format
function is_valid_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Function to sanitize email
if (!function_exists('sanitize_email')) {
    function sanitize_email($email)
    {
        // Implement your email sanitization logic here
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }
}

?>
