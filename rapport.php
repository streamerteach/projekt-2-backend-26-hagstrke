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
                <h1>Reflektiv rapport</h1>
                <p>
                    Detta projekt har varit ganska tufft för mig, delvis för att jag jobba ensam men också för att man har hamnat lära sig mycket på egen hand.<br>
                    Det tog mig en tid att riktigt förstå hur PHP fungerar och vänja mig vid det.
                    Svåraste delen för mig var tid och datum delen. Jag tycker att det skulle ha varit lämpligare att räkna ut skillnaden mellan datummen i JS 
                    men man skulle göra det i PHP så nu blir det en fördröjning på countern. Jag spenderade nog för mycket tid på att lösa det och hamnade förr eller senare ge upp.
                    Allt annat gick ganska smidigt.<br>
                    Jag tycker inte så hemskt mycket om webbutveckling så det har varit ganska tråkigt men allt som allt har det gått bra.
                </p>
            </article>
        </section>
    </div>

</body>

</html>