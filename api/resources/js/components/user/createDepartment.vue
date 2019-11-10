<template>
<div style="font-family: Kanit;" class="container font-weight-bold" >
    <div>
    <br />
    <h2 style="font-family: Kanit;">เพิ่มหน่วยงานใหม่</h2>
    <br />
    <form>
        <div class="form-group">
        <label>DEPARTMENT NAME:</label>
        <br />
        <input type="text" class="form-control" v-model="name" :placeholder="getPlaceHolder('โปรดระบุชื่อหน่วยงาน')"/>
        </div>
        <div class="form-group d-flex">
            <button type="submit" class="btn btn-success" v-on:click="addNewDepartment()">เพิ่มหน่วยงาน</button>
            <a class="btn btn-outline-secondary" style="margin-left:5px;" :href="getUrl()" >ยกเลิก</a>
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
    },
    data() {
        return {
            name: ""
        }
    },
    methods: {
        addNewDepartment() {
            axios.post("/api/department"+"?token="+this.token, {
                name: this.name,
            });
            location.reload();
        },
        getPlaceHolder(e){
            return e;
        },
        getUrl(){
            return "/admin/user?token="+this.token
        },
        getRedirect(){
            return '/admin/department'+'?token='+token
        }
    }
};
</script>
