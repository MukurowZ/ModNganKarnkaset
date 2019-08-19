<template >
    <div class="form-group" @mouseleave="passing()" @touchend="passing()" >
        <label class="typo__label">SELECT IMG SET</label>
        <multiselect v-model="img_set" placeholder="เลือกชุดอัลบั้ม" label="name" track-by="id" :options="sets" :option-height="104" :custom-label="customLabel" :show-labels="false">
            <template height="104px" slot="singleLabel" slot-scope="props">
                <img height="104px" class="option__image" v-lazy="props.option.img" >
                <span class="option__name"><span class="option__id"> เลือกอัลบั้ม: {{ props.option.id }} </span>ชื่ออัลบั้ม: {{ props.option.name }}</span>
            </template>
            <template slot="option" slot-scope="props" class="d-flex bd-highlight mb-3"><img height="104px" class="option__image p-2 bd-highlight" v-lazy="props.option.img" >
                <div class="option__name align-self-center p-2 bd-highlight"><span class="option__id ">{{ props.option.id }}</span><span class="option__small">{{ props.option.name }}</span></div>
            </template>
        </multiselect>
    </div>
</template>


<script>
export default {
    props: {
        editId: String,
    },
    beforeMount() {},
    mounted() {
        this.getAllSet();
        this.removePrime();
    },
    computed: {},
    data() {
        return {
            sets: [],
            set: {
                id: "",
                name: "",
                owner_id: "",
                imgids: [],
                imgid: {
                    id: "",
                    img_set: "",
                    path: ""
                }
            },
            img_set: { },
            checker: '',
        }
    },
    methods: {
        getAllSet() {
            axios.get("/api/img_set").then(response => this.setSetData(response.data));
        },
        setSetData(e) {
            this.sets = e;
            var i = 0;
            var element = '';
            for(element in this.sets){
                this.sets[i].img = '/storage/imgs/' + this.sets[i].imgid[0].path;
                i++;
            }
        },
        getImg(imgs) {
            if(imgs.length!=0){
                return '/storage/imgs/'+imgs[0].path;
            }
            return '';
        },
        customLabel ({ id, name }) {
            return `${id} – ${name}`
        },
        passing () {
            if (this.checker == this.img_set.id) return '';
            else {
                this.$emit('clicked', this.img_set.id);
                this.checker = this.img_set.id;
            }
        },
        removePrime() {
            var b = this.editId;
            if(b != null){
                b = b.replace("'","");
                b = b.replace("\'\'","");
                axios.get("/api/img_set/"+b).then(response => this.setImg_setData(response.data));
            }else return null;
        },
        setImg_setData(e){
            this.img_set = {
                id: e.id,
                name: e.name,
                img: '/storage/imgs/'+e.imgid[0].path
            }
        },
    }
};
</script>
