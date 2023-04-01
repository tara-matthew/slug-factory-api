import { defineNuxtPlugin } from "#app";

export default defineNuxtPlugin((nuxtApp) => {
    const config = useRuntimeConfig();
    console.log(useCookie("XSRF-TOKEN").value);
    const cookie = useCookie("XSRF-TOKEN").value;
    // console.log(Cookies.get('XSRF-TOKEN'))
    console.log("api fetch loaded", useCookie("XSRF-TOKEN").value);

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
