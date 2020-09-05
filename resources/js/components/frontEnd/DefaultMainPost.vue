<template>
    <div class="container-md">




        <!-- Default form contact -->
            <div class="create-store-panel p-5 shadow mx-auto">

                <p class="h4 text-center mb-4">Complete your Information</p>

                <!-- Default input name -->
                <label class="grey-text">Title</label>
                <input type="text"  class="form-control" v-model="data.title">
                <br>

                <div class="form-group">
                    <label >Size(m <sup>2</sup>)</label>
                    <input type="number"  class="form-control" v-model="data.size">
                </div>
                <br>


                <!-- Default input subject -->
                <label  class="grey-text">Price($)</label>
                <input type="number" v-model="data.price" class="form-control">

                <br>

                <!-- Default textarea message -->
                <label  class="grey-text">Description</label>
                <textarea type="text"  class="form-control" rows="8" v-model="data.description"></textarea>
                <div class="photo-container" >

                    <input multiple id="fileOpen" type="file" @change="previewImage" class="d-none">

                    <div class="img-container one" @click="openFileExplore">
                        <p>+</p>
                    </div>

                    <div class="img-container" v-if="data.temp.length > 0" v-for="t in this.data.temp" @click.prevent="removeImagePreview(t)">
                        <img :src="t.img" >

                        <div class="remove">
                            Remove
                        </div>
                    </div>

                </div>
                <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="provinces">Province / City</label>
                            <select v-model="data.provinceSelected" id="provinces" class="form-control" @change="getDistricts">

                                <option v-for="province in allProvinces" :value="province.pro_id">{{ province.ProvinceName }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="districts">Districts</label>
                            <!--Start Loading Indicator-->
                            <div v-if="loadingDistricts" class="justify-content-center w-100 align-middle text-center">
                                <div class="spinner-border text-success" role="status"></div>
                            </div>
                            <!--End Loading Indicator-->
                            <div v-if="!data.provinceSelected" class="form-control bg-primary text-white">Please Select Province First</div>
                            <select v-if="!loadingDistricts && data.provinceSelected" v-model="data.districtSelected" id="districts" class="form-control" @change="getCommunes">
                                <option v-for="district in allDistricts" :value="district.dis_id">{{ district.DistrictName }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="communes">Communes</label>
                            <!--Start Loading Indicator-->
                            <div v-if="progressing.loadingCommunes" class="justify-content-center w-100 align-middle text-center">
                                <div class="spinner-border text-success" role="status"></div>
                            </div>
                            <!--End Loading Indicator-->
                            <div v-if="!data.districtSelected" class="form-control bg-primary text-white">Please Select a District First</div>
                            <select v-if="!progressing.loadingCommunes && data.districtSelected" v-model="data.communeSelected "id="communes" class="form-control">
                                <option v-for="commune in allCommunes" :value="commune.com_id">{{ commune.CommuneName }}</option>
                            </select>

                        </div>

                    </div>
                </div>
                <hr>
                <br>
                <label  class="grey-text">Email</label>
                <input type="text" v-model="data.email" class="form-control">

                <br>
                <label  class="grey-text">Phone Number</label>
                <input type="number" v-model="data.phone" class="form-control" placeholder="010 xxx xxx / 012 xxx xxx">

                <br>
                <label class="grey-text">Location Details*</label>
                <textarea type="text"  class="form-control" rows="4" v-model="data.localDetail"></textarea>
                <br>
                <g_map>

                </g_map>
                <div class="text-center mt-4">
                    <button class="btn btn-primary" type="submit" @click="storeToDatabase()">Upload</button>
                </div>


        <!-- Default form contact -->

            </div>

    </div>
<!--    <h2>{{test}}</h2>-->
</template>

<script>
    import G_map from './GoogleMapComponent'
    export default {
        components: {
            'g_map': G_map,
        },
       data(){
           return{

               data:{
                   temp: [],
                   temp_id: 0,
                   bedroom: '',
                   bathroom:'',
                   title:'',
                   facing:'',
                   size:'',
                   price:'',
                   description:'',
                   provinceSelected: null,
                   districtSelected: null,
                   communeSelected: null,
                   uid: '',
                   phone: '',
                   email:'',
                   localDetail:'',
                   glat: '',
                   glng: '',
                   cat_name: this.$store.getters.categoryName,
               },
               progressing:{
                   loadingCommunes: false,
               },
               allProvinces: [],
               allDistricts: [],
               allCommunes: [],
               loadingDistricts: false,

           }
       },
        mounted() {
            axios.get('api/province').then(response => {
                if(response.status === 200){
                    this.allProvinces = response.data;

                    //console.log(response);
                }
            }).catch(err => {

            }).finally(() => {

            });
        },
        created() {
            this.GetUserInfor();
        },
        methods:{
            GetUserInfor(){
                const trustClientToken = window.localStorage.getItem('userAccessToken');
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ trustClientToken;
                axios.get('api/user').then(response => {
                    console.log(response.data);
                    this.data.uid = response.data.id;
                }).catch(err => {
                    console.log(err);
                })
            },
            getDistricts(e){
                this.loadingDistricts = true;
                axios.get('api/districts/'+ e.target.value).then(response => {
                    if(response.status === 200){
                        console.log(response.data);
                        this.allDistricts = response.data;
                        this.loadingDistricts = false;
                    }
                }).catch(errors => {
                    console.log("Errors ", errors.response);
                    this.loadingDistricts = false;
                });
            },
            getCommunes(e){

                this.progressing.loadingCommunes = true;
                axios.get('api/communes/'+ e.target.value).then(response => {
                    if(response.status === 200){
                        //console.log(response.data);
                        this.allCommunes = response.data;
                        this.progressing.loadingCommunes = false;
                    }
                }).catch(errors => {
                    console.log("Errors ", errors.response);
                    this.progressing.loadingCommunes= false;
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

                        this.data.temp.push({id: this.data.temp_id, img: e.target.result});
                        this.data.temp_id++;
                    }
                }
            },
            removeImagePreview(e){
                this.data.temp.splice(this.data.temp.findIndex(v => v.id === e.id), 1);
            },
            storeToDatabase(){
                this.data.glat = this.$store.getters.getLat;
                this.data.glng = this.$store.getters.getLng;
                axios.post('api/uploadData', this.data).then(response => {
                    console.log(response.data);
                    this.$router.push({name:'home.userpagemaster'})

                }).catch(err => {
                    console.log(err);
                });

            }
        }
    }
</script>

<style scoped>
    .main-post{
        width: 60%;
        height: 500px;
    }
    .photo-container{
        display: flex;
        flex-direction: row;
    }
    .img-container{
        width: 200px;
        height: 200px;
        background: blue;
        margin: 10px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
    /*.img-container:hover img {*/
    /*  background-color: red;*/
    /*}*/
    .remove {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
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
