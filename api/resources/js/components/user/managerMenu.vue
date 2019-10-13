<template>
    <div>
        <br>
        <center>
            <button class="btn btn-success" v-on:click="addNewUser()">เพิ่มผู้ใช้</button>
            <br>
            <br>
            <button class="btn btn-primary" v-on:click="addNewDepartment()">เพิ่มหน่วยงาน</button>
        </center>
        <br>
    </div>
</template>
<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins:[adminMixin],
    methods: {
        addNewUser(){
            window.location.href = "/admin/user/create"+"?token="+this.token
        },
        addNewDepartment(){
            window.location.href = "/admin/department/create"+"?token="+this.token
        }
    },
}
</script>
