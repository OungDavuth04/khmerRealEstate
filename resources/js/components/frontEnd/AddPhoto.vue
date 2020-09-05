<template>
    <!--Employee Photo Upload-->
    <div class="form-group">
        <div class="row">
            <div class="col-md-3">
                <div class="photo-frame border position-relative" >
                    <input multiple id="fileOpen" type="file" @change="previewImage" class="d-none">
                    <div v-if="photos == null" class="position-absolute w-100 h-100" @click="openFileExplore">
                        <i class="user-icon fas fa-user-tie fa-5x position-absolute text-white">Hello</i>
                    </div>
                    <div v-for="t in photos" v-if="employeeData.photo!= null" class="position-absolute w-100 h-100">
                        <img :src="employeeData.photo" alt="">
                        <div class="custom-overlay position-absolute"></div>
                        <button class="btn btn-primary" @click.prevent="removeImagePreview">Remove</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddPhoto",
        created() {
            console.log("Hello");
        },
        data(){
            return{
                employeeData: {
                    photo: null,
                },

                photos: [],
            }
        },
        methods:{
            previewImage(e){
                if(e.target.files[0] && !e.files){
                    let image = e.target.files[0];
                    let reader = new FileReader();
                    reader.readAsDataURL(image);
                    reader.onload = e =>{
                        this.employeeData.photo = e.target.result;
                        this.photos.push({id: 1, img: e.target.result});
                    }
                }
            },
            openFileExplore(){
                $('#fileOpen').click();
            },
            removeImagePreview(){
                this.employeeData.photo = null;
                $("#fileOpen").val(''); //completely remove from input type file
            },
        }
    }
</script>

<style scoped>
    .photo-frame{
        cursor: pointer;
        width: 10rem;
        height: 14rem;
        background-color: #636b6f;
    }
    .photo-frame .user-icon{
        cursor: pointer;
        left: 50%;
        top: 50%;
        z-index:3;
        -webkit-transform: translateY(-50%) translateX(-50%);
        -moz-transform: translateY(-50%) translateX(-50%);
        -ms-transform: translateY(-50%) translateX(-50%);
        -o-transform: translateY(-50%) translateX(-50%);
        transform: translateY(-50%) translateX(-50%);
    }
    .photo-frame img{
        width: 100%;
        height: 100%;
        position: absolute;
        object-fit: cover;
    }
    .photo-frame button{
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translateY(-50%) translateX(-50%);
        -moz-transform: translateY(-50%) translateX(-50%);
        -ms-transform: translateY(-50%) translateX(-50%);
        -o-transform: translateY(-50%) translateX(-50%);
        transform: translateY(-50%) translateX(-50%);
        display: none;
    }
    .photo-frame .custom-overlay{
        width: 100%;
        height: 100%;
        background-color: rgb(100,100,100);
        opacity: 0;
        -webkit-transition: 0.3s;
        -moz-transition: 0.3s;
        -ms-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
    }
    .photo-frame:hover .custom-overlay{
        opacity: 0.7;
    }
    .photo-frame:hover button{
        display: block;
    }
</style>
