<template>
  <component :is="tag">
    {{ content }}
  </component>
</template>

<script setup lang="ts">
defineProps({
    tag: String, // Make this an enum
    content: String

});

</script>
