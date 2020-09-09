<template>
    <Dropdown
        :options="[{ id: 1, name: 'Option 1'}, { id: 2, name: 'Option 2'}]"
        v-on:selected="validateSelection"
        v-on:filter="getDropdownValues"
        :disabled="false"
        name="zipcode"
        :maxItem="10"
        placeholder="Please select an option">
    </Dropdown>
</template>

<script>
    export default {
        name: "SearchDropdown"
    }
</script>

<style scoped>

</style>
