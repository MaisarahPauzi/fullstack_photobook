<template>
  <v-app>
    <v-toolbar app>
      <v-toolbar-title to="/" class="headline text-uppercase">
        <span>PHOTOBOOK</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
    <v-toolbar-items>
      <v-btn flat v-if="!isLoggedin" to="/login">Login</v-btn>
      <v-btn flat v-if="!isLoggedin" to="/register">Sign Up</v-btn>
      <v-btn flat v-if="isLoggedin" @click="loggedOut">Logout</v-btn>
    </v-toolbar-items>
    </v-toolbar>

    <v-content>
      <router-view/>
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: 'App',
  
  data () {
    return {
      //
    }
  },
  computed: {
    isLoggedin () {
          return this.$store.state.isLoggedin
    }
  },
  methods:{
    loggedOut(){
      this.$store.commit('loggedOut');
    }
  }
}
</script>