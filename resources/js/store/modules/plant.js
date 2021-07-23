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
  async getPlant({ commit }, payload) {
    try {
      return await axios.get('/api/plant')
    } catch (e) {
      return e
    }
  },
  async create({ commit }, payload) {
    try {
      return await axios.post('/api/plant', payload)
    } catch (e) {
      return JSON.stringify(e)
    }
  },
  async getPlantDetail({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.get('/api/plant/' + payload.id )
      }
    } catch (e) {
      return e
    }
  },
  async update({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.put('/api/plant/' + payload.id, payload)
      }
    } catch (e) {
      return e
    }
  },
  async getPlantType({ commit }, payload) {
    try {
      return await axios.get('/api/plant_type')
    } catch (e) {
      return e
    }
  },
  async getSoilType({ commit }, payload) {
    try {
      return await axios.get('/api/soil_type')
    } catch (e) {
      return e
    }
  },
  async getPlantState({ commit }, payload) {
    return await axios.get('/api/plant-state').then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
    // try {
    //   return await axios.get('/api/plant-state')
    // } catch (e) {
    //   return e
    // }
  },
  async getPlantSettingFarm({ commit }, payload) {
    try {
      return await axios.get('/api/plant/getPlantSettingFarm')
    } catch (e) {
      this.$Notice.error({title: 'Error', desc: 'Request failed: ' + e.toString()})
      return e
    }
  },

   getPlantOfFarm({ commit }, payload) {
    return axios.get('/api/plant/getPlantOfFarm', {params: payload}).then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
  }

}


