<template>
    <div >
        <div class="sidebar-container">
            <div class="sidebar-logo">
                Kh Real Estate
            </div>
            <ul class="sidebar-navigation">
                <li class="header">Navigation</li>
                <li>
                    <router-link to="/admin">
<!--                        <i class="fa fa-tachometer" aria-hidden="true"></i>-->
                        Dashboard
                    </router-link>
                </li>
                <li>
                    <router-link to="/mgUser">
<!--                        <i class="fa  fa-users" aria-hidden="true"></i>-->
                        Manage User
                    </router-link>
                </li>
                <li class="header">Another Menu</li>
                <li>
                    <router-link to="/mgRealEstate">
<!--                        <i class="fa fa-home  " aria-hidden="true"></i> -->
                        Manage Real Estate
                    </router-link>
                </li>
                <li>
                    <router-link to="/doReport">
<!--                        <i class="fa fa-cog" aria-hidden="true"></i> -->
                        Reports
                    </router-link>
                </li>
                <li>
                    <router-link to="/promoted">
<!--                        <i class="fa fa-info-circle" aria-hidden="true"></i> -->
                        Estate Promoted
                    </router-link>
                </li>
            </ul>
        </div>
        <div class="content-container">
            <div class="header">
                <nav class="navbar">
                    <div class="container">

                        <div class="navbar-header">
                            <button class="navbar-toggler" data-toggle="open-navbar1">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <a href="#">
                                <h4>Khmer Real<span> Estate</span></h4>
                            </a>
                        </div>
                        <div class="navbar-menu" id="open-navbar1">
                            <ul class="navbar-nav">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a @click="logout">Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="container-fluid" style="padding-top: 2rem">
                <div class="container">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import ManageUser from "./ManageUser";

    export default {
        name: "admin",
        data(){
            return{
            }
        },
        components:{
            'mguser':ManageUser
        },
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

<style scoped lang="scss">
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap');

    $font-family: 'Roboto', sans-serif;
    $font-size-base: 0.925rem;
    $base-color: #66f;
    $text-dark: #3c4250;
    $border-color: #ececec;

    $navbar-body-color: #fff;
    $navbar-link-hover: $base-color;
    $navbar-dropdown-separator-color: #eee;
    $navbar-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.035);

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    body {
        font-family: $font-family;
        font-size: $font-size-base;
    }

    a {
        text-decoration: none;
    }

    .container {
        width: 1170px;
        position: relative;
        margin: {
            left: auto;
            right: auto;
        }
        padding: {
            left: 15px;
            right: 15px;
        }
    }

    // Start navbar

    .navbar,
    .navbar .container {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        @media (max-width: 768px) {
            display: block;
        }
    }

    .navbar {
        padding: 1.15rem 1rem;
        box-shadow: $navbar-shadow;
        background-color: $navbar-body-color;

        .container {
            @media (min-width: 576px) {
                max-width: 540px;
            }
            @media (min-width: 768px) {
                max-width: 720px;
            }
            @media (min-width: 992px) {
                max-width: 960px;
            }
            @media (min-width: 1200px) {
                max-width: 1140px;
            }
        }

        /*
        |-----------------------------------
        | Start navbar logo or brand etc..
        |-----------------------------------
        */
        .navbar-header {
            display: flex;
            align-items: center;

            @media (max-width: 768px) {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-direction: row-reverse;
            }

            .navbar-toggler {
                border-radius: 5px;
                background-color: transparent;
                cursor: pointer;
                border: none;
                display: none;
                outline: none;

                @media (max-width: 768px) { display: block }

                span {
                    height: 2px;
                    width: 22px;
                    background-color: lighten($text-dark, 35%);
                    display: block;
                }
                span:not(:last-child) {
                    margin-bottom: 0.2rem;
                }
            }

            > a {
                font-weight: 500;
                color: $text-dark;
            }
        }

        /*
        |-----------------------------------
        | Start navbar menu
        |-----------------------------------
        */
        .navbar-menu {
            display: flex;
            flex-basis: auto;
            flex-grow: 1;
            align-items: center;

            @media (max-width: 768px) {
                display: none;
                text-align: center;
            }

            // Ul
            .navbar-nav {
                margin-left: auto;
                flex-direction: row;
                display: flex;
                padding-left: 0;
                margin-bottom: 0;
                list-style: none;

                @media (max-width: 768px) {
                    width: 100%;
                    display: block;
                    border-top: 1px solid #EEE;
                    margin-top: 1rem;
                }

                > li {
                    > a {
                        color: $text-dark;
                        text-decoration: none;
                        display: inline-block;
                        padding: 0.5rem 1rem;
                        &:hover {
                            color: $navbar-link-hover;
                        }
                        @media (max-width: 768px) {
                            border-bottom: 1px solid #EEE;
                        }
                    }
                    &.active {
                        a {
                            color: $base-color;
                        }
                    }
                }

                .navbar-dropdown {
                    .dropdown {
                        list-style: none;
                        position: absolute;
                        top: 150%;
                        left: 0;
                        background-color: #fff;
                        padding: 0.5rem 0;
                        min-width: 160px;
                        width: auto;
                        white-space: nowrap;
                        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
                        z-index: 99999;
                        border-radius: 0.75rem;
                        display: none;
                        @media (max-width: 768px) {
                            position: relative;
                            box-shadow: none;
                        }
                        li {
                            a {
                                color: $text-dark;
                                padding: 0.25rem 1rem;
                                display: block;
                            }
                        }
                        &.show {
                            display: block !important;
                        }
                    }
                }

                .dropdown > .separator {
                    height: 1px;
                    width: 100%;
                    margin: 9px 0;
                    background-color: $navbar-dropdown-separator-color;
                }
            }
        }

        .navbar-dropdown {
            position: relative;
        }
    }


    // Custom
    .navbar .navbar-header > a span {
        color: $base-color;
    }
    .navbar .navbar-header h4 {
        font-weight: 500;
        font-size: 1.25rem;
        @media (max-width: 768px) {
            font-size: 1.05rem;
        }
    }

    .header{
        display: flex;
        flex-direction: row;
        width: 100%;
        background: #0c7cd5;
        padding: 2px;
        -webkit-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 14px 0px rgba(0,0,0,0.75);
    }
    .icon-menu{
        font-size: 30px;
        float: right;
    }
    .sidebar-container {
        position: fixed;
        width: 220px;
        height: 100%;
        left: 0;
        overflow-x: hidden;
        overflow-y: auto;
        background: #1a1a1a;
        color: #fff;
    }

    .content-container {
        //padding-top: 20px;
    }

    .sidebar-logo {
        padding: 28px 28px 18px 23px;
        font-size: 20px;
        background-color: #0c7cd5;
    }

    .sidebar-navigation {
        padding: 0;
        margin: 0;
        list-style-type: none;
        position: relative;
    }

    .sidebar-navigation li {
        background-color: transparent;
        position: relative;
        display: inline-block;
        width: 100%;
        line-height: 20px;
    }

    .sidebar-navigation li a {
        padding: 10px 15px 10px 30px;
        display: block;
        color: #fff;
    }

    .sidebar-navigation li .fa {
        margin-right: 10px;
    }

    .sidebar-navigation li a:active,
    .sidebar-navigation li a:hover,
    .sidebar-navigation li a:focus {
        text-decoration: none;
        outline: none;
    }

    .sidebar-navigation li::before {
        background-color: #2574A9;
        position: absolute;
        content: '';
        height: 100%;
        left: 0;
        top: 0;
        -webkit-transition: width 0.2s ease-in;
        transition: width 0.2s ease-in;
        width: 3px;
        z-index: -1;
    }

    .sidebar-navigation li:hover::before {
        width: 100%;
    }

    .sidebar-navigation .header {
        font-size: 12px;
        text-transform: uppercase;
        background-color: #151515;
        padding: 10px 15px 10px 30px;
    }

    .sidebar-navigation .header::before {
        background-color: transparent;
    }

    .content-container {
        padding-left: 220px;
    }
</style>
