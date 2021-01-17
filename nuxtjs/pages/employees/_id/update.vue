<template>
  <div>
    <h1>Update employee</h1>
    <hr>

    <div class="row">
      <div class="col-md-6">
        <form
          method="post"
          @submit.prevent="submitForm()"
        >
          <div class="form-group">
            <label for="">Name</label>
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
            <label for="">Job</label>
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
            <label for="">sallary</label>
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
          <nuxt-link :to="'/employees/' + $route.params.id" class="btn btn-secondary mr-3">
            Cancel
          </nuxt-link>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  async asyncData (context) {
    const { data } = await context.$axios.get('/employees/' + context.route.params.id)
    return {
      employee: data.data
    }
  },

  data () {
    return {
      errors: null,
      name: null,
      job: null,
      sallary: null
    }
  },

  mounted () {
    this.fillFormData()
  },

  methods: {
    fillFormData () {
      this.name = this.employee.name
      this.job = this.employee.job_title
      this.sallary = this.employee.pay_rate
    },

    submitForm () {
      this.$axios.put('/employees/' + this.$route.params.id, {
        id: this.$route.params.id,
        name: this.name,
        job_title: this.job,
        pay_rate: this.sallary
      })
        .then((response) => {
          if (response.data.success) {
            this.$router.push({ name: 'employees-id', params: { updated: 'yes', id: this.$route.params.id } })
          }
        })
        .catch((error) => {
          console.log(error)
          if (error.response.data.errors) {
            this.errors = error.response.data.errors
          }
        })
    }
  }
}
</script>
