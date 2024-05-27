function toggleCheckbox(id, eventId) {
    let checkbox = document.getElementById(id);
    checkbox.checked = !checkbox.checked;

    let event = document.getElementById(eventId);
    if (checkbox.checked) {
        event.classList.add("active");
    } else {
        event.classList.remove("active");
    }
}