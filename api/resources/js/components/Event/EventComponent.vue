<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Event Component</div>

          <table>
            <tr v-for="event in events" v-bind:key="event.id">
              <td>{{event.id}}</td>
              <td>{{event.event_name}}</td>
              <td>{{event.event_description}}</td>
              <td>{{event.created_at}}</td>
              <td>{{event.updated_at}}</td>
              <td>
                <img height="200px" :src="fullPath(event.img_set_id)" />
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
            onclick="window.location.href='/event/create'"
            class="btn btn-outline-primary"
          >เพิ่มกิจกรรม</button>
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
  methods: {
    getEventData() {
      axios
        .get("/api/event/")
        .then(response => this.setEventData(response.data));
    },
    setEventData(e) {
      e.forEach(a => {
        axios.get("/api/img/set/" + a.img_set_id).then(response => {
          a.img_set_id = response.data.path;
        });
      });
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
        window.location.href = "/event/" + e + "/edit";
      }
      return "";
    },
    getRemove(id, name) {
      this.confirmBox = "";
      this.$bvModal
        .msgBoxConfirm(
          "Please confirm that you want to delete event " +
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
          if (value) {
            return fetch("/api/event/" + id, {
              method: "DELETE"
            }).then((window.location.href = "/event"));
          } else {
            return "";
          }
        })
        .catch(err => {
          // An error occurred
        });
    }
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
        img_path: ""
      },
      path: [],
      i: 0,
      confirmBox: ""
    };
  }
};
</script>
