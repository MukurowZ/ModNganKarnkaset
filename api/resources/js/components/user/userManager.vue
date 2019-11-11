<template>
    <div style="font-family: Kanit;" class="container" >
        <table>
            <tr class="font-weight-bold">
                <td>ชื่อผู้ใช้</td>
                <td>อีเมลล์</td>
                <td>ชื่อจริง</td>
                <td>ระดับการควบคุม</td>
                <td>หน่วยงาน</td>
                <td>แก้ไข</td>
                <td>ลบข้อมูล</td>
            </tr>
            <tr v-for="user in users" v-bind:key="user.id">
                <td>{{ user.userId }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.permission }}</td>
                <td>{{ user.dept.name }}</td>
                <td><button class="btn btn-warning" style="margin-left: 5px" v-on:click="getEditUrl(user.id)">แก้ไขกิจกรรม</button></td>
                <td><b-button class="btn btn-danger" v-on:click="showModal(dept.id,dept.name)">ลบผู้ใช้</b-button></td>
            </tr>
        </table>
    </div>
</template>
<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins: [adminMixin],
    mounted() {
        this.getAllUser();
    },
    data() {
        return {
            users: [],
            user: {
                id: '',
                userId: '',
                email: '',
                password: '',
                name: '',
                lastname: '',
                department_id: '',
                permission: '',
                dept: {
                    id: '',
                    name: '',
                },
            },
        }
    },
    methods: {
        getAllUser(){
            axios.get("/api/user"+"?token="+this.token).then(response => this.setUserData(response.data));
        },
        setUserData(e){
            this.users = e;
        },
        removeUser(e){
            return fetch("/api/user/" + e + "?token="+this.token, {
                method: "DELETE"
            }).then((window.location.href = "../user"));
        },
        showModal(e,f) {
            this.$bvModal
                .msgBoxConfirm(
                "ต้องการที่จะลบหน่วยงาน " + f + " ใช่หรือไม่",
            {
                title: "Please Confirm",
                size: "sm",
                buttonSize: "sm",
                okVariant: "danger",
                okTitle: "YES",
                cancelTitle: "NO",
                cancelVariant: "outline-secondary",
                footerClass: "p-2",
                hideHeaderClose: false,
                centered: false
            })
            .then(value => {
                if(value==true){
                    this.removeUser(e);
                }
            })
            .catch(err => {})
        },
        getEditUrl(e){
            window.location.href = '../user/'+e+'?token='+this.token;
        }
    },
}
</script>
