<template>
	<div>
		 
          <div class="bs-stepper">
            <div class="bs-stepper-header">
              <div class="step active" data-target="#test-l-1">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">1</span>
                  <span class="bs-stepper-label">First step</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#test-l-2">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">2</span>
                  <span class="bs-stepper-label">Second step</span>
                </button>
              </div>
              <div class="line"></div>
              <div class="step" data-target="#test-l-3">
                <button type="button" class="btn step-trigger">
                  <span class="bs-stepper-circle">3</span>
                  <span class="bs-stepper-label">Third step</span>
                </button>
              </div>
            </div>
            <div class="bs-stepper-content">
              <div id="test-l-1" class="content">
                <p class="text-center">test 1</p>
                <button class="btn btn-primary" @click="next">Next</button>
              </div>
              <div id="test-l-2" class="content">
                <p class="text-center">test 2</p>
                <button class="btn btn-primary" @click="next">Next</button>
              </div>
              <div id="test-l-3" class="content">
                <p class="text-center">test 3</p>
                <button class="btn btn-primary" @click="next">Next</button>
                <button class="btn btn-primary" @click="previous">Previous</button>
              </div>
            </div>
          </div>
	</div>
</template>

<script>
	
	import Stepper from 'bs-stepper'

	export default {
		name: "BsStepper",
		data(){
			return {

				stepper: '',
				stepperNode: '',
			}
		},
		mounted(){

			// this.stepper = new Stepper(this.$el.querySelector('.bs-stepper'));
			// this.stepperNode = this.$el.querySelector('.bs-stepper');
			
		},
		methods: {

			next(event){
				console.warn(event)
				this.stepper.next()
			},
			previous(event){
				console.warn(event)
				this.stepper.previous()
			}
		}
	}
</script>