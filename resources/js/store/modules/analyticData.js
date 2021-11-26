import analyticDataService from '../../services/analyticData.service'

// state
export const state = {}

// getters
export const getters = {}

// mutations
export const mutations = {}

export const actions = {
  getDataAnalytics ({ commit }, data) {
    return analyticDataService.getDataAnalytics(data)
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
  getAnalyticDataSevenDayNearest ({ commit }, data) {
    return analyticDataService.getAnalyticDataSevenDayNearest(data)
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
  }
}
