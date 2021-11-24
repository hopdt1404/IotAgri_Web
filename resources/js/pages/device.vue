<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-end">
        <div class="col-2">
          <Button type="info" v-if="user.group_user_id === 1"
                  @click="showModal">{{ $t('add-button')}}</Button>
        </div>
      </div>

      <div class="table-content mt-3">
        <b-table id="table-data"
                 :fields="columnsShow"
                 :items="listDevice" outlined
                 @row-clicked="myRowClickHandler"
                 :current-page="currentPage"
                 :per-page="perPage">
          <template #cell(Status)="data">
            {{ data['item']['Status'] == -1 ? $t('trouble') :
            data['item']['Status'] == 1 ? $t('activate') : $t('deactivate')}}
          </template>
<!--          <template #cell(created_at)="data" class="width-15">-->
<!--            {{ moment(data['item']['created_at']).format("YYYY-MM-DD HH:mm:ss") }}-->
<!--          </template>-->
<!--          <template #cell(updated_at)="data">-->
<!--            {{ data['item']['updated_at'] ? moment(data['item']['updated_at']).format("YYYY-MM-DD HH:mm:ss") : ''}}-->
<!--          </template>-->
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
    <vs-popup name="form-info"
              :active.sync="modal"
              :title="$t('detail_info')"
              icon-close="x">
      <div class="dialog-content">
        <vs-row>
          <vs-col cols="12">
            <label class="input-title" for="name">{{ $t('name') }}</label>
          </vs-col>
          <vs-col cols="12">
            <Input id="name"
                   v-model="name"
                   clearable
                   type="text"
                   :disabled="!isAdmin"
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
            <label class="input-title" for="device_type">{{ $t('device_type') }}</label>
          </vs-col>
          <vs-col cols="12">
            <b-form-select id="device_type"
                           v-model="device_type"
                           :options="listDeviceType"
                           :disabled="!isAdmin"></b-form-select>
          </vs-col>
        </vs-row>
      </div>
      <div v-if="!isAdmin" class="dialog-item">
        <vs-row>
          <vs-col class="" cols="12">
            <vs-col class="" cols="12">
              <label class="input-title" for="farm_id">{{ $t('farm_own') }}</label>
            </vs-col>
            <vs-col cols="12">
              <b-form-select id="farm_id"
                             v-model="farm_id"
                             :options="listFarmOfUser"
                             @change="updateListPlotOfFarm"
              ></b-form-select>
            </vs-col>
          </vs-col>
        </vs-row>
      </div>
      <div v-if="!isAdmin" class="dialog-item">
        <vs-row>
          <vs-col class="" cols="12">
            <label class="input-title" for="plot_id">{{ $t('plot_position') }}</label>
          </vs-col>
          <vs-col cols="12">
            <b-form-select id="plot_id" name="plot_id" v-model="plot_id" :options="listPlotOfFarmSelect"></b-form-select>
          </vs-col>
        </vs-row>
      </div>
      <div v-if="isAdmin" class="dialog-item" >
        <vs-row>
          <vs-col class="" cols="12">
            <label class="input-title" for="device_owner">{{ $t('device_owner') }}</label>
          </vs-col>
          <vs-col cols="12">
            <b-form-select id="device_owner" v-model="user_id_owner" :options="listUser"></b-form-select>
          </vs-col>
        </vs-row>
      </div>
