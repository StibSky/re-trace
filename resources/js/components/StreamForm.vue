<template>
    <div class="card-body text-center">
        <h4>Which materials are in your stream?</h4>
        <form action="{{ route('add-streams3', $id) }}" method="post" class="mt-5">
            @csrf
            <input placeholder="search here" type="text" name="filter" id="filterCategories"/>
            <multiselect
                v-model="streams.tags"
                :options="allTags"
                :taggable="true"
                :multiple="true"></multiselect>
            <button type="submit" id="main-button-wide" class="btn btn-primary" name="newStream">Next</button>
        </form>
    </div>
</template>

<script>
    import _ from 'lodash';
    import Multiselect from 'vue-multiselect';

    Vue.component('multiselect', Multiselect);

    export default {
        name: "StreamForm"
    }
</script>

<style scoped>

</style>
