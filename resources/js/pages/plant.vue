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
                 :items="listPlant" outlined
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
            <b-button variant="warning"
              @click="plantSateHandler(data['item'])">
              {{ $t('plant_state') }}
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

      <vs-popup name="form-info"
                :active.sync="modal"
                title="Form Info"
                icon-close="x"
                @close="closePopup()">
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
              <vs-col cols="12">
                <label class="input-title" for="cultivars">{{ $t('cultivars') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="cultivars"
                       v-model="cultivars"
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
                <label class="input-title" for="plant_type_id">{{ $t('plant_type') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="plant_type_id" v-model="plant_type_id" :options="listPlantType"></b-form-select>
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
              <vs-col cols="12">
                <label class="input-title" for="planting_time">{{ $t('planting_time') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-textarea
                  id="planting_time"
                  v-model="planting_time"
                  placeholder="Enter something..."
                  rows="3"
                  max-rows="6"
                ></b-form-textarea>
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="plant_density">{{ $t('plant_density') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="plant_density"
                       v-model="plant_density"
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
              <vs-col cols="12">
                <label class="input-title" for="width_bed">{{ $t('width_bed') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="width_bed"
                       v-model="width_bed"
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
              <vs-col cols="12">
                <label class="input-title" for="height_bed">{{ $t('height_bed') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="height_bed"
                       v-model="height_bed"
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
              <vs-col cols="12">
                <label class="input-title" for="row_spacing">{{ $t('row_spacing') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="row_spacing"
                       v-model="row_spacing"
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
              <vs-col cols="12">
                <label class="input-title" for="tree_spacing">{{ $t('tree_spacing') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="tree_spacing"
                       v-model="tree_spacing"
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
              <vs-col cols="12">
                <label class="input-title" for="soil_type_id">{{ $t('soil_type') }}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="soil_type_id" v-model="soil_type_id" :options="listSoilType"></b-form-select>
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
                  id="info"
                  v-model="info"
                  placeholder="Enter something..."
                  rows="3"
                  max-rows="6"
                ></b-form-textarea>
              </vs-col>
            </vs-row>
          </div>
        </div>
        <vs-row class="pt-6 pr-3" vs-type="flex" vs-justify="flex-end" vs-align="center">
          <vs-button class="square mr-2 " color="primary" type="filled" @click="save" >{{ $t('save')}}</vs-button>
          <vs-button class="square mr-0" color="#bdc3c7" type="filled" @click="cancel">{{ $t('cancel') }}</vs-button>
        </vs-row>
      </vs-popup>

      <vs-popup name="form-state"
                :active.sync="modalState"
                title="Form State"
                icon-close="x"
                @close="closeStatePopup()">

      </vs-popup>

    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      modal: false,
      modalState: false,

      name: '',
      cultivars: '',
      plant_type_id: '',
      growth_period: '',
      planting_time: '',
      plant_density: '',
      width_bed: '',
      height_bed: '',
      row_spacing: '',
      tree_spacing: '',
      soil_type_id: '',
      info: '',
      listPlantType: [],
      listPlant: [],
      listSoilType: [],
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
          label: 'Cultivars',
          key: 'cultivars',
          sortable: true
        },
        {
          label: 'Growth period',
          key: 'growth_period',
          sortable: true
        },
        {
          label: 'Plant type',
          key: 'plant_type',
          sortable: true
        },
        {
          label: 'Soil type',
          key: 'soil_type',
          sortable: true
        },
        {
          label: 'Created at',
          key: 'created_at',
          sortable: true
        },
        // {
        //   label: 'Updated at',
        //   key: 'updated_at',
        //   sortable: true
        // },
        {
          label: 'Actions',
          key: 'actions'
        },

      ],
    }
  },
  created() {
    this.getPlant()
    this.getPlantType()
    this.getSoilType()
  },
  methods: {
    async getPlantType() {
      let response = await this.$store.dispatch('plant/getPlantType')
      if (response.status === 200) {
        let data = response.data.data
        this.listPlantType = data.map((element) => {
          let elementResult = {}
          elementResult.value = element.id
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
        this.listPlantType = []
      }
    },
    async getSoilType() {
      let response = await this.$store.dispatch('plant/getSoilType')
      if (response.status === 200) {
        let data = response.data.data
        this.listSoilType = data.map((element) => {
          let elementResult = {}
          elementResult.value = element.id
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
        this.listSoilType = []
      }
    },
    showModal() {
      this.modal = true
    },
    showModalState() {
      this.modalState = true
    },
    async save() {
      let params = {
        name: this.name,
        cultivars: this.cultivars,
        plant_type_id: this.plant_type_id,
        growth_period: this.growth_period,
        planting_time: this.planting_time,
        width_bed: this.width_bed,
        height_bed: this.height_bed,
        row_spacing: this.row_spacing,
        tree_spacing: this.tree_spacing,
        soil_type_id: this.soil_type_id,
        info: this.growth_period,
      }
      let dispatch
      if (this.id) {
        params.id = this.id
        dispatch = 'plant/update'
      } else {
        dispatch = 'plant/create'
      }
      let response = await this.$store.dispatch(dispatch,params);
      if (response.status === 200) {
        this.resetForm()
        this.$Notice.success({title: 'Success', desc: response.data.message})
        await this.getPlant()
        this.modal = !this.modal
      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    resetForm () {
      if (this.id) {
        this.id = ''
      }
      this.name = ''
      this.cultivars = ''
      this.plant_type_id = ''
      this.growth_period = ''
      this.planting_time = ''
      this.plant_density = ''
      this.width_bed = ''
      this.height_bed = ''
      this.row_spacing = ''
      this.tree_spacing = ''
      this.soil_type_id = ''
      this.info = ''
    },
    async getPlant() {
      let response = await this.$store.dispatch('plant/getPlant')
      if (response.status === 200) {
        this.listPlant = response.data.data
        this.rows = this.listPlant.length
      } else {
        this.listPlant = []
        this.rows = 0
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    cancel() {
      this.resetForm();
      this.modal = !this.modal
    },
    closePopup() {
      this.resetForm();
      this.modal = false
    },
    closeStatePopup() {
      this.modalState = false
    },
    async myRowClickHandler(record, index) {
      this.showModal()
      let params = {
        id : record.id
      }
      let response = await this.$store.dispatch('plant/getPlantDetail', params)
      if (response.status === 200) {
        let data = response.data.data;
        this.id = data.id
        this.name = data.name
        this.cultivars = data.cultivars
        this.plant_type_id = data.plant_type_id
        this.growth_period = data.growth_period
        this.planting_time = data.planting_time
        this.plant_density = data.plant_density
        this.width_bed = data.width_bed
        this.height_bed = data.height_bed
        this.row_spacing = data.row_spacing
        this.tree_spacing = data.tree_spacing
        this.soil_type_id = data.soil_type_id
        this.info = data.info

      } else {
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    },
    async plantSateHandler() {
      this.showModalState()
    }
  }
}
</script>

