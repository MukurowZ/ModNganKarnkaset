<template>
    <div style="font-family: Kanit; height:100vh" class="col-8 mx-auto">
        <div>
            <div v-for="partner in partners" v-bind:key="partner.id">
                <div>{{ partner.name }}</div>
                <div>{{ partner.address }}</div>
                <div>{{ partner.email }}</div>
                <div>{{ partner.tel }}</div>
            </div>
        </div>
    </div>
</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins: [adminMixin],
    mounted() {
        this.getPartner();
    },
    data() {
        return {
            partners: [],
            partner:{
                id: "",
                name: "",
                address: "",
                email: "",
                tel: "",
            }
        }
    },
    methods: {
        getPartner() {
            axios.get("/api/partner").then(response => this.setPartnerData(response.data));
        },
        setPartnerData(e){
            this.partners=e;
        }
    },
}
</script>