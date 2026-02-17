<?php
if (!empty($_SESSION['username'])) {
    print("<h1>Welcome " . $_SESSION['username'] . "</h1>");
    if ($_COOKIE['additional_cookies'] == "yes") {
        if (!empty($_COOKIE['last_visit'])) {
            print("<p>Your last visit was " . $_COOKIE['last_visit'] . "</p>");
            setcookie("last_visit", date("d/m/Y"), 0, "/");
        } else {
            setcookie("last_visit", date("d/m/Y"), 0, "/");
        }
    }
?>
    <form action="./" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <?php
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        // Profilbild upload
        $target_dir    = "./pictures/";
        $target_file   = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk      = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ". ";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        // OBS Lazy code
        if (file_exists($target_file)) {
            echo "Sorry, file already exists. ";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large. ";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "Sorry, only JPG, JPEG and PNG files are allowed. ";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded. ";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Skriv ut vilka filer som har laddats upp
    $dir = "pictures/";

    $a = scandir($dir);
    ?>
    <div id="pictures">
        <h2>Uploaded pictures</h2>
        <?php
        for ($i = 2; $i < count($a); $i++) {
            if (!empty($a[$i])) {
                print('<a href="./index.php?pic=' . $a[$i] . '"><img src="./' . $dir . $a[$i] . '"></a>');
            }
        }
        ?>
    </div>
    <h2>Current profile picture</h2>
<?php
    if (!empty($_GET['pic'])) {
        $_SESSION['profile_picture'] = $dir . $_GET['pic'];
        header("Location: ./");
    }

    if (!empty($_SESSION['profile_picture'])) {
        print('<img src="./' . $_SESSION['profile_picture'] . '">');
    } else {
        print("You don't have a profile picture");
    }
} else {
    header("Location: ../signup");
}
