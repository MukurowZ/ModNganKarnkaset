<template>
    <div style="font-family: Kanit;" class="container font-weight-bold d-flex flex-column bd-highlight mb-3">
        <div class="p-2 bd-highlight">
            <label name="th_name" style="font-size: 1.5em">ติดต่อเรา</label>
            <br>
            <label name="name" style="font-size: 0.9em; margin-top:-2px; color:grey">Contact us</label>
        </div>
        <div class="p-2 bd-highlight d-flex justify-content-start">
            <button ref="contact" class="btn btn-success" v-on:click="contact()">ติดต่อเรา</button>
            <button ref="form" class="btn btn-success" v-on:click="form()">ส่งแบบฟอร์มติดต่อ</button>
            <button ref="partner" class="btn btn-success" v-on:click="partner()">ติดต่อผ่านคู่ค้า</button>
        </div>
        <hr align="left" width="50%">
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
        contact(){
            window.location.href = "/contact/"
        },
        form(){
            window.location.href = "/contact/form"
        },
        partner(){
            window.location.href = "/contact/partner"
        },
        changeButtonClass(){
            this.type = window.location.pathname;
            var n = this.type.indexOf("form");
            if(n>0) this.$refs['form'].className = this.clicked_class;
            else {
                n = this.type.indexOf("contact");
                if(n>0) this.$refs['contact'].className = this.clicked_class;
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
