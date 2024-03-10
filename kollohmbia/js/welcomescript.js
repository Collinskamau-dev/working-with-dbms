const slideshowContainer = document.querySelector(".slideshow-container");
const slideshowWrapper = document.querySelector(".slideshow-wrapper");
const sections = document.querySelectorAll(".section");
let currentIndex = 0;

function updateSlideshow() {
  const translateX = -100 * currentIndex;
  slideshowWrapper.style.transform = `translateX(${translateX}%)`;
}

function nextSlide() {
  currentIndex++;
  if (currentIndex >= sections.length) {
    currentIndex = 0;
  }
  updateSlideshow();
}

function prevSlide() {
  currentIndex--;
  if (currentIndex < 0) {
    currentIndex = sections.length - 1;
  }
  updateSlideshow();
}

function handleKeydown(event) {
  if (event.key === "ArrowRight") {
    nextSlide();
  } else if (event.key === "ArrowLeft") {
    prevSlide();
  }
}

slideshowContainer.addEventListener("click", nextSlide);
document.addEventListener("keydown", handleKeydown);
