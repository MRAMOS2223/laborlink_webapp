<template>
  <div>
    <VTable v-if="!loading">
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
              <div class="completed-badge" v-if="data.status == 'Completed'"> {{ data.status }}</div>
              <div class="failed-badge" v-else> {{ data.status }}</div>
            </td>
        </tr>
        </tbody>
    </VTable>
    <VCard class="chat-container loading" v-else >
        <img src="https://firebasestorage.googleapis.com/v0/b/labor-link-f9424.appspot.com/o/app_image_assets%2Floading-gif.gif?alt=media&token=c2ef9c6e-032f-4772-bc5f-f47c23953c2f" alt="Loading..." />
        <span class="loader-text">Fetching Data</span>
    </VCard>
  </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            BASE_API: window.location.origin+"/api",
            GET_TRANSACTIONS: "/v1/transactions",
            transactionData:[],
            loading: true
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

                    this.loading = false;
                });
        },

    },
    created(){

    },

}
</script>
<style scoped>
.text-center {
  padding-block: 15px !important;
}

.completed-badge {
  display: inline-block;
  border-radius: 20px;
  background-color: #5cca4a;
  color: white;
  padding-block: 5px;
  padding-inline: 10px;
}

.failed-badge {
  display: inline-block;
  border-radius: 20px;
  background-color: #f85d5d;
  color: white;
  padding-block: 5px;
  padding-inline: 10px;
}

.chat-container {
  display: flex;
  block-size: 80vh;
  inline-size: 100%;
}

.loading {
  display: flex;
  align-items: center;
  justify-content: center;
  block-size: calc(100vh - 120px);
}

.loading img {
  block-size: 80px;
  inline-size: 80px;
}

.loader-text {
  padding-inline-start: 1px;
}

</style>
