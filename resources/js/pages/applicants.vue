<template>
  <div>
    <VRow v-if="!loading">
      <div class="employee-card" v-for="employee in applicantData" :key="employee.email_address">
        <div class="employee-column">
          <img :src="employee.profile_url" alt="Employee Avatar">
          <div class="employee-details">
            <h3>{{ employee.full_name }}</h3>
            <p>{{ employee.job_role }}</p>
          </div>
        </div>
        <div class="employee-column icon-text salary-container">
          <img src="https://firebasestorage.googleapis.com/v0/b/labor-link-f9424.appspot.com/o/app_image_assets%2FicSalary.png?alt=media&token=a714342c-adde-44a0-bdc5-cc07b4331d09">
          <div class="salary-details">
            <span class="salary" v-if="employee.minimum_expected_salary != 0 && employee.minimum_expected_salary != null && employee.minimum_expected_salary != ''">₱{{  employee.minimum_expected_salary }} to ₱{{ employee.maximum_expected_salary }}</span>
            <span class="salary" v-else>No data yet</span>
            <span class="monthly">Monthly Salary</span>
          </div>
          
        </div>
        <div class="employee-column icon-text">
          <img src="https://firebasestorage.googleapis.com/v0/b/labor-link-f9424.appspot.com/o/app_image_assets%2FicLocation.png?alt=media&token=9958b30b-eecd-4296-bcd1-3c1713c41f36">
          <span>{{ employee.address }}</span>
        </div>
      </div>
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
            GET_APPLICANTS: "/v1/applicants",
            applicantData:[],
            loading: true
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
                            this.loading = false;
                        });
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
  margin: auto;
  inline-size: 80%;
  padding-block-start: 20px;
}

.employee-card {
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

.employee-column {
  display: flex;
  flex: 1;
  align-items: center;
}

.employee-column img {
  block-size: 45px;
  inline-size: 45px;
  margin-inline-end: 15px;
}

.employee-details {
  display: flex;
  flex-direction: column;
}

.employee-details h3 {
  margin: 0;
}

.employee-details p {
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
