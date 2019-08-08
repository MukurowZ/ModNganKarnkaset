<template>
<div class="container">
    <div>
    <br />
    <h2>CREATE NEW EVENT REPORT</h2>
    <br />
    <br />
    <form action="/event">
        <div class="form-group">
        <label>EVENT NAME:</label>
        <br />
        <input type="text" class="form-control" v-model="name" />
        </div>
        <div class="form-group">
        <label>EVENT DESCRIPTION:</label>
        <br />
        <input type="text" class="form-control" v-model="description" />
        </div>
        <div class="form-group">
        <label>SELECT IMG SET:</label>
        <table class="table .table-borderless">
            <thead>
            <tr>
                <th>Select Status</th>
                <th>SET ID</th>
                <th>SET OWNER ID</th>
                <th>PATH</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="set in sets" v-bind:key="set.id">
                <b-form-group>
                <td><b-form-radio v-model="selected" name="img-radios" v-bind:value="set.id">{{set.name}}</b-form-radio></td>
                </b-form-group>
                <td>{{set.id}}</td>
                <td>{{set.owner_id}}</td>
                <!-- <td>{{set.imgid}}</td> -->
                <td> <img width="200px" height="200px" :src="getImg(set.imgid)"/>  </td>
            </tr>

            </tbody>
        </table>
        </div>
        <div class="form-group">
        <label>EVENT DESCRIPTION:</label>
        <br />
        <input type="text" class="form-control" v-model="owner_id" />
        </div>
        <div class="form-group">
        <button class="btn btn-primary" v-on:click="addNewEvent">CREATE EVENT</button>
        </div>
    </form>
    </div>
</div>
</template>

<script>
export default {
    beforeMount() {
        this.getAllSet();
        // this.getImgBySet();
    },
    mounted() {

    },
    computed: {

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
        }
        };
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
            axios
                .get("/api/img_set")
                .then(response => this.setSetData(response.data));
        },
        setSetData(e) {
            this.sets = e;
        },
        setImgData(e) {
            this.imgids = e;
        },
        getImgBySet() {
            // axios
            //     .get("/api/img_set/", 1)
            //     .then(response => console.log(response.data));
        },
        getImg(imgs) {
            if(imgs.length!=0){
                return '/storage/imgs/'+imgs[0].path;
            }
            return '';
        }

    }
};
</script>
