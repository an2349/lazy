document.addEventListener("DOMContentLoaded", function () {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        const slides = modal.querySelectorAll('.slide');
        let slideIndex = 0;

        // Khi modal mở, đảm bảo ảnh đầu tiên được hiển thị
        modal.addEventListener('change', function () {
            showSlide(slideIndex);
        });

        function showSlide(index) {
            // Ẩn tất cả các slide
            slides.forEach(slide => slide.style.display = "none");

            // Hiển thị slide hiện tại
            slides[index].style.display = "block";
        }

        // Quản lý chuyển slide
        modal.querySelector('.prev').addEventListener('click', function () {
            slideIndex = (slideIndex > 0) ? slideIndex - 1 : slides.length - 1;
            showSlide(slideIndex);
        });

        modal.querySelector('.next').addEventListener('click', function () {
            slideIndex = (slideIndex < slides.length - 1) ? slideIndex + 1 : 0;
            showSlide(slideIndex);
        });

        // Hiển thị slide đầu tiên khi modal được mở
        showSlide(slideIndex);
    });
});
1