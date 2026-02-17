<?php
$php_version = phpversion();
$apache_version = apache_get_version();

// Welcomes the user back if they are logged in
if (!empty($_SESSION['username'])) {
    print("<h1>Welcome back " . $_SESSION['username'] . "</h1>");
} else {
    if (!empty($_COOKIE['first_visit'])) {
        print("<h1>Welcome back to Healthy dating</h1>");
    } else {
        print("<h1>Welcome to Healthy dating</h1>");
    }
}

print("<p>This server is running PHP $php_version and $apache_version</p>");

// Prompts the user to accept or decline additional cookies
if (empty($_COOKIE['additional_cookies'])) {
    print(
        "<form action='./' method='post'>
        <label>Do you wish to accept additional cookies?</label>
        <input type='submit' value='Accept' name='accept'>
        <input type='submit' value='Decline' name='decline'>
    </form>"
    );
    if (!empty($_REQUEST['accept'])) {
        setcookie('additional_cookies', "yes", 0, "/");
        setcookie("first_visit", date("d/m/Y"), 0, "/");
        header("Location: ./");
    }
    if (!empty($_REQUEST['decline'])) {
        setcookie('additional_cookies', "no", 0, "/");
        header("Location: ./");
    }
} else {
    if ($_COOKIE['additional_cookies'] == "yes") {
        print("You have accepted additional cookies");
        if (!empty($_COOKIE['first_visit'])) {
            print("<p>Your first visit was on " . $_COOKIE['first_visit'] . "</p>");
        }
    }
    if ($_COOKIE['additional_cookies'] == "no") {
        print('You have declined additional cookies');
    }
}
