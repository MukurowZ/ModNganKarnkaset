<template>
    <div>
        <table>
            <tr>
                <td>ชื่อผู้ใช้</td>
                <td>อีเมลล์</td>
                <td>ชื่อจริง</td>
                <td>ระดับการควบคุม</td>
                <td>หน่วยงาน</td>
                <td>แก้ไข</td>
                <td>ลบข้อมูล</td>
            </tr>
            <tr v-for="user in users" v-bind:key="user.id">
                <td></td>
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
    data() {
        return {
            users: [],
        }
    },
}
</script>
