export function useAuth () {
    function setUser (user) {
        localStorage.setItem("user", JSON.stringify(user));
    }

    function getUser () {
        return JSON.parse(localStorage.getItem("user") || "");
    }

    function removeUser () {
        localStorage.removeItem("user");
    }

    const isLoggedIn = computed(() => {
        if (process.client) {
            return !!localStorage.getItem("user");
        }
    });

    return { setUser, getUser, removeUser, isLoggedIn };
}
