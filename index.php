<?php session_start();
  $file = file_get_contents("polls.json");
  $farray = json_decode($file, true);
  $index = 1;

  $a1 = array();
  $a2 = array();

  function sortFunction( $a, $b ) {
    return strtotime($b["createdAt"]) - strtotime($a["createdAt"]);
  }
  usort($farray, "sortFunction");

  foreach($farray as $d) {
    if(date('Y-m-d') < date($d['deadline'])) array_push($a1, $d);
    else array_push($a2, $d);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Főoldal</title>
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
        <li><a href="/index.php" class="active">Főoldal</a></li>
      </ul>
    </nav>
    <p>Ezen az oldalon lehet szavazni különböző témákból. Regisztrációhoz kötött!</p>

    <h1>Jelenlegi kérdőívek</h1>
    <?php foreach($a1 as $d): ?>
      <div class="poll-box">
        <p>Sorszám: <?= $index ?></p>
        <p>Létrehozás ideje: <?= $d['createdAt'] ?></p>
        <p>Leadási határidő: <?= $d['deadline'] ?></p>
        <?php if(isset($_SESSION['username'])): ?>
          <a href="vote.php?id=<?= $d['id'] ?>" class="vote-btn">Szavazás</a>
        <?php endif; ?>
        <?php if(!isset($_SESSION['username'])): ?>
          <a href="login.php" class="vote-btn">Szavazás</a>
        <?php endif; ?>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
          <a href="delete_vote.php?id=<?= $d['id'] ?>" class="vote-btn">Törlés</a>
        <?php endif; ?>
      </div>
      <?php $index++; ?>
    <?php endforeach; ?>

    <h1>Lejárt kérdőívek</h1>
    <?php foreach($a2 as $d): ?>
      <div class="poll-box">
        <p>Sorszám: <?= $index ?></p>
        <p>Létrehozás ideje: <?= $d['createdAt'] ?></p>
        <p>Leadási határidő: <?= $d['deadline'] ?></p>
        <p>Eredmények:</p>
        <ul>
          <?php foreach($d['answers'] as $dd): ?>
            <li><?= $dd['option'] . ' : ' . $dd['value']; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php $index++; ?>
    <?php endforeach; ?>
  </body>
</html>
