<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Registration form</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <v-text-field prepend-icon="person" label="Username" type="text" v-model="username"></v-text-field>
                  <v-text-field prepend-icon="email" label="Email" type="text" v-model="email"></v-text-field>
                  <v-text-field prepend-icon="lock" label="Password" type="password" v-model="password"></v-text-field>
                  <v-text-field prepend-icon="lock" label="Confirm Password" type="password" v-model="c_password"></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="onRegister()">SIGN UP</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import axios from 'axios';
export default {
    data () {
        return {
          username:'',
          email : '',
          password : '',
          c_password : ''
        }
    },
    computed: {
        loginToken () {
          return this.$store.state.loginToken
        }
      },
    methods: {
        savetoken(token){
          this.$store.commit('savetoken', token)
        },
        onRegister(){
          //change URL from Laravel
                axios.post('/api/register', {
                    'name':this.username,
                    'email': this.email,
                    'password': this.password,
                    'c_password':this.c_password
                })
                        .then(response => {
                            console.log(response);
                            this.savetoken(response.data.success.token);
                            this.$router.push('/dashboard');
                        })
                        .catch(error => {
                            console.log(error);
                        });
            },
      }
  }
</script>