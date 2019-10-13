<template>
<div style="font-family: Kanit; ">
  <b-navbar toggleable="lg" type="light" style="background-color: #c4e6d2">
        <b-navbar-brand href="/" style="font-weight: 450;">มดงานการเกษตร</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
            <b-nav-item href="/">หน้าหลัก <font-awesome-icon :icon="['fas', 'home']" /></b-nav-item>
            <b-nav-item  href="/product">สินค้า <font-awesome-icon :icon="['fas', 'shopping-bag']" /></b-nav-item>
            <b-nav-item  href="/service">บริการ <font-awesome-icon :icon="['fas', 'hand-holding']" /></b-nav-item>
            <b-nav-item href="/contact">ติดต่อเรา <font-awesome-icon :icon="['fas', 'phone']" /> </b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
            <!-- <b-nav-form>
            <b-form-input size="sm" class="mr-sm-2" placeholder="พิมพ์เพื่อค้นหา"></b-form-input>
            <b-button size="sm" class="my-2 my-sm-0" type="submit">ค้นหา <font-awesome-icon :icon="['fas', 'search']" /></b-button>
            </b-nav-form> -->

            <b-nav-item-dropdown disabled text="Lang" left>
                <b-dropdown-item href="#">EN</b-dropdown-item>
                <b-dropdown-item href="#">CN</b-dropdown-item>
                <b-dropdown-item href="#">TH</b-dropdown-item>
            </b-nav-item-dropdown>

            <b-nav-item-dropdown v-if="auth" text="จัดการ" v-on:click="logout">
                <b-dropdown-item v-on:click="url('event')">กิจกรรม</b-dropdown-item>
                <b-dropdown-item v-on:click="url('activity')">ผลงาน</b-dropdown-item>
                <b-dropdown-item v-on:click="url('product')">ผลิตภัณฑ์</b-dropdown-item>
                <b-dropdown-item v-on:click="url('service')">บริการ</b-dropdown-item>
                <b-dropdown-item v-on:click="url('contact')">รายการติดต่อ</b-dropdown-item>
                <b-dropdown-item v-on:click="url('user')">ผู้ใช้</b-dropdown-item>
                <hr align="left" width="75%">
                <b-dropdown-item v-on:click="logout">ออกจากระบบ</b-dropdown-item>
            </b-nav-item-dropdown>
            <!-- <template slot="button-content"><em>User</em></template>
            <b-dropdown-item href="#">Profile</b-dropdown-item>
            <b-dropdown-item href="#">Sign Out</b-dropdown-item> -->
        </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</div>
</template>

<script>
export default {
    mounted() {
        this.getAuthStatus();
    },
    data() {
        return {
            auth: false,
        }
    },
    methods: {
        getAuthStatus(){
            if(localStorage.getItem('token')!=null)
                this.setAuth(true);
            else this.setAuth(false);
        },
        setAuth(e){
            this.auth = e;
        },
        logout(){
            localStorage.removeItem('token');
            localStorage.removeItem('id')
            window.location.href = "/"
        },
        url(e){
            switch(e){
                case "event":
                    window.location.href = "/event/manage"
                    break;
                case "activity":
                    window.location.href = ""
                    break;
                case "product":
                    window.location.href = ""
                    break;
                case "service":
                    window.location.href = ""
                    break;
                case "contact":
                    window.location.href = "/admin/contact"
                    break;
                case "user":
                    window.location.href = ""
                    break;
            }
        }
    },
}
</script>
