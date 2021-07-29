import axios from 'axios'

export const actions = {
  async getDevice({ commit }, payload) {
    try {
      return await axios.get('/api/device')
    } catch (error) {
      let status = error.response.status;
      if (status == 422 || status == 403) {

      }
      return error.response;
    }
  },
  async create({ commit }, payload) {
    try {
      return await axios.post('/api/device', payload)
    } catch (e) {
      return JSON.stringify(e)
    }
  },
  async getDeviceDetail({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.get('/api/device/' + payload.id )
      }
    } catch (e) {
      return e
    }
  },
  async update({ commit }, payload) {
    try {
      if (payload.DeviceID != 0) {
        return await axios.put('/api/device/' + payload.DeviceID, payload)
      }
    } catch (e) {
      return e
    }
  },
  async getDeviceType({ commit }, payload) {
    try {
      return await axios.get('/api/device_type')
    } catch (e) {
      return e
    }
  },
  async getDeviceSettingFarm({ commit }, payload) {
    try {
      return await axios.get('/api/device/getDeviceSettingFarm')
    } catch (e) {
      this.$Notice.error({title: 'Error', desc: 'Request failed: ' + e.toString()})
      return e
    }
  },
  async getDeviceOfFarm({ commit }, payload) {
    try {
      return await axios.get('/api/device/getDeviceOfFarm', {params: payload})
    } catch (e) {
      this.$Notice.error({title: 'Error', desc: 'Request failed: ' + e.toString()})
      return e
    }
  }
}
