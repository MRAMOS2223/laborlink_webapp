<template>
  <div>
    <VRow class=""  v-if="!loading">
      <div class="container">
        <div class="card" v-for="company in employerData" :key="company.email_address">
          <img :src="company.logo_url" alt="Company Logo">
          <h3>{{ company.employer_name }}</h3>
          <p>{{ company.employer_address }}</p>
        </div>
      </div>
<!-- 
        <VCol
            v-for="data in employerData"
            :key="data.email_address"
            cols="12"
            md="12"
            lg="12"
            >
            <VCard :color="data.cardBg">
                <VCardText class="d-flex justify-space-between align-center flex-wrap">
                <div class="text-no-wrap">
                    <VAvatar
                    size="34"
                    :image="data.logo_url"
                    />
                    <span class="text-black ms-2">{{ data.employer_name }}</span>
                </div>

                <div class="d-flex align-center">
                    <span class="text-subtitle-2 text-black me-4">{{ data.industry }}</span>
                </div>
                <div class="d-flex align-center">
                    <span class="text-subtitle-2 text-black">{{ data.employer_address }}</span>
                </div>
                </VCardText>
            </VCard>
        </VCol> -->
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
            GET_EMPLOYERS: "/v1/employers",
            employerData:[],
            loading: true
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData(){
            axios
                .get(this.BASE_API.concat(this.GET_EMPLOYERS), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        data.forEach(record => {
                            this.employerData.push(record);
                        });
                        this.loading = false;
                    }
                });
        },

    },
    created(){

    },

}
</script>
<style scoped>
.container {
  display: flex;
  flex-wrap: wrap;
  padding: 2px;
}

.card {
  padding: 20px;
  border: 1px solid #fff;
  border-radius: 8px;
  margin: 10px;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 10%);
  inline-size: 200px;
  text-align: center;
}

.card img {
  block-size: 50px;
  inline-size: 50px;
  margin-block-end: 10px;
}

.card p {
  padding-block-start: 8px;
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
