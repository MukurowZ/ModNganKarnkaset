<template>
<div style="font-family: Kanit;" class="container font-weight-bold" >
    <div>
    <br />
    <h2>CREATE NEW USER</h2>
    <br />
    <form>
        <div class="form-group">
            <label>USER ID</label>
            <br />
            <input type="text" class="form-control" v-model="userId" :placeholder="getPlaceHolder('ชื่อผู้ใช้')"/>
            <br>
            <label>EMAIL</label>
            <br />
            <input type="text" class="form-control" v-model="email" :placeholder="getPlaceHolder('อีเมลล์')"/>
            <br>
            <label>PASSWORD</label>
            <br />
            <input type="password" class="form-control" v-model="password" :placeholder="getPlaceHolder('รหัสผ่าน')"/>
            <br>
            <label>NAME</label>
            <br />
            <input type="text" class="form-control" v-model="name" :placeholder="getPlaceHolder('ชื่อจริง')"/>
            <br>
            <label>LASTNAME</label>
            <br />
            <input type="text" class="form-control" v-model="lastname" :placeholder="getPlaceHolder('นามสกุล')"/>
            <br>
            <label>PERMISSION</label>
            <br />
            <select class="form-control" id="permissionSelecter" v-model="permission">
                <option value="" disabled selected>{{ getPlaceHolder("โปรดเลือกระดับความสามารถ") }}</option>
                <option v-for="permission in permissions" v-bind:key="permission.id" :value="permission.name">
                    {{ permission.name }}
                </option>
            </select>
            <br>
            <label>DEPARTMENT</label>
            <br />
            <select class="form-control" id="departmentSelecter" v-model="department_id">
                <option value="" disabled selected>{{ getPlaceHolder("โปรดเลือกหน่วยงาน") }}</option>
                <option v-for="department in departments" v-bind:key="department.id" :value="department.id">
                    {{ department.name }}
                </option>
            </select>
        </div>
        <div class="form-group d-flex">
            <button type="submit" class="btn btn-success" v-on:click="addNewUser()">เพิ่มผู้ใช้</button>
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
        this.getAllDepartment();
    },
    data() {
        return {
            userId: '',
            email: '',
            password: '',
            name: '',
            lastname: '',
            department_id: '',
            permission: '',
            permissions: [
                {
                    'id':1,
                    'name':'owner'
                },
                {
                    'id': 2,
                    'name':'admin'
                },
                {
                    'id': 3,
                    'name':'staff'
                },
                {
                    'id': 4,
                    'name': 'premium'
                },
                {
                    'id': 5,
                    'name': 'user'
                }
            ],
            departments: []
        }
    },
    methods: {
        addNewUser() {
            axios.post("/api/user"+"?token="+this.token, {
                userId: this.userId,
                email: this.email,
                password: this.password,
                name: this.name,
                lastname: this.lastname,
                department_id: this.department_id,
                permission: 'admin',
            });
        },
        getPlaceHolder(e){
            return e;
        },
        getUrl(){
            return '/admin/user?token='+this.token;
        },
        getAllDepartment(){
            axios.get("/api/department"+"?token="+this.token).then(response => this.setData(response.data));
        },
        setData(e){
            this.departments = e;
        }
    }
};
</script>
