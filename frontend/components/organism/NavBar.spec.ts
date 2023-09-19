// @vitest-environment nuxt
import { describe, it, expect } from "vitest";
import { mount, RouterLinkStub } from "@vue/test-utils";
import NavBar from "../organism/NavBar.vue";

describe("Component mounts correctly", () => {
    it("displays the correct text", () => {
        const wrapper = mount(NavBar, {
            props: {
                links: [
                    {
                        title: "Prints",
                        path: "/home"
                    },
                    {
                        title: "Random Print",
                        path: "/random-print"
                    }
                ]
            },
            global: {
                stubs: {
                    RouterLink: RouterLinkStub
                }
            }
        });
        expect(wrapper.text()).toContain("Prints");
    });

    it("links to the correct url", () => {
        const wrapper = mount(NavBar, {
            props: {
                links: [
                    {
                        title: "Prints",
                        path: "/home"
                    },
                    {
                        title: "Random Print",
                        path: "/random-print"
                    }
                ]
            },
            global: {
                stubs: {
                    RouterLink: RouterLinkStub
                }
            }
        });
        const links = wrapper.findAllComponents({ name: "NuxtLink" });
        const homeLink = links.at(1);
        const randomLink = links.at(2);
        expect(homeLink.props("to")).toBe("/home");
        expect(randomLink.props("to")).toBe("/random-print");
    });
});
