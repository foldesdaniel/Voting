<?php session_start();
    $file = file_get_contents("polls.json");
    $farray = json_decode($file, true);

    $data = $_GET;

    $index = 0;

    $new_ar = [];

    foreach($farray as $d) {
        if($d['id'] == $data['id']) {
            break;
        }
        array_push($new_ar, $d);
    }
    $new_json = json_encode($new_ar, JSON_UNESCAPED_UNICODE);
    file_put_contents('polls.json', $new_json);
    header("Location: /index.php");
    exit();
?>