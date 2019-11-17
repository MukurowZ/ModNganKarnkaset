<template>
    <div class="container" >
        <div class="box ">
            <form @submit="login">
                <div style="text-align: center;"><h4 style="font-family: Kanit;">เข้าสู่ระบบ</h4></div>
                    <br>
                    <b-input-group prepend="Username">
                        <input v-model="email" type="text"
                        class="form-control" autocomplete="email"
                        placeholder="โปรดใส่อีเมลล์">
                    </b-input-group>
                    <br>
                    <b-input-group prepend="Password">
                        <input v-model="password" type="password"
                        class="form-control" autocomplete="password"
                        placeholder="โปรดใส่รหัสผ่าน">
                    </b-input-group>
                <center><span style="color:red" >{{ msg }}</span></center>
                <br>
            </form>
            <b-form-checkbox
                    id="alwaysLogin"
                    v-model="alwaysLogin"
                    name="alwaysLogin"
                    value=true
                    unchecked-value=false
                    >
                    <p style="font-family: Kanit;">จดจำฉันไว้</p>
                </b-form-checkbox>
                <br>
           <button class="btn btn-primary mt-2" style="width: 100%;" type="submit" v-on:click="login()">เข้าสู่ระบบ</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            msg: '',
            encrypt_id: '',
            alwaysLogin: false
        }
    },
    methods: {
        getAlways(){
            return this.alwaysLogin;
        },
        login() {
            let vue = this;
            let alwaysLogin = this.getAlways();
            axios.post("/api/login", {
                email: this.email,
                password: this.password
            })
            .then(function(res) {
                if(alwaysLogin){
                    localStorage.setItem('token', res.data.access_token);
                    localStorage.setItem('id',
                        res.data.access_token.substring(20,35) +
                        res.data.access_token.substring(80,105) +
                        res.data.user_id +
                        res.data.access_token.substring(10,25) +
                        res.data.access_token.substring(125,145)
                    );
                }else{
                    sessionStorage.setItem('token', res.data.access_token);
                    sessionStorage.setItem('id',
                        res.data.access_token.substring(20,35) +
                        res.data.access_token.substring(80,105) +
                        res.data.user_id +
                        res.data.access_token.substring(10,25) +
                        res.data.access_token.substring(125,145)
                    );
                }
                window.location.href = "/";
            })
            .catch(function(err) {
                if(err.response!=null)
                    switch (err.response.status) {
                    case 400:
                        vue.msg = "Incorrect email or password"
                        break;
                    }
            })
        },
    },
    computed: {

    }
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
