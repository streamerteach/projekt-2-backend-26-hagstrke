<?php
$visitors = fopen("../visitors.txt", "r") or die("Error: Unable to open file!");
$visitorCount = -1;

while (!feof($visitors)) {
    fgets($visitors);
    $visitorCount++;
}
print("<p>This site has had " . $visitorCount . " visitor(s).</p>");

fclose($visitors);

if (!empty($_SESSION['username'])) {
    print(
        '<form action="./" method="post">
            <textarea name="message" id="" cols="30" rows="10"></textarea>
            <br><br>
            <input type="submit" value="Submit">
        </form>'
    );

    $guestbook = fopen("guestbook.txt", "a+") or die("Error: Unable to open file!");

    if (!empty($_REQUEST['message'])) {
        if (!preg_match('/' . $_SESSION['username'] . '/', fread($guestbook, filesize("guestbook.txt") + 1))) {
            $message = test_input($_REQUEST['message']);
            fwrite($guestbook, $_SESSION['username'] . " on " . date("d/m/Y H:i") . " wrote: " . $message . "\n");
        } else {
            print("<p>You have already submitted a message.</p>");
        }
    }

    fclose($guestbook);
}

// Print out all messages in the guestbook
$guestbookArray = file("guestbook.txt");

if (!empty($guestbookArray)) {
    for ($i = count($guestbookArray) - 1; $i >= 0; $i--) {
        print("<p>" . $guestbookArray[$i] . "</p>");
    }
} else {
    print("<p>Guestbook is empty.</p>");
}
