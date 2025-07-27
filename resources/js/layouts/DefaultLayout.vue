<script setup lang="ts">
import DefaultHeader from '@/layouts/parts/DefaultHeader.vue';
import DefaultFooter from '@/layouts/parts/DefaultFooter.vue';
</script>

<template>
    <DefaultHeader />
        <slot />
    <DefaultFooter />
</template>

<style scoped>

</style>
