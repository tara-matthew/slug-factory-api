import { Meta, StoryFn } from "@storybook/vue3";
import BaseButton from "./BaseButton.vue";

export default {
    title: "Atom/BaseButton",
    component: { BaseButton }
} as Meta;

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { BaseButton },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<base-button v-bind='args'> </base-button>"
});

export const Default = Template.bind({});
Default.args = {
    text: "Sign in"
};
