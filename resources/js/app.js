import './bootstrap';
import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const themeToggleButton = document.querySelector('#js-theme-toggle-button');
const htmlElem = document.documentElement;

function changeTheme() {
    localStorage.getItem('birthdayBlissAppTheme') === 'light' ? htmlElem.classList.remove('dark') : htmlElem.classList.add('dark');
}

if (localStorage.getItem('birthdayBlissAppTheme') === null) {
    if (window.matchMedia('(prefers-color-scheme: light)').matches) {
        localStorage.setItem('birthdayBlissAppTheme', 'light');
    } else {
        localStorage.setItem('birthdayBlissAppTheme', 'dark');
    }
}

changeTheme();

themeToggleButton.addEventListener('click', function(event) {
    if (htmlElem.classList.contains('dark')) {
        localStorage.setItem('birthdayBlissAppTheme', 'light');
        changeTheme();
    } else {
        localStorage.setItem('birthdayBlissAppTheme', 'dark');
        changeTheme();
    }
});

