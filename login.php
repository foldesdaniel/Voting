<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Belépés</title>
  </head>
  <body>
    <nav>
      <ul class="menu">
        <li><a href="/register.php">Regisztráció</a></li>
        <li><a href="/login.php" class="active">Belépés</a></li>
        <li><a href="/index.php">Főoldal</a></li>
      </ul>
    </nav>

    <form action="/validate_login.php" method="POST" novalidate>
      <div class="container">
        <h1>Bejelentkezés</h1>
        <hr>

        <?php if(isset($_GET['success']) && $_GET['success'] == 1): ?>
            <p class="success">Sikeres regiszráció! Kérem jelentkezzen be!</p>
            <br>
        <?php endif; ?>

        <?php if(isset($_GET['success']) && $_GET['success'] == 0): ?>
            <p class="error">Hibás felhasználónév vagy jelszó!</p>
            <br>
        <?php endif; ?>

        <label for="name"><b>Felhasználónév</b></label>
        <input type="text" placeholder="Felhasználónév megadása" name="name" id="name" required>

        <label for="psw"><b>Jelszó</b></label>
        <input type="password" placeholder="Jelszó megadása" name="pw" id="pw" required>

        <hr>
        <button type="submit" class="loginbtn">Bejelentkezés</button>
      </div>
    </form>
  </body>
</html>
