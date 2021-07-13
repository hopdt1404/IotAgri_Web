import axios from 'axios'

export const actions = {
  async getDevice({ commit }, payload) {
    try {
      const data = await axios.get('/api/device')
      return data
    } catch (e) {
      return e
    }
  },
}
