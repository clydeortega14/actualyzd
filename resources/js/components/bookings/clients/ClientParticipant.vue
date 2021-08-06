<template>
	<div>
		<div class="form-group row mt-4">
			<label class="col-form-label text-md-right col-sm-4" required>Select Client</label>
			<div class="col-sm-6">
			    <select name="client" class="form-control" v-model="selected_client" @change="getUsers">
			    	<option :value="null" disabled selected>Choose Client</option>
			    	<option v-for="client in clients" :key="client.id" :value="client.id">{{ client.name }}</option>
			    </select>
			</div>
		</div>

		<div class="form-group row mt-3">
			<div class="col-md-6 offset-md-4">
				<table class="table mt-4">
					<thead>
						<tr>
							<th>
								<input type="checkbox">
							</th>
						    <th>Participants</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="participant in participants" :key="participant.id">
							<td>
								<input type="checkbox" name="participants[]" :value="participant.id">
							</td>
							<td>{{ participant.name }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "ClientParticipant",
		data(){
			return {
				selected_client: null,
				participants: []
			}
		},
		props: {
			clients: Array
		},
		created(){
			console.log(this.clients)
		},
		methods: {
			getUsers(){
				let client = this.clients.find(client => client.id == this.selected_client);
				if(client !== undefined){
					this.participants = client.users;
				}
			}
		}
	}
</script>