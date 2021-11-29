import axios from 'axios'
import { agricultureSettingService } from '../../services/agricultureSetting.service'
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

  create ({ commit }, payload) {
    return axios.post('/api/agriculture-plant', payload).then(
      response => {
        return Promise.resolve(response.data)
      },
      error => {
        return Promise.reject(false)
      }
    )
  },

  async update ({ commit }, payload) {
    return await axios.put('/api/agriculture-plant/' + payload.id, payload).then(
      response => {
        return Promise.resolve(response.data)
      },
      error => {
        return Promise.reject(false)
      }
    )
  },
  async getPlantAgricultureManagement ({ commit }, payload) {
    try {
      return await axios.get('/api/management-agriculture/', { params: payload })
    } catch (error) {
      return error.reponse
    }
  },
  async getPlantAgricultureDetail ({ commit }, payload) {
    return agricultureSettingService.getPlantAgricultureDetail(payload)
      .then(response => {
        return Promise.resolve(response.data)
      },
      () => {
        // eslint-disable-next-line prefer-promise-reject-errors
        return Promise.reject(false)
      })
      .catch(() => {
        // eslint-disable-next-line prefer-promise-reject-errors
        return Promise.reject(false)
      })
  },
  async savePlantAgriculture ({ commit }, payload) {
    try {
      return await axios.put('/api/management-agriculture/savePlantAgriculture/' + payload.id, payload.body)
    } catch (error) {
      return error.reponse
    }
  }

}
