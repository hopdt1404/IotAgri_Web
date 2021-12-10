import axios from 'axios'
import config from '../app.config'

export let agricultureSettingService

export default agricultureSettingService = {
  getPlantAgricultureDetail,
  savePlantAgriculture,
  getAgriculturePlantDetail,
}

async function getPlantAgricultureDetail(data) {
  return await axios.get(`${config.API_BASE_ULR}/management-agriculture/detail`, { params: data })
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
async function getAgriculturePlantDetail(data) {
  return await axios.get(`${config.API_BASE_ULR}/agriculture-plant/detail`, { params: data })
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

async function savePlantAgriculture(data) {
  return await axios.get(`${config.API_BASE_ULR}/management-agriculture/detail`, { params: data })
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

