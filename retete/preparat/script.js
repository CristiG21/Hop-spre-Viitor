const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const preparat = urlParams.get('nume');

const data = retete[preparat];

var page = document.getElementById("container");

incarcarePreparat();

function createBackButton(){
    var iconBack = document.createElement("i");
    iconBack.className = "fa fa-arrow-left";

    var button = document.createElement("button");
    button.className = "w3-button w3-circle w3-green w3-card-4 w3-ripple w3-left";
    button.onclick = function() { location.href = 'https://hopspreviitor.ro/retete/' };
    button.appendChild(iconBack);
    
    var heading  = document.createElement("h3")
    heading.appendChild(button);
    
    page.appendChild(heading);
}

function createTitle() {
    var bold = document.createElement("b");
    var name = document.createTextNode(preparat);
    bold.appendChild(name);

    var title = document.createElement("h1");
    title.classList.add("w3-center");
    title.appendChild(bold);
    page.appendChild(title);
}

function createImage() {
    var paragraph = document.createElement("p");
    paragraph.classList.add("w3-center");

    var image = document.createElement("img");
    image.src = "https://hopspreviitor.ro/assets/images/" + data["Nume poza"];
    image.style.width = "40%";
    image.alt = "Poza" + preparat;

    paragraph.appendChild(image);
    page.appendChild(paragraph);
}

function createSecondTitles(iconName, titleText) {
    var title = document.createElement("h2");
    title.classList.add("w3-center");

    var icon = document.createElement("i");
    icon.classList.add("fa");
    icon.classList.add(iconName);
    icon.classList.add("fa-fw");
    icon.classList.add("w3-margin-right");
    icon.classList.add("w3-text-theme");

    title.appendChild(icon);

    var text = document.createTextNode(titleText);
    title.appendChild(text);
    page.appendChild(title);
}

function createIngredientsList() {
    var ingredients = document.createElement("h3");
    ingredients.classList.add("w3-center");

    var list = document.createElement("ul");
    list.style.listStylePosition = "inside";

    data["Ingrediente"].forEach(function (ingredient) {
        var listItem = document.createElement("li");
        listItem.appendChild(document.createTextNode(ingredient));
        list.appendChild(listItem);
    });

    ingredients.appendChild(list);
    page.appendChild(ingredients);
}

function createStepsList() {
    var steps = document.createElement("h3");
    steps.classList.add("w3-left");

    var list = document.createElement("ol");
    list.classList.add("w3-left");

    data["Mod preparare"].forEach(function (step) {
        var listItem = document.createElement("li");
        listItem.appendChild(document.createTextNode(step));
        list.appendChild(listItem);
    });

    steps.appendChild(list);
    page.appendChild(steps);
}

function incarcarePreparat() {
    createBackButton();
    page.appendChild(document.createElement("br")); //Blank line
    page.appendChild(document.createElement("br")); //Blank line
    createTitle();
    page.appendChild(document.createElement("br")); //Blank line
    createImage();
    page.appendChild(document.createElement("br")); //Blank line
    createSecondTitles("fa-clock", "Timp preparare: " + data["Timp preparare"]); //Time
    page.appendChild(document.createElement("br")); //Blank line
    createSecondTitles("fa-clipboard-list", "Ingrediente:"); //Ingredients
    createIngredientsList();
    page.appendChild(document.createElement("br")); //Blank line
    createSecondTitles("fa-list-ol", "Mod de preparare:"); //Steps
    createStepsList();
}
