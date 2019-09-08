<template>
  <ProductCarousel :images="images">Sidebar content here</ProductCarousel>
</template>
<script>
export default {
  data() {
    return {
      images: [
        "https://image.shutterstock.com/image-photo/dubai-uae-dec-5-2016-600w-575342725.jpg",
        "https://image.shutterstock.com/image-illustration/img-file-document-icon-trendy-260nw-1402505648.jpg",
      ]
    };
  },
  mounted() {
    console.log("Test");
  }
};
</script>