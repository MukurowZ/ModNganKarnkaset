<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ upperType }} Component</div>

          <table>
            <tr v-for="event in events" v-bind:key="event.id">
              <td>{{event.id}}</td>
              <td>{{event.event_name}}</td>
              <td>{{event.event_description}} <span style="color:red" v-if="event.longDescription">...มีต่อ</span> </td>
              <td>{{event.created_at}}</td>
              <td>{{event.updated_at}}</td>
              <td>
                <img height="200px" :src="fullPath(event.img.path)" />
              </td>
              <td>
                <button
                  class="btn btn-warning"
                  style="margin-left: 5px"
                  v-on:click="getEditUrl(event.id)"
                >แก้ไขกิจกรรม</button>
              </td>
              <td>
                <b-button
                  v-b-modal.confirmDel
                  class="btn btn-danger"
                  style="margin-left: 5px;"
                  v-on:click="getRemove(event.id,event.event_name)"
                >ลบกิจกรรม</b-button>
              </td>
            </tr>
          </table>
          <button
            v-on:click="addPage"
            class="btn btn-outline-primary"
          >เพิ่มกิจกรรม</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
import { itemTypeMixin } from '../mixins/itemType.js'
export default {
    mixins: [adminMixin,itemTypeMixin],
    mounted() {
        this.getEventData();
    },
    methods: {
        getEventData() {
            axios
                .get("/api/"+this.itemType)
                .then(response => this.setEventData(response.data));
        },
        setEventData(e) {
            var i = 0;
            if(this.itemType=="event")
                for(i=0; i<e.length; i++){
                    if(e[i].event_description.length>200){
                        e[i].event_description = e[i].event_description.substring(0,201);
                        e[i].longDescription = true;
                    }else e[i].longDescription = false;
                }
            else
                for(i=0; i<e.length; i++){
                    if(e[i].activity_description.length>200){
                        e[i].event_description = e[i].activity_description.substring(0,201);
                        e[i].event_name = e[i].activity_name;
                        e[i].activity_description = null;
                        e[i].activity_name = null;
                        e[i].longDescription = true;
                    }else e[i].longDescription = false;
                }
            this.events = e;
        },
        fullPath(e) {
            if (e != null) {
                return "/storage/imgs/" + e;
            }
            return "";
        },
        getEditUrl(e) {
            if (e != null) {
                window.location.href = "/admin/"+ this.itemType +"/" + e + "/edit"+"?token="+this.token;
            }
            return "";
        },
        getRemove(id, name) {
            this.confirmBox = "";
            this.$bvModal
                .msgBoxConfirm(
                "Please confirm that you want to delete "+ this.itemType +
                    name +
                    " from event?",
            {
                title: "Please Confirm",
                size: "sm",
                buttonSize: "sm",
                okVariant: "outline-secondary",
                okTitle: "YES",
                cancelTitle: "NO",
                cancelVariant: "danger",
                footerClass: "p-2",
                hideHeaderClose: false,
                centered: false
            }
            )
            .then(value => {
            this.confirmBox = value;
            if (value==true) {
                return fetch("/api/"+ this.itemType +"/" + id+this.id+"?token="+this.token, {
                method: "DELETE"
                }).then((window.location.href = "../"+ this.itemType));
            } else {
                return "";
            }
            })
            .catch(err => {
            // An error occurred
            });
        },
        addPage(){
            window.location.href='/admin/'+this.itemType+'/create'+'?token='+this.token
        },
    },
    data() {
        return {
            events: [],
            event: {
                id: "0",
                event_name: "",
                event_description: "",
                img_set_id: "",
                created_at: "",
                update_at: "",
                img_path: "",
                contentDetail: {
                    id: '',
                    owner_id: '',
                    type: '',
                    owner_name: '',
                },
                img: {
                    id: "",
                    img_set_id: "",
                    path: "",
                }
            },
            path: [],
            i: 0,
            confirmBox: ""
        };
    }
};
</script>
