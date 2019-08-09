<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Event Component</div>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>DESCRIPTION</th>
                            <th>CREATED</th>
                            <th>UPDATED</th>
                            <th>IMG_SET_ID</th>
                        </tr>
                        <tr v-for="event in events" v-bind:key="event.id">
                            <td>{{event.id}}</td>
                            <td>{{event.event_name}}</td>
                            <td>{{event.event_description}}</td>
                            <td>{{event.created_at}}</td>
                            <td>{{event.updated_at}}</td>
                            <td> <img height="200px" :src="fullPath(event.img_set_id)" /> </td>
                        </tr>
                     </table>
                     <button onclick="window.location.href='/create-event'" class="btn btn-outline-primary">เพิ่มกิจกรรม</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getEventData();
        },
        methods:{
            getEventData(){
                axios.get('/api/event').then(response=>this.setEventData(response.data));
            },
            setEventData(e){
                e.forEach(a => {
                    axios.get('/api/img/set/'+a.img_set_id).then(response => {a.img_set_id = response.data.path} )
                });
                this.events = e;
            },
            fullPath(e) {
                if(e!=null){
                    return '/storage/imgs/'+e;
                }
                return '';
            }
        },
        computed: {

        },
        data(){
            return{
                events:[],
                event:{
                    id:'0',
                    event_name:'',
                    event_description:'',
                    img_set_id:'',
                    created_at:'',
                    update_at:'',
                    img_path:''
                },
                path:[],
                i: 0,
            }
        },
    }
</script>


