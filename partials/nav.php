<?php
require_once(__DIR__ . "/../lib/functions.php");

// Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}

$localWorks = true; // some people have issues with localhost for the cookie params
// if you're one of those people make this false

// Start the session only if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    // this is an extra condition added to "resolve" the localhost issue for the session cookie
    if (($localWorks && $domain == "localhost") || $domain != "localhost") {
        // Set the session cookie parameters
        $cookieParams = session_get_cookie_params();
        $cookieParams["lifetime"] = 60 * 60;
        $cookieParams["path"] = "$BASE_PATH";
        $cookieParams["domain"] = $domain;
        $cookieParams["secure"] = true;
        $cookieParams["httponly"] = true;
        $cookieParams["samesite"] = "lax";

        // Apply the modified cookie parameters
        session_set_cookie_params($cookieParams);
    }

    // Start the session
    session_start();
}

?>
<!-- include css and js files -->
<link rel="stylesheet" href="<?php echo get_url('styles.css'); ?>">
<script src="<?php echo get_url('helpers.js'); ?>"></script>

<nav>
    <ul>
        <?php if (is_logged_in()) : ?>
            <li><a href="<?php echo get_url('home.php'); ?>">Home</a></li>
            <li><a href="<?php echo get_url('profile.php'); ?>">Profile</a></li>
        <?php endif; ?>
        <?php if (!is_logged_in()) : ?>
            <li><a href="<?php echo get_url('login.php'); ?>">Login</a></li>
            <li><a href="<?php echo get_url('register.php'); ?>">Register</a></li>
        <?php endif; ?>
        <?php if (has_role("Admin")) : ?>
            <li><a href="<?php echo get_url('admin/create_role.php'); ?>">Create Role</a></li>
            <li><a href="<?php echo get_url('admin/list_roles.php'); ?>">List Roles</a></li>
            <li><a href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign Roles</a></li>
        <?php endif; ?>
        <?php if (is_logged_in()) : ?>
            <li><a href="<?php echo get_url('logout.php'); ?>">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>
