<template>
    <div style="font-family: Kanit;">
        <div v-for="product in products" v-bind:key="product.id">
            {{ product.id }}
            {{ product.name }}
            {{ product.story }}
            {{ product.price }}
            {{ product.img_set_id }}
            {{ product.description }}
            <div v-html="product.video"></div>
            {{ product.type }}
            {{ product.owner_id }}
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        getProduct(){
            axios.get("/api/product/").then(response => this.setData(response.data));
        },
        setData(e) {
            this.products = e;
        },
    },
}
</script>
