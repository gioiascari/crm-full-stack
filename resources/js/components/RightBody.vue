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
        <!-- TODAY TASKS -->

        <div class="tasks">
            <div
                class="add-tasks add-tasks d-flex items-center justify-content-between flex-row"
            >
                <h1>Today's Task</h1>
                <div class="add-action">
                    <i class="material-icons text-dark">add</i>
                </div>
            </div>
            <ul class="tasks-list">
                <li v-for="(task, i) in todayTasks" :key="i">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input
                                    type="checkbox"
                                    name="test"
                                    @change="updateTodayTask(task.taskId)"
                                    :checked="task.completed"
                                />
                                <span></span>
                            </label>
                            <h4>{{ task.title }}</h4>
                        </div>
                        <!-- Right task box -->
                        <div class="right">
                            <button style="width: fit-content">
                                <i class="material-icons">edit</i>
                            </button>

                            <button
                                style="width: fit-content"
                                @click="deleteTask(task.taskId)"
                            >
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                        <!-- /Right task box -->
                    </div>
                </li>
            </ul>
        </div>
        <!-- /TODAY TASKS -->

        <!-- UPCOMING TASKS -->
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
            <form action="" @submit="addUpcomingTask">
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
                                    @change="checkUpcoming(upcomingTask.taskId)"
                                    :checked="upcomingTask.completed"
                                />
                                <span></span>
                            </label>
                            <h4>{{ upcomingTask.title }}</h4>
                        </div>
                        <!-- Right task box -->
                        <div class="right">
                            <i class="material-icons">edit</i>
                            <button
                                @click="deleteUpcoming(upcomingTask.taskId)"
                            >
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                        <!-- /Right task box -->
                    </div>
                </li>
            </ul>
            <!--/ Left task box -->
        </div>
        <!-- /UPCOMING TASKS -->
    </div>
</template>

<script>
export default {
    name: "RightBody",
    data() {
        return {
            todayTasks: [],
            upcoming: [],
            newTask: "",
        };
    },
    mounted() {
        this.fetchUpcoming();
        this.fetchToday();
        // this.addUpcomingTask();
        // this.deleteUpcoming();
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
        addUpcomingTask(event) {
            //al refresh della pagina i dati aggiunti rimangono uguali
            event.preventDefault();

            if (this.upcoming.length > 4) {
                alert("Please complete the upcoming task");
            } else {
                const newTask = {
                    title: this.newTask,
                    waiting: true, //As Default
                    taskId: Math.random().toString(36).substring(7), //generate a random string
                };
                //Post Request
                fetch("/api/upcoming", {
                    method: "POST",
                    headers: {
                        "content-type": "application/json",
                    },
                    body: JSON.stringify(newTask), //converts a JavaScript object or value to a JSON string
                })
                    .then(() => this.upcoming.push(newTask))
                    .catch((e) => console.log(e)); //upcoming is an array

                //Clear or reset new task
                this.newTask = "";
            }
        },

        //Delete upcoming task
        deleteUpcoming(taskId) {
            if (confirm("Are you sure?")) {
                fetch(`/api/upcoming/${taskId}`, {
                    method: "delete",
                    headers: {
                        "content-type": "application/json",
                    },
                })
                    .then((r) => r.json())
                    .then(() => {
                        this.upcoming = this.upcoming.filter(
                            ({ taskId: id }) => id !== taskId
                        );
                    })
                    .catch((e) => console.log(e));
            }
        },

        //Check upcoming task
        checkUpcoming(taskId) {
            if (this.todayTasks.length > 4) {
                alert("Sorry complete existing task");
                //Refresh
                window.location.href = "/";
            } else {
                console.log("check");
                this.addDailyTask(taskId);

                // Deleted this task from DB
                fetch(`/api/upcoming/${taskId}`, { method: "delete" })
                    .then(() => {
                        this.upcoming = this.upcoming.filter(
                            ({ taskId: id }) => id !== taskId
                        );
                    })
                    .catch((e) => console.log(e));
            }
        },

        //Today
        fetchToday() {
            fetch("/api/dailytask")
                .then((res) => res.json())
                .then(({ data }) => {
                    console.log(data);
                    this.todayTasks = data;
                })
                .catch((e) => console.log(e));
        },

        //Add daily task
        addDailyTask(taskId) {
            const task = this.upcoming.filter(
                ({ taskId: id }) => id == taskId
            )[0];

            console.log(task, "task");

            fetch("/api/dailytask", {
                method: "POST",
                headers: {
                    "content-type": "application/json",
                },
                body: JSON.stringify(task),
            })
                .then(() => this.todayTasks.unshift(task))
                .catch((e) => console.log(e));
        },

        //Update today task
        updateTodayTask(taskId) {
            if (confirm("Task completed?")) {
                fetch(`/api/dailytask/${taskId}`, { method: "delete" })
                    .then(() => {
                        this.todayTasks = this.todayTasks.filter(
                            ({ taskId: id }) => id !== taskId
                        );
                    })
                    .catch((e) => console.log(e));
            }
        },

        //Delete Today Task
        deleteTask(taskId) {
            if (confirm("Are you sure?")) {
                fetch(`/api/dailytask/${taskId}`, { method: "delete" })
                    .then((r) => r.json())
                    .then(
                        () =>
                            (this.todayTasks = this.todayTasks.filter(
                                ({ taskId: id }) => id !== taskId
                            ))
                    )
                    .catch((e) => console.log(e));
            }
        },
    },
};
</script>

<style></style>
