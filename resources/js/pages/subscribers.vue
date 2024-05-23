<template>
  <div>
    <VRow v-if="!loading">
      <VCol
        v-for="data in subscriberData"
        :key="data.id"
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
              <span class="text-black ms-2">{{ data.industry }}</span>
            </div>

            <div class="d-flex align-center">
              <span class="text-subtitle-2 text-black me-4">PHP {{ data.monthly_payment }}</span>
              <span class="text-subtitle-2 text-black me-4">{{ data.plan }} plan</span>
            </div>
            <div class="d-flex align-center">
              <span class="text-subtitle-2 text-black">{{ data.status }}</span>
            </div>
          </VCardText>
        </VCard>
      </VCol>
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
      GET_SUBSCRIBERS: "/v1/subscribers",
      subscriberData: [],
      loading: true
    }
  },
  mounted() {
    this.loadData()
  },
  created(){

  },
  methods: {
    loadData(){
      axios
        .get(this.BASE_API.concat(this.GET_SUBSCRIBERS), this.status)
        .then(response => {
          if(response.data.success){
            var data = response.data.data
            data.forEach(record => {
              this.subscriberData.push(record)
              this.loading = false;
            })
          }
        })
    },

  },

}
</script>
<style scoped>
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

