import axios from 'axios'
import config from '../app.config'

// eslint-disable-next-line no-var
export var analyticsDataService
export default analyticsDataService = {
  getDataAnalytics,
  getAnalyticDataSevenDayNearest
}

async function getDataAnalytics (data) {
  return await axios.get(`${config.API_BASE_ULR}/analytics/getDataAnalytics`, { params: data })
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

async function getAnalyticDataSevenDayNearest (data) {
  return await axios.get(`${config.API_BASE_ULR}/analytics/analyticDataSevenDayNearest`, { params: data })
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
