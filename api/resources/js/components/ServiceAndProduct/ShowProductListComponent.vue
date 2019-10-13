<template>
    <div>
        <div class="container">
        <div class="row">
            <div v-for="item in items" v-bind:key="item.id" class="card col-12 col-md-6 p-3 col-lg-4">
                <div class="card-wrapper">
                <div class="card-img">
                    <img
                        v-lazy="fullPath(item.img.path)"
                    />
                </div>
                <div class="card-box">
                    <h4 class="card-title mbr-fonts-style display-5">{{ item.name }}</h4>
                    <small style="color: rgb(158, 158, 158)">Type: {{ item.type }}</small>
                    <p class="mbr-text mbr-fonts-style display-7">
                    {{ item.description }}
                    </p>
                    <!--Btn-->
                    <div class="mbr-section-btn align-left">
                    <a v-on:click="getUrl(item.id)" class="btn btn-warning-outline display-4">More detail</a>
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
    props:{
        itemType: String
    },
    mounted() {
        this.getAllData();
    },
    data() {
        return {
            backCategorys: [],
            items: [],
        }
    },
    methods: {
        getAllData(){
            this.getCategory();
            this.getProduct();
        },
        getCategory() {
            axios
                .get("/api/category")
                .then(response => this.setData(response.data, "category"))
                .catch(err => this.setData(err, "break"));
        },
        getProduct() {
            axios
                .get("/api/s/three"+this.itemType)
                .then(response => this.setData(response.data, "item"))
                .catch(err => this.setData(err,"break"));;
        },
        setData(e, f) {
            switch (f) {
                case "category":
                    this.backCategorys = e;
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
        renameCategory(e) {
            var i = 0;
            var c = JSON.parse(JSON.stringify(this.getBackCategorys()));
            c = Object.entries(c);
            for (i = 0; i < e.length; i++) {
                c.forEach(b => {
                    if (b[1].id == e[i].type) {
                        e[i].type = b[1].name + " " + b[1].THname;
                    }
                });
            }
            return e;
        },
        getBackCategorys() {
            return this.backCategorys;
        },
        fullPath(e) {
            if (e != null) {
                return "/storage/imgs/" + e;
            }
            return "";
        },
        getUrl(e) {
            if (e != null) {
                window.location.href = "/"+this.itemType+"/" + e;
            }
            return "";
        },
    },
}
</script>
