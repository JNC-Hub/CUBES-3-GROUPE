<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/PageContinent.css">
  <title>PageContinent</title>
  <header>
    <?php
    include_once "../View/Header.html"
    ?>
  </header>
</head>

<body>
  <p> Ici vont apparaitre les images des recettes </p>

  <div>
    <?php
    include_once "../Controller/affichageImageRecetteContinent.php";
    ?>
  </div>

  <footer>

    <?php
    include_once "../View/footer.html"
    ?>

  </footer>
</body>

</html>