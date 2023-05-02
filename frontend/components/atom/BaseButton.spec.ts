// @vitest-environment nuxt
import { describe, it, expect } from "vitest";
import { mount } from "@vue/test-utils";
import BaseButton from "../atom/BaseButton.vue";

describe("Base Button text", () => {
    it("displays the correct text", () => {
        const wrapper = mount(BaseButton, {
            props: {
                text: "My button",
                componentType: "link"
            }
        });

        expect(wrapper.text()).toContain("My button");
    });
});

// TODO may be able to streamline this into one test rather than having two repetitive tests
describe("Component type", () => {
    it("is a link when link is passed in as a prop", () => {
        const wrapper = mount(BaseButton, {
            props: {
                text: "hello",
                componentType: "link"
            }
        });

        expect(wrapper.find("a").exists()).toBe(true); // TODO can we check for an actual NuxtLink (not essential)
    });
    it("is a button when button is passed in as a prop", () => {
        const wrapper = mount(BaseButton, {
            props: {
                text: "hello",
                componentType: "button"
            }
        });

        expect(wrapper.find("button").exists()).toBe(true);
    });
});
