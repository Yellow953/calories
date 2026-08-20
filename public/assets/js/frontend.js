$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 8,
        nav: true,
        responsive: {
            0: {
                items: 3,
                margin: 6,
            },
            600: {
                items: 4,
            },
            1000: {
                items: 5,
            },
        },
    });
});
