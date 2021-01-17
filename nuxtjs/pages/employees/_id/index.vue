<template>
  <div>
    <h1>Employee Details</h1>

    <hr>

    <div
      v-if="$route.params.updated=='yes'"
      class="alert alert-success"
    >
      Record updated successfully
    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">
            Name
          </th>
          <th scope="col">
            Job
          </th>
          <th scope="col">
            Sallary
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ employee.name }}</td>
          <td>{{ employee.job_title }}</td>
          <td>{{ employee.pay_rate }}</td>
        </tr>
      </tbody>
    </table>
    <hr>
    <div class="d-flex justify-content-between">
      <div>
        <nuxt-link :to="'/employees/' + employee.id + '/update'" class="btn btn-primary mr-3">
          Update
        </nuxt-link>
        <button class="btn btn-danger" @click="deleteRecord()">
          Delete
        </button>
      </div>
      <nuxt-link to="/employees" class="btn btn-secondary mr-3">
        Back to employees
      </nuxt-link>
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

  methods: {
    deleteRecord () {
      if (confirm('Are you sure?') === true) {
        this.$axios.delete('/employees/' + this.$route.params.id)
          .then((response) => {
            if (response.data.success) {
              this.$router.push({ name: 'employees', params: { deleted: 'yes' } })
            }
          })
          .catch((error) => {
            console.log(error)
          })
      }
    }
  }
}
</script>
