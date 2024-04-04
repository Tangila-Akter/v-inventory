<template>
  <div>
    <h2>Login</h2>
    <input v-model="email" type="text" placeholder="Email">
    <input v-model="password" type="password" placeholder="Password">
    <button @click="login">Login</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    login() {
      axios.post('http://127.0.0.1:8000/api/login', {
        email: this.email,
        password: this.password
      })
      .then(response => {
        // Handle successful login
        console.log(response.data);
        // Redirect or perform other actions after login
      })
      .catch(error => {
        // Handle login error
        console.error(error);
      });
    }
  }
}
</script>