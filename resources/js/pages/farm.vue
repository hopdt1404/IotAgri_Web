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
                 @row-clicked="myRowClickHandler"
                 :current-page="currentPage"
                 :per-page="perPage">

          <template #cell(created_at)="data" class="width-15">
              {{ moment(data['item']['created_at']).format("YYYY-MM-DD HH:mm:ss") }}
          </template>
          <template #cell(updated_at)="data">
            {{ data['item']['updated_at'] ? moment(data['item']['updated_at']).format("YYYY-MM-DD HH:mm:ss") : ''}}
          </template>
        </b-table>
      </div>
      <div class="overflow-auto">
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
                <b-form-select v-model="farm_type" :options="null"></b-form-select>
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



  </div>
</template>

<script>

export default {

  data() {
    return {
      id: '',
      name: '',
      area: '',
      location: '',
      farm_type: '',
      modal: false,
      listFarm: [],
      currentPage: 1,
      perPage: 10,
      rows: 0,
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
          key: 'FarmTypeID',
          sortable: true
        },
        {
          label: 'Location',
          key: 'LocateID'
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
          label: 'Status',
          key: 'Status',
          sortable: true
        },
      ]
    }
  },

  components: {
    // ButtonComponent
  },

  created() {
    this.getFarm()
  },
  methods: {
    async save(event) {

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
        this.$Notice.error({title: 'Error', desc: response})
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
      }

    },
    cancel() {
      this.resetForm();
      this.modal = !this.modal
    }
  }

}


</script>
