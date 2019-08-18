<template>
<div class="container font-weight-bold">
    <div>
    <br />
    <h2>Edit Event</h2>
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

        <img-select-component :img_set="img_set" @clicked="onSelectedImage"></img-select-component>

        <div class="form-group d-flex">
        <button class="btn btn-success" v-on:click="editEvent">แก้ไขกิจกรรม</button>
        <button class="btn btn-outline-secondary" style="margin-left:5px" onclick="/event">ยกเลิก</button>
        </div>

    </form>
    </div>
</div>
</template>

<script>
export default {
    props:['id'],
    beforeMount() {
        this.getAllSet();
    },
    mounted() {
        this.maxCharacters = this.limit;
        this.getEventData(this.id);
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
        }
    },
    methods: {
        onSelectedImage (value) {
            this.img_set = value
        },
        getEventData(id){
            id = id.replace("'","");
            id = id.replace("\'\'","");
            axios.get('/api/event/'+id).then(response=> this.setEventData(response.data));
        },
        setEventData(e){
            this.name = e.event_name
            this.description = e.event_description
            this.img_set = e.img_set_id
            this.owner_id = e.owner_id
        },
        editEvent() {
            this.id = this.id.replace("'","");
            this.id = this.id.replace("\'\'","");
            axios.put("/api/event/"+this.id,{
                event_name: this.name,
                event_description: this.description,
                img_set_id: this.img_set,
                owner_id: this.owner_id
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
