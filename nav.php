<header>
    <div id="logo"><a href="../">Healthy dating</a></div>
    <nav>
        <ul>
            <a href="../home">
                <li>Home</li>
            </a>
            <a href="../rapport.php">
                <li>Rapport</li>
            </a>
            <a href="../guestbook">
                <li>Guestbook</li>
            </a>
            <a href="../countdown">
                <li>Countdown</li>
            </a>
            <?php
            if (!empty($_SESSION['username'])) {
                print('<a href="../profile"><li>' . $_SESSION['username']);
                if (!empty($_SESSION['profile_picture'])) {
                    print('<img src="../profile/' . $_SESSION['profile_picture'] . '">');
                }
            } else {
                print('<a href="../signup"><li>Sign up');
            }
            ?>
            </li>
            </a>
        </ul>
    </nav>
</header>