<template>
  <div>
    <h1>Add New employee</h1>
    <hr>

    <div class="row">
      <div class="col-md-6">
        <form
          action=""
          method="post"
          @submit.prevent="submitForm()"
        >
          <div class="form-group">
            <label>Name</label>
            <input
              v-model="name"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors && errors.name }"
            >
            <div v-if="errors && errors.name" class="invalid-feedback">
              {{ errors.name.msg }}
            </div>
          </div>

          <div class="form-group">
            <label>Job</label>
            <input
              v-model="job"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors && errors.job }"
            >
            <div v-if="errors && errors.job" class="invalid-feedback">
              {{ errors.job.msg }}
            </div>
          </div>

          <div class="form-group">
            <label>sallary</label>
            <input
              v-model="sallary"
              type="text"
              class="form-control"
              :class="{ 'is-invalid': errors && errors.sallary }"
            >
            <div v-if="errors && errors.sallary" class="invalid-feedback">
              {{ errors.sallary.msg }}
            </div>
          </div>

          <input type="submit" value="Submit" class="btn btn-primary mr-3">
          <nuxt-link to="/employees" class="btn btn-secondary mr-3">
            Cancel
          </nuxt-link>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data () {
    return {
      errors: null,
      name: null,
      job: null,
      sallary: null
    }
  },

  methods: {
    submitForm () {
      this.$axios.post('/employees', {
        name: this.name,
        job_title: this.job,
        pay_rate: this.sallary,
        active: 1
      })
        .then((response) => {

          if (response.data.meta.success) {
            this.$router.push({ name: 'employees', params: { created: 'yes' } })
          }
        })
        .catch((error) => {
          if (error.response.data.errors) {
            this.errors = error.response.data.errors
          }
        })
    }
  }
}
</script>
