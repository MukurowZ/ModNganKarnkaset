<template>
    <div class="container">
        <br>
        <h1 style="font-family: Kanit;">จัดการหมวดสินค้า</h1>
        <table>
            <tr>
                <td>ชื่อ</td>
                <td>ชื่อไทย</td>
                <td>แก้ไข</td>
                <td>ลบ</td>
            </tr>
            <tr v-for="(category,i) in categorys" v-bind:key="category.id">
                <td><input class="form-control" type="text" v-model="categorys[i].name"></td>
                <td><input class="form-control" type="text" v-model="categorys[i].THname"></td>
                <td><button class="btn btn-warning" v-on:click="editCategory(category.id,i)">แก้ไข</button></td>
                <td><b-button class="btn btn-danger" v-on:click="showModal(category.id,category.name)">ลบหมวดหมู่นี้</b-button></td>
            </tr>
        </table>
    </div>
</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
export default {
    mixins: [adminMixin],
    mounted() {

    },
    beforeMount(){
        this.getCategory();
    },
    data(){
        return{
            categorys: [],
            category:{
                THname: '',
                name: '',
            }
        }
    },
    methods: {
        getCategory(){
            axios.get("/api/category").then(response => this.setData(response.data));
        },
        setData(e){
            this.categorys = e;
            // this.loopData()
        },
        // loopData(){
        //     Object.keys(this.category).forEach(a =>{
        //         if(this.category[a].name=="Service"){
        //             this.services=this.category[a].subCategory
        //         }else if(this.category[a].name=="Product"){
        //             this.products=this.category[a].subCategory
        //         }
        //     });
        // },
        editCategory(e,i){
            axios.put("/api/category/"+e+"?token="+this.token,{
                name: this.categorys[i].name,
                THname: this.categorys[i].name,
            });
            location.reload();
        },
        removeCategory(e){
            axios.delete("/api/category/"+e+"?token="+this.token);
            location.reload();
        },
        showModal(e,f) {
            this.$bvModal
                .msgBoxConfirm(
                "ต้องการที่จะลบหมวดสินค้า " + f + " ใช่หรือไม่",
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
                    this.removeCategory(e);
                }
            })
            .catch(err => {})
        },
    },
}
</script>
