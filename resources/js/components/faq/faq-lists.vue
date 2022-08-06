<template>
	<div>
		<div id="faq-lists">
          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr @click="selectQuestion(faq.id)" v-for="(faq, index) in faqs" :key="index">
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
	
  import Swal from 'sweetalert2';

	export default {

		name: "FAQLists",
    props: {
      faqs: Array
    },
    methods: {

      
      selectQuestion(faq_id){

        let find_faq = this.faqs.find(faq => faq.id == faq_id);

        if(find_faq != undefined){

          EventBus.$emit('selecting-question', find_faq);

        }else{

          Swal.fire('Oops', 'Question not found', 'error');
        }


      }
    }
	}

</script>