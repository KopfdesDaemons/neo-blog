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

window.addEventListener("DOMContentLoaded", function() {
    // recalculate the distance when resizing
    const header = document.querySelector('.neo_header');
    if (header.classList.contains('neo_header_fixed')){
        neo_addMarginToBody()
        window.addEventListener('resize', function(event) {
            neo_addMarginToBody()
        }, true);
    }

    // header mobile submenu toggle
    const header_submenu_toggle = document.querySelectorAll('.neo_submenu_toggle');
    for(const toggle of header_submenu_toggle){
        toggle.addEventListener('click', (event) => {
            const toggleBtnParentMenu = event.target.parentElement.parentElement.querySelector('ul');

            // close all open menus
            const allOpenMenus = document.querySelectorAll('.neo_submenu_open');
            const isInSubmenu = toggleBtnParentMenu.parentElement.parentElement.classList.contains('neo_submenu_open');
            if (!isInSubmenu){
                for (const menu of allOpenMenus) {
                    if (menu === toggleBtnParentMenu) continue;
                    menu.classList.remove('neo_submenu_open');
                }
            }
            toggleBtnParentMenu.classList.toggle('neo_submenu_open');
        })
    }
}, false);