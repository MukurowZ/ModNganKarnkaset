export const adminMixin = {
    data() {
        return {
            owner_id: '',
            token: '',
        }
    },
    created() {
        this.owner_id = localStorage.getItem('id').charAt(40);
        this.token = localStorage.getItem('token');
    }
}
