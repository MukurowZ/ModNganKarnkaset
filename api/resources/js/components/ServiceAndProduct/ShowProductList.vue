<template>
    <div>
        <div v-for="product in products" v-bind:key="product.id" class="d-flex flex-wrap">
            <div class="card my-4 col-md-3 product-card">
                <img v-lazy="fullPath(product.img.path)" class="card-img-top mx-auto mt-2" alt="product img"/>
                <div class="card-body">
                    <h5 class="card-title">
                    {{ product.name }}
                    <br />
                    <small style="color: rgb(158, 158, 158)">Catagory: {{ category.name }}</small>
                    <br />
                    <small style="color: rgb(158, 158, 158)">Type: {{ product.type }}</small>
                    </h5>
                    <p class="card-text">{{ product.description }}</p>
                    <div class="price">{{ product.price }}</div>
                    <a v-on:click="getUrl(product.id)" class="btn btn-primary">More detail</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:{
        type: String
    },
    data() {
        return {
            categorys: [],
            category: {
                id: "",
                name: "",
                THname: "",
                head: "",
                isHead: "",
                subCategorys: [],
                subCategory: {
                    id: "",
                    name: "",
                    THname: "",
                    isHead: ""
                }
            },
            items: [],
            item: {
                id: "",
                name: "",
                story: "",
                price: "",
                img_set_id: "",
                description: "",
                video: "",
                type: "",
                owner_id: "",
                img: {
                    id: "",
                    img_set_id: "",
                    path: "",
                }
            },
        }
    },
    methods: {
        getCategory() {
            axios
                .get("/api/hcategory")
                .then(response => this.setData(response.data, "category")).catch(err => this.setData(err,"break"));;
        },
        getProduct() {
            axios
                .get("/api/s/three"+this.type)
                .then(response => this.setData(response.data, "item")).catch(err => this.setData(err,"break"));;
        },
        setData(e, f) {
            switch (f) {
                case "category":
                    this.categorys = e;
                    break;
                case "item":
                    e = this.renameCategory(e);
                    this.items = e;
                    break;
                case "break":
                    e = "";
                    break;
            }
        },
        getOnlyFirstThree(e){
            var result = [];
            result[0]=e[length-1];
        },
        renameCategory(e){
            var i = 0;
            var c = JSON.parse(JSON.stringify(this.getBackCategorys()))
            c = Object.entries(c)
            for(i = 0; i<e.length; i++){
                c.forEach(b => {
                    if(b[1].id==e[i].type){
                        e[i].type = b[1].name + " " + b[1].THname;
                    }
                })
            }
            return e;
        },
        getBackCategorys(){
            return this.backCategorys
        }
    },
}
</script>
