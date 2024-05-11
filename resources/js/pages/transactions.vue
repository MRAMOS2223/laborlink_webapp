<template>
  <div>

        <VTable>
            <thead>
            <tr>
                <th>
                Transaction ID
                </th>
                <th>
                Date
                </th>
                <th>
                Type
                </th>
                <th>
                Subscriber
                </th>
                <th>
                Amount Paid
                </th>
                <th>
                Status
                </th>
            </tr>
            </thead>

            <tbody>
            <tr
                v-for="data in transactionData"
                :key="data.transaction_id"
            >
                <td>
                {{ data.transaction_id }}
                </td>
                <td class="text-center">
                {{ data.transaction_datetime }}
                </td>
                <td class="text-center">
                {{ data.type }}
                </td>
                <td class="text-center">
                {{ data.subscriber_name }}
                </td>
                <td class="text-center">
                {{ data.amount_paid }}
                </td>
                <td class="text-center">
                {{ data.status }}
                </td>
            </tr>
            </tbody>
        </VTable>
  </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            BASE_API: window.location.origin+"/api",
            GET_TRANSACTIONS: "/v1/transactions",
            transactionData:[]
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData(){
            axios
                .get(this.BASE_API.concat(this.GET_TRANSACTIONS), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        data.forEach(record => {
                            this.transactionData.push(record);
                        });
                    }
                });
        },

    },
    created(){

    },

}
</script>
