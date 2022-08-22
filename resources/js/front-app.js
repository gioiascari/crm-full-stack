/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
console.log("Ok Js:)");
require("./bootstrap");

window.axios = require("axios");
window.Vue = require("vue");

import Vue from "vue";
import AppComponent from "./app/AppComponent.vue";
import "../assets/tailwind.css";

import "material-design-icons-iconfont/dist/material-design-icons.css";

Vue.component("app-component", require("./app/AppComponent.vue").default);
Vue.component(
    "body-component",
    require("./components/BodyComponent.vue").default
);
const app = new Vue({
    el: "#app",
    render: (h) => h(AppComponent),
});
