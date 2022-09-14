<template>
	<div>
		<div class="mb-3">
			<button type="button" class="btn btn-outline-primary mb-3" @click="$emit('return-back')">
				<i class="fa fa-arrow-left"></i>
			</button>
			<h5 class="card-title">{{ faqQuestion }}</h5>
			<p class="card-text">{{ faqDesc }}</p>
		</div>
		<br />
		<hr>
		<div class="mt-3">
      <h5 class="card-title">Steps or Procedure</h5>
      <ol>
        <li v-for="(step, index) in faqSteps" :key="index">
          <p>{{ step.description }}</p>
          <div v-if="step.link != null">
          	<a :href="step.link">Click Here!</a>
          </div>
        </li>
      </ol>
    </div>
	</div>
</template>


<script>

	export default {

		name: "FAQSteps",
		props: {

			faqQuestion: String,
			faqDesc: String,
			faqSteps: Array
		}

	}
</script>