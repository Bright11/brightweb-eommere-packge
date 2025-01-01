const pro_gallery = document.querySelector(".product_gallery");

let isDown = false;
let startx;
let scrollleft;

pro_gallery.addEventListener('mousedown', (e) => {
    isDown = true;
    pro_gallery.classList.add('active');
    startx = e.pageX - pro_gallery.offsetLeft;
    scrollleft = pro_gallery.scrollLeft;
});

pro_gallery.addEventListener('mouseleave', () => {
    isDown = false;
    pro_gallery.classList.remove('active');
});

pro_gallery.addEventListener('mouseup', () => {
    isDown = false;
    pro_gallery.classList.remove('active');
});

pro_gallery.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();

    const x = e.pageX - pro_gallery.offsetLeft;
    const walk = (x - startx) * 2; // Multiply by 2 for faster scroll
    pro_gallery.scrollLeft = scrollleft - walk;
});

const btn_next=document.querySelector(".btn_next")

const btn_prev=document.querySelector(".btn_prev")

btn_next.addEventListener('click',()=>{
    pro_gallery.scrollLeft += pro_gallery.clientWidth / 2; 
})

btn_prev.addEventListener('click',()=>{
    pro_gallery.scrollLeft -= pro_gallery.clientWidth / 2; 
})


// disable btn
// Disable buttons at the ends
function checkButtons() {
    btn_prev.disabled = pro_gallery.scrollLeft <= 0;
    btn_next.disabled = pro_gallery.scrollLeft >= (pro_gallery.scrollWidth - pro_gallery.clientWidth);
}

pro_gallery.addEventListener('scroll', checkButtons);

// Initial button state check
checkButtons();



// adding gallery iamge to main image on click

document.addEventListener("DOMContentLoaded",function(){
    const mainimage=document.getElementById("main_details_image");
    const galleryimages=document.querySelectorAll(".product_gallery_item img");

    galleryimages.forEach(galleryimages=>{
        galleryimages.addEventListener("click",function(){
            mainimage.src=this.src;
        });
    })


})

// rating

document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const ratingValue = document.querySelector('.rating-value');
  
    stars.forEach((star, index) => {
      star.addEventListener('click', () => {
        // Set the rating value
        ratingValue.value = index + 1;
  
        // Remove highlight from all stars
        stars.forEach((star) => {
          star.classList.remove('highlight');
        });
  
        // Add highlight to the selected star and all previous stars
        for (let i = 0; i <= index; i++) {
          stars[i].classList.add('highlight');
        }
      });
    });
  });
  














