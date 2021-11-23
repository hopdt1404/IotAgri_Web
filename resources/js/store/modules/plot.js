import axios from 'axios'
import config from '../../app.config'

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
  async getListPlotOfFarm({ commit }, payload) {
    return await axios.get(`${config.API_BASE_ULR}/plot/getPlotOfFarm`, {params: payload})
      .then(response => {
        if (response.data && response.data.data) {
          return Promise.resolve(response.data.data)
        } else {
          return Promise.reject(response.data)
        }
      }).catch(error =>{
        return Promise.reject(error)
      })
  },
  async getListPlotOfFarmSelect({ commit }, payload) {
    return await axios.get(`${config.API_BASE_ULR}/plot/getListPlotOfFarmSelect`, {params: payload})
      .then(response => {
        if (response.data && response.data.data) {
          return Promise.resolve(response.data.data)
        } else {
          return Promise.reject(response.data)
        }
      }).catch(error =>{
        return Promise.reject(error)
      })
  },
  async getPlotDetail({ commit }, payload) {
    return await axios.get(`${config.API_BASE_ULR}/plot/${payload.PlotID}`)
      .then(response => {
        if (response.data && response.data.data) {
          return Promise.resolve(response.data.data)
        } else {
          return Promise.reject(response.data)
        }
      }).catch(error =>{
        return Promise.reject(error)
      })
  },
  async createPlot({ commit }, payload) {
    return await axios.post(`${config.API_BASE_ULR}/plot/`, payload)
      .then(response => {
        if (response.data) {
          return Promise.resolve(response.data)
        } else {
          return Promise.reject(response.data)
        }
      }).catch(error =>{
        return Promise.reject(error)
      })
  },
  async updatePlot({ commit }, payload) {
    return await axios.put(`${config.API_BASE_ULR}/plot/${payload.PlotID}`, payload)
      .then(response => {
        if (response.data) {
          return Promise.resolve(response.data)
        } else {
          return Promise.reject(response.data)
        }
      }).catch(error =>{
        return Promise.reject(error)
      })
  },

}
