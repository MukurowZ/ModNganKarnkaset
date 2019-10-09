<template>
    <div>
        <div class="box">
            <div style="text-align: center;"><h4>เข้าสู่ระบบ</h4></div>
            <table>
            <tr>
                <td> <label>Email</label> </td>
                <td style="width: 100%;"> <input v-model="email" type="text" class="form-control" placeholder="โปรดใส่อีเมลล์"> </td>

            </tr>
            <tr>
                <td> <label>Password</label> </td>
                <td> <input v-model="password" type="password" class="form-control" placeholder="โปรดใส่รหัสผ่าน"> </td>
            </tr>
            </table>
            <br>
            <!-- <div class="d-flex justify-content-end"  style="margin-right: 15px;"> -->

                <button class="btn btn-primary" type="submit" v-on:click="login">เข้าสู่ระบบ</button>
            <!-- </div> -->
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            email: '',
            password: '',
        }
    },
    methods: {
        login(){
            axios.post("/api/login",{
                email: this.email,
                password: this.password
            });
        },
    },
}
</script>
<style lang="css">
    td{
        padding: 15px;
        text-align: left;
    }
    table{
        table-layout: auto;
    }
    div{
        font-family: Kanit;
    }
    div.box{
        margin-top: 100px;
        margin-left:  auto;
        margin-right: auto;
        margin-bottom: 100px;
        padding: 25px;
        box-shadow: 0px 0px 54px -12px rgba(0,0,0,0.44);
    }
    @media only screen and (max-width: 768px) {
        div.box {
            width: 75%;
        }
    }
    @media only screen and (min-width: 769px) {
        div.box {
            width: 35%;
        }
    }
    label {
        text-align: right;
        clear: both;
        float:left;
        margin-right:15px;
        margin-top:8px;
    }
</style>
