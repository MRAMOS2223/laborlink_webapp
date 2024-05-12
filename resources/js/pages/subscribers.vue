<template>
  <div>
    <VRow>
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
  </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            BASE_API: window.location.origin+"/api",
            GET_SUBSCRIBERS: "/v1/subscribers",
            subscriberData:[]
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData(){
            axios
                .get(this.BASE_API.concat(this.GET_SUBSCRIBERS), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        data.forEach(record => {
                            this.subscriberData.push(record);
                        });
                    }
                });
        },

    },
    created(){

    },

}
</script>
