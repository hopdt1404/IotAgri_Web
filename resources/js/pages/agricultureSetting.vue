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
                <b-form-select id="select_plant_id" @change="getPlantOfFarm()" v-model="plant_id" :options="listPlantOfFarm"></b-form-select>
              </vs-col>
            </vs-row>
          </div>
        </div>
      </vs-popup></div>
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
      // modal: true,
      plant_id: '',
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
      let params = {
        FarmID: record.FarmID
      }
      let response = await this.$store.dispatch('plant/getPlantOfFarm', params)
      if (response.success) {
        this.listPlantOfFarm = response.data
      } else {
        this.listPlantOfFarm = []
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    showModal() {
      this.modal = true
    },
    async getPlantOfFarm() {

    },
    initTitlePopup() {
      this.titlePopup = 'Form setting agriculture for '
    }
  }

}
</script>
