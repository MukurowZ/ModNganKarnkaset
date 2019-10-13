<template>
<div class="container font-weight-bold" style="font-family: Kanit;">
    <div>
    <br />
    <h2>Edit Event</h2>
    <br />
    <form action="/event" method="post">
        <div class="form-group">
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

        <img-select-component v-if="editId!=null" :editId="editId" @clicked="onSelectedImage"></img-select-component>

        <div class="form-group d-flex">
        <button class="btn btn-success" v-on:click="editEvent">แก้ไขกิจกรรม</button>
        <button class="btn btn-outline-secondary" style="margin-left:5px" onclick="/event">ยกเลิก</button>
        </div>
    </form>
    </div>
</div>

</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
import { itemTypeMixin } from '../mixins/itemType.js'
export default {
    mixins: [adminMixin,itemTypeMixin],
    props:['id'],
    mounted() {
        this.maxCharacters = this.limit;
        this.getEventData(this.id);
        // console.log(this.img_set);
    },
    computed: {
        charactersRemaining() {
            return this.maxCharacters - this.description.length;
        },
        charactersOver() {
                return this.isOver() ? this.description.length - this.maxCharacters : 0;
        },
    },
    data() {
        return {
            name: "",
            description: "",
            img_set: "",
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
            maxCharacters: 5000,
            limit: 5000,
            editId: this.img_set,
        }
    },
    methods: {
        onSelectedImage (value) {
            this.img_set = value
        },
        getEventData(id){
            axios.get('/api/'+this.itemType+'/'+id).then(response=> this.setEventData(response.data));
        },
        setEventData(e){
            this.name = e.event_name
            this.description = e.event_description
            this.img_set = e.img_set_id
            this.owner_id = e.contentDetail[0].owner_id
            this.editId = e.img_set_id
        },
        editEvent() {
            const token = localStorage.getItem('token');
            axios.put("/api/"+this.itemType+'/'+this.id+"?token="+token,{
                event_name: this.name,
                event_description: this.description,
                img_set_id: this.img_set,
                owner_id: this.owner_id,
            });
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
