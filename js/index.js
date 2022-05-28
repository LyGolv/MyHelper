const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");
const dropdownToggler = document.querySelector(".dropdown-toggle");
const aside = document.querySelector("aside");
const navbar = document.getElementById("navbar");
const profile_photo = document.querySelector(".profile .profile-photo");
const logo_imgs = document.querySelectorAll(".logo img");

function changeProfilePhoto(input){
    let profile_photo = document.querySelector(".img_profile_photo");
    let photo = document.querySelector(".photo");
    photo.removeChild(profile_photo);
    let newProfilePhoto = document.createElement("img");
    newProfilePhoto.setAttribute("src", input.value);
    newProfilePhoto.setAttribute("alt", "Photo modify!! please save to see modification");
    newProfilePhoto.setAttribute("class", "img_profile_photo");
    photo.appendChild(newProfilePhoto);
};

let lastposition = 0;
window.addEventListener('scroll', function() {
    lastposition = window.scrollY;
    if (lastposition < 20) {
        navbar.style.background = "none";
        navbar.style.background = "var(--color-background);";
        navbar.style.boxShadow = "none";
    }
    else {
        navbar.style.background = "var(--color-background-variant)";
        navbar.style.boxShadow = "var(--box-shadow)";
    }
});

if (window.innerWidth <= 768) {
    aside.style.display = "none";

}

menuBtn.addEventListener('click', () => {
    aside.classList.add('on');
    aside.style.display = 'block';
    aside.style.animation = "showMenu .9s ease forwards";
    aside.style.boxShadow = "var(--box-shadow)";
})

closeBtn.addEventListener('click', () => {
    aside.style.animation = "transform-hide .8s ease forwards";
    aside.style.boxShadow = "none";
})

// change theme
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('light_theme_variables');

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

    logo_imgs.forEach(img => {
        if (img.getAttribute('src') === "images/MyHelper-black.svg")
            img.setAttribute('src', "images/MyHelper-white.svg");
        else
            img.setAttribute('src', "images/MyHelper-black.svg");
    });

})

//listen for window resize event
window.addEventListener('resize', () => {
    let windowWidth = window.innerWidth;
    if(windowWidth <= 768)
        aside.style.animation = "transform-hide .7s ease forwards";
    else {
        //aside.style.position = "sticky";
        aside.style.animation = "transform-show 12s ease forwards";
        aside.classList.remove('on');

        // Remove box-shadow when window resize
        aside.style.boxShadow = "none";
    }
})

function cancel_profile_photo_style() {
    profile_photo.style.width = "2.8rem";
    profile_photo.style.height = "2.8rem";
    profile_photo.style.border = "none";
}

// display dropdown for profile menu
dropdownToggler.addEventListener('click', (e) => {
    let display_style = document.querySelector(".profile-dropdown");
    display_style.style.display = (display_style.style.display === 'block')? 'none' : 'block';

    if (display_style.classList.contains('on')) {
        cancel_profile_photo_style();
    }
    else {
        profile_photo.style.width = "3.2rem";
        profile_photo.style.height = "3.2rem";
        profile_photo.style.border = "4px solid var(--color-dark-variant)";
    }
    display_style.classList.toggle('on');
    e.stopPropagation();
})

// cancel all modification on html element
document.addEventListener('click', () => {
    let display_style = document.querySelector(".profile-dropdown");
    display_style.style.display = 'none';
    display_style.classList.remove('on');
    cancel_profile_photo_style();
})