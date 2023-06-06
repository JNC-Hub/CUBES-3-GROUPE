<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/PageContinent.css">
  <link rel="stylesheet" type="text/css" href="../css/affichageEtoile.css">
  <link rel="stylesheet" type="text/css" href="../css/etoileNote.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <title>PageContinent</title>
  <header>
    <?php
    include_once "../View/Header.html"
    ?>
  </header>
</head>

<body>
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