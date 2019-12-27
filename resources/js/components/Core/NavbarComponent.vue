<template>
<div style="font-family: Kanit; ">
    <Loading :active.sync="isLoading" :is-full-page="fullPage" :color="'#008000'" :loader="'dots'"></Loading>
    <b-navbar toggleable="lg" :sticky="getTrue()" type="light" style="background-color: #c4e6d2">
        <b-navbar-brand href="/" style="font-weight: 450;">มดงานการเกษตร</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
            <b-nav-item href="/">หน้าหลัก <font-awesome-icon :icon="['fas', 'home']" /></b-nav-item>
            <b-nav-item  href="/product">สินค้า <font-awesome-icon :icon="['fas', 'shopping-bag']" /></b-nav-item>
            <b-nav-item  href="/service">บริการ <font-awesome-icon :icon="['fas', 'hand-holding']" /></b-nav-item>
            <b-nav-item  href="/event">กิจกรรม <font-awesome-icon :icon="['fas', 'calendar-alt']" /></b-nav-item>
            <b-nav-item  href="/activity">ผลงาน <font-awesome-icon :icon="['fas', 'globe-asia']" /></b-nav-item>
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
            <v-avatar color="teal" size="48">
                <span class="white--text headline">EEE</span>
            </v-avatar>
            <b-nav-item-dropdown right v-if="auth" text="จัดการ" v-on:click="logout">
                <b-dropdown-item v-on:click="url('event')">กิจกรรม</b-dropdown-item>
                <b-dropdown-item v-on:click="url('activity')">ผลงาน</b-dropdown-item>
                <b-dropdown-item v-on:click="url('product')">ผลิตภัณฑ์</b-dropdown-item>
                <b-dropdown-item v-on:click="url('service')">บริการ</b-dropdown-item>
                <b-dropdown-item v-on:click="url('contact')">รายการติดต่อ</b-dropdown-item>
                <b-dropdown-item v-on:click="url('user')">ผู้ใช้</b-dropdown-item>
                <hr align="right" width="75%">

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
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins: [adminMixin],
    mounted() {
        this.doAjax();
        this.getAuthStatus();
    },
    data() {
        return {
            auth: false,
            isLoading: false,
            fullPage: true
        }
    },
    methods: {
        getAuthStatus(){
            if(localStorage.getItem('token')!=null || sessionStorage.getItem('token')!=null)
                this.setAuth(true);
            else this.setAuth(false);
        },
        setAuth(e){
            this.auth = e;
        },
        logout(){
            if(localStorage.getItem('token')!=null){
                localStorage.removeItem('token');
                localStorage.removeItem('id');
            }else{
                sessionStorage.removeItem('token');
                sessionStorage.removeItem('id');
            }
            window.location.href = "/";
        },
        url(e){
            switch(e){
                case "event":
                    window.location.href = "/admin/event"+"?token="+this.token
                    break;
                case "activity":
                    window.location.href = "/admin/activity"+"?token="+this.token
                    break;
                case "product":
                    window.location.href = "/admin/product"+"?token="+this.token
                    break;
                case "service":
                    window.location.href = "/admin/service"+"?token="+this.token
                    break;
                case "contact":
                    window.location.href = "/admin/contact"+"?token="+this.token
                    break;
                case "user":
                    window.location.href = "/admin/user"+"?token="+this.token
                    break;
            }
        },
        getTrue(){
            return false;
        },
        doAjax() {
            this.isLoading = true;
            setTimeout(() => {
                this.isLoading = false
            },3000)
        },
    },
}
</script>
