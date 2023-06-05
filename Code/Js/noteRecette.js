
$(document).ready(function () {
    $('.rating-star').mouseenter(function () {
        $(this).addClass('filled');
        $(this).prevAll('.rating-star').addBack().addClass('filled');
    });

    $('.rating-star').mouseleave(function () {
        $('.rating-star').removeClass('filled');
    });

    $('.rating-star').click(function () {
        // Récupérer la note attribuée
        var rating = $(this).data('rating');

        // Récupérer l'ID de la recette et l'ID de l'utilisateur
        var recipeId = <? php echo $recipeId; ?>;
        var userId = <? php echo $userId; ?>;

        // Envoyer la requête AJAX pour enregistrer la note
        $.ajax({
            url: '../Controller/notationRecette.php', // Spécifiez l'URL du script PHP ici
            type: 'POST',
            data: {
                action: 'enregistrer_note',
                idRecette: recipeId,
                idUtilisateur: userId,
                note: rating
            },
            success: function (response) {
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