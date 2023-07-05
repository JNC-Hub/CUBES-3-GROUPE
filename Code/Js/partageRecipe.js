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
    navigator.clipboard.writeText(pageURL).then(function () {
        alert('Le lien a été copié dans le presse-papiers.');
    }).catch(function (err) {
        console.error('Une erreur s\'est produite lors de la copie du lien : ', err);
    });
});
let linkPdf = document.querySelector('#linkpdf');
let pdfUrl = linkPdf.getAttribute('href');

let buttonSubmitMail = document.getElementById("submitAddress");
buttonSubmitMail.addEventListener("click", () => {
    let adressMail = document.getElementById('address').value;

    // Fonction pour télécharger le fichier PDF à partir de l'URL
    // await remplace .then pour gérer les promesses
    // réupère les données de la réponse sous forme de ArrayBuffer des données binaires brutes dans la mémoire.
    const downloadPDF = async (pdfUrl) => {
        try {
            const response = await fetch(pdfUrl);
            const pdfData = await response.arrayBuffer();
            return pdfData;
        } catch (error) {
            console.error('Erreur lors du téléchargement du fichier PDF :', error);
            throw error;
        }
    };

    // Fonction pour envoyer les données PDF et l'adresse e-mail à l'API
    const sendPDFAndEmailToAPI = async (pdfData, adressMail) => {
        try {
            const formData = new FormData();
            formData.append('pdf', new Blob([pdfData]), 'pdf.pdf');
            formData.append('address', adressMail);

            const response = await fetch('../Controller/sendMail.php', {
                method: 'POST',
                body: formData,
            });

            if (response.ok) {
                console.log('La requête a été effectuée avec succès.');
                // Traitez la réussite de la requête ici
            } else {
                console.error('La requête a échoué avec le statut :', response.status);
                // Traitez l'échec de la requête ici
            }
        } catch (error) {
            console.error('Erreur lors de l\'envoi des données à l\'API :', error);
            throw error;
        }
    };

    // Télécharger le fichier PDF, puis envoyer les données PDF et l'adresse e-mail à l'API
    downloadPDF(pdfUrl)
        .then((pdfData) => {
            sendPDFAndEmailToAPI(pdfData, adressMail);
        })
        .then(() => {
            window.alert("l'envoi de l'email est terminé avec succés");
            window.href = window.href;
        }, () => {
            window.alert("l'envoi de l'email a échoué");
        })
});

// systeme de ite pour les etoiles 
let ratingValue = 0;
let ratingStars = document.querySelectorAll('.rating-star');

ratingStars.forEach(function (star) {
    let afterSave = false;
    star.addEventListener('mouseenter', function () {
        let rating = parseInt(this.dataset.rating);
        Array.from(this.parentElement.children).forEach(function (sibling) {
            if (parseInt(sibling.dataset.rating) <= rating) {
                sibling.classList.add('filled');
            } else {
                sibling.classList.remove('filled');
            }
        });
    });

    star.addEventListener('mouseleave', function () {
        if (afterSave) {
            afterSave = false;
        } else {
            ratingStars.forEach(function (star) {
                star.classList.remove('filled');
            });
            Array.from(ratingStars).slice(0, ratingValue).forEach(function (star) {
                star.classList.add('filled');
            });
        }
    });

    star.addEventListener('click', function () {
        ratingValue = parseInt(this.dataset.rating);
        Array.from(ratingStars).slice(0, ratingValue).forEach(function (star) {
            star.classList.add('filled');
        });

        var idRecette = document.querySelector('input[name="idRecette"]').value;
        var idUtilisateur = document.querySelector('input[name="idUtilisateur"]').value;

        fetch('../Controller/attributionNoteEtoile.php', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify({
                'ratingValue': ratingValue,
                'idRecette': idRecette,
                'idUtilisateur': idUtilisateur
            })
        })
        afterSave = true;
    });
});
