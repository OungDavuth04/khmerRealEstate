<template>
    <div>

        <div class="photo-container" >

            <input multiple id="fileOpen" type="file" @change="previewImage" class="d-none">

            <div class="img-container one" @click="openFileExplore">
                <p>+</p>
            </div>

            <div class="img-container" v-if="temp.length > 0" v-for="t in this.temp" @click.prevent="removeImagePreview(t)">
                <img :src="t.img" alt="">
            </div>

        </div>




        <button @click="storeToDatabase">Save</button>


        <!--display image from database-->
        <div v-for="f in gg">
            <img :src="f.image"  style="width: 100px;">
        </div>



    </div>
</template>

<script>
    export default {
        name: "AddMultiplePhoto",
        data(){
            return{
                temp: [],
                temp_id: 0,
                photos: [],
            }
        },
        mounted() {
            this.gettingEmployeeData();
        },
        computed:{
            gg(){
                return this.photos;
            }
        },
        methods:{
            async gettingEmployeeData(){
                await axios.get('api/gg').then(response => {
                    if(response.status === 200){
                        console.log(response);
                        this.photos = response.data;
                    }
                }).catch(err =>{
                    console.log(err);
                });
            },

            openFileExplore(){
                $('#fileOpen').click();
            },
            previewImage(e){
                if(e.target.files[0] && !e.files){
                    let image = e.target.files[0];
                    let reader = new FileReader();
                    reader.readAsDataURL(image);
                    reader.onload = e =>{
                        //this.employeeData.photo = e.target.result;

                        this.temp.push({id: this.temp_id, img: e.target.result});
                        this.temp_id++;
                    }
                }
            },
            removeImagePreview(e){
                this.temp.splice(this.temp.findIndex(v => v.id === e.id), 1);
            },
            storeToDatabase(){
                this.temp.forEach(i =>{
                    console.log(i.id);
                    console.log(i.img);
                });
            }
        }
    }
</script>

<style scoped>
    .photo-container{
        display: flex;
        flex-direction: row;
    }
    .img-container{
        width: 100px;
        height: 100px;
        background: blue;
        margin: 10px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
    .img-container img{
        width: inherit;
        height: inherit;
    }
    .one{
        background: red;
    }
    .one p{
        font-size: 30px;
        color: white;
        margin: 0;
        padding: 0;
    }
</style>
