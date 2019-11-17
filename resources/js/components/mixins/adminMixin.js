export const adminMixin = {
    data() {
        return {
            owner_id: '',
            token: '',
        }
    },
    created() {
        if(localStorage.getItem('token')!=null){
            this.token = localStorage.getItem('token');
            this.owner_id = localStorage.getItem('id').charAt(40);
        }else if(sessionStorage.getItem('token')!=null){
            this.owner_id = sessionStorage.getItem('id').charAt(40);
            this.token = sessionStorage.getItem('token');
        }else{

        }

    },
}
