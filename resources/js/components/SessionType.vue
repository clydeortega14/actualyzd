<template>
	<div class="card mb-3">
		<div class="card-header">
			Session Fields
		</div>

		<div class="card-body">
			<div class="form-group">
				<label for="session_type_id">Session Type</label>
				<select class="form-control" v-model="session_selected">
					<option value="" selected disabled>Choose type of session</option>
					<option :value="session_type.id" v-for="session_type in allSessionTypes" :key="session_type.id">
						{{ session_type.name}}
					</option>
				</select>
			</div>

			<div class="form-group" v-if="show.client">
				<label>Client</label>
				<select class="form-control" v-model="client_selected" required>
					<option value="" selected disabled>- Choose a client -</option>
					<option :value="client.id" v-for="client in getAllClients" :key="client.id">{{ client.name}}</option>
				</select>
			</div>

			<div class="form-group" v-if="show.participants">
				<label>Participants</label>
				<div class="form-check ml-2" v-for="(user, index) in allClientUsers" :key="index">
					<input type="checkbox" class="form-check-input" :value="user.id" :id="user.id">
					<label class="form-check-label">{{ user.name }}</label>
				</div>
			</div>

			<div class="form-group" v-if="show.counselee" required>
				<label>Counselee</label>
				<select class="form-control" v-model="counselee_selected">
					<option value="" selected disabled>- Choose a counselee -</option>
					<option  v-for="(user, index) in allClientUsers" :key="index" :value="user.id">{{ user.name }}</option>
				</select>
			</div>
		</div>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex';

	export default {
		data(){

			return {
				session_selected: this.session,
				client_selected: this.client,
				counselee_selected: this.counselee,
				show: {
					client: false,
					counselee: false,
					participants: false
				},
				session_types: [],
				clients: []

			}
		},
		props:["session", "client", "counselee"],
		computed: {
			...mapGetters(["allClientUsers", "getAllClients", "allSessionTypes"])
		},
		created(){
			this.getSessionTypes();
			this.getClients();
		},
		watch: {
			session_selected(id){

				this.$emit('session-selected', id);
				if(id === 1){
					this.show.client = true;
					this.show.counselee = true;
					this.show.participants = false;
				}else if(id === 2 || id === 3){

					this.show.counselee = false;
					this.show.client = true;
				}else{

					this.show.counselee = false;
					this.show.client = false;
				}
			},
			client_selected(client_id){
				if(this.session_selected !== 1){
					this.show.participants = true;
				}
				this.$emit('client-selected', client_id);
				this.getClientUsers(client_id)
			},
			counselee_selected(counselee_id)
			{
				this.$emit('counselee-selected', counselee_id);
			}
		},
		methods: {
			...mapActions(["getClientUsers", "getClients", "getSessionTypes"])
		}
	}
</script>