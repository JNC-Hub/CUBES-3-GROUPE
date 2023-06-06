<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notation de la recette</title>
    <link rel="stylesheet" href="../css/etoileNote.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        console.log(jQuery.fn.jquery);
    </script>

</head>

<body>
    <h1>Notation de la recette</h1>
    <div>
        <!-- <h3>Note actuelle : <span id="current-rating"><?php echo $averageNote; ?></span></h3> -->

        <h3>Attribuer une note :</h3>
        <div class="rating">
            <span class="rating-star" data-rating="1">&#9733;</span>
            <span class="rating-star" data-rating="2">&#9733;</span>
            <span class="rating-star" data-rating="3">&#9733;</span>
            <span class="rating-star" data-rating="4">&#9733;</span>
            <span class="rating-star" data-rating="5">&#9733;</span>
        </div>
    </div>
</body>

</html>