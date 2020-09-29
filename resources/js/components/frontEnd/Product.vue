<template >
    <div style="background: rgb(110 191 255 / 83%)">

            <!--navbar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-navbar " >
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
            <nav class="navbar navbar-expand-lg navbar-toggle bg-navbar " style="margin-top: 15px;">
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
                            <div v-if="!data.provinceSelected" class="form-control " style="background-color: gold;color: black; cursor: pointer"> Select Province</div>
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
                            <div v-if="!data.districtSelected" class="form-control " style="background-color: gold;color: black;cursor: pointer">Select District</div>
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
                                        <h5 class="section-title h1" style="color: gold">ALL CATEGORY</h5>
                                        <div class="row">

                                            <!-- Team member -->
                                            <div class="card-menu">
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
                                                                <div class="card-body text-center ">
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
                                            <div class="card-menu">
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
                                                                <div class="card-body text-center">
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
                                            <div class="card-menu">
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
                                                                <div class="card-body text-center ">
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
                                            <div class="card-menu">
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
                                                                <div class="card-body text-center ">
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
                                            <div class="card-menu">
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
                                                                <div class="card-body text-center ">
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
                                        <template v-for=" item in topviewer ">
                                            <div class="page-inner">
                                                <div class="el-wrapper">
                                                    <div class="box-up" @click="Detail(item.upId,item.cat_name,item.province,item.district,item.commune)" style="cursor:pointer;">
                                                        <img :src="item.images.length>0?item.images[0].image:''">
                                                        <div class="img-info">
                                                            <div class="info-inner">
                                                                <span class="p-name" style="color: orange">{{item.title}}</span>
                                                                <span class="p-company">Yeezy</span>
                                                            </div>
                                                            <div class="a-size">Description : <span class="size">{{item.description}}</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-down">
                                                        <div class="h-bg">
                                                            <div class="h-bg-inner"></div>
                                                        </div>
                                                        <a class="cart" href="#">
                                                            <span class="price">${{item.price}}</span>
                                                            <span class="add-to-cart">
                                                        <span class="txt"  @click="Detail(item.upId,item.cat_name,item.province,item.district,item.commune)">View Detail</span></span>
                                                        </a>
                                                    </div>
                                                    <span style="margin-top: 5px;font-size: 12px;">{{item.timer}}</span>
                                                    <span style="margin-top: 5px;font-size: 12px; margin-left: 12px;"  >{{item.viewers==null?0:item.viewers}} Viewer</span>
                                                </div>
                                            </div>
                                        </template>

                                    </div>
                                </div>

                                <h2>Feature Ads</h2>
                                <div class="form-group ">
                                    <div class="row">
                                        <template v-for=" item in advertise ">
                                            <div class="page-inner">
                                                <div class="el-wrapper">
                                                    <div class="box-up" @click="Detail(item.upId,item.cat_name,item.province,item.district,item.commune)" style="cursor:pointer;">
                                                        <img :src="item.images.length>0?item.images[0].image:''">
                                                        <div class="img-info">
                                                            <div class="info-inner">
                                                                <span class="p-name" style="color: orange">{{item.title}}</span>
                                                                <span class="p-company">Yeezy</span>
                                                            </div>
                                                            <div class="a-size">Description : <span class="size">{{item.description}}</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-down">
                                                        <div class="h-bg">
                                                            <div class="h-bg-inner"></div>
                                                        </div>
                                                        <a class="cart" href="#">
                                                            <span class="price">${{item.price}}</span>
                                                            <span class="add-to-cart">
                                                        <span class="txt"  @click="Detail(item.upId,item.cat_name,item.province,item.district,item.commune)">View Detail</span></span>
                                                        </a>
                                                    </div>
                                                    <span style="margin-top: 5px;font-size: 12px;">{{item.timer}}</span>
                                                    <span style="margin-top: 5px;font-size: 12px; margin-left: 12px;"  >{{item.viewers==null?0:item.viewers}} Viewer</span>
                                                </div>
                                            </div>
                                        </template>
                                        <!-- /.card-group -->
                                    </div>
                                </div>
                                <h2>Last Ads</h2>
                                <button type="button" class=" btn1" @click="productQuery()"> Refresh New</button>
                                <hr>
                                <div class="row">

                                    <template v-if="getproduct.length > 0" v-for=" item in queriedData ">
                                        <div class="page-inner">
                                                <div class="el-wrapper">
                                                    <div class="box-up" @click="Detail(item.upId,item.cat_name)" style="cursor:pointer;">
                                                        <img :src="item.images.length>0?item.images[0].image:''">
                                                        <div class="img-info">
                                                            <div class="info-inner">
                                                                <span class="p-name" style="color: orange">{{item.title}}</span>
                                                            </div>
                                                            <div class="a-size">Description : <span class="size">{{item.description}}</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="box-down">
                                                        <div class="h-bg">
                                                            <div class="h-bg-inner"></div>
                                                        </div>
                                                        <a class="cart" >
                                                            <span class="price">${{item.price}}</span>
                                                            <span class="add-to-cart">
                                                        <span class="txt"  @click="Detail(item.upId,item.cat_name)">View Detail</span></span>
                                                        </a>
                                                    </div>
                                                    <span style="margin-top: 5px;font-size: 12px;">{{item.timer}}</span>
                                                    <span style="margin-top: 5px;font-size: 12px; margin-left: 12px;"  >{{item.viewers==null?0:item.viewers}} Viewer</span>
                                                </div>
                                        </div>
                                    </template>
                                </div>

                            </div>
            <footer-Page>
            </footer-Page>
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
                searchComm:'',
                advertise:[],
                topviewer:[]
            }
        }
       ,
        created(){
        },
        mounted() {
            // this.promote();
            //this.notification();
            this.setTimeOut();
            this.productQuery();
            this.slider();
            this.Advertise();
            this.ProAvg();
            axios.get('api/province').then(response => {
                if(response.status === 200){
                    this.allProvinces = response.data;
                    //console.log(response);
                }
            }).catch(err => {
            });
        },
        methods:{
            ProAvg(){
                axios.get('api/viewer/avg').then(response => {
                    console.log(response.data);
                    this.topviewer = response.data;
                }).catch(err => {
                })
            },
            Advertise(){
                axios.get('api/AdvertiseFavorit').then(response => {
                    //console.log(response.data);
                }).catch(err => {
                })
            },
            Advertise(){
                if(window.localStorage.getItem('userAccessToken') !== null) {
                    const trustClientToken = window.localStorage.getItem('userAccessToken');
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + trustClientToken;
                    axios.get('api/user').then(response => {
                        let uid = response.data.id;
                        let cat = window.localStorage.getItem('catName');
                        let data = {cat, pro, dist, com, uid};
                        axios.get('api/AdvertiseUser/'+uid).then(response => {
                           // console.log(response.data);
                            this.advertise = response.data
                        }).catch(err => {
                        })

                    }).catch(err => {
                        console.log(err);
                    });
                }else {
                    axios.get('api/AdvertiseDefault').then(response => {
                       // console.log(response.data);
                        this.advertise = response.data
                    }).catch(err => {
                    })
                }
            },
            productQuery(){
                if(window.localStorage.getItem('userAccessToken') !== null) {
                    const trustClientToken = window.localStorage.getItem('userAccessToken');
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + trustClientToken;
                    axios.get('api/user').then(response => {
                        let uid = response.data.id;
                        let cat = window.localStorage.getItem('catName');
                        // let pro = window.localStorage.getItem('province');
                        // let dist = window.localStorage.getItem('district');
                        // let com = window.localStorage.getItem('commune');
                        let data = {cat, uid};
                        axios.post('api/getfavorite',data).then(response => {
                            if(response.status === 200){
                               // console.log(response.data);
                               this.getproduct = response.data
                            }
                        }).catch(err => {
                        });

                    }).catch(err => {
                        console.log(err);
                    });
                }else {
                    axios.get('api/getproduct').then(response => {
                        if(response.status === 200){
                            this.getproduct = response.data;
                            //console.log(response.data);
                        }
                    }).catch(err => {
                    });
                }
            },
            setTimeOut(){
                setTimeout(function(){
                    if(window.localStorage.getItem('userAccessToken') !== null) {
                        const trustClientToken = window.localStorage.getItem('userAccessToken');
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + trustClientToken;
                        axios.get('api/user').then(response => {
                            let uid = response.data.id;
                            let cat = window.localStorage.getItem('catName');
                            let data = {cat, uid};
                            axios.get('api/chec kuserdata/'+uid).then(response => {
                                if(response.data.length < 1 || response.data.length === undefined  ){
                                    axios.post('api/userdata', data).then(response => {
                                           // console.log(response.data);
                                    }).catch(err => {
                                    });
                                }else {
                                    response.data.forEach((item)=>{
                                        if(item.catName === cat ){
                                            console.log('true')
                                        }else {
                                            axios.post('api/userdata', data).then(response => {
                                                console.log(response.data);
                                            }).catch(err => {
                                            });
                                        }
                                    });
                                }
                                console.log(data);

                            }).catch(err => {
                            });
                        }).catch(err => {
                            console.log(err);
                        });
                    }
                }, 2*60*1000);
            },
            Detail(pid,cat){
                this.$store.commit('setDetail',pid);
                this.$router.push({name:'product.detail'});
                window.localStorage.setItem('catName',cat);
                axios.get('api/viewers/'+pid).then(response => {
                    if(response.status === 200){
                        //console.log(response.data);
                    }
                }).catch(err => {
                })
            },
            promote(){
                axios.get('api/promote').then(response => {
                    if(response.status === 200){
                       // console.log(response.data);
                    }
                }).catch(err => {
                })
            },
            category(cat){
                this.$store.commit('setCategory',cat);
                this.$router.push({name:'Category'})
            },
            search(){
                window.localStorage.setItem('catName',this.searchCat);
                window.localStorage.setItem('province',this.data.provinceSelected);
                window.localStorage.setItem('district',this.data.districtSelected);
                window.localStorage.setItem('commune',this.data.communeSelected);
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
            getDistricts(e){
                this.loadingDistricts = true;
                axios.get('api/districts/'+ e.target.value).then(response => {
                    if(response.status === 200){
                      //  console.log(response.data);
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


    .d-flex {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }
    .align-center {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .flex-centerY-centerX {
        justify-content: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    body {
        background-color: #f7f7f7;
    }

    .page-wrapper {
        height: 100%;
        display: table;
    }

    .page-wrapper .page-inner {
        display: table-cell;
        vertical-align: middle;
    }

    .el-wrapper {
        width: 230px;

        padding: 15px;
        margin: 15px ;
        background-color: #fff;
    }

    @media (max-width: 991px) {
        .el-wrapper {
            width: 345px;
        }
    }

    @media (max-width: 767px) {
        .el-wrapper {
            width: 290px;
            margin: 30px auto;
        }
    }

    .el-wrapper:hover .h-bg {
        left: 0px;
    }

    .el-wrapper:hover .price {
        left: 20px;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
        color: #818181;
    }

    .el-wrapper:hover .add-to-cart {
        left: 50%;
    }

    .el-wrapper:hover .img {
        webkit-filter: blur(7px);
        -o-filter: blur(7px);
        -ms-filter: blur(7px);
        filter: blur(7px);
        filter: progid:DXImageTransform.Microsoft.Blur(pixelradius='7', shadowopacity='0.0');
        opacity: 0.4;
    }

    .el-wrapper:hover .info-inner {
        bottom: 155px;
    }

    .el-wrapper:hover .a-size {
        -webkit-transition-delay: 300ms;
        -o-transition-delay: 300ms;
        transition-delay: 300ms;
        bottom: 50px;
        opacity: 1;
    }

    .el-wrapper .box-down {
        width: 100%;
        height: 60px;
        position: relative;
        overflow: hidden;
    }
    .el-wrapper .box-up {
        width: 100%;
        height: 220px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .el-wrapper .img {
        padding: 20px 0;
        -webkit-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
        -moz-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
        -o-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
        transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
    }

    .h-bg {
        -webkit-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
        -moz-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
        -o-transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
        transition: all 800ms cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        width: 660px;
        height: 100%;
        background-color: #3f96cd;
        position: absolute;
        left: -659px;
    }

    .h-bg .h-bg-inner {
        width: 50%;
        height: 100%;
        background-color: #464646;
    }

    .info-inner {
        -webkit-transition: all 400ms cubic-bezier(0, 0, 0.18, 1);
        -moz-transition: all 400ms cubic-bezier(0, 0, 0.18, 1);
        -o-transition: all 400ms cubic-bezier(0, 0, 0.18, 1);
        transition: all 400ms cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        position: absolute;
        width: 100%;
        bottom: 25px;
    }

    .info-inner .p-name,
    .info-inner .p-company {
        display: block;
    }

    .info-inner .p-name {
        font-family: 'PT Sans', sans-serif;
        font-size: 18px;
        color: #252525;
    }

    .info-inner .p-company {
        font-family: 'Lato', sans-serif;
        font-size: 12px;
        text-transform: uppercase;
        color: #8c8c8c;
    }

    .a-size {
        -webkit-transition: all 300ms cubic-bezier(0, 0, 0.18, 1);
        -moz-transition: all 300ms cubic-bezier(0, 0, 0.18, 1);
        -o-transition: all 300ms cubic-bezier(0, 0, 0.18, 1);
        transition: all 300ms cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        position: absolute;
        width: 100%;
        bottom: -20px;
        font-family: 'PT Sans', sans-serif;
        color: #828282;
        opacity: 0;
    }

    .a-size .size {
        color: #252525;
    }

    .cart {
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        font-family: 'Lato', sans-serif;
        font-weight: 700;
    }

    .cart .price {
        -webkit-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
        -moz-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
        -o-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
        transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        -webkit-transition-delay: 100ms;
        -o-transition-delay: 100ms;
        transition-delay: 100ms;
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        font-size: 16px;
        color: #252525;
    }

    .cart .add-to-cart {
        -webkit-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
        -moz-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
        -o-transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
        transition: all 600ms cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        -webkit-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -moz-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        -o-transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        transition-timing-function: cubic-bezier(0, 0, 0.18, 1);
        /* ease-out */
        -webkit-transition-delay: 100ms;
        -o-transition-delay: 100ms;
        transition-delay: 100ms;
        display: block;
        position: absolute;
        top: 50%;
        left: 110%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .cart .add-to-cart .txt {
        font-size: 12px;
        color: #fff;
        letter-spacing: 0.045em;
        text-transform: uppercase;
        white-space: nowrap;
    }

    body{
        background-color: #e1e8f0;
    }
    .bg-navbar{
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        background: rgb(137,137,204);
        background: linear-gradient(90deg, rgba(137,137,204,1) 0%, rgba(173,114,168,1) 49%, rgba(137,137,204,1) 100%);
    }
    .card-menu{
        width: 190px;
        height: 300px;
        margin: 10px;
    }
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
        width: 190px;
        height: 300px;
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
