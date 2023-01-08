<?php session_start();
    $file = file_get_contents("polls.json");
    $farray = json_decode($file, true);
    $index = 1;
    $question = 0;
    $options = 0;
    $multiple = 0;
    $deadline = 0;

    $data = $_POST;

    foreach($farray as $d) {
        $index = preg_split('#(?<=\d)(?=[a-z])#i', strrev($d['id']))[0];
    }
    $index++;

    if(!isset($data['question'])) $question = 1;
    else if ($data['question'] == "") $question = 1;
    if(!isset($data['options'])) $option = 1;
    else if ($data['options'] == "") $options = 1;
    else if (!str_contains($data['options'], "\n")) $options = 1;
    else if (explode("\n", $data['options'])[1] == "")$options = 1;
    if(!isset($data['isMultiple'])) $multiple = 1;
    else if($data['isMultiple'] == "") $multiple = 1;
    if(!isset($data['deadline'])) $deadline = 1;
    else if (strtotime($data['deadline']) == false) $deadline = 1;

    $error = $question + $options + $multiple + $deadline;

    if($error) {
        header("Location: /make_vote.php?question=" . $question . "&options=" . $options . "&multiple=" . $multiple . "&deadline=" . $deadline);
        exit();
    }

    $options_splited = explode("\n", $data['options']);
    $options_final = [];
    $answers_final = [];

    foreach($options_splited as $d) {
        $d = trim($d);
        array_push($options_final, $d);
        $a = new stdClass();
        $a->option = $d;
        $a->value = 0;
        array_push($answers_final, $a);
    }

    $new = [
        'id' => "poll" . $index,
        'question' => $data['question'],
        'options' => $options_final,
        'isMultiple' => $data['isMultiple'] == "true" ? true : false,
        'createdAt' => date('Y-m-d'),
        'deadline' => $data['deadline'],
        'answers' => $answers_final,
        'voted' => []
    ];
    array_push($farray, $new);
    $new_json = json_encode($farray, JSON_UNESCAPED_UNICODE);
    file_put_contents('polls.json', $new_json);
    header("Location: /make_vote.php?success=1");
    exit();
?>