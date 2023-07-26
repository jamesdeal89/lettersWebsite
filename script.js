const letterContainer = document.getElementById("letter");
const contents = document.getElementById("contents");

letterContainer.style.backgroundImage = "url(envelope.png)";
letterContainer.style.backgroundSize = "100% 100%";
letterContainer.style.height = "200px";
letterContainer.style.width = "400px";
letterContainer.style.padding = "20px";
contents.style.visibility = "hidden";

function openLetter() {
    letterContainer.style.backgroundColor = "white";
    letterContainer.style.border = "rounded";
    letterContainer.style.borderRadius = "10px";
    contents.style.fontFamily = "Borel"
    letterContainer.style.backgroundImage = "url(card.png)"
    letterContainer.style.backgroundSize = "100% 100%"
    contents.style.visibility = "visible";
}


