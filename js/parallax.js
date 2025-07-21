// parallax.js
document.addEventListener("DOMContentLoaded", () => {
  const parallaxImages = document.querySelectorAll(".parallax-img");

  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset;

    parallaxImages.forEach(img => {
      const speed = parseFloat(img.dataset.speed) || 0.4;
      img.style.transform = `translateY(${scrollTop * speed}px)`;
    });
  });
});