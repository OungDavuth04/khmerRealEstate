<template>
    <div>
        <header class="header__navbar">
            <div class="navbar">
                <h4 class="navbar__logo">Khmer Real Estate</h4>
                <ul class="navbar__links">
                    <li>
                        <router-link to="/">
                            <a href="#">Home</a>
                        </router-link>
                    </li>
                    <li>
                        <div class="btn-group dropleft">
                            <i class="fas fa-align-justify setting-bar dropleft" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu ">
                                <a class="dropdown-item" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Edit Profile</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#EditPassword">Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" @click="logout()">Log Out</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="EditPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" >Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card login-form">
                                <div class="card-body">
                                    <div class="card-text">
                                        <div class="form-group">
                                            <div class="alert alert-warning" role="alert" v-if="MessageError !== ''">
                                                {{MessageError}}
                                            </div>
                                            <input type="password" class="form-control form-control-sm" v-model="ChangePass.CurrentPass" placeholder="Current Password">
                                            <input type="password" class="form-control form-control-sm" v-model="ChangePass.NewPass" placeholder="New Password">
                                            <input type="password" class="form-control form-control-sm" v-model="ChangePass.RetypePass" placeholder="Re-Type New Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" @click="ChangePassword">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="content">
            <div class="container-fluid">
                <div class="collapse " id="collapseExample">
                    <div class="card card-body background">
                        <p data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;color: black;font-size: medium">X</p>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 form-group ">
                                    <label for="name-f" class="text-white">Full Name</label>
                                    <input type="text" class="form-control" v-model="data.name"  placeholder="Enter your first name." required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="Country" class="text-white">City/Province</label>
                                    <select class="form-control custom-select browser-default" v-model="data.province">
                                        <option >Banteay Meanchey</option>
                                        <option >Battambang</option>
                                        <option >Kampong Cham</option>
                                        <option >Kampong Chhnang</option>
                                        <option >Kampong Speu</option>
                                        <option >Kampong Thom</option>
                                        <option >Kampot</option>
                                        <option >Kandal</option>
                                        <option >Koh Kong</option>
                                        <option >Kratié</option>
                                        <option >Mondulkiri</option>
                                        <option >Phnom Penh</option>
                                        <option >Preah Vihear</option>
                                        <option >Prey Veng</option>
                                        <option >Pursat</option>
                                        <option >Ratanak Kiri</option>
                                        <option >Siem Reap</option>
                                        <option >Preah Sihanouk</option>
                                        <option >Stung Treng</option>
                                        <option >Svay Rieng</option>
                                        <option >Takéo</option>
                                        <option >Oddar Meanchey</option>
                                        <option >Kep</option>
                                        <option >Pailin</option>
                                        <option >Tboung Khmum</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="Date" class="text-white">Date Of Birth</label>
                                    <input type="Date" name="dob" class="form-control" id="Date" placeholder="" required v-model="data.dob">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="sex" class="text-white">Gender</label>
                                    <select id="sex" class="form-control browser-default custom-select" v-model="data.gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="tel" class="text-white">Phone</label>
                                    <input type="tel" name="phone" v-model="data.phone" class="form-control" id="tel" placeholder="Enter Your Contact Number." required>
                                    <div id="file">
                                        <input multiple id="fileOpen" type="file" @change="previewImage" class="d-none">
                                        <div class="img-container one" @click="openFileExplore">
                                            <span>Add Profile</span>
                                        </div>
                                    </div>
                                    <div class="photo-container"  >
                                        <div class="img-container" v-if="data1.temp.length > 0" v-for="t in data1.temp" @click.prevent="removeImagePreview(t)">
                                            <img :src="t.img">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-sm-6 form-group" v-if="OldPassword === true">
                                    <label for="pass" class="text-white">Enter Old Password</label>
                                    <input type="Password" name="password"  class="form-control" id="pass" placeholder="Enter your password." required>
                                </div>
                                <div class="col-sm-6 form-group" v-if="ResetPassword === true">
                                    <label for="pass2" class="text-white">Enter New Password</label>
                                    <input type="Password" name="cnf-password"  class="form-control" id="pass2" placeholder="Re-enter your password." required>
                                </div>
                                <div class="col-sm-12 form-group mb-0">
                                    <button class="btn btn-primary float-right" @click="editProfile" >Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="user-profile-2" class="user-profile">
                    <div class="tabbable">
                        <div class="tab-content no-border padding-24">
                            <div id="home" class="tab-pane in active">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 center">
                                        <div class="profile-picture">
                                            <img class="editable img-responsive" alt=" Avatar" id="avatar2"
                                                 :src="profile">
                                        </div>
                                        <div class="space space-4"></div>
                                        <router-link to="/admin" class=" btn btn-primary" v-if="level === 'admin'"  style="margin: 10px;">
                                            <span class="bigger-110">Visit Admin Dashboard</span>
                                        </router-link >
                                    </div><!-- /.col -->
                                    <div class="col-xs-12 col-sm-9">
                                        <h4 class="blue">
                                            <span class="middle">{{name}}</span>
                                        </h4>
                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Email </div>
                                                <div class="profile-info-value">
                                                    <span>{{email}}</span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Location </div>
                                                <div class="profile-info-value">
                                                    <span>{{location}}</span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Phone  </div>
                                                <div class="profile-info-value">
                                                    <span>{{phone}}</span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Date Of Birth </div>
                                                <div class="profile-info-value">
                                                    <span>{{dob}}</span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Joined </div>
                                                <div class="profile-info-value">
                                                    <span>{{newJoin}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr hr-8 dotted"></div>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                                <div class="space-20"></div>
                            </div><!-- /#home -->
                        </div>
                     </div>
                    </div>
                </div>
    <!--  end user infor-->
        <hr>
            <div style="padding: 2%;"></div>
            <div class="content">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="bg-color">
                            <div class="form-group">
                                <h3 v-if="promoteData != 0">Real Estate Promoted</h3>
                                <div class="parent">
                                    <template v-for="item in promoteData">
                                        <div class="card" style="width: 16.4rem; margin: 5px;">
                                            <img class="card-img-top":src="item.images.length>0?item.images[0].image:''" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title text-overflow" v-text="item.title" style="color:#0b75c9; ;"></h5>
                                                <p style="color: #2e7d32;">Price : <span>{{item.price}}$</span></p>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <h3>All Real Estate</h3>
                                <div class="parent">
                                    <template v-for="(item, index) in upload">
                                        <div  class="item">
                                            <div class="card" style="width: 16.4rem; margin: 5px;">
                                                <img class="card-img-top":src="item.images.length>0?item.images[0].image:''" alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title text-overflow" v-text="item.title" style="color:#0b75c9; ;"></h5>
                                                    <p style="color: #2e7d32;">Price : <span>{{item.price}}$</span></p>
                                                    <div class="btn-group">
                                                        <button type="button" class=" btn1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                            Option
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" @click="EditPost(item.upId)"> Edit</a>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" @click="getId(item.upId)" >Delete</a>
                                                        </div>
                                                        <button class="btn1" @click="promote(item.upId)" v-if="!item.promoted"> Promote </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Your Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete this post ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" @click="Do_delete(id)">Ok</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data(){
            return{
                uPassword:'',
                alertErr:false,
                ResetPassword:false,
                OldPassword:false,
                name: "",
                uid: this.$store.getters.getId,
                email:'',
                join:'',
                level:'',
                categoryName:{
                    home_forSell:'HomeSell',
                    home_forRent:'HomeRent',
                },
                profile:'',
                upload: [],
                promoteData:[],
                dob:'',
                phone:'',
                location:'',
                id:'',
                newJoin:'',
                pagination:[],
                data:{
                    uid:'',
                    name: '',
                    email:'',
                    password:'',
                    province:'',
                    dob:'',
                    gender:'',
                    phone:'',
                    profile:''
                },
                data1: {
                    temp: [],
                    temp_id: 0,
                    removed_image_array: [],
                },
                ChangePass:{
                    CurrentPass:'',
                    NewPass:'',
                    RetypePass:'',
                    emailUser:'',
                    user_id:''
                },
                MessageError:''
            }
        },
        mounted() {
            this.GetUserInfor();
        },
        methods:{
            ChangePassword(){
                if(this.ChangePass.CurrentPass !== '' && this.ChangePass.NewPass !== '' && this.ChangePass.RetypePass !== ''){
                    axios.post('api/ChangePass', this.ChangePass).then(response => {
                        console.log(response.data)
                        if(response.data.Message === 'Changed'){
                            window.location.reload();
                        }else {
                            this.MessageError = response.data.Message
                        }
                    }).catch(err => {
                        console.log(err);
                        this.alertErr = true
                    });
                }else {
                    this.alertErr = true
                }
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
                        this.data1.temp.push({id: this.data.temp_id, img: e.target.result, isNew: true});
                        this.data1.temp_id++;
                        $('#file').hide();
                    }
                }
            },
            removeImagePreview(e){
                this.data1.temp.splice(this.data1.temp.findIndex(v => v.id === e.id), 1);
                this.data1.removed_image_array.push({image_name: e.img});
                $('#file').show();
            },
            Reset(){
                this.ResetPassword = true
                this.OldPassword = true
            },
            editProfile(){
                this.data.profile = this.data1.temp
                axios.post('api/UpdateProfile',this.data).then(response =>{
                    console.log(response.data);
                  window.location.reload();
                }).catch(err =>{
                    console.error(err);
                });
            },
            GetPost(){
                const trustClientToken = window.localStorage.getItem('userAccessToken');
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ trustClientToken;
                axios.get('api/getpost').then(response => {
                    this.upload = response.data;
                }).catch(err => {
                });
            },
            getPromote(){
                axios.get('api/getpromote').then(response =>{
                    this.promoteData = response.data;
                }).catch(err =>{
                    console.error(err);
                });
            },
            getId(id){
                this.id = id;
            },
            Do_delete(id){
                axios.post('api/delete_post/'+id).then(response =>{
                    // console.log(response.data);
                    this.$emit('changeForm', {formName: 'userpagemaster.user'});
                }).catch(err =>{
                    //
                });
            },
            EditPost(id){
                this.$store.commit('set_EditId',id);
                this.$emit('changeForm', {formName: 'edit_post'});
            },
            promote(id){
                this.$store.commit('setPro',id);
                this.$emit('changeForm', {formName: 'Payment'});
            },
          async  GetUserInfor(){
                const trustClientToken = window.localStorage.getItem('userAccessToken');
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ trustClientToken;
              await  axios.get('api/user').then(response => {
                    console.log(response.data);

                   if(response.data.profile !== ''){
                       this.profile = response.data.profile
                   }else{
                       this.profile = 'https://www.kindpng.com/picc/m/495-4952535_create-digital-profile-icon-blue-user-profile-icon.png'
                   }
                    this.uPassword = response.data.password
                    this.data.uid = response.data.id
                    this.data = response.data
                    this.name = response.data.name;
                    this.level = response.data.user_lavel;
                    this.uid = response.data.id;
                    this.email = response.data.email;
                    this.ChangePass.emailUser = response.data.email
                    this.ChangePass.user_id = response.data.id
                    this.location = response.data.province;
                    this.dob = response.data.dob;
                    this.phone = response.data.phone;
                    this.join = response.data.updated_at;
                    let currentDate = new Date(this.join);
                    let date = currentDate.getDate();
                    let month = currentDate.getMonth(); //Be careful! January is 0 not 1
                    let year = currentDate.getFullYear();
                    let dateString = date + "-" +(month + 1) + "-" + year;
                    this.newJoin = dateString;
                }).catch(err => {
                    console.log(err);
                }).finally(()=>{
                    this.GetPost()
                    this.getPromote()
                })
            },
            logout(){
                const trustClientToken = window.localStorage.getItem('userAccessToken');
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ trustClientToken;
                axios.get('api/logout').then(response => {
                    if(response.status === 200){
                        window.localStorage.removeItem('userAccessToken');
                        window.localStorage.removeItem('user_lavel');
                        window.localStorage.removeItem('commune');
                        window.localStorage.removeItem('district');
                        window.localStorage.removeItem('catName');
                        window.localStorage.removeItem('province');
                        this.$router.push({name: 'login'});
                    }
                }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>

<style scoped lang="scss">
    input[type='password']{
        margin: 6px;
    }
    .text-overflow{
        white-space: nowrap;
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .photo-container{
        display: flex;
        flex-direction: row;
    }
    .one{
        span{
            font-size: 15px;
        }

    }
    .img-container{
        width: 200px;
        margin: 10px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        background: dodgerblue;
        border: solid #d9e0e7 2px;
    }
    .text-white{
        color: white;
        cursor: pointer;
    }
    .background{
        background: #8A2387;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to bottom, #F27121, #E94057, #8A2387);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to bottom, #F27121, #E94057, #8A2387); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    .setting-bar{
        width: 2rem;
        height: 1rem;
        cursor: pointer;
    }
    * {
        box-sizing: border-box;
    }
    html {
        font-size: 62.5%;
    }
    // Typography
       body {
           font-family: sans-serif;
           line-height: 1.6;
           margin: 0;
           min-height: 100vh;
           font-size: 1.6rem;
       }

    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    h1,h2,h3,a,p {
        color: #34495e;
    }
    a {
        text-decoration: none;
    }
    .header__navbar {
        padding: 1rem 0 1rem 0;
        margin-bottom: 25px;
        border: 1px solid #a2a2a2;
        background-color: #f4f4f4;
        -webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
    }
    .navbar {
        max-width: 1366px;
        margin: 0 auto;
        padding: 0 0 0 2rem;
    &__logo {
         margin: 0;
         float: left;
     }

    &__links {
         float: right;
         margin-top: 0rem;
    & a:not(last-child) {
          padding-right: 2rem;
      }
    & a:hover {
          color: orangered;
      }
    & li {
          display: inline;
      }
    }
    &__logo a, &__links a {
                    text-transform: uppercase;
                }
    }

    main {
        max-width: 136.6rem;
        padding: 2rem;
        margin: 0 auto;
    a {
        text-decoration: underline;
    }
    }

    // Responsive Breakpoint
    @media screen and (max-width: 36rem) {
        .header__navbar {
            padding: 0 0 2rem 0;
        }
        .navbar {
            padding: 0;
            margin-bottom: 0px;

    &__logo {
         text-align: center;
         display: block;
         float: none;
         padding: 0;
     }
    &__links {
         float: none;

        li {
            display: block;
            text-align: center;
            padding-top: 1.5rem;
        }
    }
    }
    }
    .btn1{
        margin: 2px;
        border: none;
        background-color: #1e7bca;
        font-size: small;
        border-radius: 3px;
        color: white;
        max-width: 90px;
    }

    .btn1:hover{
        background-color: rgba(9, 255, 84);
        color: #41ab6b;
    }

    .parent{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }
    .item{
        width: auto;
    }
    .profile-user-info {
        display: table;
        width: 98%;
        width: calc(100% - 24px);
        margin: 0 auto
    }

    .profile-info-row {
        display: table-row
    }

    .profile-info-name,
    .profile-info-value {
        display: table-cell;
        border-top: 1px dotted #D5E4F1
    }

    .profile-info-name {
        text-align: right;
        padding: 6px 10px 6px 4px;
        font-weight: 400;
        color: #667E99;
        background-color: transparent;
        width: 110px;
        vertical-align: middle
    }

    .profile-info-value {
        padding: 6px 4px 6px 6px
    }

    .profile-info-value>span+span:before {
        display: inline;
        content: ",";
        margin-left: 1px;
        margin-right: 3px;
        color: #666;
        border-bottom: 1px solid #FFF
    }

    .profile-info-row:first-child .profile-info-name,
    .profile-info-row:first-child .profile-info-value {
        border-top: none
    }

    .profile-user-info-striped .profile-info-name {
        color: #336199;
        background-color: #EDF3F4;
        border-top: 1px solid #F7FBFF
    }

    .profile-user-info-striped .profile-info-value {
        border-top: 1px dotted #DCEBF7;
        padding-left: 12px
    }

    .profile-picture {
        border: 1px solid #CCC;
        background-color: #FFF;
        padding: 4px;
        display: inline-block;
        max-width: 57vh;
        max-height: 48vh;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, .15);
        object-fit: cover;
    }
    .profile-activity img {
        border: 2px solid #C9D6E5;
        border-radius: 100%;
        max-width: 40px;
        margin-right: 10px;
        margin-left: 0;
        box-shadow: none
    }
    .user-profile .ace-thumbnails li {
        border: 1px solid #CCC;
        padding: 3px;
        margin: 6px
    }
    .profile-social-links>a {
        text-decoration: none;
        margin: 0 1px
    }
    .profile-users .user img {
        padding: 2px;
        border-radius: 100%;
        border: 1px solid #AAA;
        max-width: none;
        width: 64px;
        -webkit-transition: all .1s;
        -o-transition: all .1s;
        transition: all .1s
    }

    .profile-users .user img:hover {
        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .33);
        box-shadow: 0 0 1px 1px rgba(0, 0, 0, .33)
    }
    .profile-users .memberdiv .tools>a {
        margin: 0 2px
    }
    @media only screen and (max-width:480px) {
        .profile-info-name {
            width: 80px
        }
        .profile-user-info-striped .profile-info-name {
            float: none;
            width: auto;
            text-align: left;
            padding: 6px 4px 6px 10px;
            display: block
        }
        .profile-user-info-striped .profile-info-value {
            margin-left: 10px;
            display: block
        }
        .user-profile .memberdiv {
            width: 50%;
            margin-left: 0;
            margin-right: 0
        }
    }
    .itemdiv>.body>.name>b {
        color: #777
    }
    .itemdiv.dialogdiv>.user>img {
        border-color: #C9D6E5
    }
    .itemdiv.memberdiv>.user>img {
        border-color: #DCE3ED
    }
    .itemdiv.memberdiv>.body>.name>a {
        display: inline-block;
        max-width: 100px;
        max-height: 18px;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-all
    }
    .item-list>li {
        padding: 9px;
        background-color: #FFF;
        margin-top: -1px;
        position: relative
    }
    .item-list>li label {
        font-size: 13px
    }
    .ace-thumbnails>li,
    .ace-thumbnails>li>:first-child {
        display: block;
        position: relative
    }
    .ace-thumbnails>li {
        float: left;
        overflow: hidden;
        margin: 2px;
        border: 2px solid #333
    }
    .ace-thumbnails>li>:first-child:focus {
        outline: 0
    }
    .ace-thumbnails>li>.tools>a,
    .ace-thumbnails>li>:first-child .inner a {
        display: inline-block;
        color: #FFF;
        font-size: 18px;
        font-weight: 400;
        padding: 0 4px
    }
    .ace-thumbnails>li>.tools>a:hover,
    .ace-thumbnails>li>:first-child .inner a:hover {
        text-decoration: none;
        color: #C9E2EA
    }

    .ace-thumbnails>li .tools.tools-bottom>a,
    .ace-thumbnails>li .tools.tools-top>a {
        display: inline-block
    }

    .tab-content {
      background: #cfd4e7;
        padding: 16px 12px;
        position: relative
    }
    .tab-content.padding-24 {
        padding: 24px 18px
    }

    .tab-content.no-border.padding-24 {
        padding: 24px
    }

    .nav-tabs>li>a {
        padding: 7px 12px 8px
    }

    .nav-tabs>li>a,
    .nav-tabs>li>a:focus {
        border-radius: 0!important;
        border-color: #C5D0DC;
        background-color: #F9F9F9;
        color: #999;
        margin-right: -1px;
        line-height: 18px;
        position: relative
    }

    .nav-tabs>li>a:hover {
        background-color: #FFF;
        color: #4C8FBD;
        border-color: #C5D0DC
    }

    .nav-tabs>li>a:active,
    .nav-tabs>li>a:focus {
        outline: 0!important
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        color: #576373;
        border-color: #C5D0DC #C5D0DC transparent;
        border-top: 2px solid #4C8FBD;
        background-color: #FFF;
        z-index: 1;
        line-height: 18px;
        margin-top: -1px;
        box-shadow: 0 -2px 3px 0 rgba(0, 0, 0, .15)
    }

    .tabs-below>.nav-tabs>li>a,
    .tabs-below>.nav-tabs>li>a:focus,
    .tabs-below>.nav-tabs>li>a:hover {
        border-color: #C5D0DC
    }

    .tabs-below>.nav-tabs>li.active>a,
    .tabs-below>.nav-tabs>li.active>a:focus,
    .tabs-below>.nav-tabs>li.active>a:hover {
        border-color: transparent #C5D0DC #C5D0DC;
        border-top-width: 1px;
        border-bottom: 2px solid #4C8FBD;
        margin-top: 0;
        box-shadow: 0 2px 3px 0 rgba(0, 0, 0, .15)
    }

    .tabs-left>.nav-tabs>li>a,
    .tabs-right>.nav-tabs>li>a {
        min-width: 60px
    }

    .tabs-left>.nav-tabs>li {
        float: none!important
    }

    .tabs-left>.nav-tabs>li>a,
    .tabs-left>.nav-tabs>li>a:focus,
    .tabs-left>.nav-tabs>li>a:hover {
        border-color: #C5D0DC;
        margin: 0 -1px 0 0
    }

    .tabs-left>.nav-tabs>li.active>a,
    .tabs-left>.nav-tabs>li.active>a:focus,
    .tabs-left>.nav-tabs>li.active>a:hover {
        border-color: #C5D0DC transparent #C5D0DC #C5D0DC;
        border-top-width: 1px;
        border-left: 2px solid #4C8FBD;
        margin: 0 -1px;
        -webkit-box-shadow: -2px 0 3px 0 rgba(0, 0, 0, .15)!important;
        box-shadow: -2px 0 3px 0 rgba(0, 0, 0, .15)!important
    }

    .tabs-right>.nav-tabs>li {
        float: none!important
    }

    .tabs-right>.nav-tabs>li>a,
    .tabs-right>.nav-tabs>li>a:focus,
    .tabs-right>.nav-tabs>li>a:hover {
        border-color: #C5D0DC;
        margin: 0 -1px
    }

    .tabs-right>.nav-tabs>li.active>a,
    .tabs-right>.nav-tabs>li.active>a:focus,
    .tabs-right>.nav-tabs>li.active>a:hover {
        border-color: #C5D0DC #C5D0DC #C5D0DC transparent;
        border-top-width: 1px;
        border-right: 2px solid #4C8FBD;
        margin: 0 -2px 0 -1px;
        -webkit-box-shadow: 2px 0 3px 0 rgba(0, 0, 0, .15);
        box-shadow: 2px 0 3px 0 rgba(0, 0, 0, .15)
    }

    .tabs-left .tab-content,
    .tabs-right .tab-content {
        overflow: auto
    }


    .blue {
        color: #478FCA!important
    }


</style>
