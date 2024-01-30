document.addEventListener("DOMContentLoaded", function () {
    var backButton = document.getElementById("back-to-top");

    backButton.addEventListener("click", function (e) {
        e.preventDefault();

        var scrollToTop = window.setInterval(function () {
            var pos = window.pageYOffset;

            if (pos > 0) {
                window.scrollTo(0, pos - 20); // Ubah 20 sesuai dengan kecepatan scrolling yang diinginkan
            } else {
                window.clearInterval(scrollToTop);
            }
        }, 5); // Ubah 5 sesuai dengan kecepatan scrolling yang diinginkan
    });

    window.addEventListener("scroll", function () {
        if (window.pageYOffset > 100) {
            backButton.style.display = "block";
        } else {
            backButton.style.display = "none";
        }
    });
});
