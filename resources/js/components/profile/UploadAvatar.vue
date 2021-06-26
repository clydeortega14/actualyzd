<template>
  <button @click.stop class="btn btn-primary ac-upload" style="position: relative;">
    <input type="file" accept="image/*" @change="uploadAvatar">
    <i class="fa fa-upload"></i>
    <span>Upload Avatar</span>
  </button>
</template>

<script>
export default {
  name: "UploadAvatar",
  props: {
    userId: {
      required: true,
      type: Number
    },
    token: {
      required: true,
      type: String
    }
  },
  data: () => ({}),
  methods: {
    async uploadAvatar (event) {
      const data = new FormData()

      if (!event.target.files[0]) return

      data.append('photo', event.target.files[0])
      data.append('user', this.userId)
      data.append('api_token', this.token)

      let res = await axios.post("/api/photo", data)

      console.log(res)

      if (res.status === 200) location.reload()
    }
  }
}
</script>
