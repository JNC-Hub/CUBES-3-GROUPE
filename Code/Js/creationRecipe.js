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
    function matchCustom(params, data) {
        var idContinent = $('#select_contient').find('option:selected').val();
        if (idContinent === '' ||
            data.element.attributes['data-label'].value === '' ||
            idContinent === data.element.attributes['data-label'].value) {
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
    // $('#uploadbutton').click(function () {
    //     $('.upload-input').click();
    // });
});