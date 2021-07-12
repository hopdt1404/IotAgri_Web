<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-end">
        <div class="col-2">
          <Button type="info" @click="showModal">{{ $t('add-button')}}</Button>
        </div>
      </div>
      <div class="table-content">
        <table class="table">
          <thead>
          <tr>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
          </tr>
          </thead>
        </table>

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
        @on-ok="save()"
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
    }
  },

  components: {
    // ButtonComponent
  },

  async created() {
    await this.$store.dispatch('farm/getFarm')
  },
  methods: {
    async save() {

      let params = {
        LocationID: this.location,
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
      let data = await this.$store.dispatch(dispatch,{params});
      console.log(data)

    },
    showModal() {
      this.modal = true
    }
  }

}


</script>
