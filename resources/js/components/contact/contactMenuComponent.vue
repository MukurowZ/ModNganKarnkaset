<template>
    <div class="container" >
        <p>ติดต่อเรา</p>
        <p>Contact us</p>
        <br>
        <button ref="contact" class="btn btn-success" v-on:click="contact()">ติดต่อเรา</button>
        <button ref="form" class="btn btn-success" v-on:click="form()">ส่งแบบฟอร์มติดต่อ</button>
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
