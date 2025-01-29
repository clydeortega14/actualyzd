

<template>
    <div class="py-4 px-3">

        <div class="alert alert-danger" role="alert" v-if="errors.length > 0">
            <ul class="list-unstyled">
                <li v-for="(err, index) in errors" :key="index">{{ err }}</li>
            </ul>
        </div>

        <form multipart="enctype/form-data" method="POST">
            <div class="form-group row">
                <label for="firstname" class="col-form-label col-sm-3 text-md-right">Firstname</label>
                <div class="col-sm-6">
                    <input type="text" id="firstname" v-model="create_psychologist_form_data.firstname" name="firstname" placeholder="Enter Firstname" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="lastname" class="col-form-label col-sm-3 text-md-right">Lastname</label>
                <div class="col-sm-6">
                    <input type="text" id="lastname" v-model="create_psychologist_form_data.lastname" name="lastname" placeholder="Enter lastname" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-form-label col-sm-3 text-md-right">Email</label>
                <div class="col-sm-6">
                    <input type="email" id="email" v-model="create_psychologist_form_data.email" name="email" placeholder="Enter email" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-form-label col-sm-3 text-md-right">Password</label>
                <div class="col-sm-6">
                    <input type="password" id="password" v-model="create_psychologist_form_data.password" name="password" placeholder="Enter Password" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="retype-password" class="col-form-label col-sm-3 text-md-right">Confirm Password</label>
                <div class="col-sm-6">
                    <input type="password" id="retype-password" v-model="create_psychologist_form_data.password_confirmation" name="password_confirmation" placeholder="Enter retype-password" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="resume" class="col-form-label col-sm-3 text-md-right" >Resume/CV</label>
                <div class="col-sm-6">
                    <input type="file" id="Retype Password" v-on:change="resumeInput" ref="resumeorcv" name="Retype Password" placeholder="Enter Retype Password" class="form-control-input">
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-6 offset-md-3">
                <button type="submit" class="btn btn-primary" @click.prevent="submitCreatePsychologist">Submit</button>
                <button class="btn btn-danger" @click="clickedCancelCreatePsychologist">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>

    import { mapActions } from "vuex";
    import SweetAlert from "../../mixins/sweet-alert";

    export default {
        name: "CreatePsychologistForm",
        data(){
            return {
                create_psychologist_form_data: {
                    role_name: 'psychologist',
                    firstname: '',
                    lastname: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    resume: []
                },
                errors: []
            }
        },
        mixins: [SweetAlert],
        methods: {
            ...mapActions(["storePsychologist"]),
            submitCreatePsychologist(e){

                this.storePsychologist({
                    'role_name': this.create_psychologist_form_data.role_name,
                    'firstname': this.create_psychologist_form_data.firstname,
                    'lastname': this.create_psychologist_form_data.lastname,
                    'email': this.create_psychologist_form_data.email,
                    'password': this.create_psychologist_form_data.password,
                    'password_confirmation': this.create_psychologist_form_data.password_confirmation,
                    'resume': [...this.create_psychologist_form_data.resume]
                })
                    .then(res => {
                        let response_data = res.data;
                        let error_response = response_data.error;

                        if(error_response){

                            this.errors = [...response_data.data]
                        }

                        if(!error_response){
                            
                            this.clearInputFields();

                            EventBus.$emit('on-succesfull-psychologist-creation', response_data);

                            this.errors = [];
                       }
                    })
                    .catch(err => {
                        this.error(err)
                    });

                // submit create psychologist to backend api

            },
            resumeInput(){
                
                const files = this.$refs.resumeorcv.files;

                this.create_psychologist_form_data.resume = [...files];

            },
            clickedCancelCreatePsychologist()
            {
                EventBus.$emit('clicked-cancel-create-psychologist');
                this.clearInputFields();
            },
            clearInputFields()
            {
                this.create_psychologist_form_data.firstname = '';
                this.create_psychologist_form_data.lastname = '';
                this.create_psychologist_form_data.role_name = 'psychologist';
                this.create_psychologist_form_data.email = '';
                this.create_psychologist_form_data.password = '';
                this.create_psychologist_form_data.password_confirmation = '';
                this.create_psychologist_form_data.resume = [];
            }
        }
    }
</script>