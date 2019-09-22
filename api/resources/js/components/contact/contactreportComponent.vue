<template>
    <div>
        <div class="card-header">Contact Component</div>
          <table>
            <tr>
                <td>ID</td>
                <td>Topic</td>
                <td>Details</td>
                <td>Address</td>
                <td>Email</td>
                <td>Country</td>
                <td>Telephone</td>
                <td>created_at</td>
                <td>updated_at</td>
            </tr>
            <tr v-for="contact in contacts" v-bind:key="contact.id">
              <td>{{contact.id}}</td>
              <td>{{contact.topic}}</td>
              <td>{{contact.detail}}</td>
              <td>{{contact.address}}</td>
              <td>{{contact.email}}</td>
              <td>{{contact.country}}</td>
              <td>{{contact.tel}}</td>
              <td>{{contact.created_at}}</td>
              <td>{{contact.updated_at}}</td>
            </tr>
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
        }
    },
    data() {
        return {
            contacts: [],
            contact:{
                id: '',
                detail: '',
                address: '',
                topic: '',
                email: '',
                country_id: '',
                tel: '',
                created_at: '',
                updated_at: '',
            },
        }
    },
}
</script>
