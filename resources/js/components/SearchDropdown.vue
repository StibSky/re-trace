<template>
    <multiselect
        v-model="value"
        :selected.sync="selected"
        :show-labels="true"
        :options="options"
        :placeholder="placeholder"
        tag-placeholder="tag-placeholder"
        :searchable="true"
        :allow-empty="true"
        :multiple="true"
        key="id"
        label="name"
        :close-on-select="false"
        :clear-on-select="false"
        :taggable="true"
    ></multiselect>
</template>

<script>
    import {Multiselect} from 'vue-multiselect';

    export default {
        name: "SearchDropdown",
        components: {Multiselect},
        data () {
            return {
                selected: null,
                options: []
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