<!--      <div class="dialog-item">-->
<!--        <vs-row>-->
<!--          <vs-col class="" cols="12">-->
<!--            <label class="input-title" for="plot_type">{{ $t('plot_type') }}</label>-->
<!--          </vs-col>-->
<!--          <vs-col cols="12">-->
<!--            <b-form-select id="plot_type" v-model="plot_type" :options="null"></b-form-select>-->
<!--          </vs-col>-->
<!--        </vs-row>-->
<!--      </div>-->
      <div class="dialog-item">
        <vs-row>
          <vs-col class="" cols="12">
            <label class="input-title" for="status">{{ $t('status') }}</label>
          </vs-col>
          <vs-col cols="12">
              <b-form-radio-group disabled v-model="status">
                <b-form-radio value="1">{{ $t('activate')}}</b-form-radio>
                <b-form-radio value="2">{{ $t('deactivate')}}</b-form-radio>
                <b-form-radio value="-1">{{ $t('trouble')}}</b-form-radio>
              </b-form-radio-group>
          </vs-col>
        </vs-row>
      </div>
      <vs-row class="pt-6 pr-3" vs-type="flex" vs-justify="flex-end" vs-align="center">
        <vs-button class="square mr-2" color="#bdc3c7" type="filled" @click="cancel">{{ $t('cancel') }}</vs-button>
        <vs-button class="square mr-2 "
                   color="primary"
                   type="filled"
                   @click="save" >{{ $t('save')}}</vs-button>
      </vs-row>

    </vs-popup>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
  data () {
    return {
      id: '',
      name: '',
      device_type: '',
      plot_type: '',
      listFarmOfUser: [],
      farm_id: '',
      plant_id: '',
      plot_id: '',
      listPlantOfFarm: [],
      listPlotOfFarmSelect: [],
      status: 1,
      user_id_owner: '',
      listUser: [],
      listDevice: [],
      currentPage: 1,
      perPage: 10,
      rows: 0,
      modal: false,
      columnsShow: [
        {
          // label: 'Name',
          label: 'Tên thiết bị',
          key: 'DeviceName',
          sortable: true
        },
        {
          // label: 'Device Type',
          label: 'Loại thiết bị',
          key: 'DeviceType',
          sortable: true
        },
        {
          // label: 'Status',
          label: 'Trạng thái',
          key: 'Status',
          sortable: true
        },
        {
          // label: 'Farm',
          label: 'Trang trại lắp đặt',
          key: 'farm_name',
          sortable: true
        },
        {
          // label: 'plot',
          label: 'Khu vực lắp đặt',
          key: 'plot_name',
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

      ],
      listDeviceType: [],
    }
  },
  components: {

  },
  created() {
    this.getDevice()
    this.getDeviceType()
  },
  computed: mapGetters({
    user: 'auth/user',
    isAdmin: 'auth/isAdmin'
  }),
  methods: {
    ...mapActions({
      getListDevice: 'device/getDevice',
      getListDeviceAdmin: 'device/getListDeviceAdmin',
      getListFarmOfUser: 'farm/getListFarmOfUser',
      getListUserCanOwner: 'device/getListUserCanOwnerDevice',
      getListPlotOfFarmSelect: 'plot/getListPlotOfFarmSelect',
      getFarmAssignedDevice: 'device/getFarmAssignedDevice',
      getPlantOfFarm: 'plant/getPlantOfFarm',
      getPlantAssignedOfDevice: 'plant/getPlantAssignOfDevice'
    }),

    async getDevice () {
      let response
      if (this.user.group_user_id === 0) {
        response = await this.getListDevice()
      } else if (this.user.group_user_id === 1) {
        response = await this.getListDeviceAdmin()
      }
      if (response.status === 200) {
        this.listDevice = response.data.data
        this.rows = this.listDevice.length
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
        this.listDevice = []
        this.rows = 0
      }
    },
    showModal() {
      this.modal = true
      if (this.isAdmin) {
        this.getListUser()
      }
      this.resetForm()

    },
    resetForm () {
      if (this.id) {
        this.id = null
      }
      this.plot_type = ''
      this.name = ''
      this.status = 1
      this.device_type = ''
      this.farm_id = ''
      this.plot_id = ''
    },
    updateListPlotOfFarm() {
      this.getListPlotOfFarm(this.farm_id)
      this.plot_id = ''
    },
    cancel() {
      this.resetForm();
      this.modal = !this.modal
    },
    async getListFarmOfCurrentUser () {
      const response = await this.getListFarmOfUser()
      if (response.success && response.data) {
        this.listFarmOfUser = response.data.map((element) => {
          let elementResult = {}
          elementResult.value = element.FarmID
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.listFarmOfUser = []
      }
    },
    async getFarmAssignDevice (params) {
      let response = await this.getFarmAssignedDevice(params)
      if (response.success && response.data) {
        this.farm_id = response.data.FarmID
      } else {
        this.farm_id = []
      }
    },
    async getListPlantOfFarm (farmId) {
      let params = {
        FarmID: farmId
      }
      let response = await this.getPlantOfFarm(params)
      if (response && response.success && response.data) {
        if (response.data.length > 0) {
          this.listPlantOfFarm = response.data.map(element => {
            let result = {}
            result.text = element.name
            result.value = element.id
            return result
          })
        } else {
          this.listPlantOfFarm = []
        }
      } else {
        this.listPlantOfFarm = []
      }
    },
    async getPlantAssignOfDevice() {
      let params = {
        DeviceID: this.id,
        FarmID: this.farm_id
      }
      let response = await this.getPlantAssignedOfDevice(params)
      if (response.success && response.data) {
        this.plant_id = response.data.id
      } else {
        this.plant_id = ''
      }

    },
    async myRowClickHandler(record, index) {
      this.showModal()
      let params = {
        id : record.DeviceID
      }
      let response
      if (!this.isAdmin) {
        this.getListFarmOfCurrentUser()
        // this.getFarmAssignDevice(params)

      }
      response = await this.$store.dispatch('device/getDeviceDetail', params)
      // console.log('response')
      // console.log(response)
      if (response.data && response) {
        const data = response.data
        this.id = data.DeviceID
        this.name = data.DeviceName
        this.device_type = data.DeviceTypeID
        this.status = data.Status
        this.farm_id = data.FarmID
        this.getListPlotOfFarm(this.farm_id)
        this.plot_id = data.PlotID
        this.user_id_owner = data.user_id
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }

    },
    async getListUser() {
      const response = await this.getListUserCanOwner()
      this.listUser = []
      this.user_id_owner = ''
      if (response && response.data && response.data.length > 0) {
        this.listUser = response.data.map(element => {
          let result = {}
          result.text = element.name
          result.value = element.id
          return result
        })
      }
    },
    async save() {
      let params = {
        DeviceName: this.name,
        DeviceTypeID: this.device_type,
        Status: this.status,
        PlotID: this.plot_id,
      }
      if (this.user.group_user_id === 0) {
        params.FarmID = this.farm_id
        params.plant_id = this.plant_id
      } else if (this.user.group_user_id === 1) {
        params.user_id = this.user_id_owner
      }
      let dispatch
      if (this.id) {
        params.DeviceID = this.id
        dispatch = 'device/update'
      } else {
        dispatch = 'device/create'
      }
      // console.log('params')
      // console.log(params)
      let response = await this.$store.dispatch(dispatch, params)
      if (response.status === 200) {
        this.$Notice.success({title: 'Success', desc: response.data.message})
        await this.getDevice()
        this.modal = !this.modal
        this.resetForm()
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    async getDeviceType() {
      let response = await this.$store.dispatch('device/getDeviceType')
      if (response.status === 200) {
        let data = response.data.data
        this.listDeviceType = data.map((element) => {
          let elementResult = {}
          elementResult.value = element.DeviceTypeID
          elementResult.text = element.DeviceType
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
        this.listDeviceType = []
      }

    },
    async getListPlotOfFarm(farmId) {
      const params = {
        FarmID: farmId
      }
      const response = await this.getListPlotOfFarmSelect(params)
      if (response) {
        this.listPlotOfFarmSelect = response.map(element => {
          let elementResult = {}
          elementResult.value = element.PlotID
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }

    }

  },
  watch: {
    // farm_id (newVal, oldVal) {
    //   if (newVal) {
    //     // this.getListPlantOfFarm(newVal)
    //     this.getListPlotOfFarm(newVal)
    //     // this.getPlantAssignOfDevice()
    //   } else {
    //     // this.plant_id = ''
    //     // this.listPlantOfFarm = []
    //     this.listPlotOfFarmSelect = []
    //     //  list is null
    //     // assign is null
    //   }
    // }
  }
}
</script>
