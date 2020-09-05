<template>
    <div class="container mt-5">
        <component :is="currentComponent" v-on:changeForm="changeForm($event)"></component>
    </div>
</template>

<script>
    import UserPost from './UserPages';
    import EditPose from './EditPost';
    import PaymentCheckout from "./PaymentCheckout";

    export default {
        name: "UserPageMaster",
        data(){
            return{
                currentComponent: 'user_post',
            }
        },
        components:{
            'user_post': UserPost,
            'edit_post': EditPose,
            'Payment':PaymentCheckout
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
