<template>
        <Modal
            v-model="$store.state.modalShowPrivacy"
            :close="closeModal"
        >
        <div class="modals">
            <h3>Privacy Modal</h3>
        </div>
        </Modal>
</template>

<script>
    export default  {
        methods : {
            
        }
    }
</script>

<style scoped>
    .modals {
        width: 300px;
        padding: 0px;
        box-sizing: border-box;
        background-color: rgb(226, 46, 46);
        font-size: 20px;
        text-align: center;
        z-index: 9999;
    }
</style>