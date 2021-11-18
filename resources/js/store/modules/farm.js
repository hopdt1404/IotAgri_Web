import axios from 'axios'
import config from '../../app.config'

export const actions = {
  async getFarm({ commit }, payload) {
    try {
      return await axios.get('/api/farm')
    } catch (error) {
      return error.response
    }
  },

  async create({ commit }, payload) {
    try {
     return await axios.post('/api/farm', payload)
    } catch (error) {
      return error.response
    }
  },
  async getFarmDetail({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.get('/api/farm/' + payload.id )
      }
    } catch (error) {
      return error.response
    }
  },
  async update({ commit }, payload) {
    try {
      if (payload.FarmID != 0) {
        return await axios.put('/api/farm/' + payload.FarmID, payload)
      }
    } catch (error) {
      return error.response
    }
  },
  async getFarmType({ commit }, payload) {
    try {
      return await axios.get('/api/farm_type')
    } catch (error) {
      return error.response
    }
  },
  async setting({ commit }, payload) {
    try {
      return await axios.post('/api/farm/setting', payload)
    } catch (error) {
      return error.response
    }
  },
  async getListFarmOfUser({ commit }, payload) {
    return await axios.get('/api/farm/getListFarmOfUser').then(
      response => {
        if (response.status === 200 && response.data) {
          return response.data
        } else {
          return response
        }
      },
      error => {
        return error.response.data
      }
    )
  },

  async getListFarmSelect({ commit }, payload) {
    return await axios.get(`${config.API_BASE_ULR}/farm/getListFarmSelect`)
      .then(response => {
        if (response.data && response.data.data) {
          return Promise.resolve(response.data.data)
        } else {
          return Promise.reject(response.data)
        }
      }).catch(error =>{
        return Promise.reject(error)
      })
  }

}
