<template>
    <div>
        <h2>Category Result</h2>
        <div class="container mb-3 mt-3" >
            <button class="btn1 btn-primary btn-grid" @click="gridList" style="float: right; margin-right: 10px;">Grid View</button>
            <button class="btn1 btn-danger btn-list" @click="showList" style="float: right;  margin-right: 10px;">List View</button>
        </div>

        <div class="container grid-container">
            <div class="row">
                <template v-for="item in Result">
                    <div class="col-12 col-md-6 col-lg-4" @click="Detail(item.upId,item.cat_name)" style="cursor: pointer;margin-top: 4vh">
                        <div class="card">
                            <img class="card-img-top" :src="item.images[0].image" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{item.title}}</h5>
                                <span>Price : {{item.price}}</span>
                                <p class="card-text description">{{item.description}}</p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        <footer-Page></footer-Page>
    </div>
</template>

<script>
    import footer from "./footer";
    export default {
        components:{
            'footer-Page' : footer
        },
        name: "Categorypage",
        data(){
            return{
                Result:[]
            }
        },
        mounted() {
            this.QueryCat();
        },
        methods:{
            Detail(pid,cat){
                window.localStorage.setItem('setId',pid);
                window.localStorage.setItem('catName',cat);
                this.$router.push({name:'product.detail'})
            },
            QueryCat(){
                axios.get('api/getcategory/'+this.$store.getters.getCategory).then(response => {
                    if(response.status === 200){
                        this.Result = response.data;
                    }
                }).catch(err => {
                })
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

        }
    }
</script>

<<style scoped lang="scss">
    .card {
        margin-bottom: 1rem;
    }
    .description {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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


</style>
