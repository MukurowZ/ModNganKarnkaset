<template>
  <div class="container">
    <br />
    <h1>{{ name }}</h1>
    <br />
    <!-- Full-width images with number text -->
    <!-- Use v-for -->
    <div v-for="image in images" v-bind:key="image.id" class="mySlides">
        <img v-lazy="fullPath(image.path)" style="width:100%"/>
    </div>

    <!-- Thumbnail images -->
    <!-- Use v-for -->
    <div class="row" >
      <div class="column" v-for="image in images" v-bind:key="image.id">
        <img
          class="demo cursor"
          v-lazy="fullPath(image.path)"
          style="width:100%"
          v-on:click="currentSlide(image.id)"
        />
      </div>
    </div>

    <!-- Event Content -->
    <div class="container">
      <div class="row">
        <div class="col-md-12" style="min-height: 50rem">
          <div class="card event-post" style="width: 100%;">
            <p class="card-text">
              {{ description }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { itemTypeMixin } from '../mixins/itemType.js'
export default {
    mixins: [itemTypeMixin],
    props:['id'],
    created() {

    },
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
            slideIndex: 1,
            slides: '',
        }
    },
    methods: {
        getEventData(id){
            axios.get('/api/'+this.itemType+'/'+id).then(response=> this.setEventData(response.data));
        },
        setEventData(e){
            this.img_set = e.img_set_id
            this.owner_id = e.contentDetail[0].owner_id
            this.editId = e.img_set_id
            if(this.itemType=="event") this.description = e.event_description
            else {
                this.description = e.activity_description
                this.name = e.activity_name
            }
            axios.get("/api/img_set/" + e.img_set_id).then(response => {
                this.setImgData(response.data);
            });
        },
        setImgData(e) {
            this.images = e.imgid;
        },
        fullPath(e){
            return "/storage/imgs/"+e;
        },
        // Thumbnail image controls
        currentSlide(n) {
            this.showSlides((this.slideIndex = n));
        },
        showSlides(n) {
            this.slides = [...document.getElementsByClassName("mySlides")]
            while(this.slides==null){
                this.slides = [...document.getElementsByClassName("mySlides")]
            }
            var i;
            var dots = document.getElementsByClassName("demo");
            if (n > this.slides.length) {
                this.slideIndex = 1;
            }
            if (n < 1) {
                this.slideIndex = this.slides.length;
            }
            for (i = 0; i < this.slides.length; i++) {
                this.slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            this.slides[this.slideIndex - 1].style.display = "block";
            dots[this.slideIndex - 1].className += " active";
        }
    }
};
</script>
