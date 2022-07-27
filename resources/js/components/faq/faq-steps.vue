<template>
	<div>

		

		<div class="mb-3">
			<div class="d-flex justify-content-between">
				<button type="button" class="btn btn-outline-primary" @click="$emit('return-back')">
					<i class="fa fa-arrow-left"></i>
				</button>

				
				<h5 class="card-title d-flex align-items-center">Book A Sesssion</h5>
				

			</div>
			
			<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		<br />
		<hr>
		<div class="mt-3">
          <h5 class="card-title">Steps or Procedure</h5>
          <ol>
            <li>
              <p>Click Book A Session button in the upper right corner of your homepage.</p>
            </li>
            <li>
              <p>Click Book A Session button.</p>
            </li>
            <li>
              <p>Answer the onboarding questions.</p>
            </li>
            <li>
              <p>Choose Prefered Date, Time and Available Psychologists.</p>
            </li>
            <li>
              <p>Then click submit booking button.</p>
            </li>
          </ol>
        </div>
	</div>
</template>


<script>
	export default {

		name: "FAQSteps"
	}
</script>