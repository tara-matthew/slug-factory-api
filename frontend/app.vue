<template>
    <div>
        <NavBar :links="links" />
        <!-- Markup shared across all pages, ex: NavBar -->
        <NuxtPage />
    </div>
</template>

<script setup lang="ts">
import NavBar from "~/components/organism/NavBar.vue";
// TODO could make the link list dynamic depending on whether logged in, or separate this into logged in links and logged out links so the navbar won't need to have logic in it

const links = ref([
    {
        title: "Prints",
        path: "/home"
    },
    {
        title: "Random Print"
    },
    {
        title: "My Favourites",
        path: "/favourites"
    },
    {
        title: "My Filaments"
    }
]);
</script>
