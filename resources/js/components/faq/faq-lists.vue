<template>
	<div>
		<div id="faq-lists">
          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr @click="selectQuestion" v-for="(faq, index) in getAllFaqs" :key="index">
                  <td width="10">
                    <i class="fa fa-list"></i>
                  </td>
                  <td>
                    {{ faq.title }}
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
	</div>
</template>

<script>
	

  import { mapGetters, mapActions } from 'vuex';

	export default {

		name: "FAQLists",
    created(){

      this.allFaqs();
      console.log(this.getAllFaqs)
    },
    computed: {
      ...mapGetters(["getAllFaqs"])
    },
    methods: {
      ...mapActions(["allFaqs"]),
      selectQuestion(){

        this.$emit('selecting-question');
      }
    }
	}

</script>