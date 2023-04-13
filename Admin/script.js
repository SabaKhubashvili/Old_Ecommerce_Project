const SideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu-btn');
const closeBtn = document.querySelector('#close-btn');
const themeToggler = document.querySelector('.theme-toggler');

//! SHOW SIDEBAR
menuBtn.addEventListener('click',function(){
    SideMenu.style.display='block';
})
//!CLOSE SIDEBAR
closeBtn.addEventListener('click',function(){
    SideMenu.style.display='none';
})

//! CHANGE THEME
themeToggler.addEventListener('click',function(){
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('i:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('i:nth-child(2)').classList.toggle('active');
})