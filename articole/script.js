var templateContainer = document.createElement("div");
templateContainer.classList.add("w3-card");
templateContainer.classList.add("w3-round");
templateContainer.classList.add("w3-white");
templateContainer.classList.add("w3-container");
templateContainer.classList.add("w3-margin-bottom");

var templateParagraph = document.createElement("p");
templateParagraph.classList.add("w3-center");

var templateImage = document.createElement("img");
templateImage.style.width = "75%";

var templateTitle = document.createElement("h3");
templateTitle.classList.add("w3-center");
templateImage.className = "w3-hover-opacity";
var icon = document.createElement("i");
icon.classList.add("fa");
icon.classList.add("fa-file-alt");
icon.classList.add("fa-fw");
icon.classList.add("w3-margin-right");
icon.classList.add("w3-text-theme");

var firstColumn = document.getElementById("firstColumn");
var secondColumn = document.getElementById("secondColumn");
var thirdColumn = document.getElementById("thirdColumn");

var nrArticol = 0;

incarcarePreparate();

function incarcarePreparate() {
    Object.keys(articole).forEach(function (key) {
        var container = templateContainer.cloneNode(true);
        var paragraph = templateParagraph.cloneNode(true);

        var image = templateImage.cloneNode(true);
        image.src = "articol/photos/" + articole[key]["Nume poza"];
        image.alt = "Poza" + key;
        
        var anchor = document.createElement("a");
        anchor.href = "https://hopspreviitor.ro/articole/articol?nume=" + key;
        anchor.appendChild(image);

        paragraph.appendChild(anchor);
        container.appendChild(paragraph);

        var title = templateTitle.cloneNode(true);

        title.appendChild(icon.cloneNode(true));

        var name = document.createTextNode(key);
        title.appendChild(name);

        container.appendChild(title);
        
        if (nrArticol % 3 === 0)
            firstColumn.appendChild(container);
        else if (nrArticol % 3 === 1)
            secondColumn.appendChild(container);
        else
            thirdColumn.appendChild(container);
            
        nrArticol ++;    
    });
}
