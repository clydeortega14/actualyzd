<template>
	<div class="card mb-3">
		<div class="card-header">
			Session Fields
		</div>

		<div class="card-body">
			<div class="form-group">
				<label for="session_type_id">Session Type</label>
				<select class="form-control" v-model="session_selected">
					<option value="">Choose type of session</option>
					<option :value="session_type.id" v-for="session_type in session_types" :key="session_type.id">
						{{ session_type.name}}
					</option>
				</select>
			</div>

			<div class="form-group" v-if="show.client">
				<label>Client</label>
				<select class="form-control" v-model="client_selected" required>
					<option value="">- Choose a client -</option>
					<option :value="client.id" v-for="client in clients" :key="client.id">{{ client.name}}</option>
				</select>
			</div>

			<div class="form-group" v-if="show.counselee" required>
				<label>Counselee</label>
				<select class="form-control" v-model="counselee_selected">
					<option value="">- Choose a counselee -</option>
					<option value="1">juan dela cruz</option>
					<option value="2">nonito del grande</option>
					<option value="3">julio cesar</option>
				</select>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data(){

			return {
				session_selected: this.session,
				client_selected: this.client,
				counselee_selected: this.counselee,
				show: {
					client: false,
					counselee: false
				},
				session_types: [],
				clients: []

			}
		},
		props:["session", "client", "counselee"],
		created(){
			this.session_types = [
				{ id: 1, name: 'Individual'},
				{ id: 2, name: 'Group Session'},
				{ id: 3, name: 'Webinar'}
			];

			this.clients = [
				{ id: 1, name: 'San Miguel Corp'},
				{ id: 2, name: 'Lalamove'},
				{ id: 3, name: 'Concentrix'},
			];
		},
		watch: {
			session_selected(id){

				this.$emit('session-selected', id);

				if(id === 1){
					this.show.client = true;
					this.show.counselee = true;
				}else if(id === 2 || id === 3){

					this.show.counselee = false;
					this.show.client = true;
				}else{

					this.show.counselee = false;
					this.show.client = false;
				}
			},
			client_selected(client_id){
				this.$emit('client-selected', client_id);
			},
			counselee_selected(counselee_id)
			{
				this.$emit('counselee-selected', counselee_id);
			}
		}
	}
</script>