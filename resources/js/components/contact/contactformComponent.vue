<template>
    <div style="font-family: Kanit;" class="container font-weight-bold" >
        <br>
        <h1>Contact us</h1>
        <form>
            <div class="form-group" style="font-size: 1.2em">
                <br>
                <label>Topic</label>
                <br />
                <input type="text" class="form-control" v-model="topic" placeholder="โปรดระบุหัวข้อในการติดต่อ"/>

                <br>
                <label>Detail</label>
                <br>
                <textarea :placeholder="getPlaceHolder('detail')" id="detail" type="text" class="form-control" @input="detailChange" size="5000"/>
                <p style="color: gray" v-if="!isOver('detail')">You have {{charactersRemaining}} / 5,000 characters remaining.</p>
                <p style="color: red" v-else class="over">You are {{ charactersOver }} characters over the limit.</p>
                <br>
                <label>Address</label>
                <br />
                <textarea :placeholder="getPlaceHolder('address')" id="address" type="text" class="form-control" v-model="address" size="5000"/>
                <p style="color: gray" v-if="!isOver('address')">You have {{charactersRemaining2}} / 5,000 characters remaining.</p>
                <p style="color: red" v-else class="over">You are {{ charactersOver2 }} characters over the limit.</p>
                <br>
                    <label>Telephone</label>
                    <vue-tel-input id="tel" @input="telChange" @country-changed="getCountry" v-bind="bindProps"></vue-tel-input>
                <br>
                <label>Email</label>
                <br />
                <input type="text" class="form-control" v-model="email" placeholder="โปรดระบุอีเมลล์ (ex. modNganKarnkaset@gmail.com)"/>
                <br>

            </div>
            <div class="form-group d-flex">
                <button class="btn btn-success" v-on:click="submitContact">Submit</button>
                <button class="btn btn-outline-secondary" style="margin-left:5px" href="../product">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {

    },
    computed: {
        // for count character remain
        charactersRemaining() {
            return this.maxCharacters - this.detail.length;
        },
        charactersOver() {
            return this.isOver('detail') ? this.detail.length - this.maxCharacters : 0;
        },
        charactersRemaining2() {
            return this.maxCharacters2 - this.address.length;
        },
        charactersOver2() {
            return this.isOver('address') ? this.address.length - this.maxCharacters2 : 0;
        },
    },
    mounted() {
        this.maxCharacters = this.limit;
        this.maxCharacters2 - this.limit2;
    },
    data() {
        return {
            detail: "",
            address: "",
            topic: "",
            email: "",
            country: "",
            tel: "",
            // for count character remain
            maxCharacters: 5000,
            limit: 5000,
            maxCharacters2: 5000,
            limit2: 5000,
            // ---------------------------
            bindProps: {
                defaultCountry: "TH",
                disabledFetchingCountry: false,
                disabled: false,
                disabledFormatting: false,
                placeholder: "โปรดระบุหมายเลขโทรศัพท์",
                required: true,
                enabledCountryCode: true,
                enabledFlags: true,
                preferredCountries: ["TH", "CN"],
                autocomplete: "true",
                name: "tel",
                maxLen: 25,
                wrapperClasses: "form-control",
                inputClasses: "",
                inputId: 'tel',
                dropdownOptions: {
                    disabledDialCode: false
                },
                inputOptions: {
                    showDialCode: true,
                },
                mode: 'international',
                dynamicPlaceholder: true
            }

        }
    },
    methods: {
        isOver(e) {
            if(e=='detail') return this.charactersRemaining < 0;
            else if(e=='address') return this.charactersRemaining2 < 0;
            else return '';
        },
        getPlaceHolder(e){
            switch(e){
                case 'detail':
                    return 'โปรดกรอกรายละเอียดของการติดต่อ'
                case 'address':
                    return 'โปรดระบุที่อยู่ในการติดต่อกลับ'
            }
        },
        submitContact(){
            alert("Confirm to submit information ?")
            axios.post("/api/contact", {
                details: this.detail,
                address: this.address,
                topic: this.topic,
                email: this.email,
                country_id: this.country,
                tel: this.tel,
            });
        },
        detailChange(e){
            var x = document.getElementById("detail").value
            this.setDetail(x)
        },
        setDetail(e){
            this.detail = e;
        },
        telChange(tel){
            this.tel = tel.replace(/ /g,"-");
            this.tel = this.tel.replace("-","");
            console.log(this.tel.replace(/ /g,"-"));
        },
        getCountry(country){
            this.country = country.dialCode
        },
        returnToMain(){
            window.location.href = "https://twitter.com/home"
        }
    },

}
</script>
