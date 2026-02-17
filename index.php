<?php include "./methods.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy dating</title>
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js"></script>
</head>

<body>
    <div id="container">
        <header>
            <div id="logo"><a href="./">Healthy dating</a></div>
            <nav>
                <ul>
                    <a href="./rapport.php">
                        <li>Rapport</li>
                    </a>
                    <a href="./guestbook">
                        <li>Guestbook</li>
                    </a>
                    <a href="./countdown">
                        <li>Countdown</li>
                    </a>
                    <?php
                    if (!empty($_SESSION['username'])) {
                        print('<a href="./profile"><li>' . $_SESSION['username']);
                        if (!empty($_SESSION['profile_picture'])) {
                            print('<img src="./profile/' . $_SESSION['profile_picture'] . '">');
                        }
                    } else {
                        print('<a href="./signup"><li>Sign up');
                    }
                    ?>
                    </li>
                    </a>
                </ul>
            </nav>
        </header>
        <section>
            <article>
                <?php include "./landingpage.php"; ?>
            </article>
        </section>
    </div>

</body>

</html>