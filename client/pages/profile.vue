<template>
  <div>
    <div class="container">
      <p>Id: {{ loggedInUser.id }}</p>
      <p>Name: {{ loggedInUser.name }}</p>
      <p>Email: {{ loggedInUser.email }}</p>
    </div>
  </div>
</template>
<script>
  import { mapGetters } from 'vuex'

  export default {
    middleware: 'auth',
    computed: {
      ...mapGetters(['loggedInUser'])
    }
  }
</script>
