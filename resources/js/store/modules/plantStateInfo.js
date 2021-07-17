import axios from 'axios'

export const actions = {
  async create({ commit }, payload) {
    try {
      return await axios.post('/api/plant-state-info', payload)
    } catch (e) {
      return JSON.stringify(e)
    }
  },
}
