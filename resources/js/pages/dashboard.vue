<script setup>
import applicantsNumberIcon from '@images/icons/logo/applicants-number-icon.png';
import jobPostingsIcon from '@images/icons/logo/job-postings-icon.png';
import successfulHiresIcon from '@images/icons/logo/successful-hires-icon.png';
import AnalyticsTotalRevenue from '../views/dashboard/AnalyticsTotalRevenue.vue';

</script>

<template>
  <VRow  v-if="!loading">
    <VCol
      cols="12"
      sm="12"
    >
      <VRow>
     
        <VCol
          cols="4"
          md="4"
        >
          <VCard>
            <VRow>
              <VCardText class="margin-left margin-symmetrical">
                <h5 class="text-h3 text-no-wrap mb-3 color-green">
                  {{ hiredCount }}
                </h5>
                <p class="mb-1">
                  Successful Hires
                </p>
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
              </VCardText>
              <VCardText class="margin-top">
                <img
                  width="60"
                  :src="successfulHiresIcon"
                  alt="image"
                >
              </VCardText>
            </VRow>
            
          </VCard>
        </VCol>

        <VCol
          cols="4"
          md="4"
        >
          <VCard>
            <VRow>
              <VCardText class="margin-left margin-symmetrical">
                <h5 class="text-h3 text-no-wrap mb-3 color-blue">
                  {{ jobPostingCount }}
                </h5>
                <p class="mb-1">
                  Job Postings
                </p>
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
              </VCardText>
              <VCardText class="margin-top">
                <img
                  width="60"
                  :src="jobPostingsIcon"
                  alt="image"
                >
              </VCardText>
            </VRow>
          </VCard>
        </VCol>
        <VCol
          cols="4"
          md="4"
        >
          <VCard>
            <VRow>
              <VCardText  class="margin-left margin-symmetrical">
                <h5 class="text-h3 text-no-wrap mb-3 color-yellow">
                  {{ applicantCount }}
                </h5>
                <p class="mb-1">
                  Applicants
                </p>
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
              </VCardText>
              <VCardText class="margin-top">
                  <img
                    width="60"
                    :src="applicantsNumberIcon"
                    alt="image"
                  >
              </VCardText>
            </VRow>
          </VCard>
        </VCol>
      </VRow>
    </VCol>

    <VCol
      cols="12"
      md="12"
    >
      <AnalyticsTotalRevenue />
    </VCol>
  </VRow>
  <VCard class="chat-container loading" v-else >
    <img src="https://firebasestorage.googleapis.com/v0/b/labor-link-f9424.appspot.com/o/app_image_assets%2Floading-gif.gif?alt=media&token=c2ef9c6e-032f-4772-bc5f-f47c23953c2f" alt="Loading..." />
    <span class="loader-text">Fetching Data</span>
  </VCard>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            BASE_API: window.location.origin+"/api",
            GET_HIRED_COUNT: "/v1/statistics/hire-count",
            GET_JOB_POSTING_COUNT: "/v1/statistics/job-postings-count",
            GET_APPLICANT_COUNT: "/v1/statistics/applicants-count",
            hiredCount: 0,
            jobPostingCount: 0,
            applicantCount: 0,
            loading: true
        }
    },
    mounted() {
        this.getHiredCount();
        this.getJobPostingCount();
        this.getApplicantCount()
    },
    methods: {
        getHiredCount(){
            axios
                .get(this.BASE_API.concat(this.GET_HIRED_COUNT), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        this.hiredCount = data;
                    }
                });
        },

        getJobPostingCount(){
            axios
                .get(this.BASE_API.concat(this.GET_JOB_POSTING_COUNT), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        this.jobPostingCount = data;
                    }
                });
        },

        getApplicantCount(){
            axios
                .get(this.BASE_API.concat(this.GET_APPLICANT_COUNT), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        this.applicantCount = data;
                        this.loading = false;
                    }
                });
        },

    },
    created(){

    },

}
</script>
<style>
.color-green {
  color: #2bc155;
}

.color-blue {
  color: #3f9ae0;
}

.color-yellow {
  color: #ff9b52;
}

.margin-top {
  margin-block-start: 52px;
}

.margin-left {
  margin-inline-start: 20px;
}

.margin-symmetrical {
  margin-block: 15px;
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
