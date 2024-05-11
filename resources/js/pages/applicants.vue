<template>
  <div>
    <VRow>
        <VCol
            v-for="data in applicantData"
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
                    :image="data.profile_url"
                    />
                    <span class="text-black ms-2">{{ data.full_name }}</span>
                </div>

                <div class="d-flex align-center">
                    <span class="text-subtitle-2 text-black me-4">{{ data.job_role }}</span>
                </div>
                <div class="d-flex align-center">
                    <span class="text-subtitle-2 text-black">{{ data.address }}</span>
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
            GET_APPLICANTS: "/v1/applicants",
            applicantData:[]
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData(){
            axios
                .get(this.BASE_API.concat(this.GET_APPLICANTS), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        data.forEach(record => {
                            this.applicantData.push(record);
                        });
                    }
                });
        },

    },
    created(){

    },

}
</script>
