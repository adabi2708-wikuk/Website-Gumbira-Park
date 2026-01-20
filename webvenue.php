<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gumbira Park</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans&display=swap" rel="stylesheet" />
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box; font-family: 'Open Sans', sans-serif;}
        body {background: #f4f7f5; color: #333;}
        header {background: #2E8B57; padding: 20px; text-align: center; color: white; font-size: 26px; font-weight: bold;}
        .container {max-width: 1000px; margin: auto; padding: 20px;}

        .slider {position: relative; width: 100%; height: 300px; overflow: hidden; border-radius: 14px; margin-bottom: 25px;}
        .slide {width: 100%; height: 100%; position: absolute; opacity: 0; transition: opacity 1s ease-in-out; object-fit: cover;}
        .slide.active {opacity: 1;}
        .dots {text-align: center; margin-top: 10px;}
        .dot {display: inline-block; width: 12px; height: 12px; margin: 0 5px; background: white; border-radius: 50%; cursor: pointer; border: 2px solid #2E8B57;}
        .dot.active {background: #2E8B57;}

        .section {background: white; padding: 20px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);}        
        h2 {font-size: 22px; font-weight: 700; margin-bottom: 10px; color: #2E8B57;}
        .area-img {width: 100%; border-radius: 12px; margin-bottom: 10px;}

        /* ✅ Button Pesan Disini */
.btn {
    display: inline-block;
    background: #2E8B57;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    margin-top: 10px;
    transition: 0.3s ease;
    text-align: center;
}

.btn:hover {
    background: #246b45;
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.btn:active {
    transform: scale(0.97);
}


        /* ✅ Floating Whatsapp Button */
        .gmail-btn {position: fixed; bottom: 20px; right: 20px; background: #00d31cff; color: white; padding: 15px 18px; border-radius: 50px; font-weight: bold; text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.2); display: flex; align-items: center; gap: 8px;}

        @media(max-width: 600px) {
            header {font-size: 20px; padding: 15px;}
            .slider {height: 200px;}
        }
    </style>
</head>
<body>
    <header>Gumbira Park</header>

    <div class="container">
        <div class="slider" id="slider">
            <img src="img/logo gumbira-01 (1).png" class="slide active" alt="Main Ground" />
            <img src="img/logo gumbira-01 (1).png" class="slide" alt="Multifunction Ground" />
            <img src="img/logo gumbira-01 (1).png" class="slide" alt="Mini Ground" />
        </div>
        <div class="dots" id="dots"></div>

        <div class="section">
            <h2>Main Ground</h2>
            <img src="img/public-20210226093927.jpg" class="area-img" alt="Main Ground" />
            <h4> 1. Lapangan Rumput terbuka cocok untuk berbagai acara</h4>
            <p>Lahan ini merupakan lapangan rumput terbuka yang luas dan asri, ideal untuk berbagai kegiatan luar ruangan seperti konser, festival, acara olahraga, atau gathering perusahaan. </p>
            <h4>2. Kapasitas Besar</h4>
            <p>Kapasitas hingga ±5.000 orang, area ini menawarkan kenyamanan dan fleksibilitas tinggi bagi penyelenggara acara.</p>
        </div>

        <div class="section">
            <h2>Multifunction Ground</h2>
            <img src="img/public-20210226093927.jpg" class="area-img" alt="Festival Ground" />
            <h4>1. Lapangan paving terbuka cocok untuk berbagai acara</h4>
            <p>Lapangan dengan permukaan paving yang luas dan nyaman ini sangat fleksibel, cocok digunakan untuk berbagai jenis kegiatan seperti bazar, konser kecil, hingga event olahraga.</p>
            <h4>2. Kapasitas bisa sampai ±500 orang</h4>
            <p>Area ini mampu menampung hingga sekitar 500 orang.</p>
        </div>

        <div class="section">
            <h2>Mini Ground</h2>
            <img src="img/public-20210226093927.jpg" class="area-img" alt="Mini Ground" />
            <h4>1. Lapangan rumput terbuka cocok untuk berbagai acara </h4>
            <p>Lapangan rumput terbuka yang luas dan nyaman untuk berbagai kegiatan komunitas atau konser kecil.</p>
            <h4>2. Kapasitas yang cukup besar</h4>
            <p>Memiliki kapasitas hingga ±500 orang.</p>
        </div>
        <a class="btn" href="http://localhost:3000/booking.html">Pesan Disini</a>
    </div>

    <!-- ✅ Floating Wa Button -->
    <a href="https://wa.me/6281233707358" class="gmail-btn">Whatsapp Kami</a>

    <script>
        let slideIndex = 0;
        const slides = document.querySelectorAll(".slide");
        const dotsContainer = document.getElementById("dots");

        slides.forEach((_, i) => {
            const dot = document.createElement("span");
            dot.classList.add("dot");
            if (i === 0) dot.classList.add("active");
            dot.addEventListener("click", () => changeSlide(i));
            dotsContainer.appendChild(dot);
        });

        const dots = document.querySelectorAll(".dot");

        function showSlide(index) {
            slides.forEach((slide, i) => slide.classList.toggle("active", i === index));
            dots.forEach((dot, i) => dot.classList.toggle("active", i === index));
        }

        function changeSlide(index) {slideIndex = index; showSlide(slideIndex);}

        function autoSlide() {
            slideIndex = (slideIndex + 1) % slides.length;
            showSlide(slideIndex);
            setTimeout(autoSlide, 3500);
        }
        autoSlide();
    </script>
</body>
</html>