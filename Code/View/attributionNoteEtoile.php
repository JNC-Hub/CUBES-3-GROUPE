<!DOCTYPE html>
<html>

<head>
    <title>Noter la recette</title>
    <style>
        .rating-star {
            display: inline-block;
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
        }

        .rating-star.filled,
        .rating-star:hover {
            color: #ffba00;
        }
    </style>
</head>

<body>
    <h1>Noter la recette</h1>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <?php
        $vote = isset($_POST['note']) ? $_POST['note'] : '';
        echo '<p>Vous avez voté : ' . $vote . '</p>';
        ?>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="hidden" name="idRecette" value="<?php echo isset($idRecette) ? $idRecette : ''; ?>">
        <input type="hidden" name="idUtilisateur" value="<?php echo isset($idUtilisateur) ? $idUtilisateur : ''; ?>">

        <p>Notez la recette :</p>

        <div class="rating-stars">
            <span class="rating-star" data-rating="1">&#9733;</span>
            <span class="rating-star" data-rating="2">&#9733;</span>
            <span class="rating-star" data-rating="3">&#9733;</span>
            <span class="rating-star" data-rating="4">&#9733;</span>
            <span class="rating-star" data-rating="5">&#9733;</span>
        </div>

        <br><br>

        <input type="submit" value="Valider">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var ratingValue = 0;

            $('.rating-star').mouseenter(function() {
                var rating = $(this).data('rating');
                $(this).prevAll('.rating-star').addBack().addClass('filled');
                $(this).nextAll('.rating-star').removeClass('filled');
            });

            $('.rating-star').mouseleave(function() {
                $('.rating-star').removeClass('filled');
                $('.rating-star').slice(0, ratingValue).addClass('filled');
            });

            $('.rating-star').click(function() {
                ratingValue = $(this).data('rating');
                $('.rating-star').removeClass('filled');
                $('.rating-star').slice(0, ratingValue).addClass('filled');
                $('input[name="note"]').val(ratingValue);
            });
        });
    </script>
</body>

</html>