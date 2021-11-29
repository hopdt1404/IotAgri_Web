<template>
  <div class="content">
    <div class="container-fluid">
      <div class="table-content mt-3">
        <b-table id="table-data"
                 :fields="columnsShow"
                 :items="listFarmAgricultureSetting" outlined
                 :current-page="currentPage"
                 :per-page="perPage"
                 @row-clicked="myRowClickHandler"
        />
      </div>
      <div v-if="rows > 0" class="overflow-auto">
        <b-pagination
          v-model="currentPage"
          :total-rows="rows"
          :per-page="perPage"
          aria-controls="my-table"
          align="center"
        />
      </div>

      <vs-popup name="setting-agriculture"
                :active.sync="modal"
                :title="$t('setting_agriculture_for') + ' ' + farmName"
                icon-close="x"
                @close="closePopup()"
      >
        <div class="dialog-content">
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="select_plant_id">{{ $t('select_plant') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="select_plant_id" v-model="plant_id" :options="listPlantOfFarm" @change="changePlantSelect" />
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="plant_state_id">{{ $t('plant_state') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="plant_state_id" v-model="plant_state_id" :options="listPlantState" @change="changePlantState" />
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="growth_period">{{ $t('growth_period_form') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="growth_period"
                       v-model="growth_period"
                       clearable
                       type="number"
                       maxlength="7"
                       show-word-limit
                       placeholder="Enter something..."
                />
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="temperature">{{ $t('temperature') + ' (oC)' }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="temperature"
                       v-model="temperature"
                       clearable
                       type="number"
                       maxlength="15"
                       show-word-limit
                       placeholder="Enter something..."
                />
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="moisture">{{ $t('moisture') + ' (%)' }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="moisture"
                       v-model="moisture"
                       clearable
                       type="number"
                       maxlength="15"
                       show-word-limit
                       placeholder="Enter something..."
                />
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="light">{{ $t('light') + '' }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="light"
                       v-model="light"
                       clearable
                       type="text"
                       maxlength="255"
                       show-word-limit
                       placeholder="Enter something..."
                />
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="note">{{ $t('note') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-textarea
                  id="note"
                  v-model="note"
                  placeholder="Enter something..."
                  rows="3"
                  max-rows="6"
                />
              </vs-col>
            </vs-row>
          </div>
        </div>
        <vs-row class="pt-6 pr-3 mt-4" vs-type="flex" vs-justify="flex-end" vs-align="center">
          <vs-button class="square mr-2" color="#e6ccff" type="filled" @click="getPlantAgricultureDefault">
            {{ $t('setting_default') }}
          </vs-button>
          <vs-button class="square mr-2" color="#bdc3c7" type="filled" @click="closeForm">
            {{ $t('cancel') }}
          </vs-button>
          <vs-button class="square mr-2 " color="primary" type="filled" @click="save">
            {{ $t('save') }}
          </vs-button>
        </vs-row>
      </vs-popup>
    </div>
  </div>
</template>

<script>

export default {

  components: {

  },
  data () {
    return {
      listFarmAgricultureSetting: [],
      id: '',
      currentPage: 1,
      perPage: 10,
      rows: 0,
      farmName: '',
      modal: false,
      farm_id: '',
      plant_id: '',
      plant_state_id: '',
      growth_period: '',
      temperature: '',
      moisture: '',
      light: '',
      note: '',
      listPlantState: [],
      listPlantOfFarm: [],

      columnsShow: [
        {
          // label: 'Name',
          label: 'Tên trang trại',
          key: 'name',
          sortable: true
        },
        // {
        //   label: 'Area',
        //   key: 'Area',
        //   sortable: true
        // },
        {
          // label: 'Farm type',
          label: 'Loại trang trại',
          key: 'FarmType',
          sortable: true
        },
        {
          // label: 'Locate',
          label: 'Vị trí',
          key: 'LocateName',
          sortable: true
        },
        {
          // label: 'Number plots',
          label: 'Số khu vực',
          key: 'number_plot',
          sortable: true
        },
        {
          // label: 'Number plant',
          label: 'Số cây trồng',
          key: 'number_plant',
          sortable: true
        },
        {
          // label: 'Number devices',
          label: 'Số thiết bị',
          key: 'number_device',
          sortable: true
        },

      ]
    }
  },
  created () {
    this.getListFarmAgricultureSetting()
    this.initTitlePopup()
    this.getPlantState()
  },
  methods: {
    closePopup () {
      this.modal = false
      this.initTitlePopup()
      this.resetFormData()
    },
    async getListFarmAgricultureSetting () {
      const response = await this.$store.dispatch('agricultureSetting/getFarmAgricultureSetting')
      if (response.status === 200) {
        if (response.data.data != null) {
          this.listFarmAgricultureSetting = response.data.data
          this.rows = this.listFarmAgricultureSetting.length
        } else {
          this.listFarm = []
          this.rows = 0
        }
      } else {
        this.listFarm = []
        this.rows = 0
        this.$Notice.error({
          title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message
        })
      }
    },
    async myRowClickHandler (record, index) {
      this.farmName = record.name
      this.showModal()
      this.farm_id = record.FarmID
      const params = {
        FarmID: this.farm_id
      }
      await this.getPlantOfFarm()
      if (this.listPlantOfFarm.length && this.listPlantState.length) {
        this.plant_id = this.listPlantOfFarm[0].value
        this.plant_state_id = this.listPlantState[0].value
        this.changePlantState()
      }
    },
    showModal () {
      this.modal = true
    },
    async getPlantOfFarm () {
      const params = {
        FarmID: this.farm_id
      }
      const response = await this.$store.dispatch('plant/getPlantOfFarm', params)
      if (response.success === true) {
        this.listPlantOfFarm = response.data.map((element) => {
          const elementResult = {}
          elementResult.value = element.id
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.listPlantOfFarm = []
        this.$Notice.error({
          title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message
        })
      }
    },
    initTitlePopup () {
      this.farmName = ''
      // this.titlePopup = 'Form setting agriculture for '
    },
    async getPlantAgricultureDefault () {
      if (this.plant_id && this.plant_state_id) {
        const params = {
          plant_id: this.plant_id,
          plant_state_id: this.plant_state_id
        }
        const response = await this.$store.dispatch('plantStateInfo/getPlantStateInfo', params)
        if (response.status === 200) {
          const data = response.data.data
          if (data) {
            this.growth_period = data.growth_period_state
            this.temperature = data.temperature
            this.moisture = data.moisture
            this.light = data.light
            this.note = data.note
          } else {
            this.resetSubFromData()
          }
        } else {
          this.$Notice.error({
            title: 'Error ' + response.status,
            desc: response.statusText + '. ' + response.data.message
          })
        }
      }
    },
    closeForm () {
      this.closePopup()
    },
    async save () {
      const params = {
        plant_id: this.plant_id,
        plant_state_id: this.plant_state_id,
        FarmID: this.farm_id,
        growth_period: this.growth_period,
        temperature: this.temperature,
        moisture: this.moisture,
        light: this.light,
        note: this.note
      }
      let dispatch
      let action
      if (this.id) {
        params.id = this.id
        dispatch = 'agricultureSetting/update'
        action = 'update'
      } else {
        dispatch = 'agricultureSetting/create'
        action = 'store'
      }
      const response = await this.$store.dispatch(dispatch, params)
      if (response.success === true) { // update
        const data = response.data
        if (data && action === 'store') {
          this.id = data.id
        }
        this.$Notice.success({ title: 'Success', desc: response.message })
      } else {
        this.$Notice.error({
          title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message
        })
      }
    },
    async getPlantState () {
      const response = await this.$store.dispatch('plant/getPlantState')
      if (response.status === 200) {
        if (response.data.data != null) {
          const data = response.data.data
          this.listPlantState = data.map((element) => {
            const elementResult = {}
            elementResult.value = element.id
            elementResult.text = element.name
            return elementResult
          })
        } else {
          this.listPlantState = []
        }
      } else {
        this.$Notice.error({
          title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message
        })
        this.listPlantState = []
      }
    },
    resetFormData () {
      if (this.id) {
        this.id = ''
      }
      this.farm_id = ''
      this.plant_id = ''
      this.plant_state_id = ''
      this.resetSubFromData()
    },
    resetSubFromData () {
      this.id = ''
      this.growth_period = ''
      this.temperature = ''
      this.moisture = ''
      this.light = ''
      this.note = ''
    },
    changePlantSelect () {
      if (this.plant_state_id && this.plant_id) {
        this.getAgriculturePlantDetail()
      }
    },
    changePlantState () {
      if (this.plant_state_id && this.plant_id) {
        this.getAgriculturePlantDetail()
      }
    },
    async getAgriculturePlantDetail () {
      const params = {
        FarmID: this.farm_id,
        plant_id: this.plant_id,
        plant_state_id: this.plant_state_id
      }
      const response = await this.$store.dispatch('agricultureSetting/getAgriculturePlantDetail', params)
      if (response.success === true) {
        const data = response.data
        if (data) {
          this.id = data.id
          this.growth_period = data.growth_period
          this.temperature = data.temperature
          this.moisture = data.moisture
          this.light = data.light
          this.note = data.note
        } else {
          this.resetSubFromData()
        }
      } else {
        this.$Notice.error({
          title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message
        })
      }
    }

  }

}
</script>
