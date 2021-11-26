<template>
  <div class="content">
    <div class="container-fluid">
      <div id="analytics-data-plot" class="mb-5">
        <div id="search-engine" class="dialog-item">
          <vs-row class="">
            <vs-col class="" cols="12">
              <h4>{{ $t('analytics-data-for-area') }}</h4>
            </vs-col>
          </vs-row>
          <div class="vx-row">
            <div class="vx-col lg:w-1/4 sm:w-1/2 w-full w-25">
              <label class="text-sm opacity-75">{{ $t('farm') }}</label>
              <b-form-select id="farm_id"
                             v-model="farm_id"
                             :options="listFarmSelect"
                             @change="getListPlotOfFarmSelect"
              ></b-form-select>
            </div>
            <div class="vx-col lg:w-1/4 sm:w-1/2 w-full w-25">
              <label class="text-sm opacity-75">{{ $t('plot') }}</label>
              <b-form-select id="plot_id"
                             v-model="plot_id"
                             :options="listPlotOfFarmSelect"
                             @change="getListDeviceOnFarmPlotSelect"
              ></b-form-select>
            </div>
            <div class="vx-col lg:w-1/4 sm:w-1/2 w-full w-25">
              <label class="text-sm opacity-75">{{ $t('device') }}</label>
              <b-form-select id="device_id" v-model="device_id" :options="listDeviceOnPlotSelect"></b-form-select>
            </div>
            <div class="vx-col lg:w-1/4 sm:w-1/2 w-full w-25">
              <label class="text-sm opacity-75">{{ $t('date_analytics') }}</label>
              <datetime format="YYYY-MM-DD" v-model="date">
              </datetime>
            </div>
          </div>
          <div class="vx-row">
            <div class="vx-col lg:w-1/4 sm:w-1/2 w-full w-25">
              <label class="text-sm opacity-75">{{ $t('analytics_data_type') }}</label>
              <b-form-select id="type_id" v-model="type_id" :options="listTypeDataSelect"></b-form-select>
            </div>
            <div class="vx-col lg:w-1/4 sm:w-1/2 w-full w-25">
            </div>
            <div class="vx-col lg:w-1/4 sm:w-1/2 w-full w-25">
            </div>
            <div class="vx-col flex flex-wrap justify-end m-auto mb-0 pt-2 lg:w-1/4 sm:w-1/2 w-full w-25">
              <Button type="info" @click="getDataAnalyticsInfo" class="ml-2">{{ $t('analytic_data')}}</Button>
            </div>
          </div>
        </div>
        <div id="result-search-engine">
          <b-table id="table-data"
                   :fields="columnsAnalyticPlotShow"
                   :items="dataAnalyticPlot"
                   outlined
                   caption-top>
            <template #table-caption>{{ $t('avg_data_for_plot_by_day') }}</template>
          </b-table>
        </div>
      </div>

      <div id="chart-data-seven-day-block">
        <vs-row class="">
          <vs-col class="" cols="12">
            <h4>{{ $t('avg_data_7_day_nearest') }}</h4>
          </vs-col>
        </vs-row>
        <div id="chart-data-seven-day">
          <v-chart class="chart" :option="myBarOption" />
        </div>

<!--        <v-chart class="chart" :option="barChartOption" />-->
<!--        <v-chart class="chart" :option="singleBarOption" />-->
      </div>
      <div>
        <!--        <v-chart class="chart" :option="option" />-->
      </div>
    </div>
  </div>
</template>

<script>
import { use } from 'echarts/core'
import datetime from 'vuejs-datetimepicker'
import { CanvasRenderer } from 'echarts/renderers'
import { PieChart } from 'echarts/charts'
import {
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  MarkLineComponent,
  MarkPointComponent
} from 'echarts/components'
import VChart, { THEME_KEY } from 'vue-echarts'
import { mapActions } from 'vuex'

