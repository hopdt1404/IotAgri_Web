import axios from 'axios'
import config from '../app.config'

export let managementAgricultureService
export default managementAgricultureService = {
  createFarmPlant,
  updateFarmPlant,
}

async function createFarmPlant (data) {
  return await axios.post(`${config.API_BASE_ULR}/management-agriculture`, data)
    .then(response => {
      if (response.data && response.data.success) {
        return Promise.resolve(response.data)
      } else {
        return Promise.reject(response)
      }
    })
    .catch(error => {
      return Promise.reject(error)
    })
}

async function updateFarmPlant (data) {
  return await axios.put(`${config.API_BASE_ULR}/management-agriculture/${data.id}`, data)
    .then(response => {
      if (response.data && response.data.success) {
        return Promise.resolve(response.data)
      } else {
        return Promise.reject(response)
      }
    })
    .catch(error => {
      return Promise.reject(error)
    })
}
