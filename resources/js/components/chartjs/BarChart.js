// import { Bar, mixins } from 'vue-chartjs'
// const { reactiveProp } = mixins
//
// const defaultOptions = {
//   elements: {
//     point: {
//       radius: 0,
//       hoverRadius: 5,
//       hitRadius: 5
//     }
//   },
//   scales: {
//     yAxes: [
//       {
//         ticks: {
//           beginAtZero: true
//         }
//       }
//     ]
//   }
// }
//
// export default {
//   extends: Bar,
//   mixins: [reactiveProp],
//   props: ['options'],
//   computed: {
//     computedOptions () {
//       return Object.assign({}, defaultOptions, this.options)
//     }
//   },
//   mounted () {
//     // this.chartData is created in the mixin.
//     // If you want to pass options please create a local options object
//     this.renderChart(this.chartData, this.computedOptions)
//   }
// }
