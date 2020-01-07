<template>
    <div style="font-family: Kanit; height:100vh" class="col-8 mx-auto">
        <div v-if="partners==[]">
            <div v-for="partner in partners" v-bind:key="partner.id">
                <div>{{ partner.name }}</div>
                <div>{{ partner.address }}</div>
                <div>{{ partner.email }}</div>
                <div>{{ partner.tel }}</div>
            </div>
        </div>
        <div v-else class="d-flex justify-content-center align-middle">
                <br>
                <br>
                <label>ยังไม่มีคู่ค้าในขณะนี้</label>
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