<style scoped>
	img {
		max-width: 100%;
		border-radius: 50%;
	}
	.chat-header {
		border: 1px solid #ccc;
		width: 100%;
		height: 10%;
		border-bottom: none;
		display: inline-block;
		background-color: #007bff;
	}
	.chat-header-img {
		border-radius: 50%;
		width: 40px;
		margin-left: 3%;
		margin-top: 10px;
		margin-bottom: 10px;
		float: left;
	}
</style>

<template>

	<div class="chat-header">
		<div class="chat-header-img">
			<img src="/images/profile.png">
		</div>
	</div>
</template>

<script>
	
	export default {
		name: "ChatHeader"
	}
</script>