<template>
  <div>
    <div class="container">
      <div class="card" style="width: 100%;">
        <ul class="list-group list-group-flush">
          <li
            v-for="event in items"
            v-bind:key="event.id"
            v-on:click="getUrl(event.id)"
            class="list-group-item forum-post"
          >
            <div class="row">
              <div class="col-md-3">
                <img v-lazy="fullPath(event.img_set_id)" height="200px" />
              </div>
              <div class="col-md-8">
                <div class="row">
                  <h4 class="card-title mb-2">{{event.event_name}}</h4>
                </div>
                <div class="row" style="height: 7rem">
                  <p class="card-text event-list-info">
                    {{event.event_description}}
                    <a
                      style="color: gray"
                      :href="getEventUrl(event.id)"
                    >อ่านต่อ</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="row justify-content-end">
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
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    itemType: String
  },
  mounted() {
    this.getAllData();
  },
  data() {
    return {
      backCategorys: [],
      items: []
    };
  },
  methods: {
    getAllData() {
      this.getProduct();
      this.getCategory();
    },
    getCategory() {
      axios
        .get("/api/category")
        .then(response => this.setData(response.data, "category"))
        .catch(err => this.setData(err, "break"));
    },
    getProduct() {
      axios
        .get("/api/s/three" + this.itemType)
        .then(response => this.setData(response.data, "item"))
        .catch(err => this.setData(err, "break"));
    },
    setData(e, f) {
      switch (f) {
        case "category":
          this.backCategorys = e;
          break;
        case "item":
          e = this.itemData(e);
          this.items = e;
          break;
        case "break":
          e = "";
          break;
      }
    },
    itemData(e) {
      e.forEach(a => {
        axios.get("/api/img/set/" + a.img_set_id).then(response => {
          a.img_set_id = response.data.path;
        });
        if (this.itemType == "event")
          a.event_description = a.event_description.substring(0, 300) + "...";
        else {
          a.event_description =
            a.activity_description.substring(0, 300) + "...";
          a.event_name = a.activity_name;
          a.activity_description = null;
          a.activity_name = null;
        }
        a.owner_name = a.contentDetail[0].owner[0].name;
      });
      this.events = e;
      return e;
    },
    fullPath(e) {
      if (e != null) {
        return "/storage/imgs/" + e;
      }
      return "";
    },
    getEventUrl(e) {
      if (e != null) {
        return "/" + this.itemType + "/" + e;
      }
      return "";
    },
    getUrl(e) {
      if (e != null) {
        window.location.href = "/" + this.itemType + "/" + e;
      }
      return "";
    }
  }
};
</script>
