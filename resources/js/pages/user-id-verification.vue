<script setup>
import '@fortawesome/fontawesome-free/css/all.css';
import logoImage from '@images/icons/logo/laborlink.png';
</script>
<template>
  <div>
    <VCard v-if="!loading">
      <!-- <img height="80px" width="80px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/1667px-PDF_file_icon.svg.png"> -->
      <div class="button-container">
        <button class="export-btn" v-on:click="exportUserIDUploadsData"> <i class="fas fa-file-pdf fa-lg"></i>  Export User ID Uploads Data to PDF</button>
      </div>
    </VCard>
    <br/>
    <VRow v-if="!loading">
      <div class="user-card" v-for="user in userIDData" :key="user.id">
        <div class="user-column">
          <img :src="user.logo" alt="User Avatar">
          <div class="user-details">
            <h3>{{ user.user_name }}</h3>
            <p>{{ user.field }}</p>
          </div>
        </div>
        <div class="user-column icon-text">
          <img src="https://firebasestorage.googleapis.com/v0/b/labor-link-f9424.appspot.com/o/app_image_assets%2FicLocation.png?alt=media&token=9958b30b-eecd-4296-bcd1-3c1713c41f36">
          <span>{{ user.location }}</span>
        </div>

        <div class="user-column">
          <div class="button-container">
            <button class="view-id-btn" v-on:click="viewId(user.ids)"> <i class="fas fa-file-pdf fa-lg"></i>  View ID</button>
          </div>
        </div>
      </div>

      <v-dialog v-model="showIDModal" max-width="400">
        <v-card>
          <v-card-title class="headline">ID</v-card-title>

          <div v-for="id in ids" :key="id.link">
            <v-card-text>{{ id.id_type }}</v-card-text>
            <v-card-text>{{ id.file_name }}</v-card-text>
            <v-img :src="id.link" alt="Error Image" class="mb-3 pa-7 bordered-image"></v-img>
          </div>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" @click="dismissModal">OK</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </VRow>
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
            GET_ID_UPLOADS: "/v1/user/id/uploads",
            userIDData:[],
            loading: true,
            showIDModal: false,
            ids:[]
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData(){
            axios
                .get(this.BASE_API.concat(this.GET_ID_UPLOADS), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        data.forEach(record => {
                            this.userIDData.push(record);
                            this.loading = false;
                        });
                    }
                });
        },

        viewId(ids){
          this.showIDModal = true;
          this.ids = ids;

        },

        dismissModal(){
          this.showIDModal = false;
        },

        exportUserIDUploadsData(){
          const doc = new jsPDF();
          const columns = ["Name", "Designation", "Address", "IDs Uploaded"];
          const rows = this.userIDData.map(data => [data.user_name, data.field, data.location, data.ids.map(obj => `${obj.id_type}`).join(', ')]);
          
          doc.addImage(logoImage, 'PNG', 10, 10, 20, 20);

          const title = "User's ID Uploads List";
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

          doc.save('User\'s ID Uploads List (January to December 2024).pdf');
      }


    },
    created(){

    },

}
</script>
<style scoped>
.button-container {
  text-align: end;
}

.export-btn {
  padding: 14px;
  border-radius: 30px;
  margin: 18px;
  background-color: #346898;
  color: white;
  font-size: 12px;
}

.view-id-btn {
  padding: 14px;
  border-radius: 30px;
  margin: 18px;
  background-color: #346898;
  color: white;
  font-size: 12px;
}

.container {
  margin: auto;
  inline-size: 80%;
  padding-block-start: 20px;
}

.user-card {
  display: flex;
  padding: 15px;
  border: 1px solid #fff;
  border-radius: 8px;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 10%);
  inline-size: 100%;
  margin-block-end: 10px;
  margin-block-start: 10px;
  margin-inline-end: 12px;
  margin-inline-start: 12px;
}

.user-column {
  display: flex;
  flex: 1;
  align-items: center;
}

.user-column img {
  block-size: 45px;
  inline-size: 45px;
  margin-inline-end: 15px;
}

.user-details {
  display: flex;
  flex-direction: column;
}

.user-details h3 {
  margin: 0;
}

.user-details p {
  color: #888;
  margin-block: 5px;
  margin-inline: 0;
}

.icon-text {
  display: flex;
  align-items: center;
}

.icon {
  margin-inline-end: 5px;
}

.salary-container {
  display: flex;
  align-items: center;
}

.salary-details {
  display: flex;
  flex-direction: column;
}

.salary {
  font-size: 17px;
  font-weight: bold;
}

.monthly {
  color: #888;
  font-size: 15px;
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
