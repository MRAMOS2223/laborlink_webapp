<script setup>
import { hexToRgb } from '@layouts/utils';
import VueApexCharts from 'vue3-apexcharts';
import {
  useDisplay,
  useTheme,
} from 'vuetify';

const vuetifyTheme = useTheme()
const display = useDisplay()

const series = [
  {
    name: `${ new Date().getFullYear() - 1 }`,
    data: [
      18,
      7,
      15,
      29,
      18,
      12,
      9,
      30,
      23,
      56,
      10,
      69,
    ],
  },
]

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

const balanceData = [
  {
    icon: 'bx-dollar',
    amount: '$32.5k',
    year: '2023',
    color: 'primary',
  },
  {
    icon: 'bx-wallet',
    amount: '$41.2k',
    year: '2022',
    color: 'info',
  },
]
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

        <!-- bar chart -->
        <VueApexCharts
          
          type="line"
          :height="336"
          :options="chartOptions.chart"
          :series="series"
        />
      </VCol>

    </VRow>
  </VCard>
</template>

<style lang="scss">
#bar-chart .apexcharts-series[rel="2"] {
  transform: translateY(-10px);
}
</style>
