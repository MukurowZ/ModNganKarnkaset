<template>
  <div style="font-family: Kanit;" class="container">
    <br />
    <div class="row">
      <div class="col-12 rounded-top border border-danger">
        <b-navbar type="light" style="background-color: white" class>
          <b-navbar-brand style="font-weight: 450;">สินค้าและบริการ</b-navbar-brand>
          <!-- <b-navbar-toggle target="nav-collapse"></b-navbar-toggle> -->
          <b-collapse id="nav-collapse" is-nav>
            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
              <b-nav-form>
                <b-form-input size="sm" class="mr-sm-2" placeholder="ค้นหาสินค้า" v-model="search"></b-form-input>
                <b-button
                  @click.prevent="searchProduct()"
                  size="sm"
                  class="my-2 my-sm-0"
                  type="submit"
                >
                  ค้นหา
                  <font-awesome-icon :icon="['fas', 'search']" />
                </b-button>
              </b-nav-form>
            </b-navbar-nav>
          </b-collapse>
        </b-navbar>
      </div>
    </div>

    <br />
    <div class="row">
      <div class="col-sm-12 col-md-2 align-self-start p-2 bd-highlight rounded-bottom border border-primary">
        <div class="list-group">
          <div v-for="category in categorys" v-bind:key="category.id">
            <a :href="getLink(category.name)" class="list-group-item list-group-item-action">
              <b>{{ category.name }}</b>
            </a>
            <div
              v-for="category in category.subCategory"
              v-bind:key="category.id"
              @click.prevent="
                                        searchProductByType(category.name)
                                    "
            >
              <a class="list-group-item list-group-item-action">
                <div>{{ category.name }}</div>
              </a>
            </div>
            <br />
          </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-10 bd-highlight rounded-bottom border border-success">
        <div class="container py-0">
          <div v-if="showSearch == true">
            <div class="row">
              <div
                v-for="s_product in s_products"
                v-bind:key="s_product.id"
                class="card col-md-6 col-lg-4"
              >
                <img
                  v-lazy="fullPath(s_product.img.path)"
                  class="card-img-top mx-auto mt-2"
                  alt="product img"
                  style="height: 146.05px"
                />
                <div class="card-body">
                  <h5 class="card-title">
                    {{ s_product.name }}
                    <br />
                    <small style="color: rgb(158, 158, 158)">
                      Type: {{ s_product.typeName.name }} {{ s_product.typeName.THname }}
                    </small>
                  </h5>
                  <p
                    class="card-text py-0"
                    style="height: 6rem; text-overflow: ellipsis; overflow: hidden;"
                  >{{ s_product.description }}</p>
                  <div class="price">{{ s_product.price }}&#3647;</div>
                  <a v-on:click="getUrl(s_product.id)" class="btn btn-primary" style="font">More detail</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div v-if="showSearch == false">
          <div class="container">
            <div class="row">
              <div
                v-for="product in products"
                v-bind:key="product.id"
                class="card my-2 col-md-6 col-lg-4"
              >
                <img
                  v-lazy="fullPath(product.img.path)"
                  class="card-img-top mx-auto mt-2"
                  alt="product img"
                  style="height: 146.05px"
                />
                <div class="card-body">
                  <h5 class="card-title">
                    {{ product.name }}
                    <br />
                    <small style="color: rgb(158, 158, 158)">Type: {{ product.typeName.name }} {{ product.typeName.THname }}</small>
                  </h5>
                  <p
                    class="card-text py-0"
                    style="height: 6rem; text-overflow: ellipsis; overflow: hidden;"
                  >{{ product.description }}</p>
                  <div class="price">Price: {{ product.price }}&#3647;</div>
                  <a
                    v-on:click="getUrl(product.id)"
                    align="center"
                    style="color: white; width: 100%"
                    class="btn btn-primary"
                  >More detail</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
  </div>
</template>

<script>
import { itemTypeMixin } from "../mixins/itemType.js";
export default {
  mixins: [itemTypeMixin],
  mounted() {
    this.getAllData();
  },
  data() {
    return {
      backCategorys: [],
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
          path: ""
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
          path: ""
        }
      },
      showProduct: "",
      showService: "",
      search: "",
      showSearch: "",
      s_product: []
    };
  },
  methods: {
    searchProduct() {
      this.showSearch = false;
      fetch("/api/search/product?q=" + this.search)
        .then(res => res.json())
        .then(res => this.setData(res, "s_product"))
        .catch(err => this.setData(err, "break"));
    },
    searchProductByType(e) {
      this.showSearch = false;
      e = e.toLowerCase();
      fetch("/api/search/productType?q=" + e)
        .then(res => res.json())
        .then(res => this.setData(res, "s_product"))
        .catch(err => this.setData(err, "break"));
    },
    getAllData() {
      this.getCategory();
      this.getBackCategory();
      this.getProduct();
    },
    getCategory() {
      axios
        .get("/api/hcategory")
        .then(response => this.setData(response.data, "hcategory"))
        .catch(err => this.setData(err, "break"));
    },
    getBackCategory() {
      axios
        .get("/api/category")
        .then(response => this.setData(response.data, "category"))
        .catch(err => this.setData(err, "break"));
    },
    getProduct() {
        axios
            .get("/api/" + this.itemType)
            .then(response => this.setData(response.data, "product"))
            .catch(err => this.setData(err, "break"));
    },
    setData(e, f) {
        switch (f) {
            case "hcategory":
                this.categorys = e;
                break;
            case "category":
                this.backCategorys = e;
                break;
            case "product":
                this.products = e;
                break;
            case "s_product":
                this.s_products = e;
                this.showSearch = true;
                // this.search = "";
                break;
            case "break":
                e = "";
                break;
        }
    },
    getUrl(e) {
      if (e != null) {
        window.location.href = "/" + this.itemType + "/" + e;
      }
      return "";
    },
    getLink(e) {
      return "/" + e.toLowerCase();
    },
    getLink2(e) {
      return "/" + this.itemType + "/" + e.toLowerCase();
    },
    fullPath(e) {
      if (e != null) {
        return "/storage/imgs/" + e;
      }
      return "";
    },
    getBackCategorys() {
      return this.backCategorys;
    }
  }
};
</script>
