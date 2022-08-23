<template>
    <div id="left">
        <div>
            <i class="material-icons cursor-pointer">menu</i>
        </div>
        <div class="profile">
            <h1>Hi Gioia</h1>
            <h2>Let's make project amazing</h2>
        </div>
        <div class="search w-full">
            <input type="text" placeholder="Search you project" class="ml-3" />

            <i class="material-icons text-white"> search </i>
        </div>
        <div class="project">
            <h3>Projects <span>(20)</span></h3>
            <div class="projects">
                <div
                    class="a-project cursor-pointer flex flex-col items-center justify-center"
                >
                    <div class="box-color w-full">
                        <span>PT</span>
                    </div>
                    <h5>Development</h5>
                </div>
                <div
                    class="a-project cursor-pointer flex flex-col items-center justify-center"
                >
                    <div class="box-color w-full">
                        <span>PT</span>
                    </div>
                    <h5>Design</h5>
                </div>
                <div
                    class="a-project cursor-pointer flex flex-col items-center justify-center"
                >
                    <div class="box-color w-full">
                        <span>PT</span>
                    </div>
                    <h5>Testing</h5>
                </div>
                <div
                    class="a-project cursor-pointer flex flex-col items-center justify-center"
                >
                    <div class="box-color w-full">
                        <span>PT</span>
                    </div>
                    <h5>Medium Draft</h5>
                </div>
                <div
                    class="a-project cursor-pointer flex flex-col items-center justify-center"
                >
                    <div class="box-color w-full">
                        <span>PT</span>
                    </div>
                    <h5>Landing Page</h5>
                </div>
                <div
                    class="a-project cursor-pointer flex flex-col items-center justify-center"
                >
                    <div class="box-color w-full">
                        <i class="material-icons"> add </i>
                    </div>
                    <h5>Add Project</h5>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LeftComponent",
};
</script>

<style></style>
