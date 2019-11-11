export const adminMixin = {
    data() {
        return {
            owner_id: '',
            token: '',
        }
    },
    created() {
        this.owner_id = sessionStorage.getItem('id').charAt(40);
        if(this.owner_id=='') this.owner_id = localStorage.getItem('id').charAt(40);
        this.token = sessionStorage.getItem('token');
        if(this.token=='') this.token = localStorage.getItem('token');
    },
}
