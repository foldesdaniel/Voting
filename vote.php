<?php session_start();
  $file = file_get_contents("polls.json");
  $farray = json_decode($file, true);
  $data = array();

  $index = 1;

  if(isset($_GET['id'])) {
    foreach($farray as $d) {
      if($d['id'] === $_GET['id'] && date('Y-m-d') < date($d['deadline'])) {
        $data = $d;
        $_SESSION['current_vote_id'] = $_GET['id'];
        break;
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Szavazóoldal</title>
  </head>
  <body>
    <nav>
        <ul class="menu">
          <?php if(!isset($_SESSION['username'])): ?>
            <li><a href="/register.php">Regisztráció</a></li>
            <li><a href="/login.php">Belépés</a></li>
          <?php endif; ?>
          <?php if(isset($_SESSION['username'])): ?>
            <li><a href="/logout.php">Kijelentkezés</a></li>
          <?php endif; ?>
          <?php if(isset($_SESSION['username']) && $_SESSION['role'] == "admin"): ?>
          <li><a href="/make_vote.php">Szavazó űrlap készítés</a></li>
        <?php endif; ?>
          <li><a href="/index.php">Főoldal</a></li>
        </ul>
    </nav>

    <?php if(isset($_GET['id']) && $data): ?>
      <form action="/validate_vote.php?id=<?= $_GET['id'] ?>" method="POST" novalidate>
        <div class="container">
          <h1>Űrlap</h1>
          <hr>

          <?php if(isset($_GET['error'])): ?>
            <p class="error">Kérem válasszon ki valamit!</p>
            <br>
          <?php endif; ?>
          <?php if(isset($_GET['success'])): ?>
            <p class="success">Sikeres szavazás!</p>
            <br>
          <?php endif; ?>

          <p><?= $data['question']; ?></p>

          <?php if($data['isMultiple']): ?>
            <?php foreach($data['options'] as $d) : ?>
              <input type="checkbox" id="answer<?= $index; ?>" name="answers[]" value=<?= $d; ?>>
              <label for="answer<?= $index; ?>"><?= $d; ?></label><br>
              <?php $index++; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <?php if(!$data['isMultiple']): ?>
            <?php foreach($data['options'] as $d) : ?>
              <input type="radio" id="answer<?= $index; ?>" name="answers2" value=<?= $d; ?>>
              <label for="answer<?= $index; ?>"><?= $d; ?></label><br>
              <?php $index++; ?>
            <?php endforeach; ?>
          <?php endif; ?>

          <p>Leadási határidő: <?= $data['deadline']; ?></p>
          <p>Létrehozási idő: <?= $data['createdAt']; ?></p>

          <hr>
          <button type="submit" class="votebtn">Szavazás</button>
        </div>
      </form>
    <?php endif; ?>
  </body>
</html>
