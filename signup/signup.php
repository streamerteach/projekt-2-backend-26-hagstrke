<?php
if (! empty($_REQUEST['form'])) {
    if ($_REQUEST['form'] == 'login') {
        print(
            "<h2>Log in</h2>
            <form action='./index.php?form=login' method='post'>
            Username: <br><input type='text' name='username'><br><br>
            Password: <br><input type='password' name='password'><br><br>
            <input type='submit' value='Log in'>
            </form>"
        );
        if (!empty($_POST)) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = test_input($_POST['username']);
                $password = test_input($_POST['password']);

                $sql = "SELECT * FROM profiles WHERE username = ?";
                $result = $conn->prepare($sql);
                $result->execute([$_POST['username']]);
                $row = $result->fetch();

                if (!empty($row)) {
                    $passhash = $row['passhash'];
                    if (password_verify($password, $passhash)) {
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
        print("<p>Don't have an account? <a href='./'>Sign up here!</a></p>");
    }
} else {
    print(
        "<h2>Sign up</h2>
        <form action='./' method='post'>
            Username: <br><input type='text' name='username'><br><br>
            Real name: <br><input type='text' name='realname'><br><br>
            Password: <br><input type='password' name='password'><br><br>
            E-mail: <br><input type='email' name='email'><br><br>
            City: <br><input type='text' name='city'><br><br>
            Bio: <br><textarea name='bio' rows='10' cols='30' placeholder='Describe yourself' maxlength='255'></textarea><br><br>
            Salary: <br><input type='number' name='salary' min='0'><br><br>
            Preference: <br><br>
            <input type='radio' name='preference' value='1'>Man<br>
            <input type='radio' name='preference' value='2'>Woman<br>
            <input type='radio' name='preference' value='3'>Both<br>
            <input type='radio' name='preference' value='4'>Other<br>
            <input type='radio' name='preference' value='5'>All<br><br>
            <input type='submit' value='Sign up'>
        </form>"
    );
    if (!empty($_POST)) {
        $missinginput = false;
        foreach ($_POST as $key => $value) {
            if (empty($value) || empty($_POST['preference'])) {
                $missinginput = true;
                break;
            }
        }
        
        if ($missinginput) {
            print("<p>Please fill out the entire form</p>");
        } else {
            $username = test_input($_POST['username']);
            $realname = test_input($_POST['realname']);
            $passhash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = test_input($_POST['email']);
            $city = test_input($_POST['city']);
            $bio = test_input($_POST['bio']);
            $salary = $_POST['salary'];
            $preference = $_POST['preference'];

            $sql = "SELECT * FROM profiles WHERE username = ?";
            $result = $conn->prepare($sql);
            $result->execute([$_POST['username']]);
            $row = $result->fetch();

            if (empty($row)) {
                if (!preg_match("/^[0-9a-zA-Z_]*$/", $username)) {
                    print("Invalid username, no special characters allowed");
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    print("Invalid email format");
                } else {
                    $sql = "INSERT INTO profiles (id, username, realname, city, bio, salary, preference, email, likes, role, passhash) 
                            VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, NULL, '1', ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$username, $realname, $city, $bio, $salary, $preference, $email, $passhash]);

                    print("<p>Thank you for signing up, redirecting soon</p>");
                    header("Refresh:3; url=./index.php?form=login");
                }
            } else {
                print("<p>This account already exists.</p>");
            }
        }
    }
    print("<p>Do you already have an account? <a href='./index.php?form=login'>Log in here!</a></p>");
}