use([
  CanvasRenderer,
  PieChart,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  MarkLineComponent,
  MarkPointComponent
])
export default {
  name: 'HelloWorld',
  components: {
    VChart,
    datetime
  },
  provide: {
    [THEME_KEY]: 'dark'
  },
  data () {
    return {
      listFarmSelect: [],
      farm_id: '',
      plot_id: '',
      device_id: '',
      date: '',
      type_id: '',
      listTypeDataSelect: [
        {
          text: 'Độ ẩm đất',
          value: 1
        },
        {
          text: 'Độ ẩm không khí',
          value: 2
        },
        {
          text: 'Nhiệt độ không khí',
          value: 3
        },
        {
          text: 'Cường độ ánh sáng',
          value: 4
        }

      ],
      typeSoilMoisture: 1,
      typeHumidity: 2,
      typeTemperature: 3,
      typeLightLevel: 4,
      listDeviceOnPlotSelect: [],
      listPlotOfFarmSelect: [],
      barChartOption: {
        title: {
          // text: 'Bar Chart custom',
          text: '',
          left: 'center'
        },
        xAxis: {
          type: 'category',
          // Todo add data in Ox
          // data: [''] add data
        },
        yAxis: {
          type: 'value'
        },
        tooltip: {
          trigger: 'item'
        },
        legend: {
          show: true
        },
        series: [
          {
            name: 'Series 1',
            type: 'bar',
            markPoint: {
              data: [
                {
                  name: 'Maximum',
                  type: 'max'
                }
              ]
            },
            markLine: {
              data: [
                {
                  name: 'Average',
                  type: 'average'
                }
              ],
              symbol: ['none', 'none']
            },
            data: [
              {
                value: ['Category 1', 1]
              },
              {
                value: ['Category 2', 4]
              },
              {
                value: ['Category 3', 10]
              },
              {
                value: ['Category 4', 8]
              },
              {
                value: ['Category 5', 2]
              },
              {
                value: ['Category 6', 3]
              }
            ]
          },
          {
            name: 'Series 2',
            type: 'bar',
            markPoint: {
              data: [
                {
                  name: 'Maximum',
                  type: 'max'
                }
              ]
            },
            markLine: {
              data: [
                {
                  name: 'Average',
                  type: 'average'
                }
              ],
              symbol: ['none', 'none']
            },
            data: [
              {
                value: ['Category 1', 1]
              },
              {
                value: ['Category 2', 2]
              },
              {
                value: ['Category 3', 6]
              },
              {
                value: ['Category 4', 3]
              },
              {
                value: ['Category 5', 2]
              },
              {
                value: ['Category 6', 5]
              }
            ]
          }
        ]
      },
      myBarOption : {
        // #ff3333(red), #ffff80, #85e085
        color: ["#3398DB"],
        tooltip: {
          trigger: "axis",
          axisPointer: {
            type: "shadow"
          }
        },
        grid: {},
        xAxis: [{
          type: "category",
          data: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
          name: 'Ngày',
          nameGap: 30
        }],
        yAxis: [{
          type: "value",
          name: '',
          nameGap: 30
        }],
        series: [{
          name: "直接访问",
          type: "bar",
          barWidth: "60%",
          // barWidth: "20%",
          data: [10, 52, 200, 334, 390, 330, 220]
        }]
      },
      singleBarOption : {
        color: ["#3398DB"],
        tooltip: {
          trigger: "axis",
          axisPointer: {
            type: "shadow"
          }
        },
        grid: {},
        xAxis: [{
          type: "category",
          data: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"]
        }],
        yAxis: [{
          type: "value"
        }],
        series: [{
          name: "直接访问",
          type: "bar",
          barWidth: "60%",
          data: [10, 52, 200, 334, 390, 330, 220]
        }]
      },
      option: {
        title: {
          text: 'Traffic Sources',
          left: 'center'
        },
        tooltip: {
          trigger: 'item',
          formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
          orient: 'vertical',
          left: 'left',
          data: [
            'Direct',
            'Email',
            'Ad Networks',
            'Video Ads',
            'Search Engines'
          ]
        },
        series: [
          {
            name: 'Traffic Sources',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: [
              { value: 335, name: 'Direct' },
              { value: 310, name: 'Email' },
              { value: 234, name: 'Ad Networks' },
              { value: 135, name: 'Video Ads' },
              { value: 1548, name: 'Search Engines' }
            ],
            emphasis: {
              itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
              }
            }
          }
        ]
      },
      columnsAnalyticPlotShow: [
        {
          label: 'Nhiệt độ không khí (oC)',
          key: 'Temperature',
        },{
          label: 'Độ ẩm không khí (%)',
          key: 'Humidity',
        },{
          label: 'Độ ẩm đất (%)',
          key: 'SoilMoisture',
        },{
          label: 'Cường độ sáng (Lux)',
          key: 'LightLevel',
        },
      ],
      dataAnalyticPlot: [
        {
          Temperature: 0,
          Humidity: 0,
          SoilMoisture: 0,
          LightLevel: 0
        }
      ]
    }
  },
  methods: {
    ...mapActions({
      getListFarmSelect: 'farm/getListFarmSelect',
      getListPlotInFarm: 'plot/getListPlotOfFarm',
      getListDeviceSelectOfFarmPlot: 'device/getListDeviceSelectOfFarmPlot',
      getDataAnalytics: 'analyticData/getDataAnalytics',
      getAnalyticDataSevenDayNearest: 'analyticData/getAnalyticDataSevenDayNearest'
    }),
    async getDataAnalyticsInfo() {
      const params = {
        FarmID: this.farm_id,
        DeviceID: this.device_id,
        PlotID: this.plot_id,
        date: this.date,
        type: this.type_id
      }
      const result = await this.getDataAnalytics(params)
      let correctData = false
      if (result.hasOwnProperty('summary_data') &&
          result.hasOwnProperty('seven_days')) {
        this.dataAnalyticPlot = [result.summary_data]
        const sevenDays = result.seven_days
        if (sevenDays.hasOwnProperty('xAxis') &&
          sevenDays.hasOwnProperty('data') &&
          sevenDays.hasOwnProperty('series_name')) {
          this.myBarOption.xAxis[0].data = sevenDays.xAxis
          let data = sevenDays.data
          if (data.length > 7) {
            data = data.slice(-7)
          }
          this.myBarOption.series[0].data = data
          const type = this.type_id

          this.myBarOption.yAxis[0].name = this.getYAxisUtilName(type)
          this.myBarOption.series[0].name = this.getYAxisName(type)
          correctData = true
        }
      }
      if (!correctData) {
        this.$Notice.error({title: 'Error ' + result.status,
          desc: result.statusText + '. ' + result.data.message})
      }
    },
    async getListFarmSelectInfo() {
      const result = await this.getListFarmSelect()
      if (result) {
        this.listFarmSelect = result.map(element => {
          let elementResult = {}
          elementResult.value = element.FarmID
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error ' + result.status,
          desc: result.statusText + '. ' + result.data.message})
      }
    },
    async getListPlotOfFarmSelect() {
      const params = {
        FarmID: this.farm_id
      }
      this.plot_id = ''
      const result = await this.getListPlotInFarm(params)
      if (result) {
        this.listPlotOfFarmSelect = result.map(element => {
          let elementResult = {}
          elementResult.value = element.PlotID
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.listPlotOfFarmSelect = []
        this.$Notice.error({title: 'Error ' + result.status,
          desc: result.statusText + '. ' + result.data.message})
      }
    },
    async getListDeviceOnFarmPlotSelect() {
      if (this.plot_id && this.farm_id) {
        const params = {
          PlotID: this.plot_id,
          FarmID: this.farm_id
        }
        const result = await this.getListDeviceSelectOfFarmPlot(params)
        if (result) {
          this.listDeviceOnPlotSelect = result.map(element => {
            let elementResult = {}
            elementResult.value = element.DeviceID
            elementResult.text = element.DeviceName
            return elementResult
          })
        } else {
          this.listDeviceOnPlotSelect = []
          this.$Notice.error({title: 'Error ' + result.status,
            desc: result.statusText + '. ' + result.data.message})
        }
      } else {
        this.listDeviceOnPlotSelect = []
      }
      this.device_id = ''
    },
    async getAnalyticDataSevenDayNearestInfo() {
      const params = {

      }
      const result = await this.getAnalyticDataSevenDayNearest(params)
      if (result) {
        console.log('result')
        console.log(result)
        // eslint-disable-next-line no-prototype-builtins


      } else {
        this.$Notice.error({title: 'Error ' + result.status,
          desc: result.statusText + '. ' + result.data.message})
      }

    },
    getYAxisName(value) {
      let yAxisName = 'Nhiệt độ'
      if (value === this.typeHumidity ) {
        yAxisName = 'Độ ẩm không khí'
      } else if (value === this.typeSoilMoisture) {
        yAxisName = 'Độ ẩm đất'
      } else if (value === this.typeLightLevel) {
        yAxisName = 'Cường độ ánh sáng'
      }
      return yAxisName
    },
    getYAxisUtilName(value) {
      return this.getYAxisName(value) + ' ' + this.getUtilAnalytics(value)
    },
    getUtilAnalytics(value) {
      let util = 'oC'
      if (value === this.typeHumidity) {
        util = '(%)'
      } else if (value === this.typeSoilMoisture) {
        util = '(%)'
      } else if (value === this.typeLightLevel) {
        util = '(Lux)'
      }
      return util
    }

  },
  created () {
    this.getListFarmSelectInfo()
    this.getDataAnalyticsInfo()
    // this.getAnalyticDataSevenDayNearestInfo()
  }
}
</script>

<style scoped>
.chart {
  height: 400px;
}
/*.datetime-picker ~ input {*/
/*  height: 38px;*/
/*}*/
</style>
