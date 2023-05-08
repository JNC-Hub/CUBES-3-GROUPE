$(document).ready(function () {
    var defaultMatcher = $.fn.select2.defaults.defaults.matcher;
    $("#select_contient").select2({
        placeholder: "Selectionnez le continent de votre recette",
        allowClear: true
    });
    $("#select_pays").select2({
        placeholder: "Veuillez choisir le pays de votre recette",
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
    $('#select_contient').change(function () {
        var idContinent = $(this).find('option:selected').val();
        var select_pays = $('#select_pays');
        select_pays.val('').change();
        if (idContinent == '') {
            select_pays.attr('disabled', true);
        } else {
            select_pays.attr('disabled', false);
        }
    });
    var text_max = 300;
    $('#countLength').html('0 / ' + text_max);

    $('#histoire').keyup(function () {
        var text_length = $('#histoire').val().length;
        $('#countLength').html(text_length + ' / ' + text_max);
    });
    // pour afficher le filename à coté du champ input file
    let fileInput = document.getElementById("file-input");
    const fileName = document.getElementById("file-name");

    fileInput.addEventListener("change", () => {
        fileName.textContent = fileInput.files[0].name;
        let uploadedImage = $('#uploaded-image');
        uploadIcon.removeClass("upload-icon");
        uploadedImage.attr('src', URL.createObjectURL(event.target.files[0]));
        uploadedImage.show();
    });

    // limiter le file à 1mega
    fileInput.onchange = function () {
        if (this.files[0].size > 1048576) {
            alert("La photo est trop grande!");
            this.value = "";
            fileName.textContent = "";
            return false
        };
    };

    $('#file-input').change(function () {
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
        var select = $("#existIngredient");
        select.select2("destroy");

        // Créer un nouvel élément input
        var input = $("<input>").attr({
            type: "text",
            name: "ingredients",
            placeholder: "Nouvel ingrédient",
            class: 'form-control ingredients'

        });

        // Remplacer le champ select par le champ input
        select.replaceWith(input);
        ingredients = $('.ingredients');
        ingredients.on('keyup', toggleButtonIngredient).trigger('keyup');

    }
    $("#ajoutNewIngredient").click(function () {
        transformerSelectEnInput();
    });

    let quantite = $('#quantite');
    let unite = $('#unite');
    let ingredients = $('.ingredients');
    let buttonAddIngredient = $('#buttonAdIngredient');

    quantite.on('keyup', toggleButtonIngredient).trigger('keyup');
    unite.on('change', toggleButtonIngredient).trigger('change');
    // ingredients.on('change keyup', toggleButtonIngredient).trigger('change keyup');

    ingredients.on('change', toggleButtonIngredient).trigger('change');
    // ingredients.on('keyup', toggleButtonIngredient).trigger('keyup');

    function toggleButtonIngredient() {
        if (quantite.val().length === 0 || unite.val().length === 0 || ingredients.val().length === 0) {
            buttonAddIngredient.prop('disabled', true);
        } else {
            buttonAddIngredient.prop('disabled', false);

        }
    }
    buttonAddIngredient.click(function () {
        let rowCount = 0; // copteur pour les ligne

        let valQuantite = quantite.val();
        let selectedUnite = $('#unite option:selected').text();
        let selectedIngredient = $('.ingredients option:selected').text();

        // creation une nouvelle ligne dans la table
        let newRow = '<tr  cope="' + rowCount + '"><td>' + valQuantite + '</td><td>' + selectedUnite + '</td><td>' + selectedIngredient + '</td><td><button type="button" class="btn btn-danger btn_remove_ingredient" style ="margin-right: 10px;" id="' + rowCount + '">X</button></td></tr>';

        // ajouter la ligne dans la table
        $('#dynamic_field_ingredient').append(newRow);
        quantite.val('');
        unite.val('');
        ingredients.val('').trigger('change');

        rowCount++;

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
        let addRow = '<tr id="rowEtape' + i + '"><td style="overflow:hidden; word-wrap:normal;">' + etape.val() + '</td><td><button type="button" class="btn btn-danger btn_remove_etape" style="margin-right: 10px;" id="' + i + '">X</button></td></tr>';

        // ajouter la ligne dans la table
        $('#dynamic_field_etape').append(addRow);
        etape.val('');
        i++;

    });
    $(document).on('click', '.btn_remove_etape', function () {
        var button_id_etape = $(this).attr("id");
        $('#rowEtape' + button_id_etape + '').remove();
    });

});