<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-card-title primary-title>
                <div>
                    <h3 class="headline mb-0">User Details</h3><br>
                    <div> 
                      <b>created at:</b> {{userdetails.created_at}}<br>
                      <b>email:</b> {{userdetails.email}}<br>
                      <b>email_verified_at:</b> {{userdetails.email_verified_at}}<br>
                      <b>id:</b> {{userdetails.id}}<br>
                      <b>name:</b> {{userdetails.name}}<br>
                      <b>updated_at:</b> {{userdetails.updated_at}}<br>
                    </div>
                </div>
                </v-card-title>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" to="/photobook">Photobook</v-btn>
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
        userdetails:{
                    created_at: '',
                    email: '',
                    email_verified_at: null,
                    id: null,
                    name:'',
                    updated_at: ''
                }
      }
    },
    computed: {
      loginToken () {
        return this.$store.state.loginToken
      }
    },
    created(){
      //http://localhost:8000
      axios.post('/api/details', {}, {
                     'headers':{
                         'Authorization':'Bearer '+ this.loginToken
                     }
                 })
                        .then(response => {
                            console.log(response);
                            this.userdetails.created_at = response.data.success.created_at;
                            this.userdetails.email = response.data.success.email;
                            this.userdetails.email_verified_at = response.data.success.email_verified_at;
                            this.userdetails.id = response.data.success.id;
                            this.userdetails.name = response.data.success.name;
                            this.userdetails.updated_at = response.data.success.updated_at;
                        })
                        .catch(error => {
                            console.log(error);
                        });
    }
  }
</script>