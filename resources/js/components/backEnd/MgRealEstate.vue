<template>
    <div>
        <body class="hm-gradient">
        <main>
            <!--MDB Tables-->
            <div class="container mt-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Grid row -->

                        <!-- Grid row -->
                        <!--Table-->
                        <table class="table table-striped">
                            <!--Table head-->
                            <thead>
                            <tr>
                                <th>Uer ID</th>
                                <th>Estate ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                                <th>Disable</th>
                            </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody >
                            <template v-for="item in list ">
                                <tr>
                                    <th scope="row">{{item.uid}}</th>
                                    <th scope="row">{{item.UpId}}</th>
                                    <td>{{item.title}}</td>
                                    <td>{{item.cat_name}}</td>
                                    <td>{{item.price}}</td>
                                    <td>
                                        <a href="#popup" @click="getId(item.UpId)">
                                            <i class="fas fa-trash-alt delete" ></i>
                                        </a>
                                    </td>
                                    <td>
                                        <label class="toggleSwitch nolabel" >
                                            <input :id="`${item.UpId}`" type="checkbox"  @click="check(item.UpId)">
                                            <span>
                                            <span>OFF</span>
                                            <span>ON</span>
                                            </span>
                                            <a></a>
                                        </label>
                                    </td>
                                </tr>
                            </template>

                            <div id="popup" class="overlay">
                                <div class="popup">
                                    <h6>Are Your Sure to delete!!!!!</h6>
                                    <a href="#admin">
                                        <button type="button" class="btn btn-primary btn-sm" @click="Dodelete(id)">Delete</button>
                                    </a>
                                    <a class="close" href="#admin">&times;</a>
                                </div>
                            </div>
                            </tbody>
                            <!--Table body-->
                        </table>
                        <!--Table-->
                    </div>
                </div>
            </div>
            <!--MDB Tables-->

        </main>

        </body>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                UserList:[],
                list:[],
                id:''
            }
        },
        mounted() {
            this.Userlist()
        },
        methods:{
            getId(id){
                this.id = id;
            },
            Dodelete(id){
                axios.get('api/deletepro/'+id).then(response => {
                    console.log(response.data)
                    this.Userlist()
                }).catch(err => {
                    console.log(err);
                });
            },
            check(id){
                const checkbox = document.getElementById(`${id}`)
                axios.get('api/disablepro/'+id+'/'+checkbox.checked).then(response => {
                    console.log(response.data)
                }).catch(err => {
                    console.log(err);
                });
            },
            Userlist(){
                axios.get('api/estatelist').then(response => {
                    this.list = response.data;
                    // response.data.forEach((valueList)=>{
                    //     if(valueList.disable == 'true'){
                    //         const checkbox = document.getElementById(`${valueList.id}`)
                    //         console.log(checkbox.checked)
                    //     }else{
                    //         const checkbox = document.getElementById(`${valueList.id}`)
                    //         checkbox.checked = false
                    //     }
                    // })

                }).catch(err => {
                    console.log(err);
                });
            },
            deleteuser(id){
                axios.get('api/userlist/'+id).then(response => {
                    console.log(response.data)
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>

<style scoped lang="scss">
    .delete{
        margin-left: 17px;
        cursor: pointer;
        margin-bottom: 12px;
    }
    .box {
        width: 40%;
        margin: 0 auto;
        background: rgba(255,255,255,0.2);
        padding: 35px;
        border: 2px solid #fff;
        border-radius: 20px/50px;
        background-clip: padding-box;
        text-align: center;
    }

    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
    }
    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 30%;
        position: relative;
        transition: all 5s ease-in-out;
    }

    .popup h2 {
        margin-top: 0;
        color: #333;
        font-family: Tahoma, Arial, sans-serif;
    }
    .popup .close {
        position: absolute;
        top: 20px;
        right: 30px;
        transition: all 200ms;
        font-size: 30px;
        font-weight: bold;
        text-decoration: none;
        color: #333;
    }
    .popup .close:hover {
        color: #06D85F;
    }
    .popup .content {
        max-height: 30%;
        overflow: auto;
    }

    @media screen and (max-width: 700px){
        .box{
            width: 70%;
        }
        .popup{
            width: 70%;
        }
    }




    /*  Toggle Switch  */
    .checkbox:checked ~ .switch {
        background-color: blue;
    }
    .checkbox:not(:checked) ~ .switch {
        background-color: gray;
    }
    .toggleSwitch span span {
        display: none;
    }
    @media only screen {
        .toggleSwitch {
            display: inline-block;
            height: 16px;
            position: relative;
            overflow: visible;
            padding: 0;
            cursor: pointer;
            width: 40px
        }
        .toggleSwitch * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .toggleSwitch label,
        .toggleSwitch > span {
            line-height: 20px;
            height: 20px;
            vertical-align: middle;
        }
        .toggleSwitch input:focus ~ a,
        .toggleSwitch input:focus + label {
            outline: none;
        }
        .toggleSwitch label {
            position: relative;
            z-index: 3;
            display: block;
            width: 100%;
        }
        .toggleSwitch input {
            position: absolute;
            opacity: 0;
            z-index: 5;
        }
        .toggleSwitch > span {
            position: absolute;
            left: -50px;
            width: 100%;
            margin: 0;
            padding-right: 50px;
            text-align: left;
            white-space: nowrap;
        }
        .toggleSwitch > span span {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 5;
            display: block;
            width: 50%;
            margin-left: 50px;
            text-align: left;
            font-size: 0.9em;
            width: 100%;
            left: 15%;
            top: -1px;
            opacity: 0;
        }
        .toggleSwitch a {
            position: absolute;
            right: 50%;
            z-index: 4;
            display: block;
            height: 100%;
            padding: 0;
            left: 2px;
            width: 18px;
            background-color: #fff;
            border: 1px solid #CCC;
            border-radius: 100%;
            -webkit-transition: all 0.2s ease-out;
            -moz-transition: all 0.2s ease-out;
            transition: all 0.2s ease-out;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        .toggleSwitch > span span:first-of-type {
            color: #ccc;
            opacity: 1;
            left: 45%;
        }
        .toggleSwitch > span:before {
            content: '';
            display: block;
            width: 100%;
            height: 100%;
            position: absolute;
            left: 50px;
            top: -2px;
            background-color: #fafafa;
            border: 1px solid #ccc;
            border-radius: 30px;
            -webkit-transition: all 0.2s ease-out;
            -moz-transition: all 0.2s ease-out;
            transition: all 0.2s ease-out;
        }
        .toggleSwitch input:checked ~ a {
            border-color: #fff;
            left: 100%;
            margin-left: -8px;
        }
        .toggleSwitch input:checked ~ span:before {
            border-color: #0097D1;
            box-shadow: inset 0 0 0 30px #0097D1;
        }
        .toggleSwitch input:checked ~ span span:first-of-type {
            opacity: 0;
        }
        .toggleSwitch input:checked ~ span span:last-of-type {
            opacity: 1;
            color: #fff;
        }
        /* Switch Sizes */
        .toggleSwitch.large {
            width: 60px;
            height: 27px;
        }
        .toggleSwitch.large a {
            width: 27px;
        }
        .toggleSwitch.large > span {
            height: 29px;
            line-height: 28px;
        }
        .toggleSwitch.large input:checked ~ a {
            left: 41px;
        }
        .toggleSwitch.large > span span {
            font-size: 1.1em;
        }
        .toggleSwitch.large > span span:first-of-type {
            left: 50%;
        }
        .toggleSwitch.xlarge {
            width: 80px;
            height: 36px;
        }
        .toggleSwitch.xlarge a {
            width: 36px;
        }
        .toggleSwitch.xlarge > span {
            height: 38px;
            line-height: 37px;
        }
        .toggleSwitch.xlarge input:checked ~ a {
            left: 52px;
        }
        .toggleSwitch.xlarge > span span {
            font-size: 1.4em;
        }
        .toggleSwitch.xlarge > span span:first-of-type {
            left: 50%;
        }
    }


    .hm-gradient {
        background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);
    }
    .darken-grey-text {
        color: #2E2E2E;
    }
    .input-group.md-form.form-sm.form-2 input {
        border: 1px solid #bdbdbd;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }
    .input-group.md-form.form-sm.form-2 input.purple-border {
        border: 1px solid #9e9e9e;
    }
    .input-group.md-form.form-sm.form-2 input[type=text]:focus:not([readonly]).purple-border {
        border: 1px solid #ba68c8;
        box-shadow: none;
    }
    .form-2 .input-group-addon {
        border: 1px solid #ba68c8;
    }
    .danger-text {
        color: #ff3547;
    }
    .success-text {
        color: #00C851;
    }
    .table-bordered.red-border, .table-bordered.red-border th, .table-bordered.red-border td {
        border: 1px solid #ff3547!important;
    }
    .table.table-bordered th {
        text-align: center;
    }
    @import "https://s3-us-west-2.amazonaws.com/s.cdpn.io/584938/dashboard.scss";
    $bg: #1b2431;
    $light-text: #738297;
    $dark-text: #273142;
    $light-bg: #313D4F;

    // global stuff
    body {
        background-color: $bg;
        color: #202020;
        font-family: "Montserrat", "Helvetica", "Open Sans", "Arial";
        font-size: 13px;
    }

    a:hover {
        text-decoration: none;
    }

    p,
    figure {
        margin: 0;
        padding: 0;
    }

    @mixin clear() {
        &:before,
        &:after {
            content: " ";
            display: table;
        }

        &:after {
            clear: both;
        }
    }

    .navbar {
        background-color: $bg;
    }

    .sidebar {
        background-color: $bg;
        box-shadow: none;

        .nav-link {
            border-left: 5px solid transparent;
            color: $light-text;
            padding: .5rem .75rem;

            &:hover {
                color: white;
            }

            &.active {
                border-left: 5px solid $light-text;
                color: white;
            }
        }

        .zmdi {
            display: inline-block;
            font-size: 1.35rem;
            margin-right: 5px;
            min-width: 25px;
        }
    }

    .card-list {
        @include clear();
        width: 100%;
    }

    .card {
        border-radius: 8px;
        color: white;
        padding: 10px;
        position: relative;

        .zmdi {
            color: white;
            font-size: 28px;
            opacity: 0.3;
            position: absolute;
            right: 13px;
            top: 13px;
        }

        .stat {
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 8px;
            margin-top: 25px;
            padding: 10px 10px 0;
            text-transform: uppercase;
        }

        .title {
            display: inline-block;
            font-size: 8px;
            padding: 10px 10px 0;
            text-transform: uppercase;
        }

        .value {
            font-size: 28px;
            padding: 0 10px;
        }

        &.blue {
            background-color: #2298F1;
        }

        &.green {
            background-color: #66B92E;
        }

        &.orange {
            background-color: #DA932C;
        }

        &.red {
            background-color: #D65B4A;
        }
    }

    .projects {
        background-color: $dark-text;
        border: 1px solid $light-bg;
        overflow-x: auto;
        width: 100%;

        &-inner {
            border-radius: 4px;
        }
    }

    .projects-header {
        color: white;
        padding: 22px;

        .count,
        .title {
            display: inline-block;
        }

        .count {
            color: #738297;
        }

        .zmdi {
            cursor: pointer;
            float: right;
            font-size: 16px;
            margin: 5px 0;
        }

        .title {
            font-size: 21px;

            + .count {
                margin-left: 5px;
            }
        }
    }

    .projects-table {
        background: #273142;
        width: 100%;

        td,
        th {
            color: white;
            padding: 10px 22px;
            vertical-align: middle;
        }

        td p {
            font-size: 12px;

            &:last-of-type {
                color: $light-text;
                font-size: 11px;
            }
        }

        th {
            background-color: $light-bg;
        }

        tr {
            &:hover {
                background-color: lighten($dark-text, 5%);
            }

            &:not(:last-of-type) {
                border-bottom: 1px solid $light-bg;
            }
        }

        .member {
            figure,
            .member-info {
                display: inline-block;
                vertical-align: top;
            }

            figure + .member-info {
                margin-left: 7px;
            }

            img {
                border-radius: 50%;
                height: 32px;
                width: 32px;
            }
        }

        .status > form {
            float: right;
        }

        .status-text {
            display: inline-block;
            font-size: 12px;
            margin: 11px 0;
            padding-left: 20px;
            position: relative;

            &:before {
                border: 3px solid;
                border-radius: 50%;
                content: "";
                height: 14px;
                left: 0;
                position: absolute;
                top: 1px;
                width: 14px;
            }

            &.status-blue:before {
                border-color: #1C93ED;
            }

            &.status-green:before {
                border-color: #66B92E;
            }

            &.status-orange:before {
                border-color: #DA932C;
            }

            &.status-red:before {
                border-color: #D65B4A;
            }
        }
    }
    // selectric plugin styling
    .selectric {
        background-color: transparent;
        border-color: $light-bg;
        border-radius: 4px;
        .label {
            color: $light-text;
            line-height: 34px;
            margin-right: 10px;
            text-align: left;
        }
        &-wrapper {
            float: right;
            width: 150px;
        }
    }
    // charts
    .chart {
        border-radius: 3px;
        // box-shadow: 0 0 10px -3px black;
        border: 1px solid $light-bg;
        color: white;
        padding: 10px;
        position: relative;
        text-align: center;

        canvas {
            height: 400px;
            margin: 20px 0;
            width: 100%;
        }

        .actions {
            margin: 15px;
            position: absolute;
            right: 0;
            top: 0;

            span {
                cursor: pointer;
                display: inline-block;
                font-size: 20px;
                margin: 5px;
                padding: 4px;
            }

            .btn-link {
                color: white;

                i {
                    font-size: 1.75rem;
                }
            }
        }

        .title {
            font-size: 18px;
            margin: 0;
            padding: 15px 0 5px;
            + .tagline {
                margin-top: 10px;
            }
        }

        .tagline {
            font-size: 12px;
        }
    }

    .danger-item {
        border-left: 4px solid #A84D43;
    }

    .zmdi {
        line-height: 1;
        vertical-align: middle;
    }

</style>
