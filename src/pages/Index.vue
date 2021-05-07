<template>
  <q-page>
    <q-list >
    </q-list>
  </q-page>
</template>

<script>
export default {
  data () {
    return {
      newTask: ''
    }
  },
  methods: {
  }
}
</script>

<style lang="scss">
  .done {
    .q-item__label {
      text-decoration: line-through;
      color: #bbb;
    }
  }

  .no-tasks {
    opacity: 0.5;
  }

</style>
