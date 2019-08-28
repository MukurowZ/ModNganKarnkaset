<template>
    <div style="font-family: Kanit;">
        <br>
        <div class="mx-auto">
            <b-navbar toggleable="lg" type="light" style="background-color: white" class="rounded-top border border-danger">
            <b-navbar-brand style="font-weight: 450;">สินค้า</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <b-nav-form>
                <b-form-input size="sm" class="mr-sm-2" placeholder="ค้นหาสินค้า"></b-form-input>
                <b-button size="sm" class="my-2 my-sm-0" type="submit">ค้นหา <font-awesome-icon :icon="['fas', 'search']" /></b-button>
                </b-nav-form>
            </b-navbar-nav>
            </b-collapse>
            </b-navbar>
            <br>
        <div class="d-flex bd-highlight mb-3">
            <div class="p-2 bd-highlight rounded-lg border border-primary">
                <div class="nav-item" v-for="category in categorys" v-bind:key="category.id" left>
                    <a style="text-decoration: none; color: black" :href="getLink(category.name)">{{ category.name }}</a>
                    <div v-for="category in category.subCategory" v-bind:key="category.id">
                    <a class="nav-link active" style="color: black" :href="getLink2(category.name)"> {{ category.name }}</a>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="col mx-md-12 mx-auto">
                <div class="align-self-start p-2  bd-highlight rounded-bottom border border-success">
                    <div v-for="product in products" v-bind:key="product.id" class="d-flex flex-wrap">
                        <img height="100px" v-lazy="fullPath(product.img_set_id)" />
                        {{ product.name }}
                        {{ product.price }}
                        {{ product.type }}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.getCategory();
        this.getProduct();
    },
    data() {
        return {
            categorys: [],
            category:{
                id: '',
                name: '',
                THname: '',
                head: '',
                isHead: '',
                subCategorys: [],
                subCategory: {
                    id: '',
                    name: '',
                    THname: '',
                    isHead: '',
                }
            },
            products: [],
            product:{
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
            services: [],
            service: {
                id: '',
                name: '',
                stroy: '',
                price: '',
                img_set_id: '',
                description: '',
                video: '',
                type: '',
                owner_id: '',
            },
        }
    },
    methods: {
        getCategory() {
            axios.get("/api/hcategory").then(response => this.setData(response.data,'category'));
        },
        getProduct(){
            axios.get("/api/product").then(response => this.setData(response.data,'product'));
        },
        setData(e,f) {
            switch(f){
                case 'category':
                    this.categorys = e;
                    break;
                case 'product':
                    e.forEach(a => {
                        axios.get("/api/img/set/" + a.img_set_id).then(response => {
                            a.img_set_id = response.data.path;
                        });
                    });
                    this.products = e;
                    break;
            }
        },
        getSubCategory(e){

        },
        getLink(e){
            return '/'+e.toLowerCase();
        },
        getLink2(e){
            return '/product/' + e.toLowerCase();
        },
        fullPath(e) {
            if (e != null) {
                return "/storage/imgs/" + e;
            }
            return "";
        },

    },
}
</script>
