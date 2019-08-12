<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="">กิจกรรม</div>

                    <table>
                        <tr>
                            <th>IMAGE</th>
                            <th>NAME</th>
                            <th>DESCRIPTION</th>
                            <th>CREATED</th>
                        </tr>
                        <tr v-for="event in events" v-bind:key="event.id">
                            <td> <img height="200px" :src="fullPath(event.img_set_id)" /> </td>
                            <td>{{event.event_name}}</td>
                            <td>{{event.event_description}}</td>
                            <td>{{event.created_at}}</td>
                        </tr>
                     </table>
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
            getEventData(){ axios.get('/api/event/').then(response=>this.setEventData(response.data)); },
            setEventData(e){
                e.forEach(a => {axios.get('/api/img/set/'+a.img_set_id).then(response => {a.img_set_id = response.data.path} )});
                this.events = e;
            },
            fullPath(e) {
                if(e!=null){ return '/storage/imgs/'+e }
                return '';
            },
            getEditUrl(e){
                if(e!=null){ window.location.href='/event/'+e+'/edit' }
                return '';
            },
            getRemove(id,name){
                this.confirmBox = '';
                this.$bvModal.msgBoxConfirm('Please confirm that you want to delete event '+ name + ' from event?', {
                    title: 'Please Confirm',
                    size: 'sm',
                    buttonSize: 'sm',
                    okVariant: 'outline-secondary',
                    okTitle: 'YES',
                    cancelTitle: 'NO',
                    cancelVariant: 'danger',
                    footerClass: 'p-2',
                    hideHeaderClose: false,
                    centered: false
                }).then(value => {
                    this.confirmBox = value
                    if(value){
                        return fetch('/api/event/' + id, {
                            method: 'DELETE'
                        }).then(window.location.href='/event');
                    }else{
                        return '';
                    }
                }).catch(err => {
                    // An error occurred
                })
            },
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
                confirmBox: '',
            }
        },
    }
</script>
