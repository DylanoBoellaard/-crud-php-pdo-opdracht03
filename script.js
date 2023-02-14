// Achtbaan cijfer range + number stuff
cijferN.addEventListener("change", () => {
    let cijferNValue = document.getElementById("cijferN").value;
    document.getElementById("cijferR").value = cijferNValue;
});

cijferR.addEventListener("change", () => {
    let cijferRValue = document.getElementById("cijferR").value;
    document.getElementById("cijferN").value = cijferRValue;
});