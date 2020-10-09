<template>
    <div>
        <download-excel :data="report"
                        :fields = "json_fields"
                        worksheet = "My Worksheet"
                        name    = "filename.xls">
            Download Data
        </download-excel>
    </div>
</template>

<script>
    export default {
        name: "Report",
        data(){
          return{
              report:[],
              json_fields: {
                  'promoteId': 'promoteId',
                  'UpId': 'UpId',
                  'price': 'price',
                  'Day' : 'day'
              },
              json_data: [
                  {
                      'name': 'Tony Peña',
                      'city': 'New York',
                      'country': 'United States',
                      'birthdate': '1978-03-15',

                  },
                  {
                      'name': 'Thessaloniki',
                      'city': 'Athens',
                      'country': 'Greece',
                      'birthdate': '1987-11-23',

                  }
              ],
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
            this.Export()
        },
        methods:{
            Export(){
                axios.get('api/export').then(response => {
                 console.log(response.data)
                    this.report = response.data
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>

<style scoped>

</style>
