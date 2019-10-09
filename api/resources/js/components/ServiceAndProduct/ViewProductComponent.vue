<template>
    <div style="font-family: Kanit;">
        <br>



        <div style="text-align: center;"  class="container">
            <div class="row">
                <!-- <img style="height: 400px" :src="previewImg" alt=""> -->
                <br>
                <div  class="d-flex flex-row bd-highlight mb-3">
                </div>
            </div>
            <div class="row">
                <h1><div style="text-align: left;">{{ product.name }}</div></h1>
            </div>
        </div>
           <div v-html="product.video"></div>

            {{ product.id }}

            {{ product.story }}
            {{ product.price }}

            {{ product.description }}

            {{ product.type }}
            {{ product.owner_id }}

            <view-p-img v-if="product.img_set_id!=null" :id="product.img_set_id"></view-p-img>
    </div>
</template>
<script>
export default {
    mounted() {
        this.getProduct(this.id);
    },
    props:{
        id: String,
    },
    data() {
        return {
            product: {
                id: '',
                name: '',
                story: '',
                price: '',
                img_set_id: '',
                description: '',
                video: '',
                type: '',
                owner_id: '',
                img: {
                    id: '',
                    img_set_id: '',
                    path: '',
                }
            },
            img: null,
        }
    },
    methods: {
        getProduct(id){
            axios.get("/api/product/"+id).then(response => this.setData(response.data));
        },
        setData(e) {
            this.product = e;
            img = this.product.img.img_set_id;
        },
    },

}
</script>
