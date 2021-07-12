import axios from 'axios'

export const actions = {
  async getFarm({ commit }, payload) {
    try {
      const data = await axios.get('/api/farm')
      return data
    } catch (e) {
      return e
    }
  },

  async create({ commit }, payload) {
    try {
      const data = await axios.post('/api/farm', payload)
      return data
    } catch (e) {
      return e
    }
  }
}
