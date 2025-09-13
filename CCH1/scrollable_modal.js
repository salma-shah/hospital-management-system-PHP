
$(document).ready(function () {
    //  modal resizable
    $('.modal-content').resizable({
        minHeight: 300,  // setting min height value
        minWidth: 300,  // max height value
        alsoResize: ".modal-content" // resize modal body along with modal
    });

    // make modal draggable by header
    $('.modal-dialog').draggable({
        handle: ".modal-header"
    });

    // Enable smooth scrolling inside modal body
    $(".modal-content").on("mousewheel DOMMouseScroll", function (e) {
        let delta = e.originalEvent.wheelDelta || -e.originalEvent.detail;
        this.scrollTop -= delta * 0.3; // Adjust scroll speed
        e.preventDefault(); // Prevent entire page from scrolling
    });
});
