<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Policy Lookup</title>
        
        <script src="https://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
    </head>
    <body>
        
        <div class="wrapper">
            <div class="innerWrap" id="clients">
                
                <h1>{{ Request::route('client') }}</h1>
                
                <h2>Policy Lookup</h2>
                
                <p>Please enter your name to find your policy below.</p>
                
                <div class="row">
                    <input v-model="search">
                </div>
                
                <div class="policyData" v-if="search">
                    <table v-if="resultQuery.length > 0">
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Address</th>
                            <th>Insurer Name</th>
                            <th>Type</th>
                            <th>Premium</th>
                        </tr>
                        <tr v-for="policy in resultQuery">
                            <td>[% policy.customer_name %]</td>
                            <td>[% policy.customer_address %]</td>
                            <td>[% policy.insurer_name %]</td>
                            <td>[% policy.type %]</td>
                            <td>£[% currency(policy.premium) %]</td>
                        </tr>
                    </table>
                    <p v-else>No records found.</p>
                </div><!-- .policyData -->
                
            </div><!-- .innerWrap -->
        </div><!-- .wrapper -->
        
        <script>
            new Vue({
                delimiters: ['[%', '%]'],
                el: '#clients',
                data: {
                    client: '{{ Request::route('client') }}',
                    search: '',
                    policies: []
                },
                mounted(){
                    this.loadData();
                },
                methods: {
                    loadData: function () {
                        $.get('/api/' + this.client, function (response) {
                            this.policies = response.data[0];
                        }.bind(this));
                    },
                    currency(price) {
                        let value = (price / 1).toFixed(2).replace('.', ',')
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                    }
                },
                computed: {
                    resultQuery(){
                        if(this.search){
                            return this.policies.filter((policy)=>{
                                return this.search.toLowerCase().split(' ').every(v => policy.customer_name.toLowerCase().includes(v))
                            })
                        }
                    }
                }
            });
        </script>
    </body>
</html>
