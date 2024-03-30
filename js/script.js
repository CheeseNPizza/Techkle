//navigate user with slide down animation to content below
document.getElementById("scrollDownBtn").addEventListener("click", function() {
    document.getElementById("content").scrollIntoView({ behavior: "smooth", block: "start" });
});

document.getElementById("ca").addEventListener("click", function() {
    document.getElementById("ca_content").scrollIntoView({ behavior: "smooth", block: "start" });
});

document.getElementById("pc").addEventListener("click", function() {
    document.getElementById("pc_content").scrollIntoView({ behavior: "smooth", block: "start" });
});

document.getElementById("aa").addEventListener("click", function() {
    document.getElementById("aa_content").scrollIntoView({ behavior: "smooth", block: "start" });
});

document.getElementById("sa").addEventListener("click", function() {
    document.getElementById("sa_content").scrollIntoView({ behavior: "smooth", block: "start" });
});

document.getElementById("ms").addEventListener("click", function() {
    document.getElementById("ms_content").scrollIntoView({ behavior: "smooth", block: "start" });
});

document.getElementById("cm").addEventListener("click", function() {
    document.getElementById("cm_content").scrollIntoView({ behavior: "smooth", block: "start" });
});

document.getElementById("ga").addEventListener("click", function() {
    document.getElementById("ga_content").scrollIntoView({ behavior: "smooth", block: "start" });
});

document.getElementById("fh").addEventListener("click", function() {
    document.getElementById("fh_content").scrollIntoView({ behavior: "smooth", block: "start" });
});

var swiper = new Swiper(".slide_container", {
    slidesPerView: 4,
    spaceBetween: 20,
    centeredSlides: false,
    slidesPerGroupSkip: 4,
    loop: true,
    centerSlide: "true",
    fade: "true",
    grabCursor: true,
    keyboard: {
      enabled: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 2,
        },
        769: {
            slidesPerView: 3,
            slidesPerGroup: 3,
        },
        1000: {
            slidesPerView: 4,
        }
    },
    scrollbar: {
      el: ".swiper-scrollbar",
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      dynamicBullets: true,
    },
});

// var cat_swiper = new Swiper(".cat_slide_container", {
//     slidesPerView: 4,
//     spaceBetween: 20,
//     centeredSlides: false,
//     slidesPerGroupSkip: 4,
//     loop: true,
//     centerSlide: "true",
//     fade: "true",
//     grabCursor: true,
//     keyboard: {
//       enabled: true,
//     },
//     breakpoints: {
//         0: {
//             slidesPerView: 1,
//         },
//         520: {
//             slidesPerView: 2,
//         },
//         769: {
//             slidesPerView: 3,
//             slidesPerGroup: 3,
//         },
//         1000: {
//             slidesPerView: 4,
//         }
//     },
//     scrollbar: {
//       el: ".cat_swiper-scrollbar",
//     },
//     navigation: {
//       nextEl: ".cat_swiper-button-next",
//       prevEl: ".cat_swiper-button-prev",
//     },
//     pagination: {
//       el: ".cat_swiper-pagination",
//       clickable: true,
//       dynamicBullets: true,
//     },
// });
