<?php
if (!empty($_COOKIE['additional_cookies']) and $_COOKIE['additional_cookies'] == "yes") {
    if (empty($_COOKIE['date'])) {
        print(
            "<form action='./' method='post'>
                <p>
                    <label>Enter a date in the future</label>
                    <input type='datetime-local' min='" . date("Y-m-d 00:00", time() + 86400) . "' name='date'>
                </p>
                <p>
                    <label>Enter your timezone</label>
                    <input type='text' name='timezone' placeholder='e.g. \"Europe/Helsinki\"'>
                </p>
                <input type='submit' value='Submit'>
            </form>"
        );
        if (!empty($_POST)) {
            if (!empty($_POST['date'])) {
                if (!empty($_POST['timezone'])) {
                    if (date_default_timezone_set($_POST['timezone']) == true) {
                        setcookie("date", $_POST['date'], strtotime($_POST['date']) + 86400, "/");
                        setcookie("timezone", $_POST['timezone'], 0, "/");
                        header("Location: ./");
                    } else {
                        print("<p>Please submit a valid timezone e.g. \"<i>Continent/City</i>\"</p>");
                    }
                } else {
                    print("<p>Please submit a timezone</p>");
                }
            } else {
                print("<p>Please submit a date</p>");
            }
        }
    } else {
        date_default_timezone_set($_COOKIE['timezone']);
        $dateTime = strtotime($_COOKIE['date']);
        $diff = $dateTime - time();
        print("<p>The date is on " . date('l \t\h\e jS \o\f F Y \w\e\e\k W \a\t H:i', $dateTime) . "</p>");
        print("<script>countdown(" . $diff . ")</script>");
    }
} else {
    print("<p>Please accept additional cookies.</p>");
}
?>
<div id="timer"></div>