export const itemTypeMixin = {
    data() {
        return {
            itemType: '',
            getType: '',
            upperType: '',
        }
    },
    created() {
        this.setItemType();
    },
    methods: {
        setItemType(){
            this.getType = window.location.pathname;
            var n = this.getType.indexOf("product");
            if(n>0) this.itemType = "product"
            else {
                n = this.getType.indexOf("service");
                if(n>0) this.itemType = "service"
                else {
                    n = this.getType.indexOf("activity");
                    if(n>0) this.itemType = "activity"
                    else {
                        this.itemType = "event"
                    }
                }
            }
            this.upperType = this.itemType.toUpperCase();
        },
    },
}
