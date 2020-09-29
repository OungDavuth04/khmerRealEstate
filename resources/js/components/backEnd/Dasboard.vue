<template>
    <div>


            <div class="card-list">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card blue">
                            <div class="title">List Real Estate</div>
                            <i class="zmdi zmdi-upload"></i>
                            <div class="value">89</div>
                            <div class="stat"><b>13</b>% increase</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card green">
                            <div class="title">All User</div>
                            <i class="zmdi zmdi-upload"></i>
                            <div class="value">5,990</div>
                            <div class="stat"><b>4</b>% increase</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card orange">
                            <div class="title">total budget</div>
                            <i class="zmdi zmdi-download"></i>
                            <div class="value">$80,990</div>
                            <div class="stat"><b>13</b>% decrease</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card red">
                            <div class="title">new customers</div>
                            <i class="zmdi zmdi-download"></i>
                            <div class="value">3</div>
                            <div class="stat"><b>13</b>% decrease</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="projects mb-4">
                <div class="projects-inner">
                    <header class="projects-header">
                        <div class="title">User List</div>
                        <div class="count">| 32 Projects</div>
                        <i class="zmdi zmdi-download"></i>
                    </header>
                </div>
            </div>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Province</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>

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
                UserList:[]
            }
        },
        mounted() {
        },
        methods:{
            UserList(){
                axios.get('api/userlist').then(response => {
                    console.log(response);
                }).catch(err => {
                    console.log(err);
                });
            }
        }

    }
</script>

<style scoped lang="scss">
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
