var letterContainer = document.getElementById("letter");
var contents = document.getElementById("contents");
var sendForm = document.getElementById("send");

letterContainer.style.backgroundImage = "url(envelope.png)";
letterContainer.style.backgroundSize = "100% 100%";
letterContainer.style.height = "200px";
letterContainer.style.width = "400px";
letterContainer.style.padding = "20px";
contents.style.visibility = "hidden";
sendForm.style.display = "none";

function showForm() {
    sendForm.style.display = "block";
}

function openLetter() {
    letterContainer.style.backgroundColor = "white";
    letterContainer.style.border = "rounded";
    letterContainer.style.borderRadius = "10px";
    contents.style.fontFamily = "Borel"
    letterContainer.style.backgroundImage = "url(card.png)"
    letterContainer.style.backgroundSize = "100% 100%"
    contents.style.visibility = "visible";
    letterContainer.style.height = "auto";
    var contentHeight = letterContainer.scrollHeight;
    letterContainer.style.height = contentHeight + "px";
}

window.addEventListener('load', adjustDivSize);
window.addEventListener('resize', adjustDivSize);

