<template>
  <div class="content">
    <div class="table-content mt-3">
      <b-table id="table-data"
               :fields="columnsShow"
               :items="listPlantManagement" outlined
               :current-page="currentPage"
               :per-page="perPage"
               @row-clicked="myRowClickHandler">
        <template #cell(status)="data">
          {{
            data['item']['status'] == -1 ?
              $t('deactivate') :
            data['item']['status'] == 0 ?
                $t('init') :
            data['item']['status'] == 1 ?
              $t('activate') :
            data['item']['status'] == 2 ?
              $t('end_season'): ''
          }}
        </template>

      </b-table>
    </div>
    <div class="overflow-auto" v-if="rows > 0">
      <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="my-table"
        align="center"
      ></b-pagination>
    </div>
    <div>
      <vs-popup name="form-info"
                :active.sync="modal"
                :title="$t('management_agriculture_form')"
                icon-close="x"
                @close="closePopup()">

        <div class="dialog-item">
          <vs-row>
            <vs-col cols="12">
              <label class="input-title" for="plant">{{ $t('plant') }}</label>
            </vs-col>
            <vs-col cols="12">
              <Input id="plant"
                     v-model="plant_name"
                     type="text"
                     disabled
              />
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-item">
          <vs-row>
            <vs-col cols="12">
              <label class="input-title" for="farm">{{ $t('farm') }}</label>
            </vs-col>
            <vs-col cols="12">
              <Input id="farm"
                     v-model="farm_name"
                     type="text"
                     disabled
              />
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-item">
          <vs-row>
            <vs-col cols="12">
              <label class="input-title" for="plot">{{ $t('plot') }}</label>
            </vs-col>
            <vs-col cols="12">
              <Input id="plot"
                     v-model="plot_name"
                     type="text"
                     disabled
              />
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-item">
          <vs-row>
            <vs-col cols="12">
              <label class="input-title" for="start_time_season">{{ $t('start_time_season') }} <Icon type="md-calendar" /></label>
            </vs-col>
            <vs-col cols="12">
              <datetime format="YYYY-MM-DD" v-model="start_time_season">
              </datetime>
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-item">
          <vs-row>
            <vs-col cols="12">
              <label class="input-title" for="end_time_season">{{ $t('end_time_season') }} <Icon type="md-calendar" /></label>
            </vs-col>
            <vs-col cols="12">
              <datetime format="YYYY-MM-DD"
                        v-model="end_time_season">
              </datetime>
            </vs-col>
          </vs-row>
        </div>
<!--        <div class="dialog-item">-->
<!--          <vs-row>-->
<!--            <vs-col cols="12">-->
<!--              <label class="input-title"-->
<!--                      for="deviceFarmPlant">-->
<!--                {{ $t('device')}}-->

<!--              </label>-->
<!--            </vs-col>-->
<!--            <vs-col cols="12">-->
<!--              <multiselect-->
<!--                id="deviceFarmPlant"-->
<!--                v-model="deviceFarmPlantSelected"-->
<!--                :options="listDeviceFarmPlant"-->
<!--                :multiple="true"-->
<!--                :close-on-select="false"-->
<!--                :clear-on-select="true"-->
<!--                :preserve-search="false"-->
<!--                placeholder="Select device for plant ..."-->
<!--                label="DeviceName"-->
<!--                track-by="DeviceID"-->
<!--                :preselect-first="true"-->
<!--              >-->

