

<template>
    <div class="py-4 px-3">
        <form multipart="enctype/form-data" method="POST">
            <div class="form-group row">
                <label for="firstname" class="col-form-label col-sm-3 text-md-right">Firstname</label>
                <div class="col-sm-6">
                    <input type="text" id="firstname" name="firstname" placeholder="Enter Firstname" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="lastname" class="col-form-label col-sm-3 text-md-right">Lastname</label>
                <div class="col-sm-6">
                    <input type="text" id="lastname" name="lastname" placeholder="Enter lastname" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-form-label col-sm-3 text-md-right">Email</label>
                <div class="col-sm-6">
                    <input type="email" id="email" name="email" placeholder="Enter email" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-form-label col-sm-3 text-md-right">Password</label>
                <div class="col-sm-6">
                    <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="retype-password" class="col-form-label col-sm-3 text-md-right">Retype Password</label>
                <div class="col-sm-6">
                    <input type="password" id="retype-password" name="retype-password" placeholder="Enter retype-password" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="resume" class="col-form-label col-sm-3 text-md-right">Resume/CV</label>
                <div class="col-sm-6">
                    <input type="file" id="Retype Password" name="Retype Password" placeholder="Enter Retype Password" class="form-control-input">
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
                    retype_password: '',
                    resume: ''
                }
            }
        },
        methods: {
            submitCreatePsychologist(e){
                alert('test')
                // submit create psychologist to backend api

            },
            clickedCancelCreatePsychologist()
            {
                EventBus.$emit('clicked-cancel-create-psychologist');
            }
        }
    }
</script>