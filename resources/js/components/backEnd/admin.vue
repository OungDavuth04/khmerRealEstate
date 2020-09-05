<template>
    <div>
        <h1>admin</h1>
        <button @click="logout">LogOut</button>
    </div>

</template>

<script>
    export default {
        name: "admin",
        methods: {
            logout(){
                const trustClientToken = window.localStorage.getItem('userAccessToken');
                axios.defaults.headers.common['Authorization'] = 'Bearer '+ trustClientToken;

                axios.get('api/logout').then(response => {
                    if(response.status === 200){
                        window.localStorage.removeItem('userAccessToken');
                        this.$router.push({name: 'login'});
                    }
                }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>

<style scoped>

</style>
