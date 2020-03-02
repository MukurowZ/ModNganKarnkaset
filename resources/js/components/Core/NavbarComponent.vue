<template>
<div style="font-family: Kanit;">
    <DocumentDialog v-if="showImage" @close="toggleDialog(null, null)" :showCert="showImage"></DocumentDialog>
    <Loading :active.sync="isLoading" :is-full-page="fullPage" :color="'#008000'" :loader="'dots'"></Loading>
    <b-navbar toggleable="lg" :sticky="false" type="light" style="background-color: #c4e6d2">
        <b-navbar-brand href="/" style="font-weight: 450;">มดงานการเกษตร</b-navbar-brand>

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
                <b-nav-item href="/">หน้าหลัก <font-awesome-icon :icon="['fas', 'home']" /></b-nav-item>
                <b-nav-item href="/product">สินค้า <font-awesome-icon :icon="['fas', 'shopping-bag']" /></b-nav-item>
                <b-nav-item href="/service">บริการ <font-awesome-icon :icon="['fas', 'hand-holding']" /></b-nav-item>
                <b-nav-item href="/event">กิจกรรม <font-awesome-icon :icon="['fas', 'calendar-alt']" /></b-nav-item>
                <b-nav-item href="/activity">ผลงาน <font-awesome-icon :icon="['fas', 'globe-asia']" /></b-nav-item>
                <b-nav-item href="/contact">ติดต่อเรา <font-awesome-icon :icon="['fas', 'phone']" /> </b-nav-item>
                <b-nav-item href="/partner">คู่ค้า <font-awesome-icon :icon="['fas', 'handshake']" /> </b-nav-item>
                <div @mouseover="showDocument = true" @mouseleave="showDocument = false">
                <b-nav-item>
                    เอกสารรับรองสินค้า/บริการ <font-awesome-icon :icon="['fas', 'file']"/>
                    <div v-show="showDocument" class="documentMenu inline-grid border border-success">
                        <div @mouseover="showResult = true" @mouseleave="showResult = false" class="mb-2 menu-item justify-content-between">
                            <font-awesome-icon :icon="['fas', 'dot-circle']" class="ml-1" style="font-size: 10px"></font-awesome-icon>
                            <span>ผลทดสอบผลิตภัณฑ์</span>
                            <font-awesome-icon :icon="['fas', 'angle-right']" style="font-size: 10px" class="mr-1"/>
                            <div v-show="showResult" class="resultMenu menu-item inline-grid border border-success">
                                <div class="menu-item mx-2"  v-for="(item, i) in files" v-bind:key="i">
                                    <font-awesome-icon :icon="['fas', 'file-image']" style="font-size: 10px" class="mr-1"/>
                                    <span @click="toggleDialog(item.lang, item.no)">{{ item.msg }}</span>
                                </div>
                            </div>
                        </div>
                        <div @mouseover="showCert = true" @mouseleave="showCert = false" class="mb-2">
                            <font-awesome-icon :icon="['fas', 'dot-circle']" class="ml-1" style="font-size: 10px"></font-awesome-icon>
                            ใบอนุญาต
                            <font-awesome-icon :icon="['fas', 'angle-right']" style="font-size: 10px" class="mr-1"/>
                            <div v-show="showCert" class="certMenu inline-grid border border-success">
                                <div class="menu-item mx-2">
                                    <font-awesome-icon :icon="['fas', 'file-image']" style="font-size: 10px" class="mr-1"/>
                                    <span @click="toggleDialog('TH', 3)">อนุญาตบินโดรน</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <font-awesome-icon :icon="['fas', 'file-image']" style="font-size: 10px" class="ml-1"/>
                            <span @click="toggleDialog('TH', 4)">กองวิจัยพัฒนาปัจจัยการผลิตทางการเกษตร</span>
                        </div>
                    </div>
                </b-nav-item>
                </div>
            </b-navbar-nav>
            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown disabled text="Lang" left>
                    <b-dropdown-item href="#">EN</b-dropdown-item>
                    <b-dropdown-item href="#">CN</b-dropdown-item>
                    <b-dropdown-item href="#">TH</b-dropdown-item>
                </b-nav-item-dropdown>
                <b-nav-item-dropdown right v-if="auth" text="จัดการ">
                    <b-dropdown-item v-on:click="url('event')">กิจกรรม</b-dropdown-item>
                    <b-dropdown-item v-on:click="url('activity')">ผลงาน</b-dropdown-item>
                    <b-dropdown-item v-on:click="url('product')">ผลิตภัณฑ์</b-dropdown-item>
                    <b-dropdown-item v-on:click="url('service')">บริการ</b-dropdown-item>
                    <b-dropdown-item v-on:click="url('category')">หมวดหมู่สินค้า/บริการ</b-dropdown-item>
                    <b-dropdown-item v-on:click="url('contact')">รายการติดต่อ</b-dropdown-item>
                    <b-dropdown-item v-on:click="url('partner')">คู่ค้า</b-dropdown-item>
                    <b-dropdown-item v-on:click="url('department')">หน่วยงาน</b-dropdown-item>
                    <b-dropdown-item v-on:click="url('user')">ผู้ใช้</b-dropdown-item>
                    <hr align="right" width="100%">
                    <b-dropdown-item v-on:click="logout">ออกจากระบบ</b-dropdown-item>
                </b-nav-item-dropdown>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</div>
