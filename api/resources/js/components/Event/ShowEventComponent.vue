<template>
  <div class="container" style="font-family: Kanit;">
    <div>
      <div>
        <div>
          <div class>กิจกรรม</div>
          <div class="card" style="width: 100%;">
            <ul class="list-group list-group-flush">
              <li v-for="event in events" v-bind:key="event.id" class="list-group-item forum-post">
                <div class="column">
                  <div class="row">
                    <div class="col-md-3">
                      <img v-lazy="fullPath(event.img_set_id)" height="200px" />
                    </div>
                    <div class="col-md-9">
                      <h4 class="card-title mb-2">{{event.event_name}}</h4>
                      <p class="card-text">
                        {{event.event_description}}
                        <a
                          style="color: gray"
                          :href="getEventUrl(event.id)"
                        >อ่านต่อ</a>
                      </p>
                    </div>
                    <div class="info-box">
                      <h6>
                        {{event.owner_name}}
                        <br />
                        <small>Created on {{event.created_at}}</small>
                        <br />
                        <small>Last Updated {{event.updated_at}}</small>
                      </h6>
                    </div>
                  </div>
                </div>
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
        a.event_description = a.event_description.substring(0, 300) + "...";
        a.owner_name = a.contentDetail[0].ownerName[0].name;
      });
      this.events = e;
    },
    fullPath(e) {
      if (e != null) {
        return "/storage/imgs/" + e;
      }
      return "";
    },
    getEventUrl(e) {
      if (e != null) {
        return "/event/" + e;
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
        img_path: "",
        owner_name: ""
      },
      path: []
    };
  }
};
</script>
