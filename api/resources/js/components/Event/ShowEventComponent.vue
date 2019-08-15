<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class>กิจกรรม</div>

          <!-- <table class="card" style="width: 100%;">
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
          </table>-->

          <div class="card" style="width: 100%;">
            <ul class="list-group list-group-flush">
              <li class="list-group-item forum-post" v-for="event in events" v-bind:key="event.id">
                <img height="200px" :src="fullPath(event.img_set_id)" />
                <h4 class="card-title mb-2">{{event.event_name}}</h4>
                <p class="card-text">{{event.event_description}}</p>
                <small style="text-align: right;">{{event.created_at}}</small>
              </li>
            </ul>
          </div>
          
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
      path: []
    };
  }
};
</script>
