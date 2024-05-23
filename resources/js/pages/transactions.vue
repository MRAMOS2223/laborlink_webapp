<script setup>
import '@fortawesome/fontawesome-free/css/all.css';
import logoImage from '@images/icons/logo/laborlink.png';
</script>
<template>
  <div>
    <VCard v-if="!loading">
      <!-- <img height="80px" width="80px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/1667px-PDF_file_icon.svg.png"> -->
      <div class="button-container">
        <button class="export-btn" v-on:click="exportTransaction"> <i class="fas fa-file-pdf fa-lg"></i>  Export Transactions to PDF</button>
      </div>
    </VCard>
    <br>
    <VCard v-if="!loading">
      <VTable id="data-table">
            <thead>
            <tr>
                <th>
                Transaction ID
                </th>
                <th>
                Date & Time
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
                {{ formatDate(data.transaction_datetime) }}
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
    </VCard>
    <VCard class="chat-container loading" v-else >
        <img src="https://firebasestorage.googleapis.com/v0/b/labor-link-f9424.appspot.com/o/app_image_assets%2Floading-gif.gif?alt=media&token=c2ef9c6e-032f-4772-bc5f-f47c23953c2f" alt="Loading..." />
        <span class="loader-text">Fetching Data</span>
    </VCard>
  </div>
</template>
<script>
import axios from 'axios';
import jsPDF from 'jspdf';
import 'jspdf-autotable';

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
        formatDate(datetime) {
        const date = new Date(datetime);
        const options = { 
          year: 'numeric', 
          month: 'long', 
          day: 'numeric', 
          hour: '2-digit', 
          minute: '2-digit' 
        };
        return new Intl.DateTimeFormat('en-US', options).format(date);
      },
      exportTransaction(){
        const doc = new jsPDF();
        const columns = ["Transaction ID", "Date & Time", "Type", "Subscriber", "Amount Paid", "Status"];
        const rows = this.transactionData.map(data => [data.transaction_id, data.transaction_datetime, data.type, data.subscriber_name, data.amount_paid, data.status]);
        
         doc.addImage(logoImage, 'PNG', 10, 10, 20, 20);

        const title = "Transactions List";
        doc.setFontSize(18);
        const pageWidth = doc.internal.pageSize.getWidth();
        const titleWidth = doc.getTextWidth(title);
        const titleX = (pageWidth - titleWidth) / 2;
        doc.text(title, titleX, 22);


        const subtitle = "From January to December 2024";
        doc.setTextColor(128, 128, 128);
        doc.setFontSize(12);
        const subtitleWidth = doc.getTextWidth(subtitle);
        const subtitleX = (pageWidth - subtitleWidth) / 2;
        doc.text(subtitle, subtitleX, 30);
        

        doc.autoTable({
          head: [columns],
          body: rows,
          startY: 40,
        });

        doc.save('Transactions (January to December 2024).pdf');
      }

    },
    created(){

    },

}
</script>
<style scoped>
.export-btn {
  padding: 14px;
  border-radius: 30px;
  margin: 18px;
  background-color: #346898;
  color: white;
  font-size: 12px;
}

.button-container {
  text-align: end;
}

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
