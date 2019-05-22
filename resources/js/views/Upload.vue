<template>
  <v-container grid-list-xl>
    <v-layout align-center justify-center>
      <v-flex xs12 sm6 md6>
        <v-card>
          <v-card-title primary-title>
              <div>
                <h3 class="headline mb-0">Upload Picture</h3>
              </div>
            </v-card-title>
            <div align="center">
                <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                <v-text-field label="Title" placeholder="Insert title" box v-model="title"></v-text-field>
                <v-text-field label="Caption" placeholder="Insert caption" box v-model="caption"></v-text-field>
            </div>
            <div align="right">
              <v-btn color="info" v-on:click="submitData()">Submit</v-btn>
              <v-btn to="/photobook">Back</v-btn>
            </div>
            
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios';
export default {
  name: 'upload',
  data () {
    return {
      title:'',
      caption:'',
      images:[],
      file: '',
      items:[],
    }
  },
  computed: {
      loginToken () {
        return this.$store.state.loginToken
      }
    },
  created() {
  },
  methods:{
        submitData(){
        axios.post( '/api/photobook',
                {
                  "title":this.title,
                  "caption":this.caption,
                  "filename":this.file.name
                },
                {
                     'headers':{
                         'Authorization':'Bearer '+ this.loginToken
                         }
                }).then(function(){
          console.log('success');
          
        })
        .catch(function(){
          console.log('failed');
        });
        this.title = '';
        this.caption = '';
        this.file = '';
        this.$router.push('photobook');
      },
      handleFileUpload(){
        this.file = this.$refs.file.files[0];
        
            let fileData = new FormData();
            fileData.append('file', this.file);
            axios.post( '/api/upload',
                fileData,
                {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization':'Bearer '+ this.loginToken
                }
              }
            ).then(function(){
          console.log('success');
        })
        .catch(function(){
          console.log('failed');
        });
      
      }
  }
}
</script>

<style>
</style>