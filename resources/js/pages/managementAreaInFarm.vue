<template>
  <div class="content">
    <div id="current-farm">
      <div class="dialog-item">
        <vs-row>
          <vs-col class="" vs-offset="8" cols="4">
            {{ $t('current_farm_management') }}
          </vs-col>
          <vs-col vs-offset="8" cols="4">
            <b-form-select id="farm_id" v-model="farm_id" :options="listFarmSelect"></b-form-select>
          </vs-col>
        </vs-row>
      </div>
    </div>

    <div class="table-content mt-3" v-if="listPlotOfFarm.length > 0">
      <b-table id="table-data"
               :fields="columnsShow"
               :items="listPlotOfFarm" outlined
               :current-page="currentPage"
               :per-page="perPage"
               @row-clicked="myRowClickHandler">
      </b-table>
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
                :title="$t('detail_info')"
                icon-close="x">
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
              />
            </vs-col>
          </vs-row>
        </div>
        <div class="dialog-content">
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="area">{{ $t('area') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="area"
                       v-model="area"
                       clearable
                       type="number"
                />
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
                  <b-form-radio value="-1">{{ $t('deactivate')}}</b-form-radio>
                  <b-form-radio value="0">{{ $t('init')}}</b-form-radio>
                  <b-form-radio value="1">{{ $t('activate')}}</b-form-radio>
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
        </div>
      </vs-popup>
    </div>
  </div>
</template>


<script>
import { mapActions } from 'vuex'

export default {

  components: {

  },
  data() {
    return {
      farm_id: '',
      listPlotOfFarm: [],
      listFarmSelect: [],
      plot_id: '',
      currentPage: 1,
      perPage: 10,
      rows: 0,
      name: '',
      modal: false,
      status: 0,
      area: '',
      isGetPlotInCreated: false,
      columnsShow: [
        {
          label: 'Tên vùng',
          key: 'name',
          sortable: true
        },
        {
          label: 'Diện tích',
          key: 'Area',
          sortable: true
        },
        {
          label: 'Trạng thái',
          key: 'status',
          sortable: true
        },
        {
          label: 'Số thiết bị trong khu vực',
          key: 'number_device',
          sortable: true
        }
      ]
    }
  },
  watch: {
    farm_id (newVal, oldVal) {
      if (newVal) {
        if (this.isGetPlotInCreated) {
          this.getListPlot()
          this.$router.push(`/management-area-in-farm/${this.farm_id}`)
        }
      }
    }
  },
  async created () {
    if (this.$route.params.farm_id) {
      this.farm_id = this.$route.params.farm_id
      await this.getListPlot()
      this.isGetPlotInCreated = true
    }
    const result = await this.getListFarmSelect()
    if (result) {
      this.listFarmSelect = result.map(element => {
        let elementResult = {}
        elementResult.value = element.FarmID
        elementResult.text = element.name
        return elementResult
      })
    }
  },
  methods: {
    ...mapActions({
      getListPlotInFarm: 'plot/getListPlotOfFarm',
      getListFarmSelect: 'farm/getListFarmSelect',
      getPlotDetail: 'plot/getPlotDetail'
    }),
    async getListPlot () {
      const params = {
        FarmID: this.farm_id
      }
      const result = await this.getListPlotInFarm(params)
      if (result) {
        this.listPlotOfFarm = result
      } else {
        this.$Notice.error({title: 'Error ' + result.status,
          desc: result.statusText + '. ' + result.data.message})
      }
    },
    showModal() {
      this.modal = true
    },
    cancel() {
      this.resetForm()
      this.modal = !this.modal
    },
    resetForm() {
      this.name = ''
      this.plot_id = ''
      this.area = ''
      this.status = 0
    },
    async myRowClickHandler(record) {
      this.showModal()
      this.plot_id = record.PlotID
      await this.getPlotDetailInfo()
    },
    async getPlotDetailInfo() {
      const params = {
        PlotID: this.plot_id
      }
      const result = await this.getPlotDetail(params)
      if (result) {
        this.plot_id = result.PlotID
        this.area = result.Area
        this.status = result.status
        this.name = result.name
      }
    },
    async save() {
      let params = {
        Area: this.area,
        status: this.status,
        name: this.name,
        FarmID: this.farm_id,
        PlotTypeID: 1
      }
      // Todo: call api
      if (this.plot_id) {
        params.PlotID = this.plot_id
        // update
      } else {
        // create
      }

    }

  },

}

</script>
