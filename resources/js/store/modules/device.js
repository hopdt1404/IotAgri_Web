import axios from 'axios'

export const actions = {
  async getDevice({ commit }, payload) {
    try {
      return await axios.get('/api/device')
    } catch (error) {
      let status = error.response.status;
      if (status == 422 || status == 403) {

      }
      return error.response;
    }
  },
  async create({ commit }, payload) {
    try {
      return await axios.post('/api/device', payload)
    } catch (error) {
      return error.response
    }
  },
  async getDeviceDetail({ commit }, payload) {
    try {
      if (payload.id != 0) {
        return await axios.get('/api/device/' + payload.id )
      }
    }  catch (error) {
      return error.response
    }
  },
  async update({ commit }, payload) {
    try {
      if (payload.DeviceID != 0) {
        return await axios.put('/api/device/' + payload.DeviceID, payload)
      }
    } catch (error) {
      return error.response
    }
  },
  async getDeviceType({ commit }, payload) {
    try {
      return await axios.get('/api/device_type')
    } catch (error) {
      return error.response
    }
  },
  async getDeviceSettingFarm({ commit }, payload) {
    try {
      return await axios.get('/api/device/getDeviceSettingFarm')
    } catch (error) {
      return error.response
    }
  },
  async getDeviceOfFarm({ commit }, payload) {
    try {
      return await axios.get('/api/device/getDeviceOfFarm', {params: payload})
    } catch (error) {
      return error.response
    }
  },
  async getListDeviceSelectOfFarmPlant({ commit }, payload) {
    try {
      return await axios.get('/api/device/getListDeviceSelectOfFarmPlant', {params: payload})
        .then(response => {
          if (response.data && response.data.success) {
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
  async getDeviceAssignForPlantFarm({ commit }, payload) {
    try {
      return await axios.get('/api/device/getDeviceAssignForPlantFarm', {params: payload})
        .then(response => {
          if (response.data && response.data.success) {
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
  async getFarmAssignedDevice ({ commit }, payload) {
    try {
      return await axios.get('/api/device/getFarmAssignedDevice/' + payload.id)
        .then(response => {
          if (response.data && response.data.success) {
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
}
