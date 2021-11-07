<template>
  <nav class="navbar is-light">
    <div class="container">
      <div class="navbar-brand">
        <nuxt-link class="navbar-item" to="/">Nuxt Auth</nuxt-link>
      </div>
      <div class="navbar-menu">
        <div class="navbar-end">
          <div class="navbar-item has-dropdown is-hoverable" v-if="isAuthenticated">
            <nuxt-link class="navbar-item" to="/profile">{{ loggedInUser.email }}</nuxt-link>
            <a class="navbar-item"  @click="logout">Logout</a>
          </div>
          <template v-else>
            <nuxt-link class="navbar-item" to="/auth/register">Register</nuxt-link>
            <nuxt-link class="navbar-item" to="/auth/login">Log In</nuxt-link>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>
<script>
  import { mapGetters } from 'vuex'
  export default {
    computed: {
      ...mapGetters(['isAuthenticated', 'loggedInUser']),
      user () {
        return this.$store.state.user.myProfile.user
      }
    },
    methods: {
      async logout () {
        await this.$auth.logout();
      }
    }
  }
</script>
