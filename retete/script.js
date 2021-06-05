var templateContainer = document.createElement("div");
templateContainer.className = "w3-card w3-round w3-white w3-container w3-margin-bottom";

var templateParagraph = document.createElement("p");
templateParagraph.className = "w3-center";

var templateImage = document.createElement("img");
templateImage.style.width = "75%";
templateImage.style.cursor = "pointer";
templateImage.className = "w3-hover-opacity";

var templateTitle = document.createElement("h3");
templateTitle.className = "w3-center";

var iconUtensils = document.createElement("i");
iconUtensils.className = "fa fa-utensils fa-fw w3-margin-right w3-text-theme";

var iconPlus = document.createElement("i");
iconPlus.className = "fa fa-plus";

var templateButton = document.createElement("button");
templateButton.className = "w3-button w3-circle w3-green w3-card-4 w3-ripple w3-right w3-margin-bottom";
templateButton.appendChild(iconPlus);

var firstColumn = document.getElementById("firstColumn");
var secondColumn = document.getElementById("secondColumn");
var thirdColumn = document.getElementById("thirdColumn");

var nrPreparate = 0;

incarcarePreparate();

function deschidereModal(id){
    document.getElementById('id_recipe').value = id;
    document.getElementById('modal').style.display = 'block';
}

function incarcarePreparate() {
    Object.keys(retete).forEach(function (key) {
        var container = templateContainer.cloneNode(true);
        var paragraph = templateParagraph.cloneNode(true);
        
        var image = templateImage.cloneNode(true);
        image.src = "https://hopspreviitor.ro/assets/images/" + retete[key]["Nume poza"];
        image.alt = "Poza " + key;
        
        var anchor = document.createElement("a");
        anchor.href = "https://hopspreviitor.ro/retete/preparat?nume=" + key;
        anchor.appendChild(image);

        paragraph.appendChild(anchor);
        container.appendChild(paragraph);

        var title = templateTitle.cloneNode(true);

        title.appendChild(iconUtensils.cloneNode(true));

        var name = document.createTextNode(key);
        title.appendChild(name);

        container.appendChild(title);
        
        var heading  = document.createElement("h3")
        var button = templateButton.cloneNode(true);
        button.onclick = function() { deschidereModal(retete[key]["Id"]) };
        heading.appendChild(button);
        container.appendChild(heading);
        

        if (nrPreparate % 3 === 0)
            firstColumn.appendChild(container);
        else if (nrPreparate % 3 == 1)
            secondColumn.appendChild(container);
        else
            thirdColumn.appendChild(container);
            
        nrPreparate ++;    
    });
}
