<template>
  <div>
    <h2>Signup</h2>
    <input v-model="email" type="text" placeholder="Email">
    <input v-model="password" type="password" placeholder="Password">
    <button @click="signup">Signup</button>
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
    signup() {
      axios.post('http://127.0.0.1:8000/api/signup', {
        email: this.email,
        password: this.password
      })
      .then(response => {
        // Handle successful signup
        console.log(response.data);
        // Redirect or perform other actions after signup
      })
      .catch(error => {
        // Handle signup error
        console.error(error);
      });
    }
  }
}
</script>