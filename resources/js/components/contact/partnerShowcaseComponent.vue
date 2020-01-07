<template>
    <div style="font-family: Kanit; height:100vh" class="col-8 mx-auto">
        <div v-for="partner in partners" v-bind:key="partner.id">
            <div class="font-weight-bold">{{ partner.name }}</div>
            <div>ที่อยู่</div>
            <div>{{ partner.address }}</div>
            <div>Email: {{ partner.email }}</div>
            <div>Tel: {{ partner.tel }}</div>
        </div>
    </div>
</template>

<script>
export default {
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