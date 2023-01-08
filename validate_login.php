<?php session_start();
    $data = $_POST;
    $file = file_get_contents("users.json");
    $farray = json_decode($file, true);

    # Checks if username and password are correct
    foreach($farray as $d) {
        if($d['username'] == $data['name'] && $d['password'] == $data['pw']) {
            $_SESSION['username'] = $data['name'];
            $_SESSION['pw'] = $data['pw'];
            $_SESSION['role'] = $d['role'];
            header("Location: /index.php");
            exit();
        }
    }

    header("Location: /login.php?success=0");
    exit();
?>