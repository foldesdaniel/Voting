<?php session_start();
    $data = $_POST;
    $file = file_get_contents("users.json");
    $farray = json_decode($file, true);
    $email = 0;
    $username = 0;
    $pw = 0;
    
    # Checks if name does not exists
    foreach($farray as $d) {
        if($d['username'] == $data['name']) {
            $username = 1;
            break;
        }
    }

    # Checks if email is valid format
    if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $email = 1;
    }

    # Checks if email does not exists
    foreach($farray as $d) {
        if($d['email'] == $data['email']) {
            $email = 2;
            break;
        }
    }

    # Checks if passwords are the same
    if($data['pw'] != $data['pw-repeat']) {
        $pw = 1;
    }

    $errors = $pw + $username + $email;

    if(!$errors) {
        $new = [
            'username' => $data['name'],
            'email' => $data['email'],
            'password' => $data['pw'],
            'role' => "user"
        ];
        array_push($farray, $new);
        $new_json = json_encode($farray);
        file_put_contents('users.json', $new_json);
        header("Location: /login.php?success=1");
        exit();
    }
    header("Location: /register.php?username=" . $username . "&email=" . $email . "&pw=" . $pw);
    exit();
?>