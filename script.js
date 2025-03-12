// Image Slider JavaScript Code
const images = [
    "assets/images/scroll/image1.jpg",
    "assets/images/scroll/image2.jpg",
    "assets/images/scroll/image3.jpg",
    "assets/images/scroll/image4.jpg",
    "assets/images/scroll/image5.jpg",
    "assets/images/scroll/image6.jpg",
    "assets/images/scroll/image7.jpg",
    "assets/images/scroll/image8.jpg",
    "assets/images/scroll/image9.jpg",
    "assets/images/scroll/image10.jpg"
];

let currentIndex = 0;
const sliderImg = document.getElementById("slider-img");

function changeImage() {
    currentIndex = (currentIndex + 1) % images.length;
    sliderImg.src = images[currentIndex];
}

// Change image every 3 seconds
setInterval(changeImage, 3000);
