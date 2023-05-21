$(document).ready(function () {
    // le matcher par défaut dans select 2( Si la recherche est vide, ou la requête est contenue dans le texte de l'élément il retourne data +insensibel à ala casee)
    let defaultMatcher = $.fn.select2.defaults.defaults.matcher;
    $("#select_contient").select2({
        placeholder: "Selectionnez le continent de votre recette",
        allowClear: true
    });
    $(".ingredients").select2({
        placeholder: "Ingrédient",
        minimumInputLength: 2,
        allowClear: true,

    });

    function matchCustom(params, data) {
        var idContinent = $('#select_contient').find('option:selected').val();
        if (data.element.attributes['data-label'] && (idContinent === '' ||
            data.element.attributes['data-label'].value === '' ||
            idContinent === data.element.attributes['data-label'].value)) {
            return defaultMatcher(params, data);
        } else {
            return null;
        }
    }

    $("#select_pays").select2({
        matcher: matchCustom
    });
    // afficher les pays qui correspondent au continent choisi 
    $('#select_contient').change(function () {
        var idContinent = $(this).find('option:selected').val();
        var select_pays = $('#select_pays');
        // si on supprime le continent et on a déja choisi le pays on désactive
        select_pays.val('').change();
        if (idContinent == '') {
            select_pays.attr('disabled', true);

        } else {
            select_pays.attr('disabled', false);
            select_pays.select2({
                placeholder: "Veuillez choisir le pays de votre recette",
                allowClear: true,
                minimumInputLength: 2
            });
        }
    });
    // on calcule les lettre du champ histoire 
    const text_max = 300;
    $('#countLength').html('0 / ' + text_max);

    $('#histoire').keyup(function () {
        let text_length = $('#histoire').val().length;
        $('#countLength').html(text_length + ' / ' + text_max);
    });
    // pour afficher le filename à coté du champ input file
    let fileInput = $('#file-input');
    const fileName = $("#file-name");

    fileInput.on("change", function () {
        fileName.text(this.files[0].name);
        let uploadedImage = $('#uploaded-image');
        uploadedImage.removeClass("upload-icon");
        uploadedImage.attr('src', URL.createObjectURL(this.files[0]));
        uploadedImage.show();
    });

    // limiter le file à 1mega
    fileInput.on("change", function () {
        if (this.files[0].size > 1048576) {
            alert("La photo est trop grande!");
            this.value = "";
            fileName.textContent = "";
            return false
        }
    });
    // démontionner la photo selon sa taille

    fileInput.change(function () {
        const file = $(this)[0].files[0];
        const uploadIcon = document.getElementById("image-preview");

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {

                const img = new Image();
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    const MAX_WIDTH = 250;
                    const MAX_HEIGHT = 80;
                    let width = img.width;
                    let height = img.height;

                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext("2d");
                    ctx.drawImage(img, 0, 0, width, height);
                    uploadIcon.src = canvas.toDataURL("image/jpeg");
                    uploadIcon.classList.remove("upload-icon");
                    $('.dropzone').css({ width: width + 'px', height: height + 'px' });
                }
                img.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }

    });
    // ajouter la classe focused pour la translation des champ pour (element parent)
    const addFocusedClass = (element) => {
        $(element).on('focus', function () {
            $(this).parent().addClass('focused');
        }).on('blur', function () {
            if (!$(this).val()) {
                $(this).parent().removeClass('focused');
            }
        });
    }
    // ajouter le focus pour le sibiling (pour que lorsque on clique sur span la translation sera faite)
    const addFocsedClassSibling = (element) => {
        $('.input-wrapper span').on('click', function () {
            $(this).siblings(element).trigger('focus');
        });
    }
    addFocusedClass('.input-wrapper input');
    addFocusedClass('.input-wrapper select');
    addFocsedClassSibling('input');
    addFocsedClassSibling('select');

    const transformerSelectEnInput = () => {
        // Récupérer le champ select existant
        let select = $("#existIngredient");
        select.select2("destroy");

        // Créer un nouvel élément input
        let input = $("<input>").attr({
            type: "text",
            name: "ingredients",
            placeholder: "Nouvel ingrédient",
            class: 'form-control ingredients',
            id: 'existIngredient'

        });

        // Remplacer le champ select par le champ input
        select.replaceWith(input);
        ingredients = $('.ingredients');
        ingredients.on('keyup', toggleButtonIngredient).trigger('keyup');

    }
    // si le champ ingredient est un select et on a appuyé sur le bouton on le modifie in input et vise vers ça 
    let isSelect = true;
    $("#ajoutNewIngredient").click(function () {
        if (isSelect) {
            transformerSelectEnInput();
            isSelect = false;
        } else {

            // Récupérer le champ select existant
            let input = $("#existIngredient");

            // Créer un nouvel élément input
            var selectField = $("<select>").attr({
                name: "ingredients",
                class: "form-control ingredients",
                id: "existIngredient"

            });
            $.ajax({
                type: 'GET',
                url: '../Controller/apigetListIngeredients.php',
                dataType: 'json',
                success: function (data) {
                    data.forEach(function (ingredient) {
                        // Ajouter une option vide
                        let emptyOption = $("<option>").attr("value", "").text("");
                        selectField.append(emptyOption);
                        let option = $("<option>").attr("value", ingredient.idIngredient).text(ingredient.libIngredient);
                        selectField.append(option);

                    }
                    )
                },
                async: false
            });

            // Remplacer le champ input par le champ select
            input.replaceWith(selectField);
            selectField.select2({
                placeholder: "Ingrédient",
                minimumInputLength: 2,
                allowClear: true,
            });
            // Réinitialiser le plugin select2 si nécessaire
            isSelect = true;
            ingredients = $('.ingredients');
            ingredients.on('change', toggleButtonIngredient).trigger('change');

        }

    });

    let quantite = $('#quantite');
    let unite = $('#unite');
    let ingredients = $('.ingredients');
    let buttonAddIngredient = $('#buttonAdIngredient');
    // trigger('keyup')  mettre à jour l'état initial du bouton  après le chargement de la page (cela simule l'événement "keyup",sans avoir besoin d'une action utilisateur réelle)

    quantite.on('keyup', toggleButtonIngredient).trigger('keyup');
    unite.on('change', toggleButtonIngredient).trigger('change');
    // ingredients.on('change keyup', toggleButtonIngredient).trigger('change keyup');

    ingredients.on('change', toggleButtonIngredient).trigger('change');
    ingredients.on('keyup', toggleButtonIngredient).trigger('keyup');

    function toggleButtonIngredient() {
        if (quantite.val().length === 0 || unite.val().length === 0 || ingredients.val().length === 0 || ingredients.val() === 0) {
            buttonAddIngredient.prop('disabled', true);
        } else {
            buttonAddIngredient.prop('disabled', false);

        }
    }
    buttonAddIngredient.click(function () {
        let rowCount = 0; // copteur pour les ligne

        let valQuantite = quantite.val();
        let selectedUnite = $('#unite option:selected').text();
        let selectedIngredient = $('.ingredients').is('input') ? $('.ingredients').val() : $('.ingredients option:selected').text();

        // creation une nouvelle ligne dans la table
        let newRow = '<tr  id="rowIngredient' + rowCount + '"><td>' + valQuantite + '</td><td>' + selectedUnite + '</td><td>' + selectedIngredient + '</td><td><button type="button" class="btn btn-danger btn_remove_ingredient" id="' + rowCount + '">X</button></td></tr>';

        // ajouter la ligne dans la table
        $('#dynamic_field_ingredient').append(newRow);

        quantite.val('');
        unite.val('');
        ingredients.val('').trigger('change');

        rowCount++;
        ingredients.on('keyup', toggleButtonIngredient).trigger('keyup');

    });
    $(document).on('click', '.btn_remove_ingredient', function () {
        let button_id_ingredient = $(this).attr("id");
        $('#rowIngredient' + button_id_ingredient + '').remove();
    });
    let buttonAddEtape = $('#buttonAdEtape');

    let etape = $('#etape');
    etape.on('keyup', toggleButtonEtape).trigger('keyup');
    function toggleButtonEtape() {

        if (etape.val().trim() === '') {
            buttonAddEtape.prop('disabled', true);
        } else {
            buttonAddEtape.prop('disabled', false);
        }
    }
    buttonAddEtape.click(function () {
        let i = 0; // copteur pour les ligne
        // creation une nouvelle ligne dans la table
        let addRow = '<tr id="rowEtape' + i + '"><td style="overflow:hidden; word-wrap:normal;">' + etape.val() + '</td><td><button type="button" class="btn btn-danger btn_remove_etape"  id="' + i + '">X</button></td></tr>';

        // ajouter la ligne dans la table
        $('#dynamic_field_etape').append(addRow);
        etape.val('');
        i++;
        etape.on('keyup', toggleButtonEtape).trigger('keyup');
    });
    $(document).on('click', '.btn_remove_etape', function () {
        var button_id_etape = $(this).attr("id");
        $('#rowEtape' + button_id_etape + '').remove();
    });

    $('#submit').click(function (event) {
        let tableValueIngredient = [];
        let etapeTab = [];
        let titleRecetteValue = $('#titleRecette').val();
        let continet = $('#select_contient').val();
        let nombrePersonne = $('#nombrePersonne').val();
        let pays = $('#select_pays').val();
        let histoire = $('#histoire').val();
        // $('#file-input') renvoie un objet jQuery, [0] pour obtenir le premier élément input puis acceder à la propriété files  du premier fichier sélectionné
        let image = $('#file-input')[0].files[0];
        var formData = new FormData();
        formData.append("img_book", image);
        if ($('#dynamic_field_ingredient tr').length >= 1) {
            $('#dynamic_field_ingredient tr').each(function () {
                let quantiteValue = $(this).find('td:eq(0)').text();
                let uniteValue = $(this).find('td:eq(1)').text();
                let ingredientValue = $(this).find('td:eq(2)').text();

                // Ajoutez les valeurs récupérées au tableau

                tableValueIngredient.push({
                    quantite: quantiteValue,
                    unite: uniteValue,
                    ingredient: ingredientValue
                });
            });
        } else {
            alert("Veuillez renseigner les ingrédients de votre recette ")
            return false;
        }
        if ($('#dynamic_field_etape tr').length >= 1) {
            $('#dynamic_field_etape tr').each(function () {
                let etapeValue = $(this).find('td:eq(0)').text();

                etapeTab.push({
                    etape: etapeValue
                });
            });
        } else {
            alert("Veuillez renseigner les étapes de votre recette ")
            return false;

        }
        formData.append("title", titleRecetteValue);
        formData.append("contient", continet);
        formData.append("pays", pays);
        formData.append("histoire", histoire);
        formData.append("nombrePersonne", nombrePersonne);
        formData.append("ingredients", JSON.stringify(tableValueIngredient));
        formData.append("etapes", JSON.stringify(etapeTab));

        $.ajax({
            url: '../Controller/creationRecipies.php',
            method: 'POST',
            // dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
        }).done(function (msg) {
            alert("L'ajout de la recette est effectué avec succés ");
            // Réorienter vers une autre page
            window.location.href = "../Controller/compteUtilisateur.php";
        }).fail(function (xhr, status, error) {
            // Gérer l'erreur
        });

    });
});