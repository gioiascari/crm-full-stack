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
        <div class="task">
            <div class="add-task">
                <h1>Today's Task</h1>
                <div class="add-action">
                    <i class="material-icons text-dark">add</i>
                </div>
            </div>
            <ul class="tasks-list">
                <li>Add Task</li>
            </ul>
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
        //Today
        fetchToday() {},
    },
};
</script>

<style></style>
