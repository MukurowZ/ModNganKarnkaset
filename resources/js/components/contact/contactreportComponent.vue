<template>
  <div class="container">
    <div class="card-header">Contact Component</div>
    <table class="table">
      <thead ead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Topic</th>
          <th scope="col-4">Details</th>
          <th scope="col">Address</th>
          <th scope="col">Email</th>
          <th scope="col">Country</th>
          <th scope="col">Telephone</th>
          <th scope="col">created_at</th>
          <th scope="col">updated_at</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts" v-bind:key="contact.id">
          <td>{{contact.id}}</td>
          <td>{{contact.topic}}</td>
          <td>{{contact.details}}</td>
          <td>{{contact.address}}</td>
          <td>{{contact.email}}</td>
          <td>{{contact.country_id}}</td>
          <td>
            <a :href="getTel(contact.tel)">{{contact.tel}}</a>
          </td>
          <td>{{contact.created_at}}</td>
          <td>{{contact.updated_at}}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getContactLog();
  },
  methods: {
    getContactLog() {
      axios
        .get("/api/contact")
        .then(response => this.setContactData(response.data));
    },
    setContactData(e) {
      this.contacts = e;
    },
    getTel(e) {
      return "tel:" + e;
    }
  },
  data() {
    return {
      contacts: [],
      contact: {
        id: '',
        detail: '',
        address: '',
        topic: '',
        email: '',
        country_id: '',
        tel: '',
        created_at: '',
        updated_at: ''
      }
    };
  }
};
</script>
