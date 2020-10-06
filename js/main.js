'use strict';

const navButton = document.querySelector('.menu-btn');
navButton.addEventListener('click', showHiddenMenu);

function showHiddenMenu(){
    navButton.classList.toggle('active');
    document.querySelector('.navmenu').classList.toggle('active');
}