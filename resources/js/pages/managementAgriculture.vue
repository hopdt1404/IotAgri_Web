<template>
  <div class="content">
    <div class="table-content mt-3">
      <b-table id="table-data"
               :fields="columnsShow"
               :items="listPlantManagement" outlined
               :current-page="currentPage"
               :per-page="perPage"
               @row-clicked="myRowClickHandler">

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
                :title="titleForm"
                icon-close="x"
                @close="closePopup()">

        <div class="dialog-content">
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
        <div class="dialog-content">
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
        <div class="dialog-content">
          <vs-row>
            <vs-col cols="12">
              <label class="input-title" for="start_time_season">{{ $t('start_time_season') }}</label>
            </vs-col>
            <vs-col cols="12">

            </vs-col>

          </vs-row>
        </div>

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
      modal: false,
      id: '',
      plant_name: '',
      plant_id: '',
      farm_name: '',
      farm_id: '',
      rows: 0,
      listPlantManagement: [],
      perPage: 10,
      currentPage: 1,
      titleForm: 'Form info',
      columnsShow: [
        {
          label: 'Plant',
          key: 'plant_name',
          sortable: true
        },
        {
          label: 'Farm',
          key: 'farm_name',
          sortable: true
        },
        {
          label: 'Status',
          key: 'status',
          sortable: true
        },
        {
          label: 'Start time season',
          key: 'start_time_season',
          sortable: true
        },
        {
          label: 'End time season',
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

  },
  mounted() {

  },
  methods: {
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

    },
    async myRowClickHandler(record, index) {
      this.showModal()
      console.log(record)
      let params = {
        id: record.id,
        query: {
          FarmID: record.FarmID,
          plant_id: record.plant_id
        }

      }
      let response = await this.$store.dispatch('agricultureSetting/getPlantAgricultureDetail', params)




    },
    showModal() {
      this.modal = true
    },
    closeModal() {
      this.modal = false;
    },
    resetForm() {

    },


  }

}
</script>
