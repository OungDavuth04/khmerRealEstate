<template>
    <div class="container-fluid">
        <div class="container">
            <div class="form-group">
                <div class="container">



                    <div class="header-title">
                        <h3 align="center"> Real Estate Categories</h3>
                    </div>
                    <hr color="red">
                    <div class="contain-addPost">
        <!--                <div class="menu-addPost">-->
        <!--                        <button class="btn-addPost" @click="addPost(categoryName.home_forSell)" >-->
        <!--                            <p>House For Sale</p>-->
        <!--                        </button>-->
        <!--                        <button class="btn-addPost" @click="addPost(categoryName.home_forRent)">-->
        <!--                       <p>House For Rent</p>-->
        <!--                   </button>-->
        <!--                </div>-->
        <!--                <div class="menu-addPost">-->
        <!--                    <button class="btn-addPost" @click="addPost(categoryName.land_forRent)">-->
        <!--                        <p>Land For Rent</p>-->
        <!--                    </button>-->
        <!--                    <button class="btn-addPost" @click="addPost(categoryName.land_forSell)">-->
        <!--                        <p>Land For Sale</p>-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--                <div class="menu-addPost">-->
        <!--                    <button class="btn-addPost" @click="addPost(categoryName.condo_forSell)">-->
        <!--                        <p>Condo For Sale</p>-->
        <!--                    </button>-->
        <!--                    <button class="btn-addPost" @click="addPost(categoryName.apartment_forRent)">-->
        <!--                        <p>Apartment For Rent</p>-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--                <div class="menu-addPost">-->
        <!--                    <button class="btn-addPost" @click="addPost(categoryName.commercial_forRent)">-->
        <!--                        <p>Commercial For Rent</p>-->
        <!--                    </button>-->
        <!--                    <button class="btn-addPost" @click="addPost(categoryName.commercial_forSell)">-->
        <!--                        <p>Commercial For Sale</p>-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--                <div class="menu-addPost">-->
        <!--                    <button class="btn-singlePost" @click="addPost(categoryName.rome_forRent)">-->
        <!--                        <p>Rome For Rent</p>-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--                <div class="menu-addPost">-->
        <!--                    <button class="btn-singlePost" @click="addPost(categoryName.other)">-->
        <!--                        <p>Other</p>-->
        <!--                    </button>-->
        <!--                </div>-->
                    <center>


                        <div class="col-md-3 col-sm-5 item" style="float: left;margin: 5px;">
                            <div class="card item-card card-block">
                                <img src="storage/icon/hous.jpg" alt="Photo of sunset">
                                <button type="button" class="btn-size blue" @click="addPost(categoryName.home_forSell)">
                                    House For Sell
                                </button>
                                <button type="button" class="btn-size blue" @click="addPost(categoryName.home_forRent)">
                                    House For Rent
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-5 item" style="float: left;margin: 5px;">
                            <div class="card item-card card-block">
                                <img src="storage/icon/land.jpeg" alt="Photo of sunset" >
                                <button type="button" class="btn-size blue" @click="addPost(categoryName.land_forSell)">
                                    land For Sell
                                </button>
                                <button type="button" class="btn-size blue" @click="addPost(categoryName.land_forRent)">
                                    land For Rent
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-5 item" style="float: left;margin: 5px;">
                            <div class="card item-card card-block">
                                <img src="storage/icon/condo.jpg" alt="Photo of sunset">
                                <button type="button" class="btn-size blue" @click="addPost(categoryName.condo_forSell)">
                                    Condo For Sell
                                </button>
                                <button type="button" class="btn-size blue" @click="addPost(categoryName.apartment_forRent)">
                                    Apartment For Rent
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-5 item" style="float: left;margin: 5px;">
                            <div class="card item-card card-block">
                                <img src="storage/icon/commercial.jpg" alt="Photo of sunset" @click="addPost(categoryName.commercial_forSell)">
                                <button type="button" class="btn-size blue">
                                    commercial For Sell
                                </button>
                                <button type="button" class="btn-size blue"@click="addPost(categoryName.commercial_forRent)">
                                    commercial For Rent
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-8 item" style="float: left; margin: 11px; height: 300px;">
                            <div class="card item-card card-block">
                                <img src="storage/icon/room.jpg" alt="Photo of sunset">

                                <button type="button" class="btn-size blue" style="margin-bottom: 40px;" @click="addPost(categoryName.rome_forRent)">
                                    Room For Rent
                                </button>
                              <p style="color: gold;">The Best Website Easy to Find your Real Estate</p>
                            </div>
                        </div>
                    </center>
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

                categoryName:{
                    home_forSell:'HomeSell',
                    home_forRent:'HomeRent',
                    land_forRent:'landRent',
                    land_forSell:'landSell',
                    condo_forSell:'condoSell',
                    apartment_forRent:'apartmentRent',
                    commercial_forSell:'commercialSell',
                    commercial_forRent:'commercialRent',
                    rome_forRent:'romeRent',
                    other:'other'

                }
            }
        },
        methods:{
            addPost(param){
                if (param === this.categoryName.home_forSell){
                    // console.log(this.categoryName.home_forRent)
                    this.$store.commit('set_catName', this.categoryName.home_forSell );
                    console.log(this.$store.getters.categoryName)
                    //this.$router.push({name:'upload'})
                    this.$emit('changeForm', {formName: 'main_post'});
                }
                else if(param === this.categoryName.home_forRent){
                    this.$store.commit('set_catName', this.categoryName.home_forRent );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'main_post'});
                }
                else if(param === this.categoryName.land_forRent){
                    this.$store.commit('set_catName', this.categoryName.land_forRent );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'default_post'});
                }
                else if(param === this.categoryName.land_forSell){
                    this.$store.commit('set_catName', this.categoryName.land_forSell );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'default_post'});
                }
                else if(param === this.categoryName.condo_forSell){
                    this.$store.commit('set_catName', this.categoryName.condo_forSell );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'default_post'});
                }
                else if(param === this.categoryName.apartment_forRent){
                    this.$store.commit('set_catName', this.categoryName.apartment_forRent );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'default_post'});
                }
                else if(param === this.categoryName.commercial_forRent){
                    this.$store.commit('set_catName', this.categoryName.commercial_forRent );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'default_post'});
                }
                else if(param === this.categoryName.commercial_forSell){
                    this.$store.commit('set_catName', this.categoryName.commercial_forSell );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'default_post'});
                }
                else if(param === this.categoryName.rome_forRent){
                    this.$store.commit('set_catName', this.categoryName.rome_forRent );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'default_post'});
                }
                else if(param === this.categoryName.other){
                    this.$store.commit('set_catName', this.categoryName.other );
                    console.log(this.$store.getters.categoryName)
                    this.$emit('changeForm', {formName: 'default_post'});
                }

            }
        }
    }
