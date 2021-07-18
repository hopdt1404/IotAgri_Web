import axios from 'axios'

export const actions = {
  async store({ commit }, payload) {
    try {
      return await axios.post('/api/plant-state-info', payload)
    } catch (e) {
      return JSON.stringify(e)
    }
  },
  async getPlantStateInfo({ commit }, payload) {
    try {
      return await axios.get('/api/plant-state-info/create', { params: payload })
    } catch (e) {
      return e
    }
  },
  async update({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.put('/api/plant-state-info/' + payload.id, payload)
      }
    } catch (e) {
      return e
    }
  },
}
