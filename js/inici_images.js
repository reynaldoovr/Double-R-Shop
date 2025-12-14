const images = ['/img/image1.jpg', '/img/image2.jpg'];
var i = 0;
setInterval(()=> {
    const SliderImage = document.getElementById('slide-images');
    i = (i+1) % images.length;
    SliderImage.src = images[i];
}, 5000);