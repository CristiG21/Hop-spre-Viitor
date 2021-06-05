const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const articol = urlParams.get('nume');

const data = articole[articol];

var page = document.getElementById("container");

incarcarePreparat();

function createBackButton(){
    var iconBack = document.createElement("i");
    iconBack.className = "fa fa-arrow-left";

    var button = document.createElement("button");
    button.className = "w3-button w3-circle w3-green w3-card-4 w3-ripple w3-left";
    button.onclick = function() { location.href = 'https://hopspreviitor.ro/articole/' };
    button.appendChild(iconBack);
    
    var heading  = document.createElement("h3")
    heading.appendChild(button);
    
    page.appendChild(heading);
}

function createTitle() {
    var bold = document.createElement("b");
    var name = document.createTextNode(articol);
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
    image.src = "photos/" + data["Nume poza"];
    image.style.width = "40%";
    image.alt = "Poza " + articol;

    paragraph.appendChild(image);
    page.appendChild(paragraph);
}

function createText() {
    var heading = document.createElement("h3");
    heading.classList.add("w3-center");

    var text = document.createTextNode(data["Text"]);
    
    heading.appendChild(text);
    page.appendChild(heading);
}

function incarcarePreparat() {
    createBackButton();
    page.appendChild(document.createElement("br")); //Blank line
    page.appendChild(document.createElement("br")); //Blank line
    createTitle();
    page.appendChild(document.createElement("br")); //Blank line
    createImage();
    page.appendChild(document.createElement("br")); //Blank line
    createText();
}
