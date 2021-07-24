<template>
  <div class="content">
    <div class="container-fluid">
      <div class="table-content mt-3">
        <b-table id="table-data"
                 :fields="columnsShow"
                 :items="listFarmAgricultureSetting" outlined
                 @row-clicked="myRowClickHandler"
                 :current-page="currentPage"
                 :per-page="perPage">

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

      <vs-popup name="setting-agriculture"
                :active.sync="modal"
                :title="titlePopup"
                icon-close="x"
                @close="closePopup()">
        <div class="dialog-content">
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="select_plant_id">{{ $t('select_plant')}}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="select_plant_id" v-model="plant_id" :options="listPlantOfFarm"></b-form-select>
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="growth_period_state">{{ $t('plant_state')}}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="plant_state_id" v-model="plant_state_id" :options="listPlantState"></b-form-select>
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
                <label class="input-title" for="temperature">{{ $t('temperature') + ' (oC)'}}</label>
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
                <label class="input-title" for="moisture">{{ $t('moisture') + ' (%)'}}</label>
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
                <label class="input-title" for="light">{{ $t('light') + ''}}</label>
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
                ></b-form-textarea>
              </vs-col>
            </vs-row>
          </div>
        </div>
        <vs-row class="pt-6 pr-3 mt-4" vs-type="flex" vs-justify="flex-end" vs-align="center">
          <vs-button class="square mr-0" color="info" type="filled" @click="getPlantAgricultureDefault">{{ $t('setting_default') }}</vs-button>
          <vs-button class="square mr-0" color="#bdc3c7" type="filled" @click="closeForm">{{ $t('cancel') }}</vs-button>
          <vs-button class="square mr-2 " color="primary" type="filled" @click="save" >{{ $t('save')}}</vs-button>
        </vs-row>
      </vs-popup>
    </div>
  </div>
</template>

<script>

export default {

  components: {

  },
  data() {
    return {
      listFarmAgricultureSetting: [],
      currentPage: 1,
      perPage: 10,
      rows: 0,
      titlePopup: '',
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
          label: 'Name',
          key: 'name',
          sortable: true
        },
        {
          label: 'Area',
          key: 'Area',
          sortable: true
        },
        {
          label: 'Farm type',
          key: 'FarmType',
          sortable: true
        },
        {
          label: 'Number devices',
          key: 'number_device',
          sortable: true
        },
        {
          label: 'Number plant',
          key: 'number_plant',
          sortable: true
        },
      ]
    }
  },
   created() {
    this.getListFarmAgricultureSetting()
    this.initTitlePopup()
    this.getPlantState()
  },
  methods: {
    closePopup() {
      this.modal = false;
      this.initTitlePopup()
    },
    async getListFarmAgricultureSetting () {
      let response = await this.$store.dispatch('agricultureSetting/getFarmAgricultureSetting')
      if (response.success) {
        this.listFarmAgricultureSetting = response.data
        this.rows = this.listFarmAgricultureSetting.length
      } else {
        this.listFarm = []
        this.rows = 0
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    async myRowClickHandler(record, index) {
      this.titlePopup += record.name;
      this.showModal()
      this.farm_id = record.FarmID
      let params = {
        FarmID: this.farm_id
      }
      await this.getPlantOfFarm()

    },
    showModal() {
      this.modal = true
    },
    async getPlantOfFarm() {
      let params = {
        FarmID: this.farm_id
      }
      let response = await this.$store.dispatch('plant/getPlantOfFarm', params)
      if (response.success) {
        this.listPlantOfFarm = response.data.map((element) => {
          let elementResult = {}
          elementResult.value = element.id
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.listPlantOfFarm = []
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    initTitlePopup() {
      this.titlePopup = 'Form setting agriculture for '
    },
    async getPlantAgricultureDefault() {

    },
    closeForm() {

    },
    async save () {

    },
    async getPlantState() {
      let response = await this.$store.dispatch('plant/getPlantState')
      if (response.success) {
        let data = response.data
        this.listPlantState = data.map((element) => {
          let elementResult = {}
          elementResult.value = element.id
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
        this.listPlantState = []
      }
    },
  }

}
</script>
