<template>
    <div>
        <div class="card-header">Event Component</div>
          <table>
            <tr v-for="contact in contacts" v-bind:key="contact.id">
              <td>{{contact.id}}</td>
              <td>{{contact.topic}}</td>
              <td>{{contact.detail}}</td>
              <td>{{contact.address}}</td>
              <td>{{contact.email}}</td>
              <td>{{contact.country}}</td>
              <td>{{contact.tel}}</td>
              <td>{{contact.created_at}}</td>
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
            .get("/api/contact/")
            .then(response => this.settContactData(response.data));
        },
        setContactData(e) {

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
                create_at: '',
                update_at: '',
            },
        }
    },
}
</script>
