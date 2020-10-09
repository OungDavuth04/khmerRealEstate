<template>
    <div>
        <div class="container">
            <div class="card">
                <div class="container-fliud">
                    <template >
                        <div class="wrapper row" id="detail">
                            <div class="codepen-container">
                                <div class="content-container">
                                    <div class="left-container">
                                        <div class="product-image--container">
                                            <img class="product-image--featured" id="featured" :src="test_images[0].img_name" alt="toaster"/>
                                            <ul class="product-image--list" id="gg">
                                                <li v-for="(im, index) in test_images" class="item-selected"><img @mouseover="myHover" class="product-image--item" :src="im.img_name" /></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="right-container" v-for="data in allDetail">
                                        <div>
                                            <h6 class="title">Title</h6>
                                            <h6 class="subtitle subtitle-container">{{data.title}}</h6>
                                            <div>
                                              <span class="rating">
                                                <a href="#" class="reviews">
                                                  232 customer reviews
                                                </a>
                                              </span>
                                            </div>
                                        </div>
                                        <span>
                                            <p>Price:
                                                <span class="emphasize">{{data.price}}$</span>
                                            </p>
                                            </span>
                                        <div>
                                            <h5 class="title">Product Description</h5>
                                            <div class="subtitle-container">
                                                <span>Size: {{data.size}}</span>
                                                <span>|</span>
                                                <span>Bedroom : {{data.bedroom}}</span>
                                                <span>|</span>
                                                <span>Bathroom : {{data.bathroom}}</span>
                                            </div>
                                            <br>
                                            <span>Price : {{data.price}}$</span>
                                            <br>
                                            <span>Email : {{data.email}}</span>
                                            <br>
                                            <span>Phone : {{data.phone}}</span>
                                            <br>
                                            <span>Location : {{data.localdetail}} </span>
                                            <br>
                                            <span>Description : </span>
                                            <p style="text-align: justify;">
                                                {{data.description}}
                                            </p>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary">
                                                Visit User Upload
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <hr>
            <h3>Properties List</h3>
            <hr>
            <div class="container mb-3 mt-3" >
                <button class="btn1 btn-primary btn-grid" @click="gridList" style="float: right; margin-right: 10px;">Grid View</button>
                <button class="btn1 btn-danger btn-list" @click="showList" style="float: right;  margin-right: 10px;">List View</button>
            </div>
            <hr>
            <div class="container grid-container">
                <div class="row">
                    <template v-for="item in getproduct">
                        <div class="col-12 col-md-6 col-lg-3" style="cursor: pointer">
                                <div class="card" @click="Detail(item.upId,item.cat_name)" >
                                    <img class="card-img-top" :src="item.images[0].image" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"> {{item.title}}</h5>
                                        <span>Price : {{item.price}}$</span>
                                        <p class="card-text description">
                                            {{item.description}}
                                        </p>
                                    </div>
                                </div>

                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                checkId:'',
                getproduct:[],
                allDetail:[],
                test_images: []
            }
        },
        mounted() {

            // if(this.$store.getters.getDetail !== null){
            //     this.checkId = this.$store.getters.getDetail
            // }else {
            //     this.checkId = window.localStorage.getItem('setId')
            // }
            this.productQuery();
            axios.get('api/vieDetail/'+ window.localStorage.getItem('setId')).then(response =>{
                this.allDetail = response.data;
                this.allDetail.forEach(item => {
                    item.images.forEach(img => {
                        this.test_images.push({'img_name': 'http://localhost:8081/RealEstateProject/public/'+img.image});
                    })
                })
            }).catch(err =>{
                console.error(err);
            });
            this.java();
        },
        methods:{
            Detail(pid,cat){
                this.$router.push({name:'product.detail'});
                window.localStorage.setItem('setId',pid);
                window.localStorage.setItem('catName',cat);
                axios.get('api/viewers/'+pid).then(response => {
                    if(response.status === 200){
                        //console.log(response.data);
                        window.location.reload()
                    }
                }).catch(err => {
                })

            },
            productQuery(){
                axios.get('api/getproduct').then(response => {
                    if(response.status === 200){
                        this.getproduct = response.data;
                    }
                }).catch(err => {
                }).finally(() => {
                });
            },
            showList(e) {
                let $gridCont = $('.grid-container');
                e.preventDefault();
                $gridCont.hasClass('list-view') ? $gridCont.removeClass('list-view') : $gridCont.addClass('list-view');
            },
            gridList(e) {
                let $gridCont = $('.grid-container')
                e.preventDefault();
                $gridCont.removeClass('list-view');
            },
            myHover(e){
                let url = e.target.currentSrc;
                //let url = $(this).children('img').attr('src');
                $('.item-selected').removeClass('item-selected');
                $(this).addClass('item-selected');
                $('#featured').attr('src', url);
            },
            java(){
                $('.product-image--list li').hover(function() {
                    let url = $(this).children('img').attr('src');
                    $('.item-selected').removeClass('item-selected');
                    console.log( $('.item-selected'));
                    $(this).addClass('item-selected');
                    $('#featured').attr('src', url);
                });

                $('#buy-toaster').click(function() {
                    alert("BUY ME PLS!");
                });
            },
        },
        computed:{
            getImages(){
                return this.test_images;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .description {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-title{
        font-size: smaller ;
        color: #0d47a1;
    }
    .btn-visit{
        border: 0px;
        border-radius: 3px;
        padding: 8px;

    }
    .btn-visit:hover{
        opacity: 4.0;
    }
    .btn1{
        border: 0px;
        border-radius: 3px;
        padding: 8px;
    }
    .btn1:hover{
        opacity: 4.0;
    }
    .card {
        margin-bottom: 1rem;
    }

    .list-view {
        .row {
            > [class*='col-'] {
                max-width: 100%;
                flex: 0 0 100%;
            }
        }
        .card {
            @media (max-width: 575.98px) {
                flex-direction: column;
            }
            flex-direction: row;
            > .card-img-top {
                width: 200px;
                height: 200px;
                object-fit: cover;
            }

            .card-body {
                display: inline-block;
            }
        }
    }
    .codepen-container {
        padding: 3em;
    }
    .content-container {
        display: flex;
        margin: 0 auto;
        background-color: white;
        max-width: 960px;
        width: 100%;
    }

    .product-image--container {
        margin: 0 2em;
    }

    .triangle-topleft {
        position: relative;
        width: 0;
        height: 0;
        border-top: 100px solid #FFC500;
        border-right: 100px solid transparent;
        -webkit-transition: all ease 0.25s;
        transition: all ease 0.25s;
    }

    .triangle-topleft:hover {
        border-top: 100px solid #ffd54d;
        -webkit-transition: all ease 0.25s;
        transition: all ease 0.25s;
    }

    .back-arrow {
        cursor: pointer;
        position: absolute;
        top: -90px;
        left: 15px;
        background-image: url('https://cdn2.iconfinder.com/data/icons/freecns-cumulus/16/519627-127_ArrowLeft-128.png');
        background-size: 35px 35px;
        background-repeat: no-repeat;
        width: 40px;
        height: 40px;
    }

    .product-image--featured {
        max-width: 451px;
        width: 100%;
        max-height: 310px;
        height: 100%;
        object-fit: cover;
    }

    .product-image--list {
        display: flex;
        justify-content: space-between;
        list-style-type: none;
        padding: 0;

    }

    .product-image--list li {
        margin: 0 5px;
        border: 2px solid #eaeaea;
        border-radius: 5px;
        -webkit-transition: all ease 0.25s;
        transition: all ease 0.25s;
    }

    .product-image--list li.item-selected {
        box-shadow: 1px 1px 1px #888888;
        border: 2px solid #FFC500;
        -webkit-transition: all ease 0.25s;
        transition: all ease 0.25s;
    }
    .product-image--item {
        cursor: pointer;
        object-fit: cover;
        max-width: 154px;
        max-height: 104px;
    }
    .right-container {
        margin: 1em;
    }

    .title {
        margin: 0.5em 0 0 0;
    }

    .subtitle {
        font-size: 1.25em;
    }

    .subtitle-container {
        margin: 0.5em 0 0.5em 0;
        opacity: 0.6;
    }


    .rating {
        overflow: hidden;
        display: inline-block;
        font-size: 0;
        position: relative;
    }
    .rating-input {
        float: right;
        width: 16px;
        height: 16px;
        padding: 0;
        margin: 0 0 0 -16px;
        opacity: 0;
    }
    .rating:hover .rating-star:hover,
    .rating:hover .rating-star:hover ~ .rating-star,
    .rating-input:checked ~ .rating-star {
        background-position: 0 0;
    }
    .rating-star,
    .rating:hover .rating-star {
        position: relative;
        float: right;
        display: block;
        width: 16px;
        height: 16px;
        background: url('http://kubyshkin.ru/samples/star-rating/star.png') 0 -16px;
    }

    .reviews {
        text-decoration: none;
    }

    a:hover.reviews {
        color: #365afc;
        text-decoration: underline;
    }

    .emphasize {
        color: #b32600;
        font-size: 1.5em;
        letter-spacing: -2px;
    }

    .select-dropdown {
        max-width: 50px;
        width: 100%;
    }

    .my-btn {
        background-color: #FFC500;
        border-radius: 5px;
        max-width: 275px;
        width: 100%;
        height: 50px;
        -webkit-transition: all ease 0.25s;
        transition: all ease 0.25s;
    }

    .my-btn:hover {
        box-shadow: 1px 1px 1px #888888;
        background-color: #ffd54d;
        -webkit-transition: all ease 0.25s;
        transition: all ease 0.25s;
    }

    .flex-btn {
        display: flex;
        align-items: center;
    }

    .cart-icon {
        margin: 2px;
        width: 30px;
        height: 30px;
    }

    .btn-text {
        font-weight: bold;
        font-size: 1.5em;
        margin: 0 auto;
    }
</style>
