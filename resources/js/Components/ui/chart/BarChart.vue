<template>
   <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script>
import { Bar } from 'vue-chartjs'
import {
   Chart as ChartJS,
   Title,
   Tooltip,
   Legend,
   BarElement,
   CategoryScale,
   LinearScale
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
   name: 'BarChart',
   components: { Bar },
   data() {
      return {
         chartData: {
            labels: ['Apr 4', 'Apr 9', 'Apr 15', 'Apr 21', 'Apr 27', 'May 3', 'May 9'],
            datasets: [
               {
                  data: [40, 20, 12, 5, 23, 30, 50],
                  backgroundColor: 'rgba(0, 128, 128, 1)',
                  borderColor: 'rgba(0, 128, 128, 1)',
                  borderWidth: 1
               }
            ]
         },
         chartOptions: {
            responsive: true
         }
      }
   }
}
</script>
