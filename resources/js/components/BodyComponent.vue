<template>
    <div id="body">
        <LeftComponent />
        <RightBody />
    </div>
</template>

<script>
import LeftComponent from "./LeftComponent.vue";
import RightBody from "./RightBody.vue";

export default {
    name: "BodyComponent",
    components: {
        LeftComponent,
        RightBody,
    },
};
</script>

<style></style>
