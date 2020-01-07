<template>
<div style="font-family: Kanit;" class="container font-weight-bold" >
    <div>
    <br />
    <h2>เพิ่มข้อมูลคู่ค้า</h2>
    <br />
    <form>
        <div class="form-group">
            <label>Name</label>
            <br />
            <input type="text" class="form-control" v-model="userId" :placeholder="getPlaceHolder('ชื่อคู่ค้า')"/>
            <br>
            <label>EMAIL</label>
            <br />
            <input type="text" class="form-control" v-model="email" :placeholder="getPlaceHolder('อีเมลล์')"/>
            <br>
            <label>Address</label>
            <br />
            <input type="text" class="form-control" v-model="lastname" :placeholder="getPlaceHolder('ที่อยู่')"/>
            <br>
            <label>Telephone Number</label>
            <vue-tel-input id="tel" @input="telChange" @country-changed="getCountry" v-bind="bindProps"></vue-tel-input>
            <br />
        </div>
        <div class="form-group d-flex">
            <button type="submit" class="btn btn-success" v-on:click="addPartner()">เพิ่มคู่ค้า</button>
            <a class="btn btn-outline-secondary" style="margin-left:5px;" href="../partner">ยกเลิก</a>
        </div>
    </form>
    </div>
</div>
</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins: [adminMixin],
    mounted() {
        this.getAllDepartment();
    },
    data() {
        return {
            
        }
    },
    methods: {
        addPartner() {
            axios.post("/api/partner"+"?token="+this.token, {
                name: this.name,
                email: this.email,
                tel: this.tel,
                address: this.address
            });
            window.location.href = '/partner?token='+this.token;
        },
        getPlaceHolder(e){
            return e;
        },
        getUrl(){

        },
        telChange(tel){
            this.tel = tel.replace(/ /g,"-");
            this.tel = this.tel.replace("-","");
        },
        getCountry(country){
            this.country = country.dialCode
        },
    }
};
</script>
