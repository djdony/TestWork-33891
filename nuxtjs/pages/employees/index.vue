<template>
  <div>
    <div class="d-flex justify-content-between align-items-center">
      <h1>Employees</h1>
      <nuxt-link to="/employees/add" class="btn btn-success">
        Add New
      </nuxt-link>
    </div>
    <hr>

    <div
      v-if="$route.params.created=='yes'"
      class="alert alert-success"
    >
      Record added successfully
    </div>
    <div
      v-if="$route.params.deleted=='yes'"
      class="alert alert-success"
    >
      Record deleted successfully
    </div>

    <div
      v-if="employees.data"
      class="list-group"
    >
      <table class="table">
        <thead>
          <tr>
            <th>
              Name
            </th>
            <th>
              Job
            </th>
            <th>
              Sallary
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="employee in employees.data"
            :key="employee.id"
          >
            <td>
              <nuxt-link
                class="list-group-item"
                :to="'/employees/' + employee.id"
              >
                {{ employee.name }}
              </nuxt-link>
            </td>

            <td>{{ employee.job_title }}</td>
            <td>{{ employee.pay_rate }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div
      v-else
      class="alert alert-info"
    >
      No records found.
    </div>
  </div>
</template>

<script>
export default {
  async asyncData (context) {
    const { data } = await context.$axios.get('/employees')
    return {
      employees: data
    }
  }
}
</script>
