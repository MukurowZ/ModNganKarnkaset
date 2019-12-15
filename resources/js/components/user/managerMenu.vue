<template>
    <div class="container" >
        <br>
        <button ref="user" class="btn btn-success" v-on:click="addNewUser()">จัดการผู้ใช้</button>
        <button ref="dept" class="btn btn-success" v-on:click="addNewDepartment()">จัดการหน่วยงาน</button>
    </div>
</template>
<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins:[adminMixin],
    mounted() {
        this.changeButtonClass();
    },
    methods: {
        addNewUser(){
            window.location.href = "/admin/user"+"?token="+this.token
        },
        addNewDepartment(){
            window.location.href = "/admin/department"+"?token="+this.token
        },
        changeButtonClass(){
            this.type = window.location.pathname;
            var n = this.type.indexOf("user");
            if(n>0) this.$refs['user'].className = this.clicked_class;
            else {
                n = this.type.indexOf("department");
                if(n>0) this.$refs['dept'].className = this.clicked_class;
            }
        }
    },
    data() {
        return {
            type: '',
            clicked_class: 'btn btn-outline-secondary',
        }
    },
}
</script>
