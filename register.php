<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>Regisztráció</title>
  </head>
  <body>
    <nav>
      <ul class="menu">
        <li><a href="/register.php" class="active">Regisztráció</a></li>
        <li><a href="/login.php">Belépés</a></li>
        <li><a href="/index.php">Főoldal</a></li>
      </ul>
    </nav>
    <form action="/validate_register.php" method="POST" novalidate>
        <div class="container">
            <h1>Regisztráció</h1>
            <p>Kérem töltse ki az űrlapot.</p>
            <hr>

            <?php if(isset($_GET['email']) && $_GET['email'] == 2): ?>
                <p class="error">Az email cím már használatban van!</p>
                <br>
            <?php endif; ?>
            <?php if(isset($_GET['email']) && $_GET['email'] == 1): ?>
                <p class="error">Rossz email formátum!</p>
                <br>
            <?php endif; ?>
            <?php if(isset($_GET['username']) && $_GET['username'] == 1): ?>
                <p class="error">A felhasználónév már használatban van!</p>
                <br>
            <?php endif; ?>
            <?php if(isset($_GET['pw']) && $_GET['pw'] == 1): ?>
                <p class="error">A jelszó nem egyezik meg!</p>
                <br>
            <?php endif; ?>
            <label for="text"><b>Felhasználónév</b></label>
            <input type="text" placeholder="Felhasználónév megadása" name="name" id="name" required>

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Email megadása" name="email" id="email" required>

            <label for="psw"><b>Jelszó</b></label>
            <input type="password" placeholder="Jelszó megadása" name="pw" id="pw" required>

            <label for="psw-repeat"><b>Jelszó megimétlése</b></label>
            <input type="password" placeholder="Jelszó megismétlése" name="pw-repeat" id="pw-repeat" required>
            <hr>
            <button type="submit" class="registerbtn">Regisztráció</button>
        </div>
        <div class="container signin">
            <p>Van már fiókja? <a href="/login.php">Jelentkezzen be</a>.</p>
        </div>
    </form>
  </body>
</html>
