function auswahl(person) {
    document.getElementById("selected-person").textContent = "Ausgewählte Person: " + person;
    document.getElementById("hiddenCoworker").value = person;
}