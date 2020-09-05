import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
const store = new Vuex.Store({
    state: {
        name: '',
        UserID:'',
        CategoryName:'',
        EditId:'',
        ImgId:'',
        lat:'',
        lng:'',
        detail:'',
        promote:'',
        categorystore:'',
        province:'',
        district:'',
        commune:'',
        searchbox:'',
        searchcategory:'',
        searchprovince:'',
        searchdistrict:'',
        searchcommune:'',
        Category:''


    },
    getters: {
        getCategory(state){
            return state.Category;
        },
        getSearchBox(state){
         return state.searchbox;
        },
        getSearchCategory(state){
            return state.searchcategory;
        },
        getSearchPro(state){
            return state.searchprovince;
        },
        getSearchDis(state){
            return state.searchdistrict;
        },
        getSearchCom(state){
            return state.searchcommune;
        },

        getProvince(state){
           return state.province;
        },
        getDistrict(state){
            return state.district;
        },
        getCommune(state){
            return state.commune;
        },
        categoryStore(state){
            return state.categorystore;
        },
        getPro(state){
            return state.promote;
        },
        getName(state){
            return state.name;
        },
        getId(state){
            return state.UserID;
        },
        categoryName(state){
            return state.CategoryName;
        },
        getEditId(state){
            return state.EditId;
        },
        getImagId(state){
            return state.ImgId;
        },
        getLat(state){
            return state.lat;
        },
        getLng(state){
            return state.lng;
        },
        getDetail(state){
            return state.detail;
        }

    },
    mutations: {
        setCategory(state,value){
            state.Category = value;
        },
        setSearchBox(state,value){
            state.searchbox = value;
        },
        setSearchPro(state,value){
            state.searchprovince = value;
        },
        setSearchDis(state,value){
            state.searchdistrict = value;
        },
        setSearchCom(state,value){
            state.searchcommune = value;
        },
        setSearchCat(state,value){
            state.searchcategory = value;
        },

        setProvince(state,value) {
            state.province = value;
        },
        setCommune(state,value) {
            state.commune = value;
        },
        setDistrict(state,value) {
            state.district = value;
        },
        setCatStore(state,value) {
            state.categorystore = value;
        },
        setPro (state,value) {
            state.promote = value;
        },
        setDetail (state,value) {
            state.detail = value;
        },
        setName (state,value) {
           state.name = value;
        },
        setID(state,ID){
            state.UserID = ID;
        },
        set_catName(state,catName){
            state.CategoryName = catName;
        },
        set_EditId(state,Id){
            state.EditId = Id;
        },
        set_ImgId(state,Id){
            state.ImgId = Id;
        },
        setLat(state,id){
            state.lat = id;
        },
        setLng(state,id){
            state.lng = id;
        }
    },

})
export default store
