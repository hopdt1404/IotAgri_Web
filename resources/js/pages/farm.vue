<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-end">
        <div class="col-2">
          <Button type="info" @click="showModal">{{ $t('add-button')}}</Button>
        </div>
      </div>
      <div class="table-content">
        <vs-table :data="listFarm">
          <template slot="header">
            <h4>{{ $t('list_farm')}} </h4>
          </template>
          <template slot="thead">
            <vs-th>
              {{ $t('name')}}
            </vs-th>
            <vs-th>
              {{ $t('area')}}
            </vs-th>
            <vs-th>
              {{ $t('farm_type')}}
            </vs-th>
            <vs-th>
              {{ $t('created_at')}}
            </vs-th>
            <vs-th>
              {{ $t('update_at')}}
            </vs-th>
            <vs-th>
              {{ $t('status')}}
            </vs-th>

          </template>

        </vs-table>

      </div>
      <div class="pagination">
<!--        <paginate-->
<!--          :page-count="20"-->
<!--          :page-range="3"-->
<!--          :margin-pages="2"-->
<!--          :click-handler="clickCallback"-->
<!--          :prev-text="'Prev'"-->
<!--          :next-text="'Next'"-->
<!--          :container-class="'pagination'"-->
<!--          :page-class="'page-item'">-->
<!--        </paginate>-->
      </div>

    </div>

    <div>

      <Modal
        v-model="modal"
        title="Form Info"
        ok-text="Save"
        @on-ok="save($event)"
        cancel-text="Cancel"
        @on-cancel="cancel()">
        <div class="dialog-content">
          <div class="dialog-item">
            <b-row>
              <b-col cols="12">
                <label class="input-title" for="name">{{ $t('name') }}</label>
              </b-col>
              <b-col cols="12">
                <Input id="name"
                       v-model="name"
                       clearable
                       type="text"
                       maxlength="50"
                       show-word-limit
                       placeholder="Enter something..."
                       />
              </b-col>
            </b-row>
          </div>
          <div class="dialog-item">
            <b-row>
              <b-col class="" cols="12">
                <label class="input-title" for="area">{{ $t('area') }}</label>
              </b-col>
              <b-col cols="12">
                <Input id="area"
                       v-model="area"
                       type="number"
                       placeholder="Enter something..."/>
              </b-col>
            </b-row>
          </div>
          <div class="dialog-item">
            <b-row>
              <b-col class="" cols="12">
                <label class="input-title" for="location">{{ $t('location') }}</label>
              </b-col>
              <b-col cols="12">
                <b-form-select id="location" v-model="location" :options="null"></b-form-select>
              </b-col>
            </b-row>
          </div>
          <div class="dialog-item">
            <b-row>
              <b-col cols="12">
                <label class="input-title"> {{ $t('farm_type') }} </label>
              </b-col>
              <b-col cols="12">
                <b-form-select v-model="farm_type" :options="null"></b-form-select>
              </b-col>
            </b-row>
          </div>

        </div>


      </Modal>

    </div>



  </div>
</template>

<script>
// import ButtonComponent from './../components/Button'

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
      columnsShow: [
        {
          title: 'Name',
          key: 'name'
        },
        {
          title: 'Area',
          key: 'Area'
        },
        {
          title: 'Farm type',
          key: 'FarmTypeID'
        },
        {
          title: 'Location',
          key: 'LocateID'
        },
        {
          title: 'Created at',
          key: 'created_at'
        },
        {
          title: 'Updated at',
          key: 'updated_at'
        },
        {
          title: 'Status',
          key: 'status'
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
        dispatch = 'farm/update'
      } else {
        dispatch = 'farm/create'
      }
      let response = await this.$store.dispatch(dispatch,params);
      if (response.status === 200) {
        this.resetForm()
        console.log(response)
        this.$Notice.success({title: 'Success', desc: response.data.message})
      } else {
        console.log('response')
        console.log(response)
        this.$Notice.error({title: 'Error', desc: response})
        // event.preventDefault();
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
      } else {
        this.listFarm = []
      }
    }
  }

}


</script>
