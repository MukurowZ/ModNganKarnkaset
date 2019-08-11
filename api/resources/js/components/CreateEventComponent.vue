<template>
<div class="container font-weight-bold">
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
        <textarea :placeholder="getPlaceHolder()" id="description" type="text" class="form-control" v-model="description" v-on:keyup="updatedCounter()" size="5000"/>
        <p style="color: gray" v-if="!isOver()">You have {{charactersRemaining}} / 5,000 characters remaining.</p>
        <p style="color: red" v-else class="over">You are {{ charactersOver }} characters over the limit.</p>
        </div>
        <div class="form-group">
        <label>SELECT IMG SET:</label>
        <br>
        <div v-for="set in sets" v-bind:key="set.id" class="d-inline-flex" style="margin-leftmargin-left:5px">
                <b-form-group>
                    <label> </label>
                    <div class="border border-success rounded col-xl-12 col-xl-12" >
                        <b-form-radio v-model="img_set" name="img-set" v-bind:value="set.id">{{set.name}}</b-form-radio>
                        <img height="200px" :src="getImg(set.imgid)"/>
                        <br> <p> </p>
                    </div>
                </b-form-group>
            </div>
        </div>
        <div class="form-group d-flex">
        <button class="btn btn-success"  v-on:click="addNewEvent">เพิ่มกิจกรรม</button>
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
        this.maxCharacters = this.limit;
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
        addNewEvent() {
            axios.post("api/event", {
                event_name: this.name,
                event_description: this.description,
                img_set_id: this.img_set,
                owner_id: this.owner_id
            });
        },
        getAllSet() {
            axios.get("/api/img_set").then(response => this.setSetData(response.data));
        },
        setSetData(e) {
            this.sets = e;
        },
        getImg(imgs) {
            if(imgs.length!=0){
                return '/storage/imgs/'+imgs[0].path;
            }
            return '';
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
