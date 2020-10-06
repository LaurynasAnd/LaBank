'use strict';

// const navButton = document.querySelector('.menu-btn');
// navButton.addEventListener('click', showHiddenMenu);

// function showHiddenMenu() {
//     navButton.classList.toggle('active');
//     document.querySelector('.navmenu').classList.toggle('active');
// }

//next an event listener for "check all" checkbox will be created
const checkAll = document.querySelector('#check_all');
const checkboxes = document.querySelectorAll('.check');
checkAll.addEventListener('change', function () {
    if (this.checked) {
        // Checkbox is checked..
        for (const box of checkboxes) {
            box.checked = true;
        }
    } else {
        // Checkbox is not checked..
        for (const box of checkboxes) {
            box.checked = false;
        }
    }
});

//next, event listener for all check boxes will be created, for the button

const checkboxesAll = document.querySelectorAll('input[type=checkbox]');
for (const box of checkboxesAll){
    box.addEventListener('change', function(){
        if(0 !== document.querySelectorAll('input[type=checkbox]:checked').length){
            document.querySelector('button').style.visibility = 'visible';
            for(const link of document.querySelectorAll('.link')){
                link.style.visibility = 'visible';
            }
        } else {
            document.querySelector('button').style.visibility = 'hidden';
            for(const link of document.querySelectorAll('.link')){
                link.style.visibility = 'hidden';
            }
        }
    })
}
