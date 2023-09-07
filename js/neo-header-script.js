function toggleMenu() {
    var menu = document.querySelector('.mobileExpandedMenu');
    menu.classList.toggle('headerMenuOpen');
}

function addMarginToBody() {
    const header = document.querySelector('.header');
    if (!header.classList.contains('fixedHeader')) return;
    const height = header.offsetHeight;
    const main = document.querySelector('main');
    main.style.marginTop = height + 15 + 'px';
}

window.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector('.header');
    if (!header.classList.contains('fixedHeader')) return;
    addMarginToBody()
    window.addEventListener('resize', function(event) {
        addMarginToBody()
    }, true);
}, false);