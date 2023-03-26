<template>
  <div class="w-1/2 m-auto">
    <AtomBaseTitle tag="h1" :content="headerContent" class="text-center"/>
    <OrganismForm :inputs="inputs" :button-text="buttonText" />
  </div>
</template>

<script setup lang="ts">
defineProps({
  headerContent: String,
  inputs: Array, // use the interface
  buttonText: String
})

</script>
