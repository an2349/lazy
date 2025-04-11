const slides = document.getElementsByClassName("mySlides");
const dots = document.getElementsByClassName("dot");

const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");

var slideIndex = 1;

showSlides(slideIndex);

function plusSlides(n) {
    slideIndex += n;
    if (slideIndex > slides.length) {slideIndex = 1;}  
    if (slideIndex < 1) {slideIndex = slides.length;}
    showSlides(slideIndex);
}

function currentSlide(n) {
    slideIndex = n;
    showSlides(slideIndex);
}

setInterval(function() {
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1;}  
    if (slideIndex < 1) {slideIndex = slides.length;}
    showSlides(slideIndex);
}, 4000);


function showSlides(n) {
    let i;
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
  
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
  
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
}