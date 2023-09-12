// toggle mobile menu
function neo_toggle_menu() {
    var menu = document.querySelector('.neo_header_menu_row');
    menu.classList.toggle('neo_header_menu_open');
}

// calculates the correct distance from header to content when the header is fixed.
function neo_addMarginToBody() {
    const header = document.querySelector('.neo_header');
    if (!header.classList.contains('neo_header_fixed')) return;
    const height = header.offsetHeight;
    const main = document.querySelector('main');
    main.style.marginTop = height + 15 + 'px';
}

// recalculate the distance when resizing
window.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector('.neo_header');
    if (!header.classList.contains('neo_header_fixed')) return;
    neo_addMarginToBody()
    window.addEventListener('resize', function(event) {
        neo_addMarginToBody()
    }, true);
}, false);