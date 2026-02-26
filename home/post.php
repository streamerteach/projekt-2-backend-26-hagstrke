<article>
    <h3><?php print($row['realname']); ?></h3>
    <?php
    if (!empty($_SESSION['username'])) {
        print("<p>" . $row['email'] . "</p>");
    }
    ?>
    <p><?php print($row['bio']); ?></p>
    <?php
    if (!empty($_SESSION['username'])) {
        print("<p>Salary: " . $row['salary'] . "€</p>");
    }
    ?>
</article>