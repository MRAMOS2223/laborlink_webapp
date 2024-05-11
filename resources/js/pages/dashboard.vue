<script setup>
import applicantsNumberIcon from '@images/icons/logo/applicants-number-icon.png';
import jobPostingsIcon from '@images/icons/logo/job-postings-icon.png';
import successfulHiresIcon from '@images/icons/logo/successful-hires-icon.png';
import AnalyticsTotalRevenue from '../views/dashboard/AnalyticsTotalRevenue.vue';

</script>

<template>
  <VRow>
    <!-- <VCol
      cols="12"
      md="8"
    >
      <AnalyticsCongratulations />
    </VCol> -->

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
                  3
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
                  10
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
                  30
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
</template>
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
