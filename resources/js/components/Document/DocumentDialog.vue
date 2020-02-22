<template>
<div class="document-dialog">
    <div class="modal-mask">
        <div class="modal-wrapper" @click.self="$emit('close')">
            <div class="modal-container">
                <div class="modal-header justify-content-end" @click="$emit('close')">
                    <font-awesome-icon :icon="['fas', 'times-circle']" />
                </div>
                <div class="modal-body">
                    <img v-for="(img, i) in showCert" v-bind:key="i" class="img" v-lazy="path(img)">
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        showCert: {
            type: Array,
        },
    },
    methods: {
        path(e) {
            return `/storage/main/${e}`;
        },
    },
};
</script>

<style lang="scss">
.document-dialog {
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 650px;
        margin: 0px auto;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
    }

    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }

    .modal-body {
        max-height: 700px;
        overflow-y: scroll;
    }

    .img {
        width: 600px;
    }
}
</style>
