<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Űrlap készítés</title>
</head>
<body>
    <nav>
      <ul class="menu">
        <li><a href="/logout.php">Kijelentkezés</a></li>
        <?php if(isset($_SESSION['username']) && $_SESSION['role'] == "admin"): ?>
          <li><a href="/make_vote.php" class="active">Szavazó űrlap készítés</a></li>
        <?php endif; ?>
        <li><a href="/index.php">Főoldal</a></li>
      </ul>
    </nav>

    <form action="/validate_make_vote.php" method="POST" novalidate>
        <div class="container">
            <h1>Űrlap</h1>
            <hr>

            <?php if(isset($_GET['question']) && $_GET['question'] == 1): ?>
                <p class="error">Adjon meg Szöveget!</p>
                <br>
            <?php endif; ?>
            <?php if(isset($_GET['options']) && $_GET['options'] == 1): ?>
                <p class="error">Adjon meg legalább 2 Lehetőségeket!</p>
                <br>
            <?php endif; ?>
            <?php if(isset($_GET['multiple']) && $_GET['multiple'] == 1): ?>
                <p class="error">Adjon meg, hogy Többször Választható-e!</p>
                <br>
            <?php endif; ?>
            <?php if(isset($_GET['deadline']) && $_GET['deadline'] == 1): ?>
                <p class="error">Adjon meg Határidőt!</p>
                <br>
            <?php endif; ?>
            <?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
                <p class="success">Sikeresen elkészítette a kérdőívet!</p>
                <br>
            <?php endif; ?>

            <label for="question"><b>Szöveg</b></label>
            <input type="text" placeholder="Szöveg" name="question" id="question" required>

            <label for="options"><b>Lehetőségek</b></label><br>
            <textarea name="options" id="options" cols="30" rows="10"></textarea><br><br>

            <b>Több lehetőség is kiválasztható-e</b><br>
            <input type="radio" id="multiple" name="isMultiple" value="true">
            <label for="multiple">Igen</label><br>
            <input type="radio" id="notmultiple" name="isMultiple" value="false">
            <label for="notmultiple">Nem</label><br><br>

            <label for="deadline"><b>Határidő</b></label><br>
            <input type="date" name="deadline" id="deadline" required><br><br>

            <hr>
            <button type="submit" class="votebtn">Szavazás elkészítése</button>
        </div>
    </form>
</body>
</html>