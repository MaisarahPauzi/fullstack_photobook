<template>
  <v-container grid-list-xl>
    <v-btn fixed
              dark
              fab
              right
              bottom
              color="pink"
              to="/upload">
      <v-icon dark>add</v-icon>
    </v-btn>
    <v-layout align-center justify-center v-for="item of items" v-bind:key="item.id">
      <v-flex xs12 sm8 md6>
        <v-card>
          <v-img
              v-bind:src="img_src+item.filename" 
              aspect-ratio="1"
            ></v-img>

            <v-card-title primary-title>
              <div>
                <h3 class="headline mb-0">{{item.title}}</h3>
                <p>{{item.caption}}</p>
              </div>
            </v-card-title>
            <v-card-actions>
                  <v-spacer></v-spacer>
                  <Popup :id="item.id" :title.sync="item.title" :caption.sync="item.caption" :filename="item.filename" ></Popup>
                  
                  <v-btn  color="error" @click="deleteData(item,index)">
                    <v-icon>delete</v-icon>DELETE
                  </v-btn>
            </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios';
import Popup from './Popup';
export default {
  name: 'HelloWorld',
  components:{
      Popup,
    },
  data () {
    return {
      img_src:'http://maipau-storage.s3-us-west-2.amazonaws.com/images/',
      items:[],
    }
  },
  computed: {
      loginToken () {
        return this.$store.state.loginToken
      }
    },
  created() {
    axios.get(`/api/photobook`,{
                     'headers':{
                         'Authorization':'Bearer '+ this.loginToken
                         }
    })
    .then(response => {
      // JSON responses are automatically parsed.
      this.items = response.data.data
    })
    .catch(e => {
      this.errors.push(e)
    });
    
  },
  methods:{
    refreshData(){
        //refresh data
    axios.get(`/api/photobook`,{
                     'headers':{
                         'Authorization':'Bearer '+ this.loginToken
                         }
    })
    .then(response => {
      // JSON responses are automatically parsed.
      this.items = response.data.data
    })
    .catch(e => {
      this.errors.push(e)
    });
    },
    deleteData(item,index){
        axios.delete( '/api/photobook/'+item.id ,{
                     'headers':{
                         'Authorization':'Bearer '+ this.loginToken
                         }
    }).then(function(){
          console.log('success delete record');
        })
        .catch(function(){
          console.log('failed delete record');
        });
        axios.delete( '/api/delPhoto/'+item.filename,{
                     'headers':{
                         'Authorization':'Bearer '+ this.loginToken
                         }
    }).then(function(){
          console.log('success delete file');
        })
        .catch(function(){
          console.log('failed delete file');
        });
       this.refreshData();
      }
  }
}
</script>

<style>
</style>