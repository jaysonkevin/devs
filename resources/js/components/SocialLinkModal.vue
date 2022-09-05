<template>
    <Modal
        v-model="$store.state.socialEdit_"
        :close="closeModal"
    >
    <div class="modals">
        <div class="container-fluid  mt-2 toggle ">
            <h4>Hellow</h4>
        </div>
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
    background-color: white;
    font-size: 20px;
    text-align: center;
    z-index: 9999;
}
</style>