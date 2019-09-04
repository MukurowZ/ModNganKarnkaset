<template>
    <div style="font-family: Kanit;">
        <br>

        <div style="text-align: center;"  class="container">
            <div class="row">
                <img style="height: 400px" :src="previewImg" alt="">
                <br>
                <div  class="d-flex flex-row bd-highlight mb-3">
                    <div class="p-2 bd-highlight" v-for="img in img_set" v-bind:key="img.id">
                        <img style="height: 90px; display: flex;" v-lazy="getFullPath(img.path)" alt="">
                    </div>
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
    </div>
</template>
<script>
export default {
    mounted() {
        this.getProduct(this.id);
    },
    props:['id'],
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
            },
            img_set:{
                id: '',
                name: '',
                owner_id: '',
                path: '',
                img_set_id: '',
                img_ids: [],
                img_id: {
                    id: '',
                    img_set_id: '',
                    path: '',
                }
            },
            previewImg:'',
        }
    },
    methods: {
        getProduct(id){
            id = id.replace("'","");
            id = id.replace("\'\'","");
            axios.get("/api/product/"+id).then(response => this.setData(response.data));
        },
        setData(e) {
            this.product = e;
            this.getImg(this.product.img_set_id);
        },
        getImg(id) {
            axios.get("/api/img_set/"+id).then(response => this.setImgData(response.data));
        },
        setImgData(e){
            this.img_set = e.imgid;
            this.getFirstImg(e.id);
        },
        getFullPath(e){
            if(e!=null){
                return '../storage/imgs/'+e;
            }
            return '';
        },
        getFirstImg(e){
            axios.get("/api/img/set/" + e).then(response => {
                this.setPreviewImg('../storage/imgs/'+response.data.path);
            });
        },
        setPreviewImg(e){
            this.previewImg = e;
        }
    },

}
</script>
