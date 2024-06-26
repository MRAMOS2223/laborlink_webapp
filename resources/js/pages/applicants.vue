<script setup>
import '@fortawesome/fontawesome-free/css/all.css';
import logoImage from '@images/icons/logo/laborlink.png';
</script>
<template>
  <div>
    <VCard v-if="!loading">
      <!-- <img height="80px" width="80px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/1667px-PDF_file_icon.svg.png"> -->
      <div class="button-container">
        <button class="export-btn" v-on:click="exportApplicantsData"> <i class="fas fa-file-pdf fa-lg"></i>  Export Applicants Data to PDF</button>
      </div>
    </VCard>
    <br/>
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
import jsPDF from 'jspdf';
import 'jspdf-autotable';

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
        exportApplicantsData(){
          const doc = new jsPDF();
          const columns = ["Applicant Name", "Job Position", "Location","Expected Salary Range",  "Email Address"];
          const rows = this.applicantData.map(data => [data.full_name, data.job_role,  data.address, "PHP ".concat(data.minimum_expected_salary == '' ? 0 : data.minimum_expected_salary).concat(" to PHP ").concat( data.maximum_expected_salary != '' ? data.maximum_expected_salary : 0),data.email_address]);
          
          doc.addImage(logoImage, 'PNG', 10, 10, 20, 20);

          const title = "Applicants List";
          doc.setFontSize(18);
          const pageWidth = doc.internal.pageSize.getWidth();
          const titleWidth = doc.getTextWidth(title);
          const titleX = (pageWidth - titleWidth) / 2;
          doc.text(title, titleX, 22);


          const subtitle = "From January to December 2024";
          doc.setTextColor(128, 128, 128);
          doc.setFontSize(12);
          const subtitleWidth = doc.getTextWidth(subtitle);
          const subtitleX = (pageWidth - subtitleWidth) / 2;
          doc.text(subtitle, subtitleX, 30);
          

          doc.autoTable({
            head: [columns],
            body: rows,
            startY: 40,
            columnStyles: {
              3: {
                cellWidth: 50
              },
            }
          });

          doc.save('Applicants List (January to December 2024).pdf');
      }

    },
    created(){

    },

}
</script>
<style scoped>
.button-container {
  text-align: end;
}

.export-btn {
  padding: 14px;
  border-radius: 30px;
  margin: 18px;
  background-color: #346898;
  color: white;
  font-size: 12px;
}

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
