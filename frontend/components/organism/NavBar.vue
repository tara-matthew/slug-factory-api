<template>
    <nav class="p-5 flex justify-between bg-purple-500 items-center">
        <div>
            <a class="text-white font-bold" href="#" style="font-size: 18px;">Slug Factory</a>
        </div>
        <ul class="flex items-center">
            <li v-for="(link, index) in links" :key="index">
                <a href="#" class="pr-8 text-white">{{ link.title }}</a>
            </li>
            <li>
                <a href="#" class="pl-7 text-white font-bold" style="font-size: 18px;">Tara</a>
            </li>
        </ul>
    </nav>
</template>

<script setup lang="ts">
defineProps({
    links: {
        type: Object,
        required: true
    }
});
</script>
