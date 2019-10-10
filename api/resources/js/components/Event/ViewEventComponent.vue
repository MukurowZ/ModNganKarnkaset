<template>
      <div class="container">  
    <br><h1>Event title</h1><br>
    <!-- Full-width images with number text -->
    <!-- Use v-for -->
    <div class="mySlides">
      <img src="./Image/img_woods.jpg" style="width:100%">
    </div>

    <!-- Thumbnail images -->
    <!-- Use v-for -->
    <div class="row">
      <div class="column">
        <img class="demo cursor" src="./Image/img_woods.jpg" style="width:100%" onclick="currentSlide(1)"
          alt="The Woods">
      </div>
  </div>

  <!-- Event Content -->
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="min-height: 50rem">
        <div class="card event-post" style="width: 100%;">
          <p class="card-text">Event description. Event description. Event description. Event description. Event
            description. Event description. Event description. Event description. Event description. Event description.
          </p>
        </div>
      </div>
    </div>
  </div>

  <script type="application/javascript">
    var slideIndex = 1;
    showSlides(slideIndex);

    // Thumbnail image controls
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      captionText.innerHTML = dots[slideIndex - 1].alt;
    }
  </script>

</template>