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
            <br />
            <table>
                <tr>
                <th></th>
                <th></th>
                </tr>
                <tr v-for="set in sets" v-bind:key="set.id">
                <td>
                    <div><input type="checkbox" value="foo" v-model="isChecked">
                    <span>{{set.name}}</span>
                    </div>



                </td>
                <td>{{set.name}}</td>

                </tr>
            </table>
            <input type="text" class="form-control" v-model="img_set" />
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
    mounted() {
        this.getAllSet();
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
        }
    }
};
</script>
