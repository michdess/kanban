<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 p-4" style="background-color: rgba(0,0,0,0.25);" v-show="show">
    <div class="bg-white w-full sm:w-1/3 rounded p-4 mx-auto flex flex-col shadow-lg">
      <h1 class="text-left text-xl font-bold">
        Edit Task
      </h1>
      <input v-model="title" class="py-1 px-2 my-2 border-2 border-gray-300 rounded" placeholder="Title" />
      <textarea v-model="description" class="py-1 px-2 my-2 border-2 border-gray-300 rounded" rows="4" placeholder="Description (optional)">
      </textarea>
      <date-picker class="py-1 px-2 my-2 border-2 border-gray-300 rounded" v-model="date" placeholder="Due On"></date-picker>
      <div class="flex justify-between">
        <div class="text-center flex justify-end mt-2">
          <button @click="remove(id)" type="button" class="px-4 py-2 bg-red-500 text-white rounded">
            Delete
          </button>
        </div>
        <div class="text-center flex justify-end mt-2">
          <button @click="cancel" type="button" class="text-purple-500 mr-4">
            Cancel
          </button>
          <button @click="confirmUpdate(id)" type="button" class="px-4 py-2 bg-purple-500 text-white rounded">
            Save
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
export default {
  props: ["show", "task"],
  inject: ["taskListState"],
  data(){
    return {
      id: this.task.id,
      title: this.task.title,
      description: this.task.description,
      date:  moment(this.task.due).format('MMM DD, YYYY'),
    }
  },
  methods: {
    cancel() {
      this.$emit("close");
      document.body.style.removeProperty("overflow");
    },
    remove(id){
      let self = this;
      axios.delete('/task/'+id)
      .then(function (response) {
          self.$emit("remove");
          self.$emit("close");
          document.body.style.removeProperty("overflow");
      })
      .catch(function (error) {
         console.log("The task could not be removed "+error);
      });
    },
    confirmUpdate(id) {
      this.$emit("close"); 
      let self = this;
      axios.patch('/task/'+this.id, {
          title : this.title,
          description: this.description,
          due: moment(this.date).format('YYYY-MM-DD'),
      })
      .then(function (response) {
          self.$emit("confirm-task-added", 'payload'); 
          document.body.style.removeProperty("overflow");
          let index = self.taskListState.tasks.map(function(e) { return e.id; }).indexOf(id);
          self.taskListState.tasks[index].due = response.data.due;
          self.taskListState.tasks[index].title = response.data.title;
          self.taskListState.tasks[index].description = response.data.description;
      })
      .catch(function (error) {
         console.log("The task could not be updated "+error);
      });
    },
  },
  watch: {
    show: {
      immediate: true,
      handler: show => {
        if (show) {
          document.body.style.setProperty("overflow", "hidden");
        } else {
          document.body.style.removeProperty("overflow");
        }
      }
    }
  },
  created() {
    const escapeHandler = e => {
      if (e.key === "Escape" && this.show) {
        this.cancel();
      }
    }
    document.addEventListener("keydown", escapeHandler);
    this.$once("hook:destroyed", () => {
      document.removeEventListener("keydown", escapeHandler);
    })
  }
}
</script>
