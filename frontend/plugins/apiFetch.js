import { defineNuxtPlugin } from "#app";

export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.provide(
        "apiFetch",
        $fetch.create({
            baseURL: "http://localhost",
            credentials: "include",
            headers: {
                Accept: "application/json",
                "X-XSRF-TOKEN": useCookie("XSRF-TOKEN").value
            }

        })
    );
});
