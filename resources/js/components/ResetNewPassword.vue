<template>
    <div>
        <div class="container">
            <div class="card login-form">
                <div class="card-body">
                    <h3 class="card-title text-center">Reset password</h3>
                    <div class="card-text">
                        <div class="form-group">
                            <p for="exampleInputEmail1">Email Address</p>
                            <input type="email" class="form-control form-control-sm"  v-model="email" placeholder="Enter your email address">
                            <small v-if="errorEmail === true" class="form-text text-muted" style="color: #0d47a1">Token Has Sending To Email...</small>
                            <small v-if="invaliMAail === true" class="form-text text-muted" style="color: orangered">Invalid Email...</small>
                        </div>
                    <button type="submit" class="btn btn-primary btn-block" @click="sendToken">Send Token</button>
                    </div>

                    <div class="card-text" v-if="validateTokens === true">
                        <hr>
                        <div class="form-group">
                            <p for="exampleInputEmail1">Verify Token</p>
                            <input type="text" class="form-control form-control-sm"  v-model="token" placeholder="Enter your email address">
                            <small v-if="errorToken === true" class="form-text text-muted" style="color: #0d47a1">Token Error...</small>
                        </div>
                    <button type="submit" class="btn btn-primary btn-block" @click="validateToken">Send Token</button>
                    </div>

                    <div class="card-text" v-if="ChangPasswords === true">
                        <hr>
                        <div class="form-group">
                            <p for="exampleInputEmail1">Reset New Password</p>
                            <span>New Password</span>
                            <input type="password" class="form-control form-control-sm"  v-model="NewPassword" placeholder="New Password">
                            <span>Confirm Password</span>
                            <input type="password" class="form-control form-control-sm"  v-model="PasswordAgain" placeholder="Confirm Password">
                            <small v-if="errNotMatch === true" class="form-text text-muted" style="color: #0d47a1">Password Not Match</small>
                            <small v-if="failReset === true" class="form-text text-muted" style="color: orangered">Failed Reset</small>
                        </div>
                    <button type="submit" class="btn btn-primary btn-block" @click="ChangPassword">Send Token</button>
                    </div>
                </div>
            </div>
<!--                <form v-on:submit.prevent="sendToken" >-->
<!--                    <div class="form-group">-->
<!--                        <label >Email</label>-->
<!--                        <input type="text" class="form-control"-->
<!--                               v-model="email"-->
<!--                               placeholder="Enter Email Reset...." style="width: 40% ;margin: 10px">-->
<!--                        <small id="emailHelp" class="form-text text-muted">Token Has Sending To Email...</small>-->
<!--                        <small id="emailHelp" class="form-text text-muted">Invalid Email...</small>-->
<!--                        <button type="submit" class="btn btn-outline-primary" >Send Email Token</button>-->
<!--                    </div>-->
<!--                </form>-->
<!--                    <div class="form-group" v-if="validateTokens">-->
<!--                        <label>Token</label>-->
<!--                        <input type="text" class="form-control"-->
<!--                               v-model="token"-->
<!--                               v-bind:class="{'is valid':tokenInfor,'is valid':errorToken }"-->
<!--                               placeholder="Enter Email Reset...." style="width: 40%;margin: 10px">-->
<!--                        <div class="valid-feedback">{{tokenInfor}}</div>-->
<!--                        <div class="invalid-feedback">{{errorToken}}</div>-->
<!--                        <button type="submit" class="btn btn-outline-primary" @click="validateToken">Validate Token</button>-->
<!--                    </div>-->
<!--                <form v-on:submit.prevent="ChangPassword" >-->
<!--                    <div class="form-group" v-if="ChangPasswords">-->
<!--                        <label >Reset New Password</label>-->
<!--                        <input type="text" class="form-control" v-model="NewPassword" placeholder="Enter New Password...." style="width: 40%;margin: 10px">-->
<!--                        <input type="text" class="form-control"  v-model="PasswordAgain" placeholder="Enter Password Again...." style="width: 40%;margin: 10px">-->
<!--                        <div class="invalid-feedback">{{errNotMatch}}</div>-->
<!--                        <button type="submit" class="btn btn-outline-primary">Chang Password</button>-->
<!--                    </div>-->
<!--                </form>-->

        </div>
    </div>
</template>

<script>
    export default {
        name: "ResetNewPassword",
        data(){
            return{
                failReset:false,
                emailSending:'',
                validateTokens: false,
                ChangPasswords: false,
                email:'',
                token:'',
                NewPassword:'',
                PasswordAgain:'',
                emailInfor:null,
                errorEmail:false ,
                tokenInfor:null,
                errorToken:false,
                user:null,
                errNotMatch:false,
                invaliMAail:false
            }
        },
        methods:{
            sendToken(){
                const data ={
                    email: this.email
                }
                axios.post('send-token',data).then(response=>{
                    this.validateTokens = true
                    this.errorEmail = true
                }).catch(err=>{
                    this.invaliMAail = true
                })
            },
            validateToken(){
                const data ={
                    token: this.token,
                    email: this.email
                }
                axios.post('valid-token',data).then(response =>{
                    this.user = response.data
                    this.ChangPasswords = true
                    this.errorToken = false
                }).catch(err=>{
                    this.errorToken = true
                })
            },
            ChangPassword(){
                if(this.NewPassword !== this.PasswordAgain){
                    this.errNotMatch = true
                }else {
                    const data ={
                        password: this.NewPassword,
                        user_id: this.user.id
                    }
                    axios.post('reset-password',data).then(response=>{
                        this.$router.push("/login")
                        console.log(response.data)
                    }).catch(err=>{
                        console.log(err)
                        this.failReset = true
                    })
                }
            }
        }
    }
</script>

<style scoped>

    .container{
        margin-top: 88px;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    @media (min-width: 1200px){
        .container-xl, .container-lg, .container-md, .container-sm, .container {
            max-width: 413px;
        }
    }

    html,body { height: 100%; }
    body{
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        background-color: #f5f5f5;
    }

    form{
        padding-top: 10px;
        font-size: 14px;
        margin-top: 30px;
    }

    .card-title{ font-weight:300; }

    .btn{
        font-size: 14px;
        margin-top:20px;
    }

    .login-form{
        width:420px;
        margin:20px;
    }

    .sign-up{
        text-align:center;
        padding:20px 0 0;
    }

    span{
        font-size:14px;
    }



</style>
