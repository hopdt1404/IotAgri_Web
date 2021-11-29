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
  async getFarmAgricultureSetting ({ commit }, payload) {
    try {
      return await axios.get('/api/farm/getFarmAgricultureSetting')
    } catch (error) {
      return error.response
    }
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
    return axios.get('/api/agriculture-plant/' + payload.PlotID, {params: payload}).then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
  },
  async getPlantAgricultureManagement({ commit }, payload) {
    try {
      return await axios.get('/api/management-agriculture/', {params: payload})
    } catch (error) {
      return error.reponse
    }
  },
  async getPlantAgricultureDetail({ commit }, payload) {
    try {
      return await axios.get('/api/management-agriculture/detail/' + payload.id, {params: payload.query})
    } catch (error) {
      return error.reponse
    }
  },
  async savePlantAgriculture({ commit }, payload) {
    try {
      return await axios.put('/api/management-agriculture/savePlantAgriculture/' + payload.id, payload.body)
    } catch (error) {
      return error.reponse
    }
  },

}
