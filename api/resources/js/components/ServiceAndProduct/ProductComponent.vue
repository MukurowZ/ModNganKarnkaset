<template>
  <div style="font-family: Kanit;">
    <br/>
    <div class="mx-auto">
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
                <b-form-input size="sm" class="mr-sm-2" placeholder="ค้นหาสินค้า"></b-form-input>
                <b-button size="sm" class="my-2 my-sm-0" type="submit">
                    ค้นหา
                <font-awesome-icon :icon="['fas', 'search']" />
                </b-button>
            </b-nav-form>
            </b-navbar-nav>
        </b-collapse>
        </b-navbar>

        <div>
            <div class="col mx-md-4 mx-auto">
                <div class="align-self-start p-2 bd-highlight rounded-bottom border border-primary">
                    <div class="list-group">
                        <div v-for="category in categorys" v-bind:key="category.id">
                        <a :href="getLink(category.name)" class="list-group-item list-group-item-action active">
                            {{category.name}}
                            <a :href="getLink2(category.name)" class="list-group-item list-group-item-action active">
                        </a>
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="col mx-md-12 mx-auto">
                <div class="align-self-start p-2 bd-highlight rounded-bottom border border-success">
                    <div v-for="product in products" v-bind:key="product.id" class="d-flex flex-wrap">
                        <div class="card my-4 col-md-3 product-card">
                        <img v-lazy="fullPath(product.img_set_id)" class="card-img-top mx-auto mt-2" alt="product img" />
                        <div class="card-body">
                        <h5 class="card-title">
                            Product Name{{ product.name }}
                            <br />
                            <small style="color: rgb(158, 158, 158)">Catagory: {{ category.name }}</small>
                            <br>
                            <small style="color: rgb(158, 158, 158)">Type: {{ category.type }}</small>
                        </h5>
                        <p class="card-text">
                            {{ product.description }}
                        </p>
                        <div class="price">
                            {{ product.price }}
                        </div>
                        <a v-on:click="getUrl(product.id)" class="btn btn-primary">More detail</a>
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
        owner_id: ""
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
        owner_id: ""
      }
    };
  },
  methods: {
    getCategory() {
      axios
        .get("/api/hcategory")
        .then(response => this.setData(response.data, "category"));
    },
    getProduct() {
      axios
        .get("/api/product")
        .then(response => this.setData(response.data, "product"));
    },
    setData(e, f) {
      switch (f) {
        case "category":
          this.categorys = e;
          break;
        case "product":
          e.forEach(a => {
            axios.get("/api/img/set/" + a.img_set_id).then(response => {
              a.img_set_id = response.data.path;
            });
          });
          this.products = e;
          break;
      }
    },
    getUrl(e){
        if (e!=null){
            window.location.href = "/product/"+e;
        }
        return "";
    },
    getSubCategory(e) {},
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
