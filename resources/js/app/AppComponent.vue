<template>
    <div class="gcontainer">
        <body-component />
    </div>
</template>

<script>
import BodyComponent from "../components/BodyComponent.vue";
export default {
    name: "AppComponent",
    components: {
        BodyComponent,
    },
};
</script>
<style scoped></style>
