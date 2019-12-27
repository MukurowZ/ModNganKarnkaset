<template>
<div style="font-family: Kanit;" class="container font-weight-bold" >
    <div>
    <br />
    <h2 style="font-family: Kanit;">เพิ่มหมวดหมู่สินค้าใหม่</h2>
    <br />
    <form>
        <div class="form-group">
            <div class="form-group d-flex">
                <select class="form-control mr-auto p-2 bd-highlight" id="categorySelecter" v-model="type">
                    <option value="" disabled selected>{{ getPlaceHolder("โปรดเลือกประเภท") }}</option>
                    <option value="1">Product</option>
                    <option value="2">Service</option>
                </select>
                <input type="text" class="form-control" v-model="name" :placeholder="getPlaceHolder('โปรดระบุชื่อหมวดหมู่ในภาษาอังกฤษ')"/>
                <input type="text" class="form-control" v-model="THname" :placeholder="getPlaceHolder('โปรดระบุชื่อหมวดหมู่ในภาษาไทย')"/>
            </div>
        </div>
        <div class="form-group d-flex">
            <button type="submit" class="btn btn-success" v-on:click="addNewDepartment()">เพิ่มหน่วยงาน</button>
        </div>
    </form>
    </div>
</div>
</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins: [adminMixin],
    data() {
        return {
            name: "",
            THname: "",
            type: "โปรดเลือกประเภท",
            head: "",
        }
    },
    methods: {
        addNewDepartment() {
            if(type=="1") this.head="1" // Product
            else this.head="2"          // Service
            axios.post("/api/category"+"?token="+this.token, {
                name: this.name,
                THname: this.THname,
                head: this.head
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
            return '/admin/department'+'?token='+this.token
        }
    }
};
</script>
