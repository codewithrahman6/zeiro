// PREMIUM HERO SLIDESHOW

let heroImages = document.querySelectorAll(".hero-img");
let hi = 0;

function nextHeroImage() {
    heroImages.forEach(img => img.classList.remove("active"));
    heroImages[hi].classList.add("active");

    hi++;
    if (hi >= heroImages.length) hi = 0;
}
// PARALLAX CAMERA MOTION

document.addEventListener("mousemove", (e) => {
    let moveX = (e.clientX - window.innerWidth / 2) * 0.008;
    let moveY = (e.clientY - window.innerHeight / 2) * 0.008;

    document.querySelector(".hero-slideshow").style.transform =
        `translate(${moveX}px, ${moveY}px)`;
});


// Change every 4 seconds
setInterval(nextHeroImage, 4000);
