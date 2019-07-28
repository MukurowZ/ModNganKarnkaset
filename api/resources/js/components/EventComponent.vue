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
                            <td>{{event.img_set_id}}</td>
                        </tr>
                     </table>
                     <button class="btn btn-danger">TEST</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getEventData();
            // this.replaceSetToPath();
        },
        methods:{
            getEventData(){
                axios.get('/api/event').then(response=>this.setEventData(response.data));
            },
            setEventData(e){
                this.events = e;
            },
            getOneImgBySet(index, e){
                axios.get('/api/oneimgset/'+e).then(response=>this.setImgData(response.data));
            },
            setImgData(index, e){
                // console.log(index);
            },
            // replaceSetToPath(e){
            //     console.log(e.lenght);
            //     for(this.i = 0; this.i < this.events.lenght; this.i++){
            //         console.log("ewewe");
            //         axios.get('/api/oneimgset/'+this.events[this.i].img_set_id).
            //             then(setImgData(console.log(this.i,response.data)));
            //     }
            // }
        },
        computed: {
            replaceSetToPath(){
                axios.get('/api/oneimgset/'+this.event.img_set_id).then(response=>this.setImgData(response.data));
            },
            reverseMessage: function () {
                return this.event.event_name.split('').reverse().join('')
            }
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
            }
        },
    }
</script>


