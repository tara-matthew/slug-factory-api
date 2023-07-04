<template>
    <div>
        <NavBar :links="links" />
        <!-- Markup shared across all pages, ex: NavBar -->
        <NuxtPage />
    </div>
</template>

<script setup lang="ts">
import NavBar from "~/components/organism/NavBar.vue";

const links = ref([
    {
        title: "Prints"
    },
    {
        title: "Random Print"
    },
    {
        title: "My Favourites"
    },
    {
        title: "My Filaments"
    }
]);
</script>
