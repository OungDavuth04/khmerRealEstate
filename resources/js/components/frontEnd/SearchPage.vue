<template>

    <div class="container">
        <h2>Searching Result</h2>
        <div class="container mb-3 mt-3" >
            <button class="btn1 btn-primary btn-grid" @click="gridList" style="float: right; margin-right: 10px;">Grid View</button>
            <button class="btn1 btn-danger btn-list" @click="showList" style="float: right;  margin-right: 10px;">List View</button>
        </div>

        <div class="container grid-container">
            <div class="row">
                <template v-for="item in searchResult">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top" :src="item.images[0].image" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{item.title}}</h5>
                                <span>Price : {{item.price}}</span>
                                <p class="card-text">{{item.description}}</p>
                            </div>
                            <button class="bnt btn-primary" @click="Detail(item.upId)"> View Detail</button>
                        </div>
                    </div>
                </template>

            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                data:{
                    category:this.$store.getters.getSearchCategory,
                    searchBox:this.$store.getters.getSearchBox,
                    searchPro:this.$store.getters.getSearchPro,
                    searchDist:this.$store.getters.getSearchDis,
                    searchCom:this.$store.getters.getSearchCom
                },
                searchResult:[]
            }
        },
        mounted() {

            // console.log(this.$store.getters.getSearchBox);
            // console.log(this.$store.getters.getSearchCategory);
            // console.log(this.$store.getters.getSearchPro);
            // console.log(this.$store.getters.getSearchDis);
            // console.log(this.$store.getters.getSearchCom);
            this.search(this.searchBox);
        },methods:{
            Detail(pid){
                this.$store.commit('setDetail',pid);
                this.$router.push({name:'product.detail'})
            },
            search(){
                axios.post('api/searchdata',this.data).then(response => {
                    console.log(response.data);
                    this.searchResult = response.data;
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

<style scoped lang="scss">
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


</style>
