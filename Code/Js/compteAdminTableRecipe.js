let deleteButton = document.querySelectorAll("td[deleteRecipe]");
for (let i = 0; i < deleteButton.length; i++) {
    let button = deleteButton[i];
    button.addEventListener("click", () => {
        let idRecette = button.getAttribute("deleteRecipe");
        deleteRecipe(idRecette)
            .then(() => {
                window.location.reload();
            })
            .catch(error => {
                console.error(error);
            });
    });
}

const deleteRecipe = (idRecette) => {
    const mode = 'delete';
    return fetch('../Controller/apiGestionRecipe.php', {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        method: 'POST',
        body: JSON.stringify({
            'idRecette': idRecette,
            'mode': mode
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });
};
let pageURL = window.location.href;
let addressForm = document.querySelector('.address-form');
// Lien de partage Facebook
let shareFacebook = document.getElementById('shareFacebook');
shareFacebook.addEventListener('click', function () {
    addressForm.style.display = 'none';
    let facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageURL);
    window.open(facebookURL, '_blank');
});

// Lien de partage par e-mail
let shareEmail = document.getElementById('shareEmail');
shareEmail.addEventListener('click', function () {
    addressForm.style.display = 'block';
});

// Copier le lien de la page
let shareLink = document.getElementById('shareLink');
shareLink.addEventListener('click', function () {
    addressForm.style.display = 'none';
    let tempInput = document.createElement('input');
    tempInput.value = pageURL;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    alert('Le lien a été copié dans le presse-papiers.');
});