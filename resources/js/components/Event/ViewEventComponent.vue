<template>
  <div class="container">
    <br />
    <h1 style="font-family: Kanit;">{{ name }}</h1>
    <br />
        <div>
            <agile class="main" ref="main" :options="options1" :as-nav-for="asNavFor1">
                <div class="slide" v-for="(slide, index) in images" :key="index" :class="`slide--${index}`"><img v-lazy="fullPath(slide.path)"/></div>
            </agile>
            <agile class="thumbnails" ref="thumbnails" :options="options2" :as-nav-for="asNavFor2">
                <div class="slide slide--thumbniail" v-for="(slide, index) in images" :key="index" :class="`slide--${index}`" @click="$refs.thumbnails.goTo(index)"><img v-lazy="fullPath(slide.path)"/></div>
                <template slot="prevButton"><i class="fas fa-chevron-left"></i></template>
                <template slot="nextButton"><i class="fas fa-chevron-right"></i></template>
            </agile>
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

<style lang="sass">
.main
	margin-bottom: 30px

.thumbnails
	margin: 0 -5px
	width: calc(100% + 10px)

.agile
	&__nav-button
		background: transparent
		border: none
		color: #ccc
		cursor: pointer
		font-size: 24px
		transition-duration: .3s

		.thumbnails &
			position: absolute
			top: 50%
			transform: translateY(-50%)

			&--prev
				left: -45px

			&--next
				right: -45px

		&:hover
			color: #888

	&__dot
		margin: 0 10px

		button
			background-color: #eee
			border: none
			border-radius: 50%
			cursor: pointer
			display: block
			height: 10px
			font-size: 0
			line-height: 0
			margin: 0
			padding: 0
			transition-duration: .3s
			width: 10px

		&--current,
		&:hover
			button
				background-color: #888

.slide
	align-items: center
	box-sizing: border-box
	color: #fff
	display: flex
	height: 450px
	justify-content: center

	&--thumbniail
		cursor: pointer
		height: 100px
		padding: 0 5px
		transition: opacity .3s

		&:hover
			opacity: .75

	img
		height: 100%
		object-fit: cover
		object-position: center
		width: 100%
</style>
