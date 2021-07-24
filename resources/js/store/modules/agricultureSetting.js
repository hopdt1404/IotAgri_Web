import axios from 'axios'

// state
export const state = {

}

// getters
export const getters = {

}

// mutations
export const mutations = {

}

export const actions = {
  getFarmAgricultureSetting ({ commit }, payload) {
    return axios.get('/api/farm/getFarmAgricultureSetting').then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
  },

  create({ commit }, payload)
  {
    return axios.post('/api/agriculture-plant', payload).then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
  },

  async update({ commit }, payload) {
    return await axios.put('/api/agriculture-plant/' + payload.id, payload).then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
  },
  getAgriculturePlantDetail({ commit }, payload) {
    return axios.get('/api/agriculture-plant/' + payload.FarmID, {params: payload}).then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
  }
}