</script>

<style scoped>
    *,
    *::before,
    *::after {
        padding: 0;
        margin: 0;
    }

    .btn-size{
        color:gold;
        width: 100%;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: 300%;
        transition: all 0.6s;
        font-size: 12px;
        text-transform: uppercase;
        border-radius: 4px;
        position: relative;
        border: 1px solid #66ccff;
    }
    .black {
        color: black;
        background-image: linear-gradient(90deg, white 50%, black 50%);
    }

    .green {
        color: green;
        background-image: linear-gradient(-120deg, green 50%, white 50%);
    }
    .orange {
        color: orange;
        background-image: linear-gradient(120deg, white 50%, orange 50%);
    }

    .blue{
        color: orangered;
        background-image: linear-gradient(160deg, white 50%, blue 50%);
    }

    .pink{
        color: pink;
        background-image: linear-gradient(20deg, white 50%, pink 50%);
    }

    .btn-size:hover {
        color: #fff;
        background-position: 100%;
    }

    .btn-size:active {
        transform: translate(0.5rem, 0.5rem);
        box-shadow: 0px 10px 20px -15px rgba(0, 0, 0, 0.75);
    }

    img{
        height:150px;
        width:100%;
    }

    .item{
        padding-left:5px;
        padding-right:5px;
    }
    .item-card{
        transition:0.5s;
        cursor:pointer;
    }
    .item-card-title{
        font-size:15px;
        transition:1s;
        cursor:pointer;
    }
    .item-card-title i{
        font-size:15px;
        transition:1s;
        cursor:pointer;
        color:#ffa710
    }
    .card-title i:hover{
        transform: scale(1.25) rotate(100deg);
        color:#18d4ca;

    }
    .card:hover{
        transform: scale(1.05);
        box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
    }
    .card-text{
        height:80px;
    }

    .card::before, .card::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform: scale3d(0, 0, 1);
        /*transition: transform .3s ease-out 0s;*/
        background: rgba(255, 255, 255, 0.1);
        content: '';
        pointer-events: none;
    }
    .card::before {
        transform-origin: left top;
    }
    .card::after {
        transform-origin: right bottom;
    }
    .card:hover::before, .card:hover::after, .card:focus::before, .card:focus::after {
        transform: scale3d(1, 1, 1);
    }
   .btn-singlePost{
       height: 100%;
       width: 100%;
       border: solid 1px;
       cursor: pointer;
       background-color: #857b26;
   }
   .btn-singlePost:hover{
       background-color: #1d68a7;
   }

    .btn-addPost{
        height: 100%;
        width: 50%;
        border: solid 1px;
        float: left;
        cursor: pointer;
        background-color: #857b26;
        text-align: justify;
    }
    .btn-addPost:hover{
        background-color: #1d68a7;
    }
    .menu-addPost{
        width: 20%;
        height: 30%;
        padding: 1%;
        float: left;
        margin-left: 4%;
        margin-bottom: 3%;
    }

    .contain-addPost{
        width: 100%;
        height: 100%;

        margin-top: 2%;
        padding: 5%;
    }

    .main-content{
        background-color: #6cb2eb;
        width: 80%;
        height: 50rem;
        margin-left: 10%;
        padding-top: 2%;

    }
    .header-title{
        font-family: Algerian;
        color: #857b26;
        text-shadow: #857b26;
    }
</style>
