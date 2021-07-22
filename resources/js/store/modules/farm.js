import axios from 'axios'

export const actions = {
  async getFarm({ commit }, payload) {
    try {
      const data = await axios.get('/api/farm')
      return data
    } catch (e) {
      this.$Notice.error({title: 'Error', desc: 'Request failed: ' + e.toString()})
      return e
    }
  },

  async create({ commit }, payload) {
    try {
     return await axios.post('/api/farm', payload)
    } catch (e) {
      this.$Notice.error({title: 'Error', desc: 'Request failed: ' + e.toString()})
      return e
    }
  },
  async getFarmDetail({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.get('/api/farm/' + payload.id )
      }
    } catch (e) {
      this.$Notice.error({title: 'Error', desc: 'Request failed: ' + e.toString()})
      return e
    }
  },
  async update({ commit }, payload) {
    try {
      if (payload.FarmID != 0) {
        return await axios.put('/api/farm/' + payload.FarmID, payload)
      }
    } catch (e) {
      this.$Notice.error({title: 'Error', desc: 'Request failed: ' + e.toString()})
      return e
    }
  },
  async getFarmType({ commit }, payload) {
    try {
      return await axios.get('/api/farm_type')
    } catch (e) {
      this.$Notice.error({title: 'Error', desc: 'Request failed: ' + e.toString()})
      return e
    }
  },
  setting({ commit }, payload) {
    return axios.post('/api/farm/setting', payload).then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
  }
}
