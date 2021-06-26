const search = document.querySelector('input[placeholder="search"]');
const dishContainer = document.querySelector(".dishes-box");

search.addEventListener("keyup", function (event){

    if(event.key === "Enter" ) {

        event.preventDefault();
        const data = {search: this.value};
        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        }).then(function (response) {
            return response.json();
        }).then(function (dishes){
            //window.location.pathname = '/dishesView'
            dishContainer.innerHTML = "";
            loadDishes(dishes);
        });
    }
});


function loadDishes(dishes) {
    dishes.forEach(dish => {
        console.log(dish);
        createDish(dish);
    });
}

function createDish(dish) {
    const template = document.querySelector("#dishes-template");
    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${dish.image_name}`;
    const name = clone.querySelector("h3");
    name.innerHTML = dish.name;
    const description = clone.querySelector("h4");
    description.innerHTML = dish.description;
    const price = clone.querySelector("p");
    price.innerHTML = dish.price;

    dishContainer.appendChild(clone);
}
