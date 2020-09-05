<template>
    <div class="container mt-5">
        <component :is="currentComponent" v-on:changeForm="changeForm($event)"></component>
    </div>
</template>

<script>
    import AddPost from "./AddPost";
    import MainPost from "./MainPost";
    import Default from"./DefaultMainPost"

    export default {
        name: "AddPostMaster",
        data(){
            return{
                currentComponent: 'add_post',
            }
        },
        components:{
            'add_post': AddPost,
            'main_post': MainPost,
            'default_post': Default,
        },
        methods:{
            changeForm(e){
                this.currentComponent = e.formName;
            }
        }
    }
</script>

<style scoped>

</style>
