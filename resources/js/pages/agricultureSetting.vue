<template>
  <div class="content">
    <div class="container-fluid">
      <div class="table-content mt-3">

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
    }
  },
  created() {
    console.log('hello')
  },
  methods: {
    async getListFarmAgricultureSetting () {
      let response = await this.$store.dispatch('agricultureSetting/getFarmAgricultureSetting')
      if (response.status === 200) {
        this.listFarm = response.data.data
        this.rows = this.listFarm.length
      } else {
        this.listFarm = []
        this.rows = 0
        this.$Notice.error({title: 'Error', desc: 'Request failed'})
      }
    }
  }

}
</script>
