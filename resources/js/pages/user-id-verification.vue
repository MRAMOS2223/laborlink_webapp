<template>
  <div>
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
        }

    },
    created(){

    },

}
</script>
<style scoped>
.view-id-btn {
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
