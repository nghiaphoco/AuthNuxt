<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Login</h1>
        <p>{{ error }}</p>
        <form>
          <div class="form-group">
            <label>Email address</label>
            <input v-model="email" type="email" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input v-model="password" type="password" class="form-control" />
          </div>
          <div class="form-check">
            <input id="exampleCheck1" type="checkbox" class="form-check-input">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="button" class="btn btn-primary" @click="login">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        email: 'nghiadh@relipasoft.com',
        password: '123456',
        error: ''
      }
    },
    methods: {
      async login () {
        await this.$auth.loginWith('local', { data: { email: this.email, password: this.password } })
          .then((res) => {
            // this.$auth.setToken('local', 'Bearer ' + res.data.token);
            // this.$auth.setStrategy('local');
            // this.$store.commit('user/SET_MY_PROFILE', {})
            if (res.data.status === true) {
              this.$router.push('/')
            } else {
              this.error = 'Login false'
            }
          })
        // try {
        //   await this.$auth.loginWith('local', {
        //     data: { email: this.email, password: this.password }
        //   }).then((res) => {
        //     if (res.data.success === true) {
        //       this.$router.push('/')
        //     } else {
        //       this.error = 'Login false'
        //     }
        //   })
        // } catch (e) {
        //   this.error = 'Login falses'
        // }

      }
    }
  }
</script>
