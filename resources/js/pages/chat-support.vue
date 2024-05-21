<template>
  <div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            BASE_API: window.location.origin+"/api",
            chatSupportData:[]
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData(){
            // axios
            //     .get(this.BASE_API.concat(this.GET_TRANSACTIONS), this.status)
            //     .then(response => {
            //         if(response.data.success){
            //             var data = response.data.data
            //             data.forEach(record => {
            //                 this.transactionData.push(record);
            //             });
            //         }
            //     });
        },

    },
    created(){

    },

}
</script>
