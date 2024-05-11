<template>
  <div>
    <VRow>
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
            GET_EMPLOYERS: "/v1/employers",
            employerData:[]
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
                    }
                });
        },

    },
    created(){

    },

}
</script>
