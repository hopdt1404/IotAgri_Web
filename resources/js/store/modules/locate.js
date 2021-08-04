import axios from 'axios'

// state
export const state = {}

// getters
export const getters = {}

// mutations
export const mutations = {}

export const actions = {
  async getLocate ({ commit }, data) {
    try {
      return await axios.get('/api/locate')
    } catch (error) {
      return error.response
    }
  }
}
