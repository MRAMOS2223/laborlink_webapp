<script setup>
import applicantsNumberIcon from '@images/icons/logo/applicants-number-icon.png';
import jobPostingsIcon from '@images/icons/logo/job-postings-icon.png';
import successfulHiresIcon from '@images/icons/logo/successful-hires-icon.png';
import AnalyticsProfileStrength from '../views/dashboard/AnalyticsProfileStrength.vue';

</script>

<template>
  <VRow>
    <VCol
      cols="12"
      sm="12"
    >
      <VRow>
     
        <VCol
          cols="2"
          md="2"
        >
          <VCard>
            <VRow>
              <VCardText class="margin-left margin-symmetrical">
                <p class="mb-1">
                  Companies
                </p>
                <h5 class="text-h4 text-no-wrap mb-3">
                  {{ companiesCount }}
                </h5>
                
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
              </VCardText>
            </VRow>
            
          </VCard>
        </VCol>

        <VCol
          cols="2"
          md="2"
        >
          <VCard>
            <VRow>
              <VCardText class="margin-left margin-symmetrical">
                <p class="mb-1">
                  Applicants
                </p>
                <h5 class="text-h4 text-no-wrap mb-3">
                  {{ applicantCount }}
                </h5>
                
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
              </VCardText>
            </VRow>
            
          </VCard>
        </VCol>

        <VCol
          cols="2"
          md="2"
        >
          <VCard>
            <VRow>
              <VCardText class="margin-left margin-symmetrical">
                <p class="mb-1">
                  Job Postings
                </p>
                <h5 class="text-h4 text-no-wrap mb-3">
                  {{ jobPostingCount }}
                </h5>
                
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
              </VCardText>
            </VRow>
            
          </VCard>
        </VCol>

        <VCol
          cols="2"
          md="2"
        >
          <VCard>
            <VRow>
              <VCardText class="margin-left margin-symmetrical">
                <p class="mb-1">
                  Rejected
                </p>
                <h5 class="text-h4 text-no-wrap mb-3">
                  {{ rejectedCount }}
                </h5>
                
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
              </VCardText>
            </VRow>
            
          </VCard>
        </VCol>

        <VCol
          cols="2"
          md="2"
        >
          <VCard>
            <VRow>
              <VCardText class="margin-left margin-symmetrical">
                <p class="mb-1">
                  Hired
                </p>
                <h5 class="text-h4 text-no-wrap mb-3">
                  {{ hiredCount }}
                </h5>
                
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
              </VCardText>
            </VRow>
            
          </VCard>
        </VCol>

        <VCol
          cols="2"
          md="2"
        >
          <VCard>
            <VRow>
              <VCardText class="margin-left margin-symmetrical">
                <p class="mb-1">
                  Interviewed
                </p>
                <h5 class="text-h4 text-no-wrap mb-3">
                  {{ interviewedCount }}
                </h5>
                
                <span
                  class="d-flex align-center gap-1 text-sm"
                >
                </span>
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
      <AnalyticsProfileStrength />
    </VCol>
  </VRow>
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
            GET_REJECTED_COUNT: "/v1/statistics/rejected-count",
            GET_COMPANIES_COUNT: "/v1/statistics/companies-count",
            GET_INTERVIEWED_COUNT: "/v1/statistics/interviewed-count",
            hiredCount: 0,
            jobPostingCount: 0,
            applicantCount: 0,
            rejectedCount: 0,
            companiesCount: 0,
            interviewedCount: 0,
        }
    },
    mounted() {
        this.getHiredCount();
        this.getJobPostingCount();
        this.getApplicantCount();
        this.getRejectedCount();
        this.getCompaniesCount();
        this.getInterviewedCount();
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
                    }
                });
        },

        getRejectedCount(){
            axios
                .get(this.BASE_API.concat(this.GET_REJECTED_COUNT), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        this.rejectedCount = data;
                    }
                });
        },

        getInterviewedCount(){
            axios
                .get(this.BASE_API.concat(this.GET_INTERVIEWED_COUNT), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        this.interviewedCount = data;
                    }
                });
        },

        getCompaniesCount(){
            axios
                .get(this.BASE_API.concat(this.GET_COMPANIES_COUNT), this.status)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        this.companiesCount = data;
                    }
                });
        },

    },
    created(){

    },

}
</script>
<style>
.color-green{
  color:#2BC155;
}
.color-blue{
  color:#3F9AE0;
}
.color-yellow{
  color:#FF9B52;
}
.margin-top{
  margin-top:52px;
}
.margin-left{
  margin-left:20px;
}
.margin-symmetrical{
  margin-top:15px;
  margin-bottom:15px
}
</style>
