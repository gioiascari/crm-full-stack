<template>
    <div id="right">
        <h1 class="text-3xl font-bold">Development CRM</h1>

        <div class="horizontal flex">
            <button class="leftH"></button>
            <button class="rightH ml-2 active"></button>
        </div>

        <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dicta et
            obcaecati natus vitae porro enim culpa laboriosam sapiente doloribus
            molestias magni id reiciendis nobis, corrupti est suscipit iste?
            Dolore, veniam.
        </p>
        <div class="tasks">
            <div class="add-tasks">
                <h1>Today's Task</h1>
                <div class="add-action">
                    <i class="material-icons text-dark">add</i>
                </div>
            </div>
            <ul class="tasks-list">
                <li>Add Task</li>
            </ul>
        </div>
        <div class="upcoming">
            <div
                class="add-tasks d-flex items-center justify-content-between flex-row"
            >
                <h2>Upcoming</h2>
                <div class="add-action cursor-pointer">
                    <i class="material-icons">add</i>
                </div>
            </div>
            <!-- Form -->
            <form action="">
                <input type="text" v-model="newTask" />
            </form>
            <!-- /Form -->

            <!-- Left task box -->
            <ul class="tasks-list">
                <li v-for="upcomingTask in upcoming" :key="upcomingTask.i">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input
                                    type="checkbox"
                                    name="test"
                                    :checked="upcomingTask.completed"
                                    @change="checkUpcoming(upcomingTask.taskId)"
                                />
                                <span></span>
                            </label>
                            <h4>{{ upcomingTask.title }}</h4>
                        </div>
                    </div>
                </li>
            </ul>
            <!--/ Left task box -->

            <!-- Right task box -->
            <div class="right">
                <i class="material-icons">edit</i>
                <i
                    class="material-icons"
                    @click="deleteUpcoming(upcomingTask.taskId)"
                    >delete</i
                >
            </div>
            <!-- /Right task box -->
        </div>
    </div>
</template>

<script>
export default {
    name: "RightBody",
    data() {
        return {
            todayTask: [],
            upcoming: [],
            newTask: "",
        };
    },
    mounted() {
        this.fetchUpcoming();
        this.fetchToday();
    },
    methods: {
        //Upcoming
        fetchUpcoming() {
            //The fetch() method in JavaScript is used to request to the server and load the information on the webpages. The request can be of any APIs that return the data of the format JSON
            fetch("/api/upcoming")
                .then((res) => res.json())
                .then(({ data }) => {
                    console.log(data);
                    this.upcoming = data;
                })
                .catch((e) => console.log(e));
        },
        //Add Upcoming task
        addUpcomingTask(e) {
            e.preventDefault();
            console.log(this.newTask);
        },

        //Today
        fetchToday() {},
    },
};
</script>

<style></style>
