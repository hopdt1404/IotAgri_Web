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
                 :items="listDevice" outlined
                 @row-clicked="myRowClickHandler"
                 :current-page="currentPage"
                 :per-page="perPage">
          <template #cell(Status)="data">
            {{ data['item']['Status'] == -1 ? 'Trouble' :
            data['item']['Status'] == 1 ? 'Activate' : 'Deactivate'}}
          </template>
          <template #cell(created_at)="data" class="width-15">
            {{ moment(data['item']['created_at']).format("YYYY-MM-DD HH:mm:ss") }}
          </template>
          <template #cell(updated_at)="data">
            {{ data['item']['updated_at'] ? moment(data['item']['updated_at']).format("YYYY-MM-DD HH:mm:ss") : ''}}
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
    <vs-popup name="form-info"
              :active.sync="modal"
              title="Form Info"
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
            <b-form-select id="device_type" v-model="device_type" :options="listDeviceType"></b-form-select>
          </vs-col>
        </vs-row>
      </div>
      <div class="dialog-item">
        <vs-row>
          <vs-col class="" cols="12">
            <label class="input-title" for="plot_type">{{ $t('plot_type') }}</label>
          </vs-col>
          <vs-col cols="12">
            <b-form-select id="plot_type" v-model="plot_type" :options="null"></b-form-select>
          </vs-col>
        </vs-row>
      </div>
      <div class="dialog-item">
        <vs-row>
          <vs-col class="" cols="12">
            <label class="input-title" for="status">{{ $t('status') }}</label>
          </vs-col>
          <vs-col cols="12">
              <b-form-radio-group v-model="status">
                <b-form-radio value="1">Activate</b-form-radio>
                <b-form-radio value="2">Deactivate</b-form-radio>
                <b-form-radio value="-1">Trouble</b-form-radio>
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
</template>

<script>
export default {
  data() {
    return {
      id: '',
      name: '',
      device_type: '',
      plot_type: '',
      status: 1,
      listDevice: [],
      currentPage: 1,
      perPage: 10,
      rows: 0,
      modal: false,
      columnsShow: [
        {
          label: 'Name',
          key: 'DeviceName',
          sortable: true
        },
        {
          label: 'Device Type',
          key: 'DeviceType',
          sortable: true
        },
        {
          label: 'Plot type',
          key: 'PlotID',
          sortable: true
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
  methods: {

    async getDevice () {
      let response = await this.$store.dispatch('device/getDevice')
      if (response.status === 200) {
        this.listDevice = response.data.data
        this.rows = this.listDevice.length
      } else {
        this.listDevice = []
        this.rows = 0
      }
    },
    showModal() {
      this.modal = true
    },
    resetForm () {
      if (this.id) {
        this.id = null
      }
      this.plot_type = ''
      this.name = ''
      this.status = 1
      this.device_type = ''
      console.log('reset')
    },
    cancel() {
      this.resetForm();
      this.modal = !this.modal
    },
    async myRowClickHandler(record, index) {
      this.showModal()
      let params = {
        id : record.DeviceID
      }
      let response = await this.$store.dispatch('device/getDeviceDetail', params)
      if (response.status === 200) {
        let data = response.data.data
        this.id = data.DeviceID
        this.name = data.DeviceName
        this.device_type = data.DeviceTypeID
        this.status = data.Status
        this.plot_type = data.PlotId
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    async save() {
      let params = {
        DeviceName: this.name,
        DeviceTypeID: this.device_type,
        Status: this.status,
        PlotId: this.plot_type
      }
      let dispatch
      if (this.id) {
        params.DeviceID = this.id
        dispatch = 'device/update'
      } else {
        dispatch = 'device/create'
      }
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

    }
  }
}
</script>
