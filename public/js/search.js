const search = document.querySelector('input[placeholder="search"]');
const dishContainer = document.querySelector(".dishes-box");

search.addEventListener("keyup", function (event){

    if(event.key === "Enter" ) {

        // fetch('/dishesView')
        //     .then((response)=> {
        //     return response.text();
        // }).then((html) => {
        //     document.body.innerHTML = html
        // });
        // fetch("/dishesView").then(window.location.reload(true));
        // window.location.pathname = '/dishesView'
        event.preventDefault();
        const data = {search: this.value};



        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (dishes){
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
