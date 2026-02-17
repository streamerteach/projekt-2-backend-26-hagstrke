<?php
if (! empty($_REQUEST['form'])) {
    if ($_REQUEST['form'] == 'login') {
        print(
            "<h2>Log in</h2>
            <form action='./index.php?form=login' method='post'>
            Username: <br><input type='text' name='username'><br>
            Password: <br><input type='password' name='password'><br>
            <input type='submit' value='Log in'>
            </form>
            <p>Don't have an account? <a href='./'>Sign up here!</a></p>"
        );
        if (!empty($_POST)) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = test_input($_POST['username']);
                $password = test_input($_POST['password']);

                $accounts = fopen("accounts.json", "a+") or die("Error: Unable to open file!");
                $accountsArray = json_decode(fread($accounts, filesize("accounts.json") + 1), true);
                fclose($accounts);

                if ($accountsArray == null) {
                    $accountsArray = array();
                }

                if (array_key_exists($username, $accountsArray)) {
                    if ($accountsArray[$username] == $password) {
                        $_SESSION['username'] = $username;
                        header("Location: ../profile");
                    } else {
                        print("<p>Incorrect password, please try again.</p>");
                    }
                } else {
                    print("<p>This account doesn't exist</p>");
                }
            } else {
                print("<p>You need to enter a username and a password.</p>");
            }
        }
    }
} else {
    print(
        "<h2>Sign up</h2>
        <form action='./' method='post'>
            Username: <br><input type='text' name='username'><br>
            E-mail: <br><input type='email' name='email'><br>
            <input type='submit' value='Sign up'>
        </form>
        <p>Do you already have an account? <a href='./index.php?form=login'>Log in here!</a></p>"
    );
    if (!empty($_POST)) {
        if (!empty($_POST['username'] && !empty($_POST['email']))) {
            $username = test_input($_POST['username']);
            $email = test_input($_POST['email']);
            $accounts = fopen("accounts.json", "a+") or die("Error: Unable to open file!");
            $accountsArray = json_decode(fread($accounts, filesize("accounts.json") + 1), true);

            if ($accountsArray == null) {
                $accountsArray = array();
            }

            if (!array_key_exists($username, $accountsArray)) {
                if (!preg_match("/^[0-9a-zA-Z_]*$/", $username)) {
                    print("Invalid username, no special characters allowed");
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    print("Invalid email format");
                } else {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomPass = '';

                    for ($i = 0; $i < 8; $i++) {
                        $randomPass .= $characters[random_int(0, strlen($characters) - 1)];
                    }

                    $accountsArray[$username] = $randomPass;

                    fclose($accounts);
                    $accounts = fopen("accounts.json", "w") or die("Error: Unable to open file!");
                    fwrite($accounts, json_encode($accountsArray));

                    $msg = "Hello " . $username . ". Here is your password: " . $randomPass;
                    mail($email, "Sign up", $msg);

                    print("<p>Thank you for signing up, you will receive an email with your new password shortly</p>");
                    header("Refresh:3; url=./index.php?form=login");
                }
            } else {
                print("<p>This account already exists.</p>");
            }

            fclose($accounts);
        }
        if (empty($_POST['username'])) {
            print("<p>Username is required</p>");
        }
        if (empty($_POST['email'])) {
            print("<p>Email is required</p>");
        }
    }
}
