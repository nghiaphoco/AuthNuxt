export function callApiUseProfile(axios, token) {
  return this.$axios.post('/auth/user/profile', token )
}
//
// export function callApiAuthUserProfile (axios, token, locale) {
//   return putBase(axios, '/auth/user/profile', {}, token, locale)
// }
