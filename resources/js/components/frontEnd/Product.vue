<template >
    <div>
        <div class="content">
            <!--navbar-->
            <nav class="navbar navbar-expand-lg navbar-light bg-primary " >
            <a class="navbar-brand" href="#">
                <img src="storage/icon/logo.jpg"  style="width: 40px; height: 40px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="searchBox">
                    <div class="form-group mr-sm-2">
                        <select  class="form-control" v-model="searchCat">
                            <option value="allCartegory" >All Category</option>
                            <option value="houseSale">House for Sale</option>
                            <option value="houseRent">House for Rent</option>
                            <option value="condoSale">Condo for Sale</option>
                            <option value="apRent">Apartment for Rent</option>
                            <option value="landSale">Land for Sale</option>
                            <option value="landRent">Land for Rent</option>
                            <option value="comSale">Commercial for Sale</option>
                            <option value="comRent">Commercial for Rent</option>
                            <option value="roomRent">Room for Rent</option>
                        </select>
                    </div>

                    <button class="btn btn-outline-success my-2 my-sm-0 bg-light" type="submit" @click="search()">Search</button>
                </form>
            </div>
        </nav>


            <nav class="navbar navbar-expand-lg navbar-toggle bg-info " style="margin-top: 15px;">


                <div class="collapse navbar-collapse" >
                    <ul class="navbar-nav mr-auto"></ul>
                    <form class="form-inline my-2 my-lg-0">


                        <div class="form-group mr-sm-2">
                            <select v-model="data.provinceSelected" id="provinces" class="form-control" @change="getDistricts">
                                <option v-for="province in allProvinces" :value="province.pro_id">{{ province.ProvinceName }}</option>
                            </select>
                        </div>
                        <div class="form-group mr-sm-2">

                            <!--Start Loading Indicator-->
                            <div v-if="loadingDistricts" class="justify-content-center w-100 align-middle text-center">
                                <div class="spinner-border text-success" role="status"></div>
                            </div>
                            <!--End Loading Indicator-->
                            <div v-if="!data.provinceSelected" class="form-control bg-primary "> Select Province</div>
                            <select v-if="!loadingDistricts && data.provinceSelected" v-model="data.districtSelected" id="districts" class="form-control" @change="getCommunes">
                                <option v-for="district in allDistricts" :value="district.dis_id">{{ district.DistrictName }}</option>
                            </select>
                        </div>
                        <div class="form-group mr-sm-2">

                            <!--Start Loading Indicator-->
                            <div v-if="progressing.loadingCommunes" class="justify-content-center w-100 align-middle text-center">
                                <div class="spinner-border text-success" role="status"></div>
                            </div>
                            <!--End Loading Indicator-->
                            <div v-if="!data.districtSelected" class="form-control bg-primary ">Select District</div>
                            <select v-if="!progressing.loadingCommunes && data.districtSelected" v-model="data.communeSelected "id="communes" class="form-control">
                                <option v-for="commune in allCommunes" :value="commune.com_id">{{ commune.CommuneName }}</option>
                            </select>
                        </div>

                    </form>
                </div>
            </nav>
            <!-- end navbar-->
                            <!--menu-->
                            <div class="form-group">
                                <section id="team" class="pb-5">
                                    <div class="container">
                                        <h5 class="section-title h1">ALL CATEGORY</h5>
                                        <div class="row">

                                            <!-- Team member -->
                                            <div class="  col-md-3">
                                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                                    <div class="mainflip">
                                                        <div class="frontside">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <p><img class=" img-fluid" src="storage/icon/hous.jpg" alt="card image"></p>
                                                                    <h4 class="card-title">House</h4>

                                                                    <a href="#" class=" btn-primary btn-sm">KHMER REAL ESTATE</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="backside">
                                                            <div class="card">
                                                                <div class="card-body text-center mt-4">
                                                                    <h4 class="card-title">House</h4>
                                                                    <hr>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('HomeSell')">
                                                                            <span>Buy</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('HomeRent')">
                                                                            <span>Rent</span>
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./Team member -->
                                            <!-- Team member -->
                                            <div class="col-md-3">
                                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                                    <div class="mainflip">
                                                        <div class="frontside">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <p><img class=" img-fluid" src="storage/icon/land.jpeg" alt="card image"></p>
                                                                    <h4 class="card-title">Lands</h4>
                                                                    <a href="#" class=" btn-primary btn-sm">KHMER REAL ESTATE</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="backside">
                                                            <div class="card">
                                                                <div class="card-body text-center mt-4">
                                                                    <h4 class="card-title">Land</h4>
                                                                    <hr>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('landSell')">
                                                                            <span>Buy</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('landRent')">
                                                                            <span>Rent</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./Team member -->
                                            <!-- Team member -->
                                            <div class="col-md-3">
                                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                                    <div class="mainflip">
                                                        <div class="frontside">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <p><img class=" img-fluid" src="storage/icon/condo.jpg" alt="card image"></p>
                                                                    <h4 class="card-title">Condos</h4>
                                                                    <a href="#" class=" btn-primary btn-sm">KHMER REAL ESTATE</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="backside">
                                                            <div class="card">
                                                                <div class="card-body text-center mt-4">
                                                                    <h4 class="card-title">Condo & Apartment</h4>
                                                                    <hr>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('condoSell')">
                                                                            <span>Buy</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('apartmentRent')">
                                                                            <span>Rent</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./Team member -->

                                            <!-- Team member -->
                                            <div class="col-md-3">
                                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                                    <div class="mainflip">
                                                        <div class="frontside">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <p><img class=" img-fluid" src="storage/icon/commercial.jpg" alt="card image"></p>
                                                                    <h4 class="card-title">Commersials</h4>
                                                                    <a href="#" class=" btn-primary btn-sm">KHMER REAL ESTATE</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="backside">
                                                            <div class="card">
                                                                <div class="card-body text-center mt-4">
                                                                    <h4 class="card-title">Commercial</h4>
                                                                    <hr>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('commercialSell')">
                                                                            <span>Buy</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('commercialRent')">
                                                                            <span>Rent</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./Team member -->
                                            <!-- Team member -->
                                            <div class="col-md-3">
                                                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                                                    <div class="mainflip">
                                                        <div class="frontside">
                                                            <div class="card">
                                                                <div class="card-body text-center">
                                                                    <p><img class=" img-fluid" src="storage/icon/room.jpg" alt="card image"></p>
                                                                    <h4 class="card-title">Rooms</h4>
                                                                    <a href="#" class=" btn-primary btn-sm">KHMER REAL ESTATE</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="backside">
                                                            <div class="card">
                                                                <div class="card-body text-center mt-4">
                                                                    <h4 class="card-title">Room</h4>
                                                                    <hr>
                                                                    <div class="btn-holder">
                                                                        <button class="btn btn-5 hover-border-11" @click="category('romeRent')">
                                                                            <span>Rent</span>
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./Team member -->

                                        </div>
                                    </div>
                                </section>


                            </div>
                            <!--end menu-->
                            <div class="container">

                                <h2>Popular Ads</h2>
                                <div class="form-group ">
                                    <div class="row">

                                    </div>
                                </div> 

                                <h2>Feature Ads</h2>
                                <div class="form-group bg-primary">
                                    <div class="row mx-auto my-auto">
                                        <div id="myCarousel" class="carousel slideInLeft  w-100" data-ride="carousel" style="padding: 5px;">
                                            <div class="carousel-inner w-100" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="col-lg-3 ">
                                                        <div class="card" style="width: 16rem;">
                                                            <img class="card-img-top" src="http://placehold.it/350x180?text=1" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Card title 1</h5>
                                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="col-lg-3 ">
                                                        <div class="card" style="width: 16rem;">
                                                            <img class="card-img-top" src="http://placehold.it/350x180?text=2" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Card title 2</h5>
                                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="col-lg-3 ">
                                                        <div class="card" style="width: 16rem;">
                                                            <img class="card-img-top" src="http://placehold.it/350x180?text=3" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Card title 3</h5>
                                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="col-lg-3 ">
                                                        <div class="card" style="width: 16rem;">
                                                            <img class="card-img-top" src="http://placehold.it/350x180?text=4" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Card title 4</h5>
                                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="col-lg-3 ">
                                                        <div class="card" style="width: 16rem;">
                                                            <img class="card-img-top" src="http://placehold.it/350x180?text=5" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Card title 5</h5>
                                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="col-lg-3 ">
                                                        <div class="card" style="width: 16rem;">
                                                            <img class="card-img-top" src="http://placehold.it/350x180?text=6" alt="Card image cap">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Card title 6</h5>
                                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                                <a href="#" class="btn btn-primary">Go somewhere</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev bg-dark w-auto" href="#myCarousel" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next bg-dark w-auto" href="#myCarousel" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <h2>Last Ads</h2>
                                <button type="button" class=" btn1" @click="productQuery()"> Refresh New</button>
                                <hr>
                                <div class="row">

                                    <template v-if="getproduct.length > 0" v-for=" item in queriedData ">
                                        <div class="col-xs-12 col-sm-6 col-md-3" >
                                            <article class="card-wrapper">
                                                <div class="image-holder">
                                                    <a href="#" class="image-holder__link" @click="Detail(item.upId,item.cat_name,item.province,item.district,item.commune)"></a>
                                                    <div class="image-liquid image-holder--original" >
                                                        <img :src="item.images.length>0?item.images[0].image:''">
                                                    </div>
                                                </div>

                                                <div class="product-description">
                                                    <!-- title -->
                                                    <h1 class="product-description__title">
                                                        <a href="#">
                                                           {{item.title}}
                                                        </a>
                                                    </h1>

                                                    <!-- category and price -->
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-8 product-description__category secondary-text">
                                                            Price
                                                        </div>
                                                        <div class="col-xs-12 col-sm-4 product-description__price">
                                                            {{item.price}}
                                                        </div>
                                                    </div>

                                                    <!-- divider -->
                                                    <hr />

                                                    <!-- sizes -->
                                                    <div class="sizes-wrapper">
                                                        <b>Discription</b>
                                                        <br />
                                                        <span class="secondary-text text-uppercase">
                                                            {{item.description}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </article>

                                         </div>
                                    </template>
                                </div>
                            </div>
                            <footer-Page>

                            </footer-Page>
        </div>
    </div>
</template>

<script>



   import Footer from './footer'
    export default {
        name: "Product",
        components: {
            'footer-Page' : Footer
        },
        data(){

            return{
                data:{
                    provinceSelected: null,
                    districtSelected: null,
                    communeSelected: null,
                },
                progressing:{
                    loadingCommunes: false,
                },
                allProvinces: [],
                allDistricts: [],
                allCommunes: [],
                loadingDistricts: false,
                slides: 7,
                getproduct:[],
                alertMessage:[],
                searchBox:'',
                searchCat:'',
                searchPro:'',
                searchDist:'',
                searchComm:''
            }

        }
       ,
        created(){

        },
        mounted() {
            this.promote();
            this.notification();
            const ClientToken = window.localStorage.getItem('userAccessToken');

            if(ClientToken == null){
                console.log('true');
            }
            else {

            }
            this.productQuery();
            this.slider();
            axios.get('api/province').then(response => {
                if(response.status === 200){
                    this.allProvinces = response.data;

                    //console.log(response);
                }
            }).catch(err => {

            });

        },
        methods:{
            promote(){
                axios.get('api/promote').then(response => {
                    if(response.status === 200){
                        console.log(response.data);
                    }
                }).catch(err => {

                })
            },
            category(cat){
                this.$store.commit('setCategory',cat);
                this.$router.push({name:'Category'})
            },
            search(){
                this.$store.commit('setSearchBox',this.searchBox);
                this.$store.commit('setSearchCat',this.searchCat);
                this.$store.commit('setSearchPro',this.data.provinceSelected);
                this.$store.commit('setSearchDis',this.data.districtSelected);
                this.$store.commit('setSearchCom',this.data.communeSelected);
                this.$router.push({name:'product.search'})
            },
            notification(){
                Pusher.logToConsole = true;

                var pusher = new Pusher('66799a7de1a190499614', {
                    cluster: 'ap1'
                });
                var channel = pusher.subscribe('my-channel');
                channel.bind('my-event', function(data) {
                    app.alertMessage.push(JSON.stringify(data))  ;
                });
            },

            Detail(pid,cat,province,district,commune){
                this.$store.commit('setDetail',pid);
                this.$store.commit('setProvince',province);
                this.$store.commit('setCommune',commune);
                this.$store.commit('setDistrict',district);
                this.$store.commit('setCatStore',cat);
                this.$router.push({name:'product.detail'})
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
            getMac(){
                axios.get('api/macadd').then(response => {
                    if(response.status === 200){
                        console.log(response.data);
                        //console.log(response);
                    }
                }).catch(err => {

                })
            },
            productQuery(){
                axios.get('api/getproduct').then(response => {
                    if(response.status === 200){
                      this.getproduct = response.data;
                       console.log(response.data);
                    }
                }).catch(err => {

                }).finally(() => {

                });
            }
            ,


            slider(){
                $('#myCarousel').carousel({
                    interval: 1000
                })

                $('.carousel .carousel-item').each(function() {
                    let minPerSlide = 8;
                    let next = $(this).next();
                    if (!next.length) {
                        next = $(this).siblings(':first');
                    }
                    next.children(':first-child').clone().appendTo($(this));

                    for (let i = 0; i < minPerSlide; i++) {
                        next = next.next();
                        if (!next.length) {
                            next = $(this).siblings(':first');
                        }

                        next.children(':first-child').clone().appendTo($(this));
                    }
                });
            }


        },
        computed:{
            queriedData(){

                return this.getproduct;
            }

        }



    }
</script>

<style lang="scss">
    .btn1{
        border: 0px;
        border-radius: 3px;
        padding: 8px;
        width: 150px;
        background-color: #0e2af78c;
    }
    .btn1:hover{
        opacity: 4.0;
    }
    @import "https://www.w3schools.com/w3css/4/w3.css";
    @media (min-width: 768px) {

        .carousel-inner .carousel-item-right.active,
        .carousel-inner .carousel-item-next {
            transform: translateX(50%);
        }

        .carousel-inner .carousel-item-left.active,
        .carousel-inner .carousel-item-prev {
            transform: translateX(-50%);
        }

    }

    /* large - display 3 */
    @media (min-width: 992px) {

        .carousel-inner .carousel-item-right.active,
        .carousel-inner .carousel-item-next {
            transform: translateX(33%);
        }

        .carousel-inner .carousel-item-left.active,
        .carousel-inner .carousel-item-prev {
            transform: translateX(-33%);
        }
    }

    @media (max-width: 768px) {
        .carousel-inner .carousel-item>div {
            display: none;
        }

        .carousel-inner .carousel-item>div:first-child {
            display: block;
        }
    }

    .carousel-inner .carousel-item.active,
    .carousel-inner .carousel-item-next,
    .carousel-inner .carousel-item-prev {
        display: flex;
    }

    .carousel-inner .carousel-item-right,
    .carousel-inner .carousel-item-left {
        transform: translateX(0);
    }






    :active, :hover, :focus {
        outline: 0!important;
        outline-offset: 0;
    }
    ::before,
    ::after {
        position: absolute;
        content: "";
    }


    .btn-holder {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        max-width: 1000px;
        margin: 10px auto 35px;
    }


    .btn {
        position: relative;
        display: inline-block;
        width: auto;
        height: auto;
        background-color: transparent;
        border: none;
        cursor: pointer;
        margin: 0px 25px 15px;
        min-width: 150px;
    }
    .btn span {
        position: relative;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 2px;
        text-transform: uppercase;
        top: 0; left: 0;
        width: 100%;
        padding: 7px ;
        transition: 0.3s;
    }

    .btn-4 span {
        color: rgb(28, 31, 30);
        background-color: rgb(245,245,245);
    }
    .btn-4 span:hover {
        color: rgb(54, 56, 55);
    }


    .btn.hover-border-6 span::before,
    .btn.hover-border-6 span::after {
        width: 0%; height: 0%;
        background: transparent;
        opacity: 0;
        z-index: 2;
        transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s 0.35s;
    }
    .btn.hover-border-6 span::before {
        top: 0; left: 0;
        border-left: 2px solid rgb(54, 56, 55);
        border-bottom: 2px solid rgb(54, 56, 55);
    }
    .btn.hover-border-6 span::after {
        top: 0; right: 0;
        border-right: 2px solid rgb(54, 56, 55);
        border-bottom: 2px solid rgb(54, 56, 55);
    }
    .btn.hover-border-6 span:hover::before,
    .btn.hover-border-6 span:hover::after {
        width: 50%; height: 96%;
        opacity: 1;
        transition: height 0.2s 0.2s ease-in, width 0.2s 0.4s linear, opacity 0s 0.2s;
    }



    .btn.hover-border-7 span::before,
    .btn.hover-border-7 span::after {
        width: 0%; height: 0%;
        background: transparent;
        opacity: 0;
        z-index: 2;
        transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s 0.35s;
    }
    .btn.hover-border-7 span::before {
        bottom: 0; left: 0;
        border-left: 2px solid rgb(54, 56, 55);
        border-top: 2px solid rgb(54, 56, 55);
    }
    .btn.hover-border-7 span::after {
        bottom: 0; right: 0;
        border-right: 2px solid rgb(54, 56, 55);
        border-top: 2px solid rgb(54, 56, 55);
    }
    .btn.hover-border-7 span:hover::before,
    .btn.hover-border-7 span:hover::after {
        width: 50%; height: 96%;
        opacity: 1;
        transition: height 0.2s 0.2s ease-in, width 0.2s 0.4s linear, opacity 0s 0.2s;
    }



    .btn.hover-border-8 span::before,
    .btn.hover-border-8 span::after {
        width: 0%; height: 0%;
        bottom: 0;
        background: transparent;
        opacity: 0;
        z-index: 2;
    }
    .btn.hover-border-8 span::before {
        left: 0%;
        border-left: 2px solid rgb(54, 56, 55);
        transition: height 0.25s ease-in, opacity 0s 0.35s;
    }
    .btn.hover-border-8 span:hover::before {
        height: 96%;
        opacity: 1;
        transition: height 0.25s 0.2s ease-out, opacity 0s 0.2s;
    }
    .btn.hover-border-8 span::after {
        right: 0%;
        border-right: 2px solid rgb(54, 56, 55);
        border-top: 2px solid rgb(54, 56, 55);
        transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s 0.35s;
    }
    .btn.hover-border-8 span:hover::after {
        width: 99%; height: 96%;
        opacity: 1;
        transition: height 0.15s 0.1s linear, width 0.2s 0.25s linear, opacity 0s 0.1s;
    }


    .btn.hover-border-9 span::before,
    .btn.hover-border-9 span::after {
        width: 0%; height: 0%;
        bottom: 0;
        background: transparent;
        opacity: 0;
        z-index: 2;
    }
    .btn.hover-border-9 span::after {
        right: 0%;
        border-right: 2px solid rgb(54, 56, 55);
        transition: height 0.25s ease-in, opacity 0s 0.35s;
    }
    .btn.hover-border-9 span:hover::after {
        height: 96%;
        opacity: 1;
        transition: height 0.25s 0.2s ease-out, opacity 0s 0.2s;
    }
    .btn.hover-border-9 span::before {
        left: 0%;
        border-left: 2px solid rgb(54, 56, 55);
        border-top: 2px solid rgb(54, 56, 55);
        transition: width 0.2s ease-in, height 0.15s 0.2s linear, opacity 0s 0.35s;
    }
    .btn.hover-border-9 span:hover::before {
        width: 98.5%; height: 96%;
        opacity: 1;
        transition: height 0.15s 0.1s linear, width 0.2s 0.25s linear, opacity 0s 0.1s;
    }

    .btn.hover-border-10 span::before,
    .btn.hover-border-10 span::after {
        width: 0%; height: 0%;
        background: transparent;
        opacity: 0;
        z-index: 2;
    }
    .btn.hover-border-10 span::after {
        bottom: 0; left: 0%;
        border-bottom: 2px solid rgb(54, 56, 55);
        transition: width 0.25s ease-in, opacity 0s 0.35s;
    }
    .btn.hover-border-10 span:hover::after {
        width: 100%;
        opacity: 1;
        transition: width 0.25s 0.2s ease-out, opacity 0s 0.2s;
    }
    .btn.hover-border-10 span::before {
        top: 0%; left: 0%;
        border-top: 2px solid rgb(54, 56, 55);
        border-right: 2px solid rgb(54, 56, 55);
        transition: height 0.15s ease-in, width 0.2s 0.15s linear, opacity 0s 0.35s;
    }
    .btn.hover-border-10 span:hover::before {
        width: 98.5%; height: 96%;
        opacity: 1;
        transition: width 0.2s 0.1s linear, height 0.15s 0.3s ease-out, opacity 0s 0.1s;
    }

    /*--- btn-5 ---*/
    .btn-5 span {
        color: rgb(28, 31, 30);
        border: 2px solid rgb(249, 211, 27);
        transition: 0.2s;
    }
    .btn-5 span:hover {
        background-color: rgb(245,245,245);
    }

    /* 21. hover-border-11 */
    .btn.hover-border-11::before,
    .btn.hover-border-11::after {
        width: 100%; height: 2px;
        background-color: rgb(54, 56, 55);
        z-index: 2;
        transition: 0.35s;
    }
    .btn.hover-border-11::before {
        top: 0; right: 0;
    }
    .btn.hover-border-11::after {
        bottom: 0; left: 0;
    }
    .btn.hover-border-11:hover::before,
    .btn.hover-border-11:hover::after {
        width: 0%;
        transition: 0.2s 0.2s ease-out;
    }

    .btn.hover-border-11 span::before,
    .btn.hover-border-11 span::after {
        width: 2px; height: 100%;
        background-color: rgb(54, 56, 55);
        z-index: 2;
        transition: 0.25s;
    }
    .btn.hover-border-11 span::before {
        bottom: 0; right: -2px;
    }
    .btn.hover-border-11 span::after {
        top: 0; left: -2px;
    }
    .btn.hover-border-11 span:hover::before,
    .btn.hover-border-11 span:hover::after {
        height: 0%;
    }
    @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    #team {
        background: #eee !important;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #108d6f;
        border-color: #108d6f;
        box-shadow: none;
        outline: none;
    }

    .btn-primary {
        color: #fff;
        background-color: #007b5e;
        border-color: #007b5e;
    }

    section {
        padding: 60px 0;
    }

    section .section-title {
        text-align: center;
        color: #007b5e;
        margin-bottom: 50px;
        text-transform: uppercase;
    }

    #team .card {
        border: none;
        background: #ffffff;
    }

    .image-flip:hover .backside,
    .image-flip.hover .backside {
        -webkit-transform: rotateY(0deg);
        -moz-transform: rotateY(0deg);
        -o-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        transform: rotateY(0deg);
        border-radius: .25rem;
    }

    .image-flip:hover .frontside,
    .image-flip.hover .frontside {
        -webkit-transform: rotateY(180deg);
        -moz-transform: rotateY(180deg);
        -o-transform: rotateY(180deg);
        transform: rotateY(180deg);
    }

    .mainflip {
        -webkit-transition: 1s;
        -webkit-transform-style: preserve-3d;
        -ms-transition: 1s;
        -moz-transition: 1s;
        -moz-transform: perspective(1000px);
        -moz-transform-style: preserve-3d;
        -ms-transform-style: preserve-3d;
        transition: 1s;
        transform-style: preserve-3d;
        position: relative;
        cursor: pointer;
    }

    .frontside {
        position: relative;
        -webkit-transform: rotateY(0deg);
        -ms-transform: rotateY(0deg);
        z-index: 2;
        margin-bottom: 30px;
    }

    .backside {
        position: absolute;
        top: 0;
        left: 0;
        background: white;
        -webkit-transform: rotateY(-180deg);
        -moz-transform: rotateY(-180deg);
        -o-transform: rotateY(-180deg);
        -ms-transform: rotateY(-180deg);
        transform: rotateY(-180deg);
        -webkit-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        -moz-box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
        box-shadow: 5px 7px 9px -4px rgb(158, 158, 158);
    }

    .frontside,
    .backside {
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -ms-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transition: 1s;
        -webkit-transform-style: preserve-3d;
        -moz-transition: 1s;
        -moz-transform-style: preserve-3d;
        -o-transition: 1s;
        -o-transform-style: preserve-3d;
        -ms-transition: 1s;
        -ms-transform-style: preserve-3d;
        transition: 1s;
        transform-style: preserve-3d;
    }

    .frontside .card,
    .backside .card {
        min-height: 300px;
    }

    .backside .card a {
        font-size: 18px;
        color: #007b5e !important;
    }

    .frontside .card .card-title,
    .backside .card .card-title {
        color: #007b5e !important;
    }

    .frontside .card .card-body img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
    }
    .container {
        padding-top: 25px;
        padding-bottom: 25px;
    }

    img {
        max-width: 100%;
    }

    hr {
        border-color: #e5e5e5;
        margin: 15px 0;
    }

    .secondary-text {
        color: #b6b6b6;
    }

    .list-inline {
        margin: 0;
    }
    .list-inline li {
        padding: 0;
    }

    .card-wrapper {
        position: relative;
        width: 100%;
        height: 290px;
        border: 1px solid #e5e5e5;
        border-bottom-width: 2px;
        overflow: hidden;
        margin-bottom: 30px;
    }
    .card-wrapper:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: opacity 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .card-wrapper:hover:after {
        opacity: 1;
    }
    .card-wrapper:hover .image-holder:before {
        opacity: .75;
    }
    .card-wrapper:hover .image-holder:after {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
    .card-wrapper:hover .image-holder--original {
        transform: translateY(-15px);
    }
    .card-wrapper:hover .product-description {
        height: 205px;
    }
    @media (min-width: 768px) {
        .card-wrapper:hover .product-description {
            height: 140px;
        }
    }

    .image-holder {
        display: block;
        position: relative;
        width: 100%;
        height: 110px;
        background-color: #ffffff;
        z-index: 1;
    }
    @media (min-width: 568px) {
        .image-holder {
            height: 325px;
        }
    }
    .image-holder:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #4CAF50;
        opacity: 0;
        z-index: 5;
        transition: opacity 0.6s;
    }
    .image-holder:after {
        content: 'View';
        font-family: 'Raleway', sans-serif;
        font-size: 30px;
        color: #4CAF50;
        text-align: center;
        position: absolute;
        top: 92.5px;
        left: 50%;
        width: 75px;
        height: 75px;
        line-height: 75px;
        background-color: #ffffff;
        opacity: 0;
        border-radius: 50%;
        z-index: 10;
        transform: translate(-50%, 100%);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease-out;
    }
    @media (min-width: 768px) {
        .image-holder:after {
            top: 107.5px;
        }
    }
    .image-holder .image-holder__link {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 15;
    }
    .image-holder .image-holder--original {
        transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .image-liquid {
        width: 100%;
        height: 325px;
        background-size: cover;
        background-position: center center;
    }

    .product-description {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 80px;
        padding: 10px 15px;
        overflow: hidden;
        background-color: #fafafa;
        border-top: 1px solid #e5e5e5;
        transition: height 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        z-index: 2;
    }
    @media (min-width: 768px) {
        .product-description {
            height: 65px;
        }
    }
    .product-description p {
        margin: 0 0 5px;
    }
    .product-description .product-description__title {
        font-family: 'Raleway', sans-serif;
        position: relative;
        white-space: nowrap;
        overflow: hidden;
        margin: 0;
        font-size: 18px;
        line-height: 1.25;
    }
    .product-description .product-description__title:after {
        content: '';
        width: 60px;
        height: 100%;
        position: absolute;
        top: 0;
        right: 0;
        background: linear-gradient(to right, rgba(255, 255, 255, 0), #fafafa);
    }
    .product-description .product-description__title a {
        text-decoration: none;
        color: inherit;
    }
    .product-description .product-description__category {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-description .product-description__price {
        color: #4CAF50;
        text-align: left;
        font-weight: bold;
        letter-spacing: 0.06em;
    }
    @media (min-width: 768px) {
        .product-description .product-description__price {
            text-align: right;
        }
    }
    .product-description .sizes-wrapper {
        margin-bottom: 15px;
    }
    .product-description .color-list {
        font-size: 0;
    }
    .product-description .color-list__item {
        width: 25px;
        height: 10px;
        position: relative;
        z-index: 1;
        transition: all .2s;
    }
    .product-description .color-list__item:hover {
        width: 40px;
    }
    .product-description .color-list__item--red {
        background-color: #F44336;
    }
    .product-description .color-list__item--blue {
        background-color: #448AFF;
    }
    .product-description .color-list__item--green {
        background-color: #CDDC39;
    }
    .product-description .color-list__item--orange {
        background-color: #FF9800;
    }
    .product-description .color-list__item--purple {
        background-color: #673AB7;
    }
</style>
