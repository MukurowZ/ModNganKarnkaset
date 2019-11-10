<template>
    <div>
        <br>
        <center>
            <button class="btn btn-success" v-on:click="addNewUser()">จัดการผู้ดูแล</button>
            <br>
            <br>
            <button class="btn btn-primary" v-on:click="addNewDepartment()">จัดการหน่วยงาน</button>
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
            window.location.href = "/admin/user"+"?token="+this.token
        },
        addNewDepartment(){
            window.location.href = "/admin/department"+"?token="+this.token
        }
    },
}
</script>
