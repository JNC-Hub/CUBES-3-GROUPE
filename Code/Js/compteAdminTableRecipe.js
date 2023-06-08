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