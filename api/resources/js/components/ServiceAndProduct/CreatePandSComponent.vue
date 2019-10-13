<template>
<div class="container" style="font-family: Kanit;">
    <div>
    <br />
    <h2  class="font-weight-bold">เพิ่มสินค้าและบริการ</h2>
    <br />
    <br />
    <form action="/product">
        <div class="form-group">
            <!-- Name -->
        <label>Name</label>
        <br />
        <input type="text" class="form-control" v-model="name" placeholder="ชื่อสินค้า"/>
            <!-- Price -->
        <label>Price</label>
        <br />
        <input type="number" class="form-control" v-model="price" placeholder="ราคา"/>

        </div>
            <!-- Story -->
        <div class="form-group">
        <label>Story</label>
        <textarea :placeholder="getPlaceHolder('story')" id="story" type="text" class="form-control" v-model="story" size="5000"/>
        <p style="color: gray" v-if="!isOver('story')">You have {{ charactersRemaining }} / 5,000 characters remaining.</p>
        <p style="color: red" v-else class="over">You are {{ charactersOver }} characters over the limit.</p>
        </div>
            <!-- Description -->
        <div class="form-group">
        <label>Description</label>
        <textarea :placeholder="getPlaceHolder('description')" id="description" type="text" class="form-control" v-model="description" size="5000"/>
        <p style="color: gray" v-if="!isOver('description')">You have {{ charactersRemaining2 }} / 5,000 characters remaining.</p>
        <p style="color: red" v-else class="over">You are {{ charactersOver2 }} characters over the limit.</p>
        </div>
            <!-- Video -->
        <label>Video</label>
        <br />
        <input type="text" class="form-control" v-model="video" placeholder="วิดิโอ"/>
            <!-- Type -->
        <br>
        <label>Category</label>
        <div @change="getSubCategory()">
        <select class="form-control" id="categorySelecter" v-model="type">
            <option value="" disabled selected>{{ getPlaceHolder("category") }}</option>
            <option v-for="category in allCategorys" v-bind:key="category.id" :value="getObject(category.name,category.id)">
                {{ category.name }}
            </option>
        </select>
        </div>
        <br>
        <label>Sub Category</label>
        <select class="form-control" id="subCategorySelect" v-model="subType" >
            <option value="" disabled selected>{{ getPlaceHolder("subCategory") }}</option>
            <option v-for="category in subCategorys" v-bind:key="category.id" :value="category.id">
                {{ category.name }}
            </option>
        </select>
        <br />
            <!-- Img_set_id -->
        <br>

        <img-select-component @clicked="onSelectedImage"></img-select-component>

        <div class="form-group d-flex">
        <button class="btn btn-success" v-on:click="addNewProduct_Service()">เพิ่มสินค้า / บริการ</button>
        <button class="btn btn-outline-secondary" style="margin-left:5px" onclick="/product">ยกเลิก</button>
        </div>
    </form>
    </div>
</div>
</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins: [adminMixin],
    beforeMount() {

    },
    mounted() {
        this.getAllCategory();
        // for count character remain
        this.maxCharacters = this.limit;
        this.maxCharacters2 - this.limit2;
        // ---------------------------
    },
    computed: {
        // for count character remain
        charactersRemaining() {
            return this.maxCharacters - this.story.length;
        },
        charactersOver() {
            return this.isOver('story') ? this.stroy.length - this.maxCharacters : 0;
        },
        charactersRemaining2() {
            return this.maxCharacters2 - this.description.length;
        },
        charactersOver2() {
            return this.isOver('description') ? this.description.length - this.maxCharacters2 : 0;
        },
        // ---------------------------
    },
    data() {
        return {
            name: "",
            story: "",
            price: "",
            img_set: "",
            description: "",
            video: "",
            type: "",
            subType: "",
            sets: [],
            set: {
                id: "",
                name: "",
                owner_id: "",
                imgids: [],
                imgid: {
                id: "",
                img_set_id: "",
                path: ""
                }
            },
            // for count character remain
            maxCharacters: 5000,
            limit: 5000,
            maxCharacters2: 5000,
            limit2: 5000,
            // ---------------------------
            type: '',
            allCategorys: [],
            allCategory:{
                id: '',
                name: '',
                head: '',
                THname: '',
                isHead: '',
            },
            subCategorys: [],
            subCategory: {
                id: '',
                name: '',
                head: '',
                THname: '',
                isHead: '',
            },
            oldType: '',
        }
    },
    methods: {
        onSelectedImage (value) {
            this.img_set = value
        },
        addNewProduct_Service() {
            const token = localStorage.getItem('token')
            axios.post("/api/"+this.type.name.toLowerCase()+"?token="+token, {
                name: this.name,
                story: this.story,
                price: this.price,
                description: this.description,
                type: this.subType,
                video: this.video,
                img_set_id: this.img_set,
                owner_id: this.owner_id
            });
        },
        getAllSet() {
            axios.get("/api/img_set").then(response => this.setSetData(response.data));
        },
        customLabel ({ id, name }) {
            return `${id} – ${name}`
        },
        isOver(e) {
            if(e=='story') return this.charactersRemaining < 0;
            else if(e=='description') return this.charactersRemaining2 < 0;
            else return '';
        },
        getPlaceHolder(e){
            switch(e){
                case 'story':
                    return 'ความเป็นมาของสินค้า';
                case 'description':
                    return 'คำอธิบายสินค้า';
                case 'subCategory':
                    return 'โปรดเลือก Category ใหญ่ก่อน';
                case 'category':
                    return 'โปรดเลือก Category';
            }
        },
        getAllCategory() {
            axios.get("/api/hcategory").then(response => this.setAllCategory(response.data));
        },
        setAllCategory(e){
            this.allCategorys = e;
        },
        getSubCategory() {
            if(this.type.id == null) {}
            else if (this.type.id == this.oldType) {}
            else {
                this.oldType = this.type.id;
                axios.get("/api/category/"+this.type.id).then(response => this.setSubCategory(response.data));
            }
        },
        setSubCategory(e){
            if(this.subCategorys == e) {}
            else this.subCategorys = e.subCategory;
        },
        getObject(e, f){
            return {
                name: e,
                id: f
            };
        }
    }
};
</script>
