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
  getFarmAgricultureSetting ({ commit }, payload) {
    return axios.get('/api/farm/getFarmAgricultureSetting').then(
      response => {
        return Promise.resolve(response.data);
      },
      error => {
        return Promise.reject(false);
      }
    )
}
