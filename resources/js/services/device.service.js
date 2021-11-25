import axios from 'axios'
import config from '../app.config'

// eslint-disable-next-line no-var
export var deviceService
export default deviceService = {
  getListDeviceSelectOfFarmPlot
}

async function getListDeviceSelectOfFarmPlot (data) {
  return await axios.get(`${config.API_BASE_ULR}/device/getListDeviceSelectOfFarmPlot`, { params: data })
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
