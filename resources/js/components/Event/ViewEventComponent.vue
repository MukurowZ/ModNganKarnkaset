<template>
  <div class="container">
    <br />
    <h1 style="font-family: Kanit;">{{ name }}</h1>
    <br />
    <div class="modn-content" style="max-width:1200px">
      <!-- Full-width images with number text -->
      <!-- Use v-for -->
      <img
        v-for="image in images"
        v-bind:key="image.id"
        class="mySlides"
        v-lazy="fullPath(image.path)"
        style="width:100%;display:none"
      />

      <!-- Thumbnail images -->
      <!-- Use v-for -->
      <div class="modn-row-padding modn-section">
        <div class="modn-col s4" v-for="image in images" v-bind:key="image.id">
          <img
            class="selector modn-opacity modn-hover-opacity-off"
            v-lazy="fullPath(image.path)"
            style="width:100%;cursor:pointer"
            v-on:click="currentSlide(image.id)"
          />
        </div>
      </div>
    </div>

    <!-- Event Content -->
    <div class="container">
      <div class="row">
        <div class="col-md-12" style="min-height: 50rem">
          <div class="card event-post" style="width: 100%;">
            <p class="card-text">{{ description }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { itemTypeMixin } from "../mixins/itemType.js";
export default {
  mixins: [itemTypeMixin],
  props: ["id"],
  mounted() {
    this.getEventData(this.id);
    this.begin();
    this.showSlides(this.slideIndex);
  },
  data() {
    return {
      name: "",
      description: "",
      img_set: "",
      owner_id: "",
      sets: [],
      set: {
        id: "",
        name: "",
        owner_id: "",
        imgids: [],
        imgid: {
          id: "",
          img_set_id: "",
          path: ""
        }
      },
      images: [],
      slideIndex: 0,
      slides: ""
    };
  },
  methods: {
    begin() {
      setTimeout(() => this.currentSlide(this.slideIndex), 1000);
    },
    getEventData(id) {
      axios
        .get("/api/" + this.itemType + "/" + id)
        .then(response => this.setEventData(response.data));
    },
    setEventData(e) {
      this.img_set = e.img_set_id;
      this.owner_id = e.contentDetail[0].owner_id;
      this.editId = e.img_set_id;
      if (this.itemType == "event") {
        this.description = e.event_description;
        this.name = e.event_name;
      } else {
        this.description = e.activity_description;
        this.name = e.activity_name;
      }
      axios.get("/api/img_set/" + e.img_set_id).then(response => {
        this.setImgData(response.data);
      });
    },
    setImgData(e) {
      this.images = e.imgid;
    },
    fullPath(e) {
      return "/storage/imgs/" + e;
    },
    // Thumbnail image controls
    currentSlide(n) {
      n = this.images[this.images.length - 1].id - n;
      this.showSlides((this.slideIndex = n));
    },
    showSlides(n) {
      this.slides = [...document.getElementsByClassName("mySlides")];
      while (this.slides == null) {
        this.slides = [...document.getElementsByClassName("mySlides")];
      }
      var i;
      // var this.refs['selector'] = document.getElementsByClassName("selector");
      if (n > this.slides.length) {
        this.slideIndex = 1;
      }
      if (n < 1) {
        this.slideIndex = this.slides.length;
      }
      for (i = 0; i < this.slides.length; i++) {
        this.slides[i].style.display = "none";
      }
      for (i = 0; i < this.refs["selector"].length; i++) {
        this.refs["selector"].className = this.refs[
          "selector"
        ].className.replace(" modn-opacity-off", "");
      }
      this.slides[this.slideIndex - 1].style.display = "block";
      this.refs["selector"].className += " modn-opacity-off";
    }
  }
};
</script>

<style lang="css">
@import "w3.css";
</style>
