<template>
    <div style="font-family: Kanit;" class="container font-weight-bold" >
        <br>
        <h1>Contact us</h1>
        <form>
            <div class="form-group">
                <br>
                <label>Topic</label>
                <br />
                <input type="text" class="form-control" v-model="topic" placeholder="โปรดระบุหัวข้อในการติดต่อ"/>

                <br>
                <label>Detail</label>
                <br>
                <textarea :placeholder="getPlaceHolder('detail')" id="detail" type="text" class="form-control" v-model="detail" size="5000"/>
                <p style="color: gray" v-if="!isOver('detail')">You have {{charactersRemaining}} / 5,000 characters remaining.</p>
                <p style="color: red" v-else class="over">You are {{ charactersOver }} characters over the limit.</p>

                <br>
                <label>Address</label>
                <br />
                <textarea :placeholder="getPlaceHolder('address')" id="address" type="text" class="form-control" v-model="address" size="5000"/>
                <p style="color: gray" v-if="!isOver('address')">You have {{charactersRemaining2}} / 5,000 characters remaining.</p>
                <p style="color: red" v-else class="over">You are {{ charactersOver2 }} characters over the limit.</p>

                <br>
                <label  v-on:click="submitContact()">Telephone </label>
                <vue-tel-input id="tel" v-model="tel" v-bind="bindProps" ></vue-tel-input>

                <br>
                <label>Email</label>
                <br />
                <input type="text" class="form-control" v-model="email" placeholder="โปรดระบุอีเมลล์"/>
                <br>

            </div>
            <div class="form-group d-flex">
                <button type="submit" class="btn btn-success">Submit</button>
                <button class="btn btn-outline-secondary" style="margin-left:5px" onclick="/">Cancel</button>
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
            detail: '',
            address: '',
            topic: '',
            email: '',
            country_id: '',
            tel: '',
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
                autocomplete: "off",
                name: "tel",
                maxLen: 25,
                wrapperClasses: "",
                inputClasses: "",
                inputId: 'tel',
                dropdownOptions: {
                    disabledDialCode: false
                },
                inputOptions: {
                    showDialCode: false,
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
            }
        },
        submitContact(){
            console.log(this.tel);
        }
    },

}
</script>
