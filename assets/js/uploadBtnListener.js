function addUploadListeners() {
    var uploadButtons = document.getElementsByClassName("gl_upload-button");
    for (var i = 0; i < uploadButtons.length; i++) {
        uploadButtons[i].addEventListener("change", function() {
            var fileName = this.files[0].name;
            this.parentElement.querySelector(".gl_upload-button-text").innerText = fileName;
        });
    }
}
// Initial call to add listeners to existing upload buttons
addUploadListeners();
// MutationObserver to watch for new upload buttons
var observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.addedNodes.length) {
            addUploadListeners();
        }
    });
});
// Config to watch for child nodes addition
var config = { childList: true, subtree: true };
// Start observing the document body
setTimeout(function() {
    observer.observe(document.body, config);
}, 1000);