<template>
  <button type="button"
    @click="createTaskModalOpen = true"
    @confirm-task-added="addTask($event)"
  >
       Create Task
        <portal to="modals" v-if="createTaskModalOpen">
          <create-task-modal
            :status="status"
            :show="createTaskModalOpen"
            @close="createTaskModalOpen = false"
            @confirm-task-added="addTask($event)"
          />
        </portal>
  </button>
</template>

<script>
import CreateTaskModal from "./CreateTaskModal.vue"
export default {
  props: ['status'],
  components: {
    CreateTaskModal
  },
  data() {
    return {
      createTaskModalOpen: false
    }
  },
  methods: {
        addTask(event){
            console.log(event);
        },
  },
}
</script>
