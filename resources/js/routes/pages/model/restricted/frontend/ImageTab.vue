<template>
    <div id="img-tab" class="tab-pane fade in active show">
        <section class="mt-3">
            <small>
                <p>
                    <i  data-bs-toggle="modal" title="add image" data-bs-target="#add_image" class="fa-solid add-image fa-circle-plus"></i>
                    Upload your updated photos and attract your employers!   
                </p>
            </small>
          
            <div class="row">
                <div class="col-md-4 col-xs-4" v-for="(item, index) in imagesHolder">
                    <div class="card img-card">
                        <div class="card-header">
                           <span @click="removeImg(item.id , index)" style="cursor:pointer"> <i class="fa fa-trash"  style="color:red"></i> Remove </span>
                        </div>
                        <div class="card-body"  >
                            <img
                                @click="showImg('../storage/photo/'+item._p_+'/'+item.image)"
                                :src="'../storage/photo/'+item._p_+'/'+item.image"
                                class="img-fluid image-tab gallery"
                                data-bs-toggle="modal" data-bs-target="#imgModal"
                                />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- MODALS -->
    <div class="modal fade" id="imgModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <img
                    v-bind:src="imgSrc"
                    class="img-fluid" />
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="add_image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Add Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <Form  @submit="uploadImage" :validation-schema="schema" ref="form"  v-slot="{ isSubmitting }">
                    <div class="modal-body">
                        <div class="helper"></div>
                        <div class="drop display-inline align-center" @dragover.prevent @drop="onDrop">
                            <div class="helper"></div>
                            <label v-if="!image" class="btn-helper display-inline">
                                SELECT OR DROP AN IMAGE (350px recommended size)
                                <input type="file" name="image" @change="onChange">
                            </label>
                     
                            <div class="hidden display-inline align-center" v-else v-bind:class="{ 'image': true }">
                                <img width="350" height="350" :src="image" id="img-upload" alt="" name="image" class="" />
                                <br>
                                <br>
                                <button class="btn-helper" @click="removeFile">REMOVE</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-theme" :disabled="isSubmitting"   v-if="image">Upload Image <i v-show="isSubmitting" class="fa fa-spin fa-spinner"></i></button>
                    </div>
                </Form>
            </div>
        </div>
    </div>

</template>

<script>
    import { Form, Field, ErrorMessage } from 'vee-validate';
    export default { 
        components: {
            Form,
            Field,
            ErrorMessage,
        },
        data () {
            return {
                imgSrc : '', 
                image: '' ,
                imgHolder : [] ,
                imagesHolder : []
            }
        },
        methods : {
            showImg (url) {
                this.imgSrc = ''; 
                this.imgSrc = url;

            },
            onDrop: function(e) {
                e.stopPropagation();
                e.preventDefault();
                var files = e.dataTransfer.files;
                this.createFile(files[0]);
            },
            onChange(e) {
                var files = e.target.files;
                this.imgHolder = files;
                this.createFile(files[0]);
            },
            createFile(file) {
                if (!file.type.match('image.*')) {
                alert('Select an image');
                return;
                }
                var img = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function(e) {
                vm.image = e.target.result;
                }
                reader.readAsDataURL(file);
            },
            removeFile() {
                this.image = '';
            },
            uploadImage(values , actions) {
               
                let data = new FormData();
                data.append('image', this.imgHolder[0]);
                
                axios.post('/api/imageUpload',data).then(function (response) {
                    window.location.reload()
                });
            },
            removeImg (id , index) {
                let imgH  = this.imagesHolder
                var me = this;
                this.$swal({
                    title: "Are you sure you want to delete this image?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    cancelButtonColor: 'grey',
                    confirmButtonColor: "red",
                    confirmButtonText: "Delete"
                }).then(function(result){
                   if(result.isConfirmed){      
                        axios.post('api/removeImg' , {id : id}).then(response => {
                            if(response.data.status == true){
                                me.$swal({
                                    title: "",
                                    text: "Success!",
                                    iconHtml: '<i class="fa-solid fa-check" style="color:green"></i>',
                                    type: "success",
                                    showCancelButton: false,
                                    showConfirmButton : false,
                                    timer: 1500
                                });
                                imgH.splice(index, 1)
                            } else{
                                me.$swal({
                                    title: "",
                                    text: "Something went wrong!",
                                    iconHtml: '<i style="color:red" class="fa">&#xf12a;</i>',
                                    type: "error",
                                    showCancelButton: false,
                                    showConfirmButton : false,
                                    timer: 1500
                                });
                            }
                        }).catch((error) => {
                            
                        });
                   }
                }, function(result) {
                    // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                    if (result.dismiss === 'cancel') { // you might also handle 'close' or 'timer' if you used those
                       
                    } else {
                        throw dismiss;
                    }
                })
            }
                
        },
        mounted () {
            axios.get('api/getImage').then(response => {
                this.imagesHolder = response.data;
            }).catch((error) => {

            });
        }
    }
</script>

<style>
.btn-helper {
  background-color: var(--theme);
  border: 0;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-weight: bold;
  padding: 15px 35px;
  position: relative;
}

.btn:hover {
  background-color: #722040;
}

input[type="file"] {
  position: absolute;
  opacity: 0;
  z-index: -1;
}

.align-center {
  text-align: center;
}

.helper {
  height: 100%;
  display: inline-block;
  vertical-align: middle;
  width: 0;
}

.hidden {
  display: none !important;
}

.hidden.image {
  display: inline-block !important;
}

.display-inline {
  display: inline-block;
  vertical-align: middle;
}

.img {
  border: 1px solid #f6f6f6;
  display: inline-block;
  height: auto;
  max-height: 80%;
  max-width: 80%;
  width: auto;
}

.drop {
  background-color: #f2f2f2;
  background-color: #f6f6f6;
  border-radius: 2px;
  height: 100%;
  width: 100%;
}
</style>