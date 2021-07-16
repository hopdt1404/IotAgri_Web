<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-end">
        <div class="col-2">
          <Button type="info" @click="showModal">{{ $t('add-button')}}</Button>
        </div>
      </div>
      <div class="table-content mt-3">

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
      </vs-popup>

    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      modal: false,
      name,

      columnsShow: [

      ],
    }
  },
  created() {

  },
  methods: {
    showModal() {
      this.modal = true
    },
  }
}
</script>

