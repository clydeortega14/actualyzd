<style scoped>
	.container {
		max-width: 500 !important;
		margin: auto;
		margin-top: 4%;
		font-family: sans-serif;
		letter-spacing: 0.5px;
	}

</style>

<template>
	<div class="container">

		<ChatHeader />

		
	</div>
</template>

<script>

	import ChatHeader from './ChatHeader.vue';
	
	export default {

		name: "ChatComponent",
		components: {
			ChatHeader
		}
	}
</script>