<template>
<div class="container" style="font-family: Kanit;">
    <div>
    <br />
    <h2  class="font-weight-bold">เพิ่มสินค้าและบริการ</h2>
    <br />
    <br />
    <form action="/product">
        <div class="form-group">
        <div class="form-group">
            <!-- Owner -->
        <label>Owner:</label>
        <br />
        <input type="text" class="form-control" v-model="owner_id" />
        </div>
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
        <label>Type</label>
        <br />
        <input type="text" class="form-control" v-model="type" placeholder="ชนิดของสินค้า/บริการ"/>
            <!-- Img_set_id -->
        <br>
        <img-select-component @clicked="onSelectedImage"></img-select-component>

        <div class="form-group d-flex">
        <button class="btn btn-success"  v-on:click="addNewEvent()">เพิ่มสินค้า / บริการ</button>
        <button class="btn btn-outline-secondary" style="margin-left:5px" onclick="/event">ยกเลิก</button>
        </div>
    </form>
    </div>
</div>
</template>

<script>
export default {
    beforeMount() {
        this.getAllSet();
    },
    mounted() {
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
            img_set_id: "",
            description: "",
            video: "",
            type: "",
            owner_id: "",
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
        }
    },
    methods: {
        onSelectedImage (value) {
            this.img_set = value
        },
        addNewEvent() {
            axios.post("/api/event", {
                event_name: this.name,
                event_description: this.description,
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
            if(e=='story') return 'ความเป็นมาของสินค้า';
            else if(e=='description') return 'คำอธิบายสินค้า';
        },
    }
};
</script>
