<template>
	<div>
		<div id="faq-lists">
          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr @click="selectQuestion">
                  <td width="10">
                    <i class="fa fa-list"></i>
                  </td>
                  <td>
                    Change or Reset Password
                  </td>
                </tr>

                <tr @click="selectQuestion">
                  <td width="10">
                    <i class="fa fa-list"></i>
                  </td>
                  <td>
                    Book A Session
                  </td>
                </tr>
                <tr @click="selectQuestion">
                  <td width="10">
                    <i class="fa fa-list"></i>
                  </td>
                  <td>
                    Update Profile
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
	</div>
</template>

<script>
	
	export default {

		name: "FAQLists",
		methods: {

			selectQuestion(){

				this.$emit('selecting-question');
			}
		}
	}

</script>