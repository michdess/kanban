<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 p-4" style="background-color: rgba(0,0,0,0.25);" v-show="show">
    <div class="bg-white w-full sm:w-1/3 rounded p-4 mx-auto flex flex-col shadow-lg">
      <h1 class="text-left text-xl font-bold">
        Create New Task
      </h1>
      <input v-model="title" class="py-1 px-2 my-2 border-2 border-gray-300 rounded" placeholder="Title" />
      <textarea v-model="description" class="py-1 px-2 my-2 border-2 border-gray-300 rounded" rows="4" placeholder="Description (optional)">
      </textarea>
      <date-picker class="py-1 px-2 my-2 border-2 border-gray-300 rounded" v-model="date" format="D MMM YYYY" placeholder="Due On"></date-picker>
      <div class="text-center flex justify-end mt-2">
        <button @click="cancel" type="button" class="text-purple-500 mr-4">
          Cancel
        </button>
        <button @click="confirmCreate" type="button" class="px-4 py-2 bg-purple-500 text-white rounded">
          Create
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
export default {
  inject: ["taskListState"],
  props: ["show", "status"],
  data(){
    return {
      title: '',
      description: '',
      date: '',
    }
  },
  methods: {
    cancel() {
      this.$emit("close");
      document.body.style.removeProperty("overflow");
    },
    confirmCreate(e) {
      this.$emit("close"); 
      e.preventDefault();
      let self = this;
      axios.post('/task', {
          title : this.title,
          description: this.description,
          due: moment(this.date).format('YYYY-MM-DD'),
          status: this.status,
      })
      .then(function (response) {
          self.taskListState.tasks.push(response.data);
          document.body.style.removeProperty("overflow");
      })
      .catch(function (error) {
         console.log(error);
      });
    },
  },
  watch: {
    show: {
      immediate: true,
      handler: show => {
        if (show) {
          document.body.style.setProperty("overflow", "hidden")
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
