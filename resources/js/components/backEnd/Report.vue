<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="form-group" style="display: flex;flex-direction: row">
                    <div style="width: 40%;margin-right: 1rem">
                        <label for="Report"> Report</label>
                        <select class="form-control" id="Report" v-model="data.select">
                            <option value="DailyReport">Daily Report</option>
                            <option value="WeekReport">Week Report</option>
                        </select>
                    </div>
                    <div style="margin-right: 1rem">
                        <label > Filter Date</label>
                        <input type="Date" class="form-control" v-model="data.filter">
                    </div>
                    <div style="width: 40%;margin-right: 1rem" >
                        <button type="submit" class="btn" @click="Export" >Save</button>
                    </div>
                    <div style="width: 40%;margin-right: 1rem" id="print">
                        <download-excel class="btn1" @click="errorMessage"
                            :data="report"
                            :fields = "json_fields"
                            worksheet = "My Worksheet"
                            name = "filename.xls">
                            Print Report
                        </download-excel>
                    </div>

                </div>

            </div>
            <div class="error" v-if="error === true">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> The Report Out Of Date...
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Report",
        data(){
          return{
              error:false,
              data:{
                  filter:'',
                  select:'',
              },
              report:[],
              json_fields: {
                  'PromoteId': 'promoteId',
                  'UpId': 'UpId',
                  'Price': 'price',
                  'Day' : 'day',
                  'Expire' :'expire' ,
                  'Disable':'disable',
                  'Promoted Viewer':'viewer'
              },
              json_meta: [
                  [
                      {
                          'key': 'charset',
                          'value': 'utf-8'
                      }
                  ]
              ],
          }
        },
        mounted() {
            $('#print').hide()
        },
        methods:{
            errorMessage(){

            },
            Export(){
                    axios.post('api/export',this.data).then(response => {
                        console.log(response.data)
                        this.report = response.data
                        if (this.report.length < 1 || this.report === undefined){
                            this.error = true
                            $('#print').hide()
                        }else {
                            this.error = false
                            $('#print').show()
                        }

                    }).catch(err => {
                        console.log(err);
                    });

            }
        }
    }
</script>

<style scoped>
    .btn{
        background: #0c7cd5;
        width: 140px;
        height: 38px;
        margin-top: 20px;
    }
    .btn1{
        cursor: pointer;
        background: #6cb2eb;
        width: 140px;
        height: 38px;
        margin-top: 20px;
    }
    .row{
        padding: 2%;
        background: #ffffff;
        width: 100%;
    }
    .error{
        padding: 1%;
        width: 100%;
    }
</style>
