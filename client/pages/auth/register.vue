<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Login</h1>
        <form>
          <div class="form-group">
            <label>Name</label>
            <input v-model="name" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label>Email address</label>
            <input v-model="email" type="email" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input v-model="password" type="password" class="form-control" />
          </div>
          <button type="button" class="btn btn-primary" @click="register">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        name: 'Dev',
        email: 'nghiadh@relipasoft.com',
        password: '123456'
      }
    },
    methods: {
      async register () {
        const res = await this.$axios.post('/auth/register', {
          name: 'Dev',
          email: this.email,
          password: '123456'
        })
        if (res.data.status === true) {
          this.$auth.setUserToken(res.data.token)
        }
      }
    }
  }
</script>
