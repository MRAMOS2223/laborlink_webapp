<script setup>
import { hexToRgb } from '@layouts/utils';
import VueApexCharts from 'vue3-apexcharts';
import {
  useDisplay,
  useTheme,
} from 'vuetify';

const vuetifyTheme = useTheme()
const display = useDisplay()


const chartOptions = computed(() => {
  const currentTheme = vuetifyTheme.current.value.colors
  const variableTheme = vuetifyTheme.current.value.variables
  const disabledTextColor = `rgba(${ hexToRgb(String(currentTheme['on-surface'])) },${ variableTheme['disabled-opacity'] })`
  const primaryTextColor = `rgba(${ hexToRgb(String(currentTheme['on-surface'])) },${ variableTheme['high-emphasis-opacity'] })`
  const borderColor = `rgba(${ hexToRgb(String(variableTheme['border-color'])) },${ variableTheme['border-opacity'] })`
  
  return {
    chart: {
      chart: {
        parentHeightOffset: 0,
        toolbar: { show: false },
        dropShadow: {
          top: 5,
          blur: 4,
          left: 0,
          enabled: true,
          opacity: 0.2,
          color: "#3F9AE0",
        },
      },
      
      dataLabels: { enabled: false },
      stroke: {
        width: 4,
        curve: 'smooth',
        lineCap: 'round',
        
      },
      colors: [`rgba(${ hexToRgb(String("#3F9AE0")) }, 1)`],
      legend: {
        offsetX: -10,
        position: 'top',
        fontSize: '14px',
        horizontalAlign: 'left',
        fontFamily: 'Public Sans',
        labels: { colors: currentTheme.secondary },
        itemMargin: {
          vertical: 4,
          horizontal: 10,
        },
        markers: {
          width: 8,
          height: 8,
          radius: 10,
          offsetX: -4,
        },
      },
      states: {
        hover: { filter: { type: 'none' } },
        active: { filter: { type: 'none' } },
      },
      grid: {
        borderColor,
        padding: { bottom: 5 },
      },
      plotOptions: {
        chart: {
          borderRadius: 10,
          columnWidth: '30%',
          endingShape: 'rounded',
          startingShape: 'rounded',
        },
      },
      xaxis: {
        axisTicks: { show: false },
        crosshairs: { opacity: 0 },
        axisBorder: { show: false },
        categories: [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'Septemper',
          'October',
          'November',
          'December',
        ],
        labels: {
          style: {
            fontSize: '14px',
            colors: disabledTextColor,
            fontFamily: 'Public Sans',
          },
        },
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '14px',
            colors: disabledTextColor,
            fontFamily: 'Public Sans',
          },
        },
      }
    },
  }
})

</script>

<template>
  <VCard>
    <VRow no-gutters>
      <VCol
        cols="12"
        sm="12"
        md="12"
        lg="12"
        xl="12"
        :class="$vuetify.display.smAndUp ? 'border-e' : 'border-b'"
      >
        <VCardItem class="pb-0">
          <VCardTitle>Earnings</VCardTitle>

          <template #append>
            <div class="me-n3">
              <MoreBtn />
            </div>
          </template>
        </VCardItem>

        <VueApexCharts
          ref="earningsChart"
          type="line"
          :height="336"
          :options="chartOptions.chart"
          :series="series"
        />
      </VCol>

    </VRow>
  </VCard>
</template>
<script>
import axios from 'axios';


let series = [
  {
    name: `${ new Date().getFullYear() }`,
    data: [
      
    ],
}];

export default {
  data() {
        return {
            BASE_API: window.location.origin+"/api",
            GET_MONTHLY_EARNINGS: "/v1/statistics/monthly-earnings",
        }
    },
    mounted(){
      this.getMonthlyEarnings()
    },
    methods: {
      getMonthlyEarnings(){
          axios
              .get(this.BASE_API.concat(this.GET_MONTHLY_EARNINGS), this.status)
              .then(response => {
                  if(response.data.success){
                      var data = response.data.data
                      console.log(series);

                      this.$refs.earningsChart.updateSeries([{
                        data: data
                      }], false, true);
                  }
              });
      },
    },
}
</script>

<style lang="scss">
#bar-chart .apexcharts-series[rel="2"] {
  transform: translateY(-10px);
}
</style>
