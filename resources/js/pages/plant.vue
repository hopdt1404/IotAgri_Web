<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-end">
        <div class="col-2">
          <Button type="info" v-if="user.group_user_id === 1" @click="showModal">{{ $t('add-button')}}</Button>
        </div>
      </div>
      <div class="table-content mt-3">
        <b-table id="table-data"
                 :fields="columnsShow"
                 :items="listPlant" outlined
                 :current-page="currentPage"
                 :per-page="perPage">
<!--          <template #cell(created_at)="data" class="width-15">-->
<!--            {{ moment(data['item']['created_at']).format("YYYY-MM-DD HH:mm:ss") }}-->
<!--          </template>-->
<!--          <template #cell(updated_at)="data">-->
<!--            {{ data['item']['updated_at'] ? moment(data['item']['updated_at']).format("YYYY-MM-DD HH:mm:ss") : ''}}-->
<!--          </template>-->
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
                :title="$t('detail_info')"
                icon-close="x"
                @close="closePopup()">
        <div class="dialog-content">
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="name">{{ $t('plant_name') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="name"
                       v-model="name"
                       clearable
                       type="text"
                       :disabled="!isAdmin"
                       maxlength="50"
                       show-word-limit
                       placeholder="..."
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
                <b-form-select id="plant_type_id"
                               v-model="plant_type_id"
                               :disabled="!isAdmin"
                               :options="listPlantType"></b-form-select>
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
                       :disabled="!isAdmin"
                       maxlength="50"
                       show-word-limit
                       placeholder="..."
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
                  :disabled="!isAdmin"
                  placeholder="..."
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
                       :disabled="!isAdmin"
                       placeholder="..."
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
                       :disabled="!isAdmin"
                       placeholder="..."
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
                       :disabled="!isAdmin"
                       placeholder="..."
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
                       :disabled="!isAdmin"
                       placeholder="..."
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
                       :disabled="!isAdmin"
                       placeholder="..."
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
                <b-form-select id="soil_type_id"
                               v-model="soil_type_id"
                               :disabled="!isAdmin"
                               :options="listSoilType"></b-form-select>
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
                  :disabled="!isAdmin"
                  placeholder="..."
                  rows="3"
                  max-rows="6"
                ></b-form-textarea>
              </vs-col>
            </vs-row>
          </div>
        </div>
        <vs-row class="pt-6 pr-3" vs-type="flex" vs-justify="flex-end" vs-align="center">
          <vs-button class="square mr-2" color="#bdc3c7" type="filled" @click="cancel">{{ $t('cancel') }}</vs-button>
          <vs-button v-if="isAdmin" class="square mr-2 " color="primary" type="filled" @click="save" >{{ $t('save')}}</vs-button>
<!--          <vs-button class="square mr-2 " color="primary" type="filled" @click="save" >{{ $t('save')}}</vs-button>-->
        </vs-row>
      </vs-popup>

      <vs-popup name="form-state"
                :active.sync="modalState"
                :title="$t('plant_state') + ' ' + name"
                icon-close="x"
                @close="closeStatePopup()">
        <div class="dialog-content">
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="plant_state_id">{{ $t('plant_state')}}</label>
              </vs-col>
              <vs-col cols="12">
                <b-form-select id="plant_state_id" @change="getPlantStateInfo()" v-model="plant_state_id" :options="listPlantState"></b-form-select>
              </vs-col>
            </vs-row>
          </div>
          <div class="dialog-item">
            <vs-row>
              <vs-col cols="12">
                <label class="input-title" for="growth_period_state">{{ $t('growth_period_state') + $t('growth_period_unit') }}</label>
              </vs-col>
              <vs-col cols="12">
                <Input id="growth_period_state"
                       v-model="growth_period_state"
                       clearable
                       type="number"
                       maxlength="7"
                       show-word-limit
                       :disabled="!isAdmin"
                       placeholder="..."
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
                       :disabled="!isAdmin"
                       placeholder="..."
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
                       :disabled="!isAdmin"
                       placeholder="..."
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
                       :disabled="!isAdmin"
                       placeholder="..."
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
                  :disabled="!isAdmin"
                  placeholder="..."
                  rows="3"
                  max-rows="6"
                ></b-form-textarea>
              </vs-col>
            </vs-row>
          </div>
        </div>
        <vs-row class="pt-6 pr-3 mt-4" vs-type="flex" vs-justify="flex-end" vs-align="center">
          <vs-button class="square mr-2" color="#bdc3c7" type="filled" @click="closeFormState">{{ $t('cancel') }}</vs-button>
          <vs-button class="square mr-2 " v-if="isAdmin" color="primary" type="filled" @click="saveState" >{{ $t('save')}}</vs-button>
        </vs-row>
      </vs-popup>

    </div>

  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data() {
    return {
      modal: false,
      modalState: false,
      id: '',
      name: '',
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
      listPlantState: [],
      plant_state_id: '',
      currentPage: 1,
      perPage: 10,
      rows: 0,
      columnsShow: [
        {
          // label: 'Name',
          label: 'Tên cây trồng',
          key: 'name',
          sortable: true
        },
        {
          // label: 'Growth period',
          label: 'Thời gian sinh trưởng',
          key: 'growth_period',
          sortable: true
        },
        {
          // label: 'Plant type',
          label: 'Loại cây trồng',
          key: 'plant_type',
          sortable: true
        },
        {
          // label: 'Soil type',
          label: 'Loại đất trồng',
          key: 'soil_type',
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

      ],
      plant_state_info_id: '',
      growth_period_state: '',
      temperature: '',
      moisture: '',
      light: '',
      note: '',
    }
  },
  created() {
    this.getPlant()
    this.getPlantType()
    this.getSoilType()
    this.getPlantState()
  },
  computed: mapGetters({
    user: 'auth/user',
    isAdmin: 'auth/isAdmin'
  }),
  methods: {
    async getPlantState() {
      let response = await this.$store.dispatch('plant/getPlantState')
      if (response.status === 200) {
        let data = response.data.data
        this.listPlantState = data.map((element) => {
          let elementResult = {}
          elementResult.value = element.id
          elementResult.text = element.name
          return elementResult
        })
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
        this.listPlantState = []
      }
    },
    async saveState() {
      let params = {
        plant_state_id: this.plant_state_id,
        plant_id: this.id,
        growth_period_state: this.growth_period_state,
        temperature: this.temperature,
        moisture: this.moisture,
        light: this.light,
        note: this.note,
      }
      let dispatch
      let action
      if (this.plant_state_info_id) {
        params.id = this.plant_state_info_id
        dispatch = 'plantStateInfo/update'
        action = 'update'
      } else {
        dispatch = 'plantStateInfo/store'
        action = 'store'
      }
      let response = await this.$store.dispatch(dispatch, params);
      if (response.status === 200) {
        let data = response.data.data
        if (data && action === 'store') {
          this.plant_state_info_id = data.id
        }
        this.$Notice.success({title: 'Success', desc: response.data.message})
      } else {
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    async getPlantStateInfo() {
      let params = {
        plant_state_id: this.plant_state_id,
        plant_id: this.id
      }
      let response = await this.$store.dispatch('plantStateInfo/getPlantStateInfo', params);
      if (response.status === 200) {
        if (response.data.data != null) {
          let data = response.data.data
          this.growth_period_state = data.growth_period_state
          this.temperature = data.temperature
          this.moisture = data.moisture
          this.light = data.light
          this.note = data.note
          this.plant_state_info_id = data.id
        } else {
          this.resetInfoPlantState()
        }
      } else {
        this.resetInfoPlantState()
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    closeFormState() {
      this.modalState = false
      this.resetFromState()
    },
    resetFromState() {
      if (this.plant_state_info_id) {
        this.plant_state_info_id = ''
      }
      this.id = ''
      this.plant_state_id = ''
      this.resetInfoPlantState()

    },
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
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
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
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
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
        plant_type_id: this.plant_type_id,
        growth_period: this.growth_period,
        planting_time: this.planting_time,
        plant_density: this.plant_density,
        width_bed: this.width_bed,
        height_bed: this.height_bed,
        row_spacing: this.row_spacing,
        tree_spacing: this.tree_spacing,
        soil_type_id: this.soil_type_id,
        info: this.info,
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
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    resetForm () {
      if (this.id) {
        this.id = ''
      }
      this.name = ''
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
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
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
      this.closeFormState()
    },
    async myRowClickHandler(record, index) {
      this.showModal()
      let params = {
        id : record.id
      }
      let response = await this.$store.dispatch('plant/getPlantDetail', params)
      if (response.status === 200) {
        let data = response.data.data
        this.id = data.id
        this.name = data.name
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
        this.$Notice.error({title: 'Error ' + response.status,
          desc: response.statusText + '. ' + response.data.message})
      }
    },
    async plantSateHandler(record, index) {

      this.showModalState()
      this.id = record.id
      this.name = record.name
      if (this.listPlantState.length) {
        this.plant_state_id = this.listPlantState[0].value
        this.getPlantStateInfo()
      }
    },
    resetInfoPlantState() {
      this.plant_state_info_id = ''
      this.growth_period_state = ''
      this.temperature = ''
      this.moisture = ''
      this.light = ''
      this.note = ''
      this.name = ''
    }
  }
}
</script>

