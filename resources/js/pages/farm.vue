<script src="../store/modules/auth.js"></script>
<script src="../store/modules/farm.js"></script>
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
          <template #cell(Status)="data" class="width-15">
            {{ data['item']['Status'] == 1 ? $t('activate') : $t('deactivate') }}
          </template>
<!--          <template #cell(created_at)="data" class="width-15">-->
<!--              {{ moment(data['item']['created_at']).format("YYYY-MM-DD HH:mm:ss") }}-->
<!--          </template>-->
<!--          <template #cell(updated_at)="data">-->
<!--            {{ data['item']['updated_at'] ? moment(data['item']['updated_at']).format("YYYY-MM-DD HH:mm:ss") : ''}}-->
<!--          </template>-->
          <template #cell(actions)="data">
            <b-button variant="primary"
                      @click="myRowClickHandler(data['item'])">
              {{ $t('detail') }}
            </b-button>
<!--            <b-button variant="secondary"-->
<!--                      @click="settingFarm(data['item'])">-->
<!--              {{ $t('setting_farm') }}-->
<!--            </b-button>-->
            <b-button variant="secondary"
                      @click="managementAreaInFarm(data['item'])">
              {{ $t('management_area_in_farm') }}
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
                :title="$t('detail_info')"
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
                       maxlength="128"
                       show-word-limit
                       placeholder="..."
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
                       placeholder="..."/>
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col class="" cols="12">
                <label class="input-title" for="location">{{ $t('location') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="location" v-model="location" :options="listLocation"></b-form-select>
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
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="status">{{ $t('status') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-radio-group v-model="status">
                  <b-form-radio value="0">{{ $t('deactivate')}}</b-form-radio>
                  <b-form-radio value="1">{{ $t('activate')}}</b-form-radio>
                </b-form-radio-group>
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="info">{{ $t('info') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-textarea
                  id="planting_time"
                  v-model="info"
                  placeholder="..."
                  rows="3"
                  max-rows="6"
                ></b-form-textarea>
              </vs-col>
            </vs-row>
          </div>
          <vs-row class="pt-6 pr-3" vs-type="flex" vs-justify="flex-end" vs-align="center">
            <vs-button class="square mr-2" color="#bdc3c7" type="filled" @click="cancel">{{ $t('cancel') }}</vs-button>
            <vs-button class="square mr-2 " color="primary" type="filled" @click="save" >{{ $t('save')}}</vs-button>
          </vs-row>
        </div>
      </vs-popup>

    </div>

    <vs-popup name="form-state"
              :active.sync="modalSetting"
              :title="$t('form_setting_farm')"
              icon-close="x"
              @close="closeFormSetting()">
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
                     for="plantFarm">{{ $t('management_plant') }}</label>
            </vs-col>
            <vs-col cols="12">
              <multiselect
                id="plantFarm"
                v-model="plantSelected"
                :options="listPlantSetting"
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
          <vs-button class="square mr-2" color="#bdc3c7" type="filled" @click="closeFormSetting">{{ $t('cancel') }}</vs-button>
          <vs-button class="square mr-2 " color="primary" type="filled" @click="saveSetting" >{{ $t('save')}}</vs-button>
        </vs-row>
      </div>

    </vs-popup>



  </div>
</template>

<script>

import { mapActions } from 'vuex'
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
      info: '',
      status: '',
      modal: false,
      listFarm: [],
      listFarmType: [],
      listLocation: [],
      currentPage: 1,
      perPage: 10,
      rows: 0,
      modalSetting: false,
      devicesSelected: [],
      listDeviceSetting: [],
      plantSelected: [],
      listPlantSetting: [],
      listFarmSetting: [],
      columnsShow: [
        {
          // label: 'Name',
          label: 'Tên trang trại',
          key: 'name',
          sortable: true
        },
        {
          // label: 'Area',
          label: 'Diện tích',
          key: 'Area',
          sortable: true
        },
        {
          // label: 'Farm type',
          label: 'Loại trang trại',
          key: 'FarmType',
          sortable: true
        },
        {
          // label: 'Location',
          label: 'Vị trí',
          key: 'LocateName',
          sortable: true
        },
        {
          // label: 'Status',
          label: 'Trạng thái',
          key: 'Status',
          sortable: true
        },
        // {
        //   label: 'Created at',
        //   key: 'created_at',
        //   sortable: true
        // },
        // {
        //   label: 'Updated at',
        //   key: 'updated_at',
        //   sortable: true
        // },
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
    this.getLocationSelect()
  },
  methods: {
    ...mapActions({
      getListLocation: 'locate/getLocate'
    }),
    async save() {
      let params = {
        LocateID: this.location,
        name: this.name,
        Area: this.area,
        FarmTypeId: this.farm_type,
        info: this.info,
        Status: this.status
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
      this.resetForm()
    },
    managementAreaInFarm(farmInfo) {
      this.$router.push({path:`/management-area-in-farm/${farmInfo.FarmID}`});
    },
    resetForm () {
      if (this.id) {
        this.id = null
      }
      this.status = ''
      this.location = ''
      this.name = ''
      this.area = ''
      this.farm_type = ''
      this.info = ''
    },
    async getLocationSelect() {
      let response = await this.getListLocation()
      if (response.status === 200 && response.data ) {
        let data = response.data.data
        this.listLocation = data.map(element => {
          let elementResult = {}
          elementResult.value = element.LocateID
          elementResult.text = element.LocateName
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
        this.listLocation = []
      }
    },
    async getFarm () {
      let response = await this.$store.dispatch('farm/getFarm')
      if (response.status === 200) {
        this.listFarm = response.data.data
        this.rows = this.listFarm.length
      } else {
        this.listFarm = []
        this.rows = 0
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
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
        this.info = data.info
        this.status = data.Status
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
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
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
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
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
        this.listDeviceSetting = []
      }
    },
    async getListPlantSetting() {
      let response = await this.$store.dispatch('plant/getPlantSettingFarm')
      if (response.status === 200) {
        this.listPlantSetting = response.data.data
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
        this.listPlantSetting = []
      }
    },

    async settingFarm(record) {
      this.showModalSetting()
      this.id = record.FarmID
      await this.getListDeviceOfFarm()
      await this.getListPlantAssigned()
      await this.getListDeviceSetting()
      await this.getListPlantSetting()
    },
    async getListDeviceOfFarm() {
      let params = {
        FarmID : this.id
      }
      let response = await this.$store.dispatch('device/getDeviceOfFarm', params)
      if (response.status === 200) {
        let data = response.data.data
        if (data && data.length > 0) {
            this.devicesSelected = data
        } else {
          this.devicesSelected = []
        }
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    async getListPlantAssigned() {
      let params = {
        FarmID : this.id
      }
      let response = await this.$store.dispatch('plant/getPlantOfFarm', params)
      if (response.success) {
        let data = response.data
        if (data && data.length > 0) {
          this.plantSelected = data
        } else {
          this.plantSelected = []
        }
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    closeSettingPopup() {
      this.modalSetting = false
    },
    async saveSetting() {
      let deviceSelectedIds = [];
      if (this.devicesSelected.length > 0) {
        deviceSelectedIds = this.devicesSelected.map((element) => element.id)
      }
      let plantSelectedIds = [];
      if (this.plantSelected.length > 0) {
        plantSelectedIds = this.plantSelected.map((item) => item.id)
      }
      let params = {
        FarmID: this.id,
        deviceIds: deviceSelectedIds,
        plantIds: plantSelectedIds
      }
      let dispatch = 'farm/setting'
      let response = await this.$store.dispatch(dispatch, params)
      if (response.status === 200) {
        this.$Notice.success({title: 'Success', desc: response.data.message})
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    closeFormSetting() {
      this.closeSettingPopup()
      this.resetFormSetting()
    },
    resetFormSetting() {
      this.id = ''
      this.plantSelected = []
      this.devicesSelected = []
      this.listDeviceSetting = []
      this.listPlantSetting = []
    }

  }

}

</script>
