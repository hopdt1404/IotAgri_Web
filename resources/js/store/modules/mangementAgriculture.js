import { managementAgricultureService } from '../../services/managementAgriculture.service'

export const state = {

}

// getters
export const getters = {

}

// mutations
export const mutations = {

}

export const actions = {
  createFarmPlant ({ commit }, data) {
    return managementAgricultureService.createFarmPlant(data)
      .then(response => {
        return Promise.resolve(response)
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
  updateFarmPlant ({ commit }, data) {
    return managementAgricultureService.updateFarmPlant(data)
      .then(response => {
        return Promise.resolve(response)
      },
      () => {
        // eslint-disable-next-line prefer-promise-reject-errors
        return Promise.reject(false)
      })
      .catch(() => {
        // eslint-disable-next-line prefer-promise-reject-errors
        return Promise.reject(false)
      })
  }

}
