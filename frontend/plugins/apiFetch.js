import { defineNuxtPlugin } from "#app";

export default defineNuxtPlugin(() => {
    const fetch =
        $fetch.create({
            baseURL: "http://localhost",
            credentials: "include",
            headers: {
                Accept: "application/json",
                "X-XSRF-TOKEN": useCookie("XSRF-TOKEN").value
            }

        });
    return {
        provide: {
            apiFetch: fetch
        }
    };
});
