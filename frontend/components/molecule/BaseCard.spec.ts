// @vitest-environment nuxt
import { describe, it, expect } from "vitest";
import { mount, RouterLinkStub } from "@vue/test-utils";
import { defineComponent } from "vue";
import BaseCard from "../molecule/BaseCard.vue";
import BaseTitle from "~/components/atom/BaseTitle.vue";

export default defineComponent({
    components: { BaseTitle }
});

describe("Component mounts correctly", () => {
    it("displays the correct text", () => {
        const wrapper = mount(BaseCard, {
            slots: {
                // default: [BaseCard, '<base-title />', 'text']
                title: "<h1>Test</h1>",
                content: "<p>Hello world</p>"
            }
            // global: {
            //     stubs: ['base-title']
            // }
        });

        expect(wrapper.text()).toContain("Hello world");
    });
});
