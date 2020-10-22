import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import UserPageMaster from "../components/frontEnd/UserPageMaster";
import index from "../components/frontEnd/index";
import Login from "../components/Login";
import Register from "../components/Register";
import AddPost from "../components/frontEnd/AddPost";
import MainPost from "../components/frontEnd/MainPost";
import EditPost from "../components/frontEnd/EditPost";
import userPage from "../components/frontEnd/UserPages";
import ProductMaster from "../components/frontEnd/ProductMaster";
import AddPostMaster from "../components/frontEnd/AddPostMaster";
import Detail from "../components/frontEnd/ViewDetail";
import Product from "../components/frontEnd/Product";
import GoogleMap from "../components/frontEnd/GoogleMap";
import  admin from "../components/backEnd/admin"
import PaymentCheckout from "../components/frontEnd/PaymentCheckout";
import SearchPage from "../components/frontEnd/SearchPage";
import Categorypage from "../components/frontEnd/Categorypage";
import ManageUser from "../components/backEnd/ManageUser";
import Dashboard from "../components/backEnd/Dasboard";
import MgRealEstate from "../components/backEnd/MgRealEstate";
import Report from "../components/backEnd/Report";
import RealEstatePromoted from "../components/backEnd/RealEstatePromoted";
import PaymentList from "../components/backEnd/PaymentList";
import ResetNewPassword from "../components/ResetNewPassword";


const routes = [
    {
        path: '/admin',
        name: 'admin',
        component:admin,
        meta:{
            requiresAdmin: true
        },
        children:[
            {
                path: '/admin',
                component: Dashboard,
                name:'Dashboard',
            },
            {
                path: '/mgUser',
                name: 'mgUser',
                component: ManageUser
            },
            {
                path: '/mgRealEstate',
                name:'mgRealEstate',
                component: MgRealEstate
            },
            {
                path: '/doReport',
                name:'doReport',
                component: Report
            },
            {
                path: '/promoted',
                name:'promoted',
                component: RealEstatePromoted
            },
            {
                path: '/paylist',
                name:'paylist',
                component: PaymentList
            }

        ]
    },
    {
        path: '/',
        component: index,
        meta:{
            requiresVisitor: true
        },
        children: [
            {
                path: '/',
                name: 'home.product_master',
                component: ProductMaster,
                children:[
                    {
                        path:'/',
                        name: 'home.product',
                        component: Product,
                    },
                    {
                        path:'/search',
                        name:'product.search',
                        component:SearchPage
                    },
                    {
                        path:'/Category',
                        name:'Category',
                        component:Categorypage
                    }

                ]
            },
            {
                path: '/map',
                name: 'map',
                component: GoogleMap,
            },
            {
                path: '/user',
                name: 'home.userpagemaster',
                component: UserPageMaster,
                meta: { requiresAuth: true },
                children:[
                    {
                        path: '/user/selected_user',
                        name: 'userpagemaster.user',
                        component: userPage,
                    },

                ]
            },
            {
                path:'/addPost',
                name:'AddPost',
                component: AddPostMaster,
                meta: { requiresAuth: true },
                children:[
                    {
                        path:'/addPost',
                        name:'upload',
                        component: AddPost
                    },
                    {
                        path:'/addPost/mainpost',
                        name:'addpost.mainpost',
                        component: MainPost
                    },
                ]

            },
            {
                path: '/detail',
                name: 'product.detail',
                component: Detail,
            },

        ]
    },
    {
        path:'/login',
        name:'login',
        component: Login
    },
    {
        path:'/register',
        name:'register',
        component: Register
    },
    {
        path:'/resetNewPassword',
        name:'resetnewpassword',
        component:ResetNewPassword
    },
    {
        path:'/edit_post',
        name:'edit_post',
        component: EditPost
    }
];

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    routes // short for `routes: routes`
});


router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)){
        if(window.localStorage.getItem('userAccessToken') !== null ||
            window.localStorage.getItem('user_lavel') === 'user' ||
            window.localStorage.getItem('user_lavel') === 'admin'){
            next();
        }else{
            next({
                name: 'login'
            })
        }
    }
    if(to.matched.some(record => record.meta.requiresAdmin)){
        if(window.localStorage.getItem('user_lavel') !== null && window.localStorage.getItem('user_lavel') === 'admin'){
            next();
        }else{
            next({
                name: 'home.product'
            })
        }
    }
    if(to.matched.some(record => record.meta.requiresVisitor)){
        next();
    }
    else{
        next();
    }
});

export default router
