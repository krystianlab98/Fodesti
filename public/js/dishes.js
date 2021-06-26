
document.querySelectorAll(".addToOrder").forEach(e=> e.addEventListener("click", function (event ){
    event.preventDefault();
    const parent = event.target.parentNode;

    const id = parent.getAttribute("data-id");
    fetch("/addDishToOrder", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id
        })
    }).then(result => result.json())
        .then(result => {
            console.log(result);
           alert("Dodano danie do koszyka");
        })
}));
