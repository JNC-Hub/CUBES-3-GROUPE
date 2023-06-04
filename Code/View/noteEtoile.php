<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notation de la recette</title>
    <link rel="stylesheet" href="../css/etoileNote.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.rating-star').click(function() {
                // Récupérer la note attribuée
                var rating = $(this).data('rating');

                // Récupérer l'ID de la recette et l'ID de l'utilisateur (vous devrez les passer depuis votre modèle ou votre contrôleur)
                var recipeId = <?php echo $recipeId; ?>;
                var userId = <?php echo $userId; ?>;

                // Envoyer la requête AJAX pour enregistrer la note
                $.ajax({
                    url: 'notationRecette.php',
                    type: 'POST',
                    data: {
                        action: 'enregistrer_note',
                        idRecette: recipeId,
                        idUtilisateur: userId,
                        note: rating
                    },
                    success: function(response) {
                        // Traiter la réponse de la requête AJAX
                        var data = JSON.parse(response);
                        if (data.success) {
                            // Afficher un message de succès
                            alert(data.message);
                            // Mettre à jour l'affichage de la note (facultatif)
                            $('#current-rating').text(rating);
                        } else {
                            // Afficher un message d'erreur (facultatif)
                            alert('Erreur lors de l\'enregistrement de la note.');
                        }
                    }
                });
            });
        });
    </script>
</head>

<body>
    <h1>Notation de la recette</h1>
    <div>
        <h3>Note actuelle : <span id="current-rating"><?php echo $currentRating; ?></span></h3>
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