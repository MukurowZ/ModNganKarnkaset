<template>
  <div class="container">
    <br />
    <h1 style="font-family: Kanit;">{{ name }}</h1>
    <br />

    <div class="card-carousel">
        <div class="card-img">
        <img :src="currentImage" alt />
        <div class="actions">
            <span @click="prevImage" class="prev">
                <i class="fas fa-chevron-left"></i>
            </span>
            <span @click="nextImage" class="next">
                <i class="fas fa-chevron-right"></i>
            </span>
        </div>
        </div>
        <div class="thumbnails">
            <agile class="main" ref="main" :options="options1" :as-nav-for="asNavFor1">
                <div class="slide" v-for="(slide, index) in images" :key="index" :class="`slide--${index}`"><img v-lazy="fullPath(slide.path)"/></div>
            </agile>
            <agile class="thumbnails" ref="thumbnails" :options="options2" :as-nav-for="asNavFor2">
                <div class="slide slide--thumbniail" v-for="(slide, index) in images" :key="index" :class="`slide--${index}`" @click="$refs.thumbnails.goTo(index)"><img v-lazy="fullPath(slide.path)"/></div>
                <template slot="prevButton"><i class="fas fa-chevron-left"></i></template>
                <template slot="nextButton"><i class="fas fa-chevron-right"></i></template>
            </agile>
            <!-- <div v-for="image in images" v-bind:key="image.id" @click="activateImage(index)">
          <img v-lazy="fullPath(image.path)" />
        </div> -->
        </div>
    </div>

    <!-- Event Content -->
    <div class="row">
        <div class="col-md-12" style="min-height: 50rem">
            <div class="card event-post" style="width: 100%;">
            <p class="card-text">{{ description }}</p>
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
        asNavFor1: [],
        asNavFor2: [],
        options1: {
            dots: false,
            fade: true,
            navButtons: false
        },
        options2: {
            autoplay: true,
            centerMode: true,
            dots: false,
            navButtons: false,
            slidesToShow: 3,
            responsive: [
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 5
                }
            },
            {
                breakpoint: 1000,
                settings: {
                    navButtons: true
                }
            }
            ]
        },
    };
  },
  methods: {
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
        this.images=e.imgid;
    },
    fullPath(e) {
      return "/storage/imgs/" + e;
    },
  }
};
</script>