<!--              </multiselect>-->
<!--            </vs-col>-->
<!--          </vs-row>-->
<!--        </div>-->
        <div class="dialog-item">
          <vs-row>
            <vs-col class="" cols="12">
              <label class="input-title" for="current_plant_state">{{ $t('current_plant_state') }}</label>
            </vs-col>
            <vs-col cols="12">
              <b-form-select id="current_plant_state" v-model="current_plant_state" :options="listPlantState"></b-form-select>
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-item">
          <vs-row>
            <vs-col class="" cols="12">
              <label class="input-title" for="current_growth_day">{{ $t('current_growth_day') }}</label>
            </vs-col>
            <vs-col cols="12">
              <Input id="current_growth_day"
                     v-model="current_growth_day"
                     type="number"

              />
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-item">
          <vs-row>
            <vs-col class="" cols="12">
              <label class="input-title" for="total_growth_day">{{ $t('total_growth_day') }}</label>
            </vs-col>
            <vs-col cols="12">
              <Input id="total_growth_day"
                     v-model="total_growth_day"
                     type="number"
                     disabled
              />
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-item">
          <vs-row>
            <vs-col class="" cols="12">
              <label class="input-title" for="status">{{ $t('status') }}</label>
            </vs-col>
            <vs-col cols="12" v-if="listStatusFarmPlant.length > 0">
              <b-form-radio-group v-model="status" :options="listStatusFarmPlant">
              </b-form-radio-group>
            </vs-col>
          </vs-row>
        </div>
        <vs-row class="pt-6 pr-3" vs-type="flex" vs-justify="flex-end" vs-align="center">
          <vs-button class="square mr-2" color="#bdc3c7" type="filled" @click="cancel">{{ $t('cancel') }}</vs-button>
          <vs-button class="square mr-2 " color="primary" type="filled" @click="save" >{{ $t('save')}}</vs-button>
        </vs-row>
      </vs-popup>

    </div>
  </div>
</template>

<script>
import datetime from 'vuejs-datetimepicker'
import { mapActions } from 'vuex'

