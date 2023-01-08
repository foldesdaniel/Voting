<?php session_start();
    $file = file_get_contents("polls.json");
    $farray = json_decode($file, true);
    $data = $_POST;
    $data2 = $_GET;
    
    if(!$data) {
        header("Location: /vote.php?error=1&id=" . $_SESSION['current_vote_id']);
        exit();
    }

    //TODO: polls.json fajl szerkesztest => adat frissites / hozzaadas

    $new_ar = [];

    foreach($farray as $d) {
        if($d['id'] == $data2['id']) {
            $votedbool = false;
            foreach($d['voted'] as $name) {
                if($name == $_SESSION['username']) {
                    //mar szavazott a jelenlegi felhasznalo
                    $votedbool = true;
                    array_push($new_ar, $d);
                }
            }
            if(!$votedbool) {
                array_push($d['voted'], $_SESSION['username']);
                $answers = [];
                if(isset($data['answers2'])) {
                    foreach($d['answers'] as $a) {
                        if($a['option'] == $data['answers2']) {
                            $a['value']++;
                        }
                        array_push($answers, $a);
                    }
                }
                else {
                    foreach($d['answers'] as $a) {
                        foreach($data['answers'] as $a2) {
                            if($a['option'] == $a2) {
                                $a['value']++;
                            }
                        }
                        array_push($answers, $a);
                    }
                }
                $new = [
                    'id' => $d['id'],
                    'question' => $d['question'],
                    'options' => $d['options'],
                    'isMultiple' => $d['isMultiple'],
                    'createdAt' => $d['createdAt'],
                    'deadline' => $d['deadline'],
                    'answers' => $answers,
                    'voted' => $d['voted']
                ];
                array_push($new_ar, $new);
            }
        }
        else array_push($new_ar, $d);
    }

    $new_json = json_encode($new_ar, JSON_UNESCAPED_UNICODE);
    file_put_contents('polls.json', $new_json);

    header("Location: /vote.php?success=1&id=" . $_SESSION['current_vote_id']);
    exit();
?>