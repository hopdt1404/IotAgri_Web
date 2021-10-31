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
  async getPlant ({ commit }, payload) {
    try {
      return await axios.get('/api/plant')
    } catch (error) {
      return error.response
    }
  },
  async create ({ commit }, payload) {
    try {
      return await axios.post('/api/plant', payload)
    } catch (error) {
      return error.response
    }
  },
  async getPlantDetail ({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.get('/api/plant/' + payload.id)
      }
    } catch (error) {
      return error.response
    }
  },
  async update ({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.put('/api/plant/' + payload.id, payload)
      }
    } catch (error) {
      return error.response
    }
  },
  async getPlantType ({ commit }, payload) {
    try {
      return await axios.get('/api/plant_type')
    } catch (error) {
      return error.response
    }
  },
  async getSoilType ({ commit }, payload) {
    try {
      return await axios.get('/api/soil_type')
    } catch (e) {
      return e
    }
  },
  async getPlantState ({ commit }, payload) {
    try {
      return await axios.get('/api/plant-state')
    } catch (error) {
      return error.response
    }
  },
  async getPlantSettingFarm ({ commit }, payload) {
    try {
      return await axios.get('/api/plant/getPlantSettingFarm')
    } catch (error) {
      return error.response
    }
  },

  async getPlantOfFarm ({ commit }, payload) {
    try {
      return await axios.get('/api/plant/getPlantOfFarm', { params: payload })
        .then(
          response => {
            if (response.status === 200 && response.data) {
              return response.data
            } else {
              return response
            }
          },
          error => {
            return error.response.data
          })
    } catch (error) {
      return error.response
    }
  },
  async getPlantAssignOfDevice ({ commit }, payload) {
    try {
      return await axios.get('/api/plant/getPlantAssignOfDevice', { params: payload })
        .then(
          response => {
            if (response.status === 200 && response.data) {
              return response.data
            } else {
              return response
            }
          },
          error => {
            return error.response.data
          })
    } catch (error) {
      return error.response
    }
  }

}
