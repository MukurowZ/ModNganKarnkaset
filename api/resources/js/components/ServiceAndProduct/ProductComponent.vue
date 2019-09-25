<template>
  <div style="font-family: Kanit;"  class="container">
    <br />
    <div class="mx-auto">
        <div class="d-flex bd-highlight mb-3 rounded-top border border-danger align-content-end flex-wrap">
            <div class="mr-auto p-2 bd-highlight"><h5>สินค้า</h5></div>
            <b-form-input size="sm" style="text-align:right;" align="right" class="p-2 bd-highlight" placeholder="ค้นหาสินค้า" v-model="search"></b-form-input>
            <b-button @click.prevent="searchProduct()" size="sm" class="my-2 my-sm-0 p-2 bd-highlight" type="submit">
                    ค้นหา<font-awesome-icon :icon="['fas', 'search']" />
            </b-button>
        </div>
        <b-navbar
            toggleable="lg"
            type="light"
            style="background-color: white"
            class="rounded-top border border-danger"
        >
            <b-navbar-brand style="font-weight: 450;">สินค้า</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <b-nav-form>
                <b-form-input size="sm" class="mr-sm-2" placeholder="ค้นหาสินค้า" v-model="search"></b-form-input>
                <b-button @click.prevent="searchProduct()" size="sm" class="my-2 my-sm-0" type="submit">
                    ค้นหา
                    <font-awesome-icon :icon="['fas', 'search']" />
                </b-button>
                </b-nav-form>
            </b-navbar-nav>
            </b-collapse>
        </b-navbar>
        <br>
        <div class="row">
        <div class="col-2">
            <div class="align-self-start p-2 bd-highlight rounded-bottom border border-primary">
                <div class="list-group">
                <div v-for="category in categorys" v-bind:key="category.id">
                    <a :href="getLink(category.name)" class="list-group-item list-group-item-action"><b>{{category.name}}</b></a>
                    <div v-for="category in category.subCategory" v-bind:key="category.id">
                        <a :href="getLink(category.name)" class="list-group-item list-group-item-action">{{category.name}}</a>
                    </div>
                    <br>
                </div>
                </div>
            </div>
        </div>

        <div class="col-10">
        <div class="align-self-start p-2 bd-highlight rounded-bottom border border-success">
            <div v-if="showSearch==true">
            <div v-for="s_product in s_products" v-bind:key="s_product.id" class="d-flex flex-wrap">
                <div class="card my-4 col-md-3 product-card">
                    <img v-lazy="fullPath(s_product.img.path)" class="card-img-top mx-auto mt-2" alt="product img"/>
                    <div class="card-body">
                        <h5 class="card-title">
                        {{ s_product.name }}
                        <br />
                        <small style="color: rgb(158, 158, 158)">Catagory: {{ category.name }}</small>
                        <br />
                        <small style="color: rgb(158, 158, 158)">Type: {{ s_product.type }}</small>
                        </h5>
                        <p class="card-text">{{ s_product.description }}</p>
                        <div class="price">{{ s_product.price }}</div>
                        <a v-on:click="getUrl(s_product.id)" class="btn btn-primary">More detail</a>
                    </div>
                </div>
            </div>
            </div>
            <div v-if="showSearch==false">
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
            products: [],
            product: {
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
            services: [],
            service: {
                id: "",
                name: "",
                stroy: "",
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
            showProduct: '',
            showService: '',
            search: '',
            showSearch: '',
            s_product: [],
        };
    },
    methods: {
        searchProduct(){
            fetch('/api/search?q='+this.search)
            .then(res => res.json())
            .then(res => this.setData(res,"s_product"))
            .catch(err => this.setData(err,"break"));
        },
        getCategory() {
            axios
                .get("/api/hcategory")
                .then(response => this.setData(response.data, "category")).catch(err => this.setData(err,"break"));;
        },
        getProduct() {
            axios
                .get("/api/product")
                .then(response => this.setData(response.data, "product")).catch(err => this.setData(err,"break"));;
        },
        setData(e, f) {
            switch (f) {
                case "category":
                    this.categorys = e;
                    break;
                case "product":
                    this.products = e;
                    break;
                case "service":
                    this.services = e;
                    break;
                case "s_product":
                    this.s_products = e;
                    this.showSearch = true;
                    this.search = '';
                    this.s_products = JSON.parse(this.s_product);
                    break;
                case "break":
                    e = "";
                    break;
            }
        },
        getUrl(e) {
            if (e != null) {
                window.location.href = "/product/" + e;
            }
            return "";
        },
        getLink(e) {
            return "/" + e.toLowerCase();
        },
        getLink2(e) {
            return "/product/" + e.toLowerCase();
        },
        fullPath(e) {
            if (e != null) {
                return "/storage/imgs/" + e;
            }
            return "";
        }
    }
};
</script>
