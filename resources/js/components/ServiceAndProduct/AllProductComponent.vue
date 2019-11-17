<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ upperType }} Component</div>

          <table>
            <tr v-for="item in items" v-bind:key="item.id">
              <td>{{item.id}}</td>
              <td>{{item.name}}</td>
              <td>{{item.story}} <span style="color:red" v-if="item.longDescription">...มีต่อ</span> </td>
              <td>{{item.price}}</td>
              <td>{{item.type}}</td>
              <td>
                <img height="200px" :src="fullPath(item.img.path)" />
              </td>
              <td>
                <button
                  class="btn btn-warning"
                  style="margin-left: 5px"
                  v-on:click="getEditUrl(item.id)"
                >แก้ไขสินค้า/บริการ</button>
              </td>
              <td>
                <b-button
                  v-b-modal.confirmDel
                  class="btn btn-danger"
                  style="margin-left: 5px;"
                  v-on:click="getRemove(item.id,item.name)"
                >ลบสินค้า/บริการ</b-button>
              </td>
            </tr>
          </table>
          <button
            v-on:click="addPage"
            class="btn btn-outline-primary"
          >เพิ่มสินค้าหรือบริการ</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { adminMixin } from '../mixins/adminMixin.js'
import { itemTypeMixin } from '../mixins/itemType.js'
export default {
    mixins: [adminMixin,itemTypeMixin],
    mounted() {
        this.getCategory();
        this.getProduct();
    },
    methods: {
        getCategory() {
            axios
                .get("/api/category")
                .then(response => this.setData(response.data, "category"))
                .catch(err => this.setData(err, "break"));
        },
        getProduct() {
            axios
                .get("/api/"+this.itemType)
                .then(response => this.setData(response.data, "product"))
                .catch(err => this.setData(err, "break"));
        },
        setData(e, f) {
            switch (f) {
                case "category":
                    this.categorys = e;
                    break;
                case "product":
                    e = this.renameCategory(e);
                    this.items = e;
                    break;
            }
        },
        fullPath(e) {
            if (e != null) {
                return "/storage/imgs/" + e;
            }
            return "";
        },
        getEditUrl(e) {
            if (e != null) {
                const token = localStorage.getItem('token')
                window.location.href = "/admin/"+ this.itemType +"/" + e + "/edit"+"?token="+token;
            }
            return "";
        },
        getRemove(id, name) {
            this.confirmBox = "";
            this.$bvModal
                .msgBoxConfirm(
                "Please confirm that you want to delete "+ this.itemType +
                    name +
                    " from event?",
            {
                title: "Please Confirm",
                size: "sm",
                buttonSize: "sm",
                okVariant: "outline-secondary",
                okTitle: "YES",
                cancelTitle: "NO",
                cancelVariant: "danger",
                footerClass: "p-2",
                hideHeaderClose: false,
                centered: false
            }
            )
            .then(value => {
            this.confirmBox = value;
            if (value) {
                const token = localStorage.getItem('token');
                return fetch("/api/"+ this.itemType +"/" + id+this.id+"?token="+token, {
                method: "DELETE"
                }).then((window.location.href = "../"+ this.itemType));
            } else {
                return "";
            }
            })
            .catch(err => {
            // An error occurred
            });
        },
        addPage(){
            window.location.href='/admin/'+this.itemType+'/create'+'?token='+this.token
        },
        renameCategory(e) {
            var i = 0;
            var c = JSON.parse(JSON.stringify(this.getCategorys()));
            c = Object.entries(c);
            for (i = 0; i < e.length; i++) {
                c.forEach(b => {
                    if (b[1].id == e[i].type) {
                        e[i].type = b[1].name + " " + b[1].THname;
                    }
                });
                if(e[i].description.length>=201)
                    e[i].description = e[i].description.substring(0,201);
                if(e[i].story.length>=201)
                    e[i].story = e[i].story.substring(0,201);
            }
            return e;
        },
        getCategorys() {
            return this.categorys;
        }
    },
    data() {
        return {
            categorys: [],
            items: [],
            path: [],
            i: 0,
            confirmBox: ""
        };
    }
};
</script>
