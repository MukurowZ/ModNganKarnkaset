<template>
  <ProductCarousel :images="images">
    Sidebar content here
  </ProductCarousel>
</template>
<script>
export default {
  components: {
    ProductCarousel,
  },
  data() {
    images: [
      'http://lorempixel.com/1000/1000/business/1/',
      'http://lorempixel.com/1000/1000/business/2/',
      'http://lorempixel.com/1000/1000/business/3/',
    ]
  },
}
</script>