<template >

    <div class="content" >
        <div class="container">
            <div class="form animated flipInY">
                <h2>Login To Your Account</h2>
                <form>
                    <input placeholder="Email" type="email" v-model="data.email">
                    <input placeholder="Password" type="password" v-model="data.password">
                    <small v-if="errLogIn === true" class="form-text text-muted" style="color: #0d47a1">Log In Fail...</small>
                    <span style="color: orange; font-size: 12px">{{messageErr}}</span>
                    <button @click="login">Login</button>

                    <router-link to="/">
                        <p style="color: #0b75c9; font-size: 12px" >Back Home Page</p>
                    </router-link>
                    <router-link to="/register">
                        <p style="color: #0b75c9; font-size: 12px" >Register</p>
                    </router-link>
                        <p style="color: #0b75c9; font-size: 12px">Reset the Password
                            <span style="font-size: 12px">
                                <router-link to="/resetNewPassword">
                                   <strong style="color: white">  here</strong>
                                </router-link>
                            </span>
                        </p>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                errLogIn:false,
                data: {
                    email: '',
                    password: '',
                },
                messageErr:''
            }
        },
        created() {
            if(window.localStorage.getItem('userAccessToken') !== null){
                this.$router.push({name:'userpage'})
            }
        },
        methods:{
            login(){
                if(this.data.password != '' && this.data.email != ''){
                    let app = this;
                    let Login = app.data;
                    axios.post('api/login', Login).then(response => {
                        const userToken = response.data.access_token ;
                        window.localStorage.setItem('userAccessToken', userToken);
                        //query user information
                        this.queryUserInfo();
                    }).catch(err => {
                        console.log(err);
                        this.errLogIn = true
                    });
                }else {
                    this.messageErr = 'Invalid File....!!!'
                }
            },
            queryUserInfo(){
                const trustClientToken = window.localStorage.getItem('userAccessToken');
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ trustClientToken;
                axios.get('api/user').then(response => {
                    window.localStorage.setItem('user_lavel', response.data.user_lavel);
                    this.$store.commit('setName', response.data.name);
                    this.$store.commit('setID', response.data.id);
                    if (response.data.user_lavel === "user" && response.data.disable === "true"){
                        this.$router.push({name:'home.userpagemaster'});
                    }else {
                        this.$router.push({name:'admin'});
                    }
                }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>

<style scoped lang="scss">
    html{
        background: #0b75c9;
    }
    .form {
        position: absolute;
        top: 40%;
        left: 55%;
        background: #0b0a48;
        width: 285px;
        margin: -140px 0 0 -182px;
        padding: 40px;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);

    }
    .form h2 {
        margin: 0 0 20px;
        line-height: 1;
        color: #44c4e7;
        font-size: 18px;
        font-weight: 400;
    }
    .form input {
        outline: none;
        display: block;
        width: 100%;
        margin: 0 0 20px;
        padding: 10px 15px;
        border: 1px solid #ccc;
        color: #ccc;
        font-family: "Roboto";
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        font-size: 14px;
        font-wieght: 400;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        -webkit-transition: 0.1s linear;
        -moz-transition: 0.1s linear;
        -ms-transition: 0.1s linear;
        -o-transition: 0.1s linear;
        transition: 0.1s linear;
    }
    .form input:focus {
        color: #333;
        border: 1px solid #44c4e7;
    }
    .form button {
        cursor: pointer;
        background: #44c4e7;
        width: 100%;
        padding: 10px 15px;
        border: 0;
        color: #fff;
        font-family: "Roboto";
        font-size: 14px;
        font-weight: 400;

    }
    .form button:hover {
        background: #369cb8;
    }


</style>