export default {
  components: {
    datetime
  },

  data() {
    return {
      modal: false,
      id: '',
      plant_name: '',
      plant_id: '',
      farm_name: '',
      farm_id: '',
      plot_id: '',
      plot_name: '',
      start_time_season: '',
      end_time_season: '',
      current_plant_state: '',
      listPlantState: [],
      current_growth_day: '',
      total_growth_day: '',
      status: '',
      listStatusFarmPlant: [
        { text: 'Deactivate', value: -1 },
        { text: 'Init', value: 0 },
        { text: 'Activate', value: 1 },
        { text: 'End season', value: 2 },
      ],
      deviceFarmPlantSelected: [],
      listDeviceFarmPlant: [],
      rows: 0,
      listPlantManagement: [],
      perPage: 10,
      currentPage: 1,
      titleForm: 'Form info',
      columnsShow: [
        {
          // label: 'Plant',
          label: 'Cây trồng',
          key: 'plant_name',
          sortable: true
        },
        {
          // label: 'Farm',
          label: 'Trang trại',
          key: 'farm_name',
          sortable: true
        },
        {
          // label: 'Plot',
          label: 'Khu vực',
          key: 'plot_name',
          sortable: true
        },
        {
          // label: 'Status',
          label: 'Trạng thái',
          key: 'status',
          sortable: true
        },
        {
          // label: 'Start time season',
          label: 'Bắt đầu mùa vụ',
          key: 'start_time_season',
          sortable: true
        },
        {
          // label: 'End time season',
          label: 'Kết thúc mùa vụ',
          key: 'end_time_season',
          sortable: true
        },
        // {
        //   label: 'Current plant state',
        // //   key: 'c',
        //   sortable: true
        // },
        // {
        //   label: 'Current growth day',
        //   key: 'current_growth_day',
        //   sortable: true
        // },
        // {
        //   label: 'Total growth day',
        //   key: 'total_growth_day',
        //   sortable: true
        // },
        // {
        //   label: 'End time season',
        //   key: 'end_time_season',
        //   sortable: true
        // },


      ]
    }
  },

   created() {
    this.getPlantAgricultureManagement()
    this.getListPlantState()

  },
  mounted() {

  },
  methods: {
    ...mapActions({
      getListDeviceSelectOfFarmPlant: 'device/getListDeviceSelectOfFarmPlant',
      getPlantAgricultureDetail: 'agricultureSetting/getPlantAgricultureDetail',
      createFarmPlant: 'mangementAgriculture/createFarmPlant',
      updateFarmPlant: 'mangementAgriculture/updateFarmPlant',
      getDeviceAssignForPlantFarm: 'device/getDeviceAssignForPlantFarm'

    }),
    async getPlantAgricultureManagement() {
      let params = {

      }
      let response = await this.$store.dispatch('agricultureSetting/getPlantAgricultureManagement', params);
      if (response.status === 200) {
        let data = response.data.data
        if(data != null) {
          this.listPlantManagement = data;
          this.rows = this.listPlantManagement.length
        }
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    closePopup() {
      this.closeModal()
      this.resetForm()
    },
    async myRowClickHandler(record, index) {
      this.showModal()
      this.plant_id = record.plant_id
      this.farm_id = record.FarmID
      this.plant_name = record.plant_name
      this.plot_id = record.plot_id
      this.plot_name = record.plot_name
      this.farm_name = record.farm_name
      const params = {
        PlotID: this.plot_id,
        plant_id: this.plant_id
      }
      if (record.id) {
        this.id = record.id
        params.id = this.id
      }
      // await this.getListDeviceOfFarmPlant(record)
      const response = await this.getPlantAgricultureDetail(params)
      // await this.getDeviceAssignedForPlantFarm(record)
      if (response) {
        const data = response
        if (data != null) {
          this.start_time_season = data.start_time_season
          this.end_time_season = data.end_time_season
          this.current_plant_state = data.current_plant_state
          this.current_growth_day = data.current_growth_day
          this.total_growth_day = data.total_growth_day
          this.status = data.status
        }
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    async getListPlantState() {
      let response = await this.$store.dispatch('plant/getPlantState')
      if (response.status === 200) {
        let data = response.data.data
        this.listPlantState = data.map((element) => {
          let elementResult = {}
          elementResult.value = element.id
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
        this.listPlantState = []
      }
    },
    cancel() {
      this.closePopup()
    },
    async save() {
      const params = {
        PlotID: this.plot_id,
        plant_id: this.plant_id,
        start_time_season: this.start_time_season,
        end_time_season: this.end_time_season,
        current_growth_day: this.current_growth_day,
        current_plant_state: this.current_plant_state,
        total_growth_day: this.total_growth_day,
        status: this.status
      }
      let response
      if (this.id) {
        params.id = this.id
        response = await this.updateFarmPlant(params)
      } else {
        response = await this.createFarmPlant(params)
      }

      if (response) {
        this.$Notice.success({title: 'Success', desc: response.message})
        this.closePopup()
        await this.getPlantAgricultureManagement()
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }


    },
    showModal() {
      this.modal = true
    },
    closeModal() {
      this.modal = false
      this.resetForm()
    },
    resetForm() {
      this.id = ''
      this.farm_id = ''
      this.farm_name = ''
      this.plant_id = ''
      this.plant_name = ''
      this.start_time_season = ''
      this.end_time_season = ''
      this.current_plant_state = ''
      this.current_growth_day = 0
      this.total_growth_day = 0
      this.status = ''
      this.deviceFarmPlantSelected = []
      this.listDeviceFarmPlant = []
    },
    async getListDeviceOfFarmPlant(data) {
      const params = {
        plant_id: data.plant_id,
        FarmID: data.FarmID
      }
      let response = await this.getListDeviceSelectOfFarmPlant(params)
      if (response.success && response.data) {
        let data = response.data
        this.listDeviceFarmPlant = data
      } else {
        this.$Notice.error({title: 'Error', desc: response.message})
      }
    },
    async getDeviceAssignedForPlantFarm(data) {
      const params = {
        plant_id: data.plant_id,
        FarmID: data.FarmID
      }
      console.log('data getDeviceAssignedForPlantFarm')
      console.log(data)
      let response = await this.getDeviceAssignForPlantFarm(params)
      if (response.success && response.data) {
        let data = response.data
        if (data) {
          this.deviceFarmPlantSelected = data
        } else {
          this.deviceFarmPlantSelected = []
        }
      }
    }


  }

}
</script>
