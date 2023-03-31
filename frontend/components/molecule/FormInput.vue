<template>
  <div>
    <AtomBaseLabel class="block mb-1" :element-id="elementId" :text="text" />
    <AtomBaseInput class="px-1 py-1 w-full" :id="elementId" :v-model="elementId" />
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
  elementId: String,
  text: String
});

</script>
