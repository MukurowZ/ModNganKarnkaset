<template>
  <div class="container">
    <br />
    <h1>Event title</h1>
    <br />
    <!-- Full-width images with number text -->
    <!-- Use v-for -->
    <div class="mySlides">
      <img src="./Image/img_woods.jpg" style="width:100%" />
    </div>

    <!-- Thumbnail images -->
    <!-- Use v-for -->
    <div class="row">
      <div class="column">
        <img
          class="demo cursor"
          src="./Image/img_woods.jpg"
          style="width:100%"
          onclick="currentSlide(1)"
          alt="The Woods"
        />
      </div>
    </div>

    <!-- Event Content -->
    <div class="container">
      <div class="row">
        <div class="col-md-12" style="min-height: 50rem">
          <div class="card event-post" style="width: 100%;">
            <p class="card-text">
              Event description. Event description. Event description. Event description. Event
              description. Event description. Event description. Event description. Event description. Event description.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>