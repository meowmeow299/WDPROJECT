<html>
    <head>
        <title>Melody Mart Website</title>
        <link rel="stylesheet" href="styles.css">
        <link href='https://unpkg.com/css.gg@2.0.0/icons/css/log-out.css' rel='stylesheet'>
    </head>

    <body>
   <?php
        include("header.php");
        ?>

     <!-- Slideshow container -->
<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
      <div class="numbertext"></div>
      <img src="image/iklan1.jpg" style="width:100%">
    </div>
  
    <div class="mySlides fade">
      <div class="numbertext">2 / 3</div>
      <img src="image/iklan2.jpg" style="width:100%">

    </div>
  
    <div class="mySlides fade">
      <div class="numbertext">3 / 3</div>
      <iframe  width="100%" height="455" controls=0 src="https://www.youtube.com/embed/CrPwZ6zHSDc?si=zBy_gzRPz9djCUqN" 
      title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
      referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    </div>
  
    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>
  
  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

 <script>
    let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
 </script>

<div class="product">
   <h1>Popular Brands</h1>
<ul>
  <li><a href=""><img src="image/ibanez.png" height="80px" width="100px"></a></li>
  <li><a href=""><img src="image/fender.png" height="80px" width="100px"alt=""></a></li>
  <li><a href=""><img src="image/squier.png" height="80px" width="100px"alt=""></a></li>
  <li><a href=""><img src="image/gibson.png" height="80px" width="100px"alt=""></a></li>
  <li><a href=""><img src="image/yamaha.png" height="80px" width="100px"alt=""></a></li>
   
  </ul>
</div>

  
<div class="review">
    <br>
    <h1>customer reviews
    </h1>
    <div class="po">
        <div class="container">
        <img src="image/chris.jpg" alt="Avatar" style="width:90px">
        <p><span>Chris Fox.</span> Beginners.</p>
        <p>"I got my first guitar! Thankyou MelodyMart."</p>
      </div>
      
      <div class="container">
        <img src="image/rebeca.jpg" alt="Avatar" style="width:90px">
        <p><span >Rebecca Flex.</span> CEO at Company.</p>
        <p>"This is the best website to buy a bass."</p>
      </div>
      
      <div class="container">
        <img src="image/girl.png" alt="Avatar" style="width:90px">
        <p><span >Hailey Bailey.</span> Artist.</p>
        <p>"Finally, i got my dream guitar. You're the best!"</p>
      </div>
    </div>
    
</div>

<footer class="footer">
    <div class="footer-content">
      <p>Author: Amirah Afiqah.</p>
      <ul>
        <li><a href="aamirah229@gmail.com">aamirah229@gmail.com</a></li>
      </ul>
    </div>
  </footer>
      
  </body>
</html>