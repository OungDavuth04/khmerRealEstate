<template>
    <div class="container-fluid">
        <sidebar></sidebar>

        <div class="main-panel">
            <h1>Profile</h1>
        </div>

    </div>
</template>

<script>
    import Sidebar from "./Sidebar";
    export default {
        name: "UserProfile",
        components: {Sidebar},
    }
</script>

<style scoped>
    .container-fluid {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .main-panel {
        position: relative;
        float: right;
        width: calc(100% - 260px);
        transition: 0.33s, cubic-bezier(0.685, 0.0473, 0.346, 1);
        z-index: 100;
    }
</style>