</template>

<script>
import DocumentDialog from '../Document/DocumentDialog.vue';
import { adminMixin } from '../mixins/adminMixin.js';

export default {
    mixins: [adminMixin],
    components: {
        DocumentDialog,
    },
    mounted() {
        this.doAjax();
        this.getAuthStatus();
    },
    data() {
        return {
            auth: false,
            isLoading: false,
            fullPage: true,
            showDocument: false,
            showImage: null,
            showResult: false,
            showCert: false,
            files: [
                { msg: 'ทดสอบแร่ธาตุ น้ำจุลินทรีย์มูลค้างคาวเข้มข้น 100%', lang: 'TH', no: 0 },
                { msg: 'ทดสอบแร่ธาตุ มูลค้างคาว', lang: 'TH', no: 1 },
                { msg: 'ทดสอบแร่ธาตุ น้ำจุลินทรีย์จากมูลค้างคาว', lang: 'TH', no: 2 },
                { msg: 'Lab result Liquid Organic Fertilizer Organically', lang: 'EN', no: 0 },
                { msg: 'Lab result Guano', lang: 'EN', no: 1 },
                { msg: 'Lab result Liquid Organic Fertilizer', lang: 'EN', no: 2 },
            ]
        };
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
                case "department":
                    window.location.href = "/admin/department"+"?token="+this.token
                    break;
                case "category":
                    window.location.href = "/admin/category"+"?token="+this.token
                    break;
                case "partner":
                    window.location.href = "/admin/partner"+"?token="+this.token
                    break;
            }
        },
        doAjax() {
            this.isLoading = true;
            setTimeout(() => {
                this.isLoading = false
            },2000)
        },
        documentHover() {
            this.showDocument = !this.showDocument;
        },
        toggleDialog(lang, e) {
            if (lang === null && e === null) this.showImage = null;
            else if (lang === 'EN') {
                if (e === 0) this.showImage = ['Certificate/Result/EN/Result02.jpg', 'Certificate/Result/EN/Result03.jpg'];
                if (e === 1) this.showImage = ['Certificate/Result/EN/Result04.jpg'];
                if (e === 2) this.showImage = ['Certificate/Result/EN/Result05.jpg', 'Certificate/Result/EN/Result06.jpg'];
            } else if (lang === 'TH') {
                if (e === 0) this.showImage = ['Certificate/Result/TH/Result02.jpg', 'Certificate/Result/TH/Result03.jpg'];
                if (e === 1) this.showImage = ['Certificate/Result/Th/Result04.jpg'];
                if (e === 2) this.showImage = ['Certificate/Result/TH/Result05.jpg', 'Certificate/Result/TH/Result06.jpg'];
                if (e === 3) this.showImage = ['Certificate/Permission/DronePermission.jpg'];
                if (e === 4) this.showImage = ['Certificate/Result/TH/Result01.jpg'];
            }
        },
    },
}
</script>
<style lang="scss">
.documentMenu {
    z-index: 1;
    position: fixed;
    border-radius: 4px;
    background: rgb(222, 253, 218);
    top: 35px;
    left: 771px;
}

.resultMenu {
    border-radius: 4px;
    z-index: 2;
    position: fixed;
    background: rgb(222, 253, 218);
}

.certMenu {
    border-radius: 4px;
    z-index: 2;
    position: fixed;
    background: rgb(222, 253, 218);
}

.inline-grid {
    display: inline-grid;
}

.menu-item:hover {
    // opacity: 0.5;
}
</style>
