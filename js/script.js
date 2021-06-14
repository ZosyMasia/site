const burger = document.querySelector('.header__burger');
const menu = document.querySelector('.header__menu');
const body = document.querySelector('body');
const link = document.querySelector('.header__link');
let marker = document.querySelector('#header__marker');
let item = document.querySelectorAll('nav li a');

burger.addEventListener('click', () => {
    burger.classList.toggle('active');
    menu.classList.toggle('active');
    body.classList.toggle('lock');
});

function indicator(e) {
    marker.style.left = e.offsetLeft + "px";
    marker.style.width = e.offsetWidth + "px";
}

item.forEach(link => {
    link.addEventListener('mouseover', (e) => {
        indicator(e.target);
    })
})