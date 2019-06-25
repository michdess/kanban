<template>
    <div>
        <div v-for="(task, index) in filteredTasks" 
             v-bind:key="task.id" 
             v-bind:class="[(task.completed) ? 'bg-gray-300' : 'bg-white', 'rounded mb-2']"
             >
            <div @click="update(index)" class="px-4 pt-4 border-l-2 border-t-2 border-r-2 border-gray-300 rounded rounded-b-none cursor-pointer">
                <div class="py-1">{{task.title}}</div>
                <div class="text-gray-700 text-sm">{{task.description}}</div>
                <div v-if="!task.completed" class="flex italic text-purple-500 items-center py-2">
                    <svg class="fill-current h-4 w-4 mr-2" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="inherit" stroke-width="1" fill="inherit" fill-rule="evenodd">
                                    <g id="icon-shape">
                                        <path d="M1,3.99508929 C1,2.8932319 1.8926228,2 2.99508929,2 L17.0049107,2 C18.1067681,2 19,2.8926228 19,3.99508929 L19,18.0049107 C19,19.1067681 18.1073772,20 17.0049107,20 L2.99508929,20 C1.8932319,20 1,19.1073772 1,18.0049107 L1,3.99508929 Z M3,6 L17,6 L17,18 L3,18 L3,6 Z M5,0 L7,0 L7,2 L5,2 L5,0 Z M13,0 L15,0 L15,2 L13,2 L13,0 Z M5,9 L7,9 L7,11 L5,11 L5,9 Z M5,13 L7,13 L7,15 L5,15 L5,13 Z M9,9 L11,9 L11,11 L9,11 L9,9 Z M9,13 L11,13 L11,15 L9,15 L9,13 Z M13,9 L15,9 L15,11 L13,11 L13,9 Z M13,13 L15,13 L15,15 L13,15 L13,13 Z" id="Combined-Shape"></path>
                                    </g>
                                </g>
                    </svg>
                Due {{ task.due | moment("MMM DD, YYYY") }}</div>
                <div v-else class="flex italic text-green-500 items-center py-2">
                    <svg class="fill-current h-4 w-4 mr-2" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="inherit" stroke-width="1" fill="inherit" fill-rule="evenodd">
                            <g id="icon-shape">
                                <polygon id="Path-126" points="0 11 2 9 7 14 18 3 20 5 7 18"></polygon>   
                            </g>
                        </g>
                    </svg>
                Completed {{ task.completed | moment("MMM DD, YYYY") }}</div>
            </div>
            <div v-if="task.completed" class="flex w-full rounded-b">    
                <div @click="updateStatus(task.id, 'started')"  class="flex flex-grow justify-center cursor-pointer text-white text-sm px-4 py-2 bg-blue-400 rounded-b">Undo</div>
            </div>
            <div v-else-if="task.status == 'started'" class="flex w-full rounded-b">    
                <div @click="updateStatus(task.id, 'backlog')" class="flex flex-grow justify-center cursor-pointer text-white text-sm px-4 py-2 bg-blue-500 rounded-bl">Backlog</div>
                <div @click="updateStatus(task.id, 'completed')" class="flex flex-grow justify-center cursor-pointer text-white text-sm px-4 py-2 bg-green-400 rounded-br">Complete</div>
            </div>
            <div v-else class="flex w-full rounded-b">    
                <div @click="updateStatus(task.id, 'started')" class="flex flex-grow justify-center cursor-pointer text-white text-sm px-4 py-2 bg-purple-500 rounded-b">Start</div>
            </div>            
            <portal to="modals" v-if="editTaskModalOpen">
              <edit-task-modal
                :show="editTaskModalOpen"
                @close="editTaskModalOpen = false"
                @remove="remove(editing.id)"
                :task="editing"
              />
            </portal>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import EditTaskModal from "./EditTaskModal.vue"
    export default {
        inject: ["taskListState"],
        props: ['status'],
        components: {
            EditTaskModal
        },
        data() {
            return{
                editTaskModalOpen: false,
                editing: '',
            }
        },
        computed:{
            filteredTasks(){
                return this.taskListState.tasks.filter(item => item.status == this.status);
            }
        },
        methods: {
            updateStatus(id, status) {
                let self = this;
                axios.patch('task/'+id,{
                    status: status,
                })
                .then(function (response) {
                    let index = self.taskListState.tasks.map(function(e) { return e.id; }).indexOf(id);
                    self.taskListState.tasks[index].status = status;
                    self.taskListState.tasks[index].completed = response.data.completed;
                })
                .catch(function (error) {
                   console.log("The task status could not be updated "+error);
                });
            },
            remove(id){
                let index = this.taskListState.tasks.map(function(e) { return e.id; }).indexOf(id);
                this.taskListState.tasks.splice(index, 1);
            },
            update(index){
                this.editing = this.filteredTasks[index],
                this.editing.index = index,
                this.editTaskModalOpen = true;
            }
        }
    }
</script>
