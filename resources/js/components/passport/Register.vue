<template>
    
        
            <div class="container">
                <b>Name</b>
                <input type="text" v-model="username" placeholder="Enter Username"  required><br>

                <b>Email</b>
                <input type="text" v-model="email" placeholder="Enter Username"  required><br>

                <b>Password</b>
                <input type="password" v-model="password" placeholder="Enter Password"  required><br>

                <b>Confirm Password</b>
                <input type="password" v-model="cpassword" placeholder="Enter Password"  required><br>

                <button type="submit" @click="onRegister()">Sign Up</button><br>

                <button type="submit" @click="afterRegister()" v-if="checkBtn">Check Details</button><br>

                <div class="container" v-if="checkDiv">
                    <h3>Details</h3>
                    
                    <b>created at:</b> {{details.created_at}}<br>
                    <b>email:</b> {{details.email}}<br>
                    <b>email_verified_at:</b> {{details.email_verified_at}}<br>
                    <b>id:</b> {{details.id}}<br>
                    <b>name:</b> {{details.name}}<br>
                    <b>updated_at:</b> {{details.updated_at}}<br>

                </div>
               </div>
        
        
        
</template>

<script>
    export default {
        data() {
            return {
                loginToken: '',
                username : '',
                email : '',
                password : '',
                cpassword : '',
                checkBtn: false,
                checkDiv: false,

                details:{
                    created_at: '',
                    email: '',
                    email_verified_at: null,
                    id: null,
                    name:'',
                    updated_at: ''
                }
            };
        },
        methods:{
            onRegister(){
                axios.post('/api/register', {
                    'name' : this.username,
                    'email': this.email,
                    'password': this.password,
                    'c_password' : this.cpassword
                })
                        .then(response => {
                            console.log(response);
                            this.loginToken = response.data.success.token;
                            this.checkBtn = true;
                        })
                        .catch(error => {
                            console.log(error);
                        });
            },
            afterRegister(){
                 axios.post('/api/details', {}, {
                     'headers':{
                         'Authorization':'Bearer '+ this.loginToken
                     }
                 })
                        .then(response => {
                            console.log(response);
                            this.checkDiv = true;

                            this.details.created_at = response.data.success.created_at;
                            this.details.email = response.data.success.email;
                            this.details.email_verified_at = response.data.success.email_verified_at;
                            this.details.id = response.data.success.id;
                            this.details.name = response.data.success.name;
                            this.details.updated_at = response.data.success.updated_at;
                        })
                        .catch(error => {
                            console.log(error);
                        });
            }
        },
    }
</script>
