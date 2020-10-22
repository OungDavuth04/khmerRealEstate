<template>
    <div class="background">
        <div class="container" >
            <h2 class="text-center" style="color: #0d47a1;">Register Information</h2>
            <div class="row jumbotron">
                <div class="col-sm-6 form-group">
                    <label for="name-f">Full Name</label>
                    <input type="text" class="form-control" v-model="data.username" name="fname" id="name-f" placeholder="Enter your first name." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" v-model="data.email" name="email" id="email" placeholder="Enter your email." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="Country">City/Province</label>
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
                    <label for="Date">Date Of Birth</label>
                    <input type="Date" name="dob" class="form-control" id="Date" placeholder="" required v-model="data.dob">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="sex">Gender</label>
                    <select id="sex" class="form-control browser-default custom-select" v-model="data.gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-sm-4 form-group">
                    <label for="tel">Phone</label>
                    <input type="tel" name="phone" v-model="data.phone" class="form-control" id="tel" placeholder="Enter Your Contact Number." required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass">Password</label>
                    <input type="Password" name="password" v-model="data.password" class="form-control" id="pass" placeholder="Enter your password." required>
                    <div class="alert alert-warning" v-if="message !== true">
                        <strong>Warning!</strong> Indicates a warning that password not match.
                    </div>
                    <div class="alert alert-warning" v-if="messageErr !== true">
                        <strong>Warning!</strong> Indicates a warning that you are not complete field.
                    </div>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="pass2">Confirm Password</label>
                    <input type="Password" name="cnf-password"v-model="data.rePassword" class="form-control" id="pass2" placeholder="Re-enter your password." required>
                </div>
                <div class="col-sm-12 form-group mb-0">
                    <button class="btn btn-primary float-right" @click="register()">Register</button>
                    <router-link to="/">
                        <h5 >Back Home To Page</h5>
                    </router-link>
                    <router-link to="/login">
                        <h5 >Log In</h5>
                    </router-link>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                message:true,
                messageErr:true,
                data:{
                    username:'',
                    email:'',
                    password:'',
                    province:'',
                    dob:'',
                    gender:'',
                    phone:'',
                    rePassword:''

                }

            }
        },
        methods:{
            register(){
                if(this.data.username !== '' &&
                    this.data.gender !== '' &&
                    this.data.dob !== '' &&
                    this.data.province !== '' &&
                    this.data.phone !== '' &&
                    this.data.email !== ''
                ){
                    this.messageErr = true;
                    if(this.data.password === this.data.rePassword){
                        axios.post('api/register', this.data).then(response => {
                            this.$router.push({name:'login'})
                            console.log(response.data)
                        }).catch(err => {
                            console.log(err);
                        })
                        this.message = true;
                    }else {
                        this.message = false;
                        console.log('no mach');
                    }
                }else {
                    this.messageErr = false;
                }
            }
        }
    }
</script>

<style scoped>
    label{
        color: white;
    }
    h5{
        color:#1d91e8 ;
    }
    .container{
        margin:0 auto;

    }
    .jumbotron{
        background: rgb(135,120,172);
        background: linear-gradient(270deg, rgba(135,120,172,1) 0%, rgba(186,132,57,1) 85%);
        width: 100%;
        height: 100%;
        margin:0;
    }

</style>
