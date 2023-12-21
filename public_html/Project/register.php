<?php

require_once(__DIR__ . "/../../partials/nav.php");
require_once(__DIR__ . "/../../lib/sanitizers.php");

reset_session();

?>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" required />
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" required maxlength="30" />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <div>
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        // TODO: Implement JavaScript validation
        // Ensure it returns false for an error and true for success
        return true;
    }
</script>
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = se($_POST, "email", "", false);
    $password = se($_POST, "password", "", false);
    $confirm = se($_POST, "confirm", "", false);
    $username = se($_POST, "username", "", false);

    $email = sanitize_email($email);

    $hasError = false;

    if (empty($email)) {
        flash("Email must not be empty", "danger");
        $hasError = true;
    }

    // Validate email using the newly defined function
    if (!is_valid_email($email)) {
        flash("Invalid email address", "danger");
        $hasError = true;
    }

    // ... (remaining validation code)

    if (!$hasError) {
        // ... (remaining registration logic)
    }
}

require(__DIR__ . "/../../partials/flash.php");
?>
