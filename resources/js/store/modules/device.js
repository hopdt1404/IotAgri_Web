import axios from 'axios'

export const actions = {
  async getDevice({ commit }, payload) {
    try {
      return await axios.get('/api/device')
    } catch (e) {
      return e
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
  }
}
