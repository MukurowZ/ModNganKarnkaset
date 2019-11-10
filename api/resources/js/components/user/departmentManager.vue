<template>
    <div class="container">
        <br>
        <h1 style="font-family: Kanit;">จัดการหน่วยงาน</h1>
        <table>
            <tr>
                <td>ชื่อ</td>
                <td>ชื่อที่ต้องการจะแก้ไข</td>
                <td>แก้ไข</td>
                <td>ลบ</td>
            </tr>
            <tr v-for="(dept,i) in departments" v-bind:key="dept.id">
                <td>{{ dept.name }}</td>
                <td><input type="text" v-model="departments[i].edit_name"></td>
                <td><button class="btn btn-success" v-on:click="editDepartment(dept.id,i)">แก้ไข</button></td>
                <td><b-button class="btn btn-danger" v-on:click="showModal(dept.id,dept.name)">ลบหน่วยงาน</b-button></td>
            </tr>
        </table>
    </div>
</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins: [adminMixin],
    mounted() {
        this.getAllDepartment();
    },
    data(){
        return{
            departments: [],
            edit_name: '',
        }
    },
    methods: {
        getAllDepartment(){
            axios.get("/api/department"+"?token="+this.token).then(response => this.setData(response.data));
        },
        setData(e){
            this.departments = e;
        },
        editDepartment(e,i){
            axios.put("/api/department/"+e+"?token="+this.token,{
                name: this.departments[i].edit_name,
            });
            location.reload();
        },
        removeDepartment(e){
            axios.delete("/api/department/"+e+"?token="+this.token);
            location.reload();
        },
        showModal(e,f) {
            this.$bvModal.msgBoxOk('ยืนยันที่จะลบหน่วยงาน ' + f)
            .then(value => {
                if(value){
                    this.removeDepartment(e);
                }
            })
            .catch(err => {})
        },
    },
}
</script>
