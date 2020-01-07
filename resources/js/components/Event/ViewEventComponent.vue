<template>
  <div class="container">
    <br />
    <h1 style="font-family: Kanit;">{{ name }}</h1>
    <br />
    <b-carousel
      id="carousel-1"
      v-model="slide"
      :interval="6000"
      controls
      indicators
      background="#757575"
      img-width="1024"
      img-height="200"
      style="text-shadow: 1px 1px 2px #333;"
      @sliding-start="onSlideStart"
      @sliding-end="onSlideEnd"
    >
        <b-carousel-slide v-for="image in images" v-bind:key="image.id">
            <template v-slot:img>
                <center>
                    <div class="flex" width="100%">
                    <img v-lazy="fullPath(image.path)" height="500" class="mx-auto">
                    </div>
                </center>
            </template>
        </b-carousel-slide>
    </b-carousel>
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
        this.asNavFor1.push(this.$refs.thumbnails)
		this.asNavFor2.push(this.$refs.main)
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

<style scoped child-component="span">
.carousel-control-prev-icon[data-v-256197b0] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23003300' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath d='M5.25 0l-4 4 4 4 1.5-1.5L4.25 4l2.5-2.5L5.25 0z'/%3e%3c/svg%3e") !important;
}
.carousel-control-next-icon[data-v-256197b0] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23003300' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath d='M2.75 0l-1.5 1.5L3.75 4l-2.5 2.5L2.75 8l4-4-4-4z'/%3e%3c/svg%3e") !important;
}
</style>
