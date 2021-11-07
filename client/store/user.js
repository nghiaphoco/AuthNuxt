import { callApiUseProfile } from '../apis/user'
export const state = () => ({
  myProfile: {}
})

export const mutations = {
  SET_MY_PROFILE (state, myProfile) {
    state.myProfile = myProfile
  }
}

export const actions = {
  async setMyProfile ({ commit }, { axios, token } ) {
    const { data } = await callApiUseProfile(axios, token)
    if (data.status === true) {
      return commit('SET_MY_PROFILE', data.response)
    }
    return null
  }
}
