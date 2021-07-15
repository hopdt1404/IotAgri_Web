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
     return await axios.post('/api/farm', payload)
    } catch (e) {
      return JSON.stringify(e)
    }
  },
  async getFarmDetail({ commit }, payload) {
    try {
      if (payload.id != 0) {
        const data = await axios.get('/api/farm/' + payload.id )
        return data
      }
    } catch (e) {
      return e
    }
  },
  async update({ commit }, payload) {
    try {
      if (payload.FarmID != 0) {
        const data = await axios.put('/api/farm/' + payload.FarmID, payload)
        return data
      }
    } catch (e) {
      return e
    }
  },
  async getFarmType({ commit }, payload) {
    try {
      const data = await axios.get('/api/farm_type')
      return data
    } catch (e) {
      return e
    }
  },
}
