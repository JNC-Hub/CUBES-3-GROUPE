let validateButtons = document.querySelectorAll("td[validateRecipe]");
for (let i = 0; i < validateButtons.length; i++) {
    let button = validateButtons[i];
    button.addEventListener("click", () => {
        let idRecette = button.getAttribute("validateRecipe");
        validateRecipe(idRecette)
            .then(() => {
                window.location.reload();
            })
            .catch(error => {
                console.error(error);
            });
    });
}

const validateRecipe = (idRecette) => {
    const mode = 'validate';
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
let rejectButtons = document.querySelectorAll("td[rejectRecipe]");
for (let i = 0; i < rejectButtons.length; i++) {
    let buttonReject = rejectButtons[i];
    buttonReject.addEventListener("click", () => {
        let idRecette = buttonReject.getAttribute("rejectRecipe");
        rejectRecipe(idRecette)
            .then(() => {
                window.location.reload();
            })
            .catch(error => {
                console.error(error);
            });
    });
}
const rejectRecipe = (idRecette) => {
    const mode = 'reject';
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