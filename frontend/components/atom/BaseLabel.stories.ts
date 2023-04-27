import { Meta, StoryFn } from "@storybook/vue3";
import BaseLabel from "~/components/atom/BaseLabel.vue";

export default {
    title: "Atom/BaseLabel",
    component: { BaseLabel }
} as Meta;

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { BaseLabel },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<BaseLabel v-bind='args'> </BaseLabel>"
});
export const Default = Template.bind({});
Default.args = {
    text: "Password"
};
