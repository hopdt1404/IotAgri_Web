<script src="../store/modules/device.js"></script>
<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-end">
        <div class="col-2">
          <Button type="info" @click="showModal">{{ $t('add-button')}}</Button>
        </div>
      </div>
      <div class="table-content mt-3">
        <b-table id="table-data"
                :fields="columnsShow"
                 :items="listFarm" outlined
                 :current-page="currentPage"
                 :per-page="perPage">

          <template #cell(created_at)="data" class="width-15">
              {{ moment(data['item']['created_at']).format("YYYY-MM-DD HH:mm:ss") }}
          </template>
          <template #cell(updated_at)="data">
            {{ data['item']['updated_at'] ? moment(data['item']['updated_at']).format("YYYY-MM-DD HH:mm:ss") : ''}}
          </template>
          <template #cell(actions)="data">
            <b-button variant="primary"
                      @click="myRowClickHandler(data['item'])">
              {{ $t('detail') }}
            </b-button>
            <b-button variant="secondary"
                      @click="settingFarm(data['item'])">
              {{ $t('setting_farm') }}
            </b-button>

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

    </div>

    <div>
      <vs-popup name="form-info"
                :active.sync="modal"
                title="Form Info"
                icon-close="x">
        <div class="dialog-content">
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="name">{{ $t('name') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="name"
                       v-model="name"
                       clearable
                       type="text"
                       maxlength="50"
                       show-word-limit
                       placeholder="Enter something..."
                       />
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col class="" cols="12">
                <label class="input-title" for="area">{{ $t('area') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="area"
                       v-model="area"
                       type="number"
                       placeholder="Enter something..."/>
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col class="" cols="12">
                <label class="input-title" for="location">{{ $t('location') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="location" v-model="location" :options="null"></b-form-select>
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title"> {{ $t('farm_type') }} </label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select v-model="farm_type" :options="listFarmType"></b-form-select>
              </vs-col>
            </vs-row>
          </div>
          <vs-row class="pt-6 pr-3" vs-type="flex" vs-justify="flex-end" vs-align="center">
            <vs-button class="square mr-2 " color="primary" type="filled" @click="save" >{{ $t('save')}}</vs-button>
            <vs-button class="square mr-0" color="#bdc3c7" type="filled" @click="cancel">{{ $t('cancel') }}</vs-button>
          </vs-row>
        </div>
      </vs-popup>

    </div>

    <vs-popup name="form-state"
              :active.sync="modalSetting"
              title="Form Setting"
              icon-close="x"
              @close="closeSettingPopup()">
      <div class="dialog-content">
        <div class="dialog-item">
          <vs-row>
            <vs-col cols="12">
              <label class="input-title"
                     for="deviceFarm">{{ $t('management_device') }}</label>
            </vs-col>
            <vs-col cols="12">
              <multiselect
                id="deviceFarm"
                v-model="devicesSelected"
                :options="listDeviceSetting"
                :multiple="true"
                :close-on-select="false"
                :clear-on-select="false"
                :preserve-search="false"
                placeholder="Pick some"
                label="name"
                track-by="id"
                :preselect-first="true"
              />
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-item">
          <vs-row>
            <vs-col cols="12">
              <label class="input-title"
                     for="plantFarm">{{ $t('management_device') }}</label>
            </vs-col>
            <vs-col cols="12">
              <multiselect
                id="plantFarm"
                v-model="plantSelected"
                :options="listFarmSetting"
                :multiple="true"
                :close-on-select="false"
                :clear-on-select="false"
                :preserve-search="false"
                placeholder="Pick some"
                label="name"
                track-by="id"
                :preselect-first="true"
              />
            </vs-col>
          </vs-row>
        </div>
        <vs-row class="pt-6 pr-3 mt-4" vs-type="flex" vs-justify="flex-end" vs-align="center">
          <vs-button class="square mr-2 " color="primary" type="filled" @click="saveSetting" >{{ $t('save')}}</vs-button>
          <vs-button class="square mr-0" color="#bdc3c7" type="filled" @click="closeFormSetting">{{ $t('cancel') }}</vs-button>
        </vs-row>
      </div>

    </vs-popup>



  </div>
</template>

<script>


export default {
  components: {

  },

  data() {
    return {
      id: '',
      name: '',
      area: '',
      location: '',
      farm_type: '',
      modal: false,
      listFarm: [],
      listFarmType: [],
      currentPage: 1,
      perPage: 10,
      rows: 0,
      modalSetting: false,
      devicesSelected: [],
      listDeviceSetting: [],
      plantSelected: [],
      listFarmSetting: [],
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
          label: 'Location',
          key: 'LocateID'
        },
        {
          label: 'Status',
          key: 'Status',
          sortable: true
        },
        {
          label: 'Created at',
          key: 'created_at',
          sortable: true
        },
        {
          label: 'Updated at',
          key: 'updated_at',
          sortable: true
        },
        {
          label: 'Actions',
          key: 'actions'
        },
      ]
    }
  },

  created() {
    this.getFarm()
    this.getFarmType()
  },
  methods: {
    async save() {
      let params = {
        LocateID: this.location,
        name: this.name,
        Area: this.area,
        FarmTypeId: this.farm_type
      }
      let dispatch
      if (this.id) {
        params.FarmID = this.id
        dispatch = 'farm/update'
      } else {
        dispatch = 'farm/create'
      }
      let response = await this.$store.dispatch(dispatch,params);
      if (response.status === 200) {
        this.resetForm()
        this.$Notice.success({title: 'Success', desc: response.data.message})
        await this.getFarm()
        this.modal = !this.modal
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }

    },
    showModal() {
      this.modal = true
    },
    resetForm () {
      if (this.id) {
        this.id = null
      }
      this.location = ''
      this.name = ''
      this.area = ''
      this.farm_type = ''
    },
    async getFarm () {
      let response = await this.$store.dispatch('farm/getFarm')
      if (response.status === 200) {
        this.listFarm = response.data.data
        this.rows = this.listFarm.length
      } else {
        this.listFarm = []
        this.rows = 0
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    async myRowClickHandler(record, index) {
      this.showModal()
      let params = {
        id : record.FarmID
      }
      let response = await this.$store.dispatch('farm/getFarmDetail', params)
      if (response.status === 200) {
        let data = response.data.data;
        this.id = data.FarmID
        this.name = data.name
        this.farm_type = data.FarmTypeID
        this.location = data.LocateID
        this.area = data.Area
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }

    },
    cancel() {
      this.resetForm();
      this.modal = !this.modal
    },
    async getFarmType() {
      let response = await this.$store.dispatch('farm/getFarmType')
      if (response.status === 200) {
        let data = response.data.data
        this.listFarmType = data.map((element) => {
          let elementResult = {}
          elementResult.value = element.FarmTypeID
          elementResult.text = element.FarmType
          return elementResult
        })

      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
        this.listFarmType = []
      }
    },
    showModalSetting() {
      this.modalSetting = true
    },
    async getListDeviceSetting() {
      let response = await this.$store.dispatch('device/getDeviceSettingFarm')
      if (response.status === 200) {
          let data = response.data.data
          this.listDeviceSetting = data.map((element) => {
            let elementResult = {}
            elementResult.id = element.DeviceID
            elementResult.name = element.DeviceName
            return elementResult
          })
      } else {
        this.listDeviceSetting = []
      }
    },
    async getListPlantSetting() {
      let response = await this.$store.dispatch('plant/getPlantSettingFarm')
      if (response.status === 200) {
        this.listFarmSetting = response.data.data
      } else {
        this.listFarmSetting = []
      }
    },

    async settingFarm(record) {
      this.showModalSetting()
      let params = {
        FarmID : record.FarmID
      }
      await this.getListDeviceSetting()
      await this.getListPlantSetting()
    },
    closeSettingPopup() {
      this.modalSetting = false
    },
    saveSetting() {

    },
    closeFormSetting() {

    },

  }

}


</script>
