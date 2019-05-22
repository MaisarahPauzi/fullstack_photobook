<template>
  <div class="text-xs-center">
    <v-dialog
      v-model="dialog"
      width="500"
    >
      <v-btn slot="activator"  color="info">
        <v-icon>edit</v-icon>EDIT
     </v-btn>

      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Edit Image Details {{newfilename}}
        </v-card-title>

        <v-card-text>
          <v-text-field label="New Title"  box v-model="newtitle"></v-text-field>
          <v-text-field label="New Caption"  box v-model="newcaption"></v-text-field>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          
          <v-btn
            color="primary"
            flat
            @click="updateData()"
          >
            SAVE
          </v-btn>
          <v-btn
            color="primary"
            flat
            @click="onExit()"
          >
            EXIT
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import axios from 'axios';
export default {
      props:{
          id:{
            type: String,
            required: true
          },
          title: {
            type: String,
            required: true
        },
        caption:{
            type: String,
            required:true
        },
        filename:{
            type: String,
            required:true
        }
      },
    data () {
      return {
        item_id: this.id,
        newtitle: this.title,
        newcaption: this.caption,
        newfilename: this.filename,
        dialog: false
      }
    },
    computed: {
      loginToken () {
        return this.$store.state.loginToken
      }
    },
    methods:{
      updateData(){
        axios.put( '/api/photobook/'+this.item_id,
                {
                  "title":this.newtitle,
                  "caption":this.newcaption,
                  "filename":this.newfilename
                },
                {
                     'headers':{
                         'Authorization':'Bearer '+ this.loginToken
                         }
    }).then(function(res){
          console.log(res.data.data);
        })
        .catch(function(){
          console.log('failed');
        });
        this.$emit('update:title', this.newtitle);
        this.$emit('update:caption', this.newcaption);
        this.dialog = false;
      },
    onExit(){
        this.dialog = false;
    }
    }
  }
</script>