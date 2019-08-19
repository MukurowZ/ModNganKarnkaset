<template>
<div style="font-family: Kanit;" class="container font-weight-bold" >
    <div>
    <br />
    <h2>CREATE NEW EVENT REPORT</h2>
    <br />
    <br />
    <form action="/event">
        <div class="form-group">
        <div class="form-group">
        <label>EVENT OWNER:</label>
        <br />
        <input type="text" class="form-control" v-model="owner_id" />
        </div>

        <label>EVENT NAME:</label>
        <br />
        <input type="text" class="form-control" v-model="name" placeholder="โปรดระบุชื่อกิจกรรม"/>
        </div>
        <div class="form-group">
        <label>EVENT DESCRIPTION:</label>
        <textarea :placeholder="getPlaceHolder()" id="description" type="text" class="form-control" v-model="description" size="5000"/>
        <p style="color: gray" v-if="!isOver()">You have {{charactersRemaining}} / 5,000 characters remaining.</p>
        <p style="color: red" v-else class="over">You are {{ charactersOver }} characters over the limit.</p>
        </div>

        <img-select-component @clicked="onSelectedImage"></img-select-component>

        <div class="form-group d-flex">
        <button type="submit" class="btn btn-success" v-on:click="addNewEvent()">เพิ่มกิจกรรม</button>
        <button class="btn btn-outline-secondary" style="margin-left:5px" onclick="/event">ยกเลิก</button>
        </div>

    </form>
    </div>
</div>
</template>

<script>
export default {
    beforeMount() {

    },
    mounted() {
        // for count character remain
        this.maxCharacters = this.limit;
        // ---------------------------
    },
    computed: {
        // for count character remain
        charactersRemaining() {
            return this.maxCharacters - this.description.length;
        },
        charactersOver() {
            return this.isOver() ? this.description.length - this.maxCharacters : 0;
        },
        // ---------------------------
    },
    data() {
        return {
            name: "",
            description: "",
            img_set: "",
            owner_id: "",
            // for count character remain
            maxCharacters: 5000,
            limit: 5000,
            // ---------------------------
        }
    },
    methods: {
        onSelectedImage (value) {
            this.img_set = value
        },
        addNewEvent(e) {
            axios.post("/api/event", {
                event_name: this.name,
                event_description: this.description,
                img_set_id: this.img_set,
                owner_id: this.owner_id
            });
        },
        customLabel ({ id, name }) {
            return `${id} – ${name}`
        },
        isOver() {
            return this.charactersRemaining < 0;
        },
        getPlaceHolder(){
            return 'โปรดระบุรายละเอียดกิจกรรม'
        }
    }
};
</script>
