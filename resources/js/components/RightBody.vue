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
                                    @change="checkUpcoming(taskId)"
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
            event.preventDefault();
            // console.log(this.newTask);
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
                }).then(() => this.upcoming.push(newTask)); //upcoming is an array

                //Clear or reset new task
                this.newTask = "";
            }
        },

        //Delete upcoming task

        deleteUpcoming(taskId) {
            if (confirm("Are you sure?")) {
                fetch(`/api/upcoming/${taskId}`, {
                    method: "POST",
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
            if (this.todayTask.length > 4) {
                alert("Sorry complete existing task");
                window.location.href = "/";
            } else {
                this.addDailyTak(taskId);

                //Deelete this task from DB
                //Devo per forza inserire method post poichè sulla chiamata api è così, se fosse stato Route::delete sarebbe andato bene
                fetch(`/api/upcoming/${taskId}`, { method: "post" }).then(
                    () => {
                        this.upcoming = this.upcoming.filter(
                            ({ taskId: id }) => id != taskId
                        );
                    }
                );
            }
            console.log("check");
        },

        //Today
        fetchToday() {},

        //Add daily task
        addDailyTak(taskId) {
            //Get Task
            const task = this.upcoming.filter(
                ({ taskId: id }) => id == taskId
            )[0];

            //Post Request
            fetch("/api/dailitask", {
                method: "POST",
                headers: {
                    "content-type": "application/json",
                },
                body: JSON.stringify(task),
            })
                .then(() => this.todayTask.unshift(task))
                .catch((e) => console.log(e));
        },
    },
};
</script>

<style></style>
