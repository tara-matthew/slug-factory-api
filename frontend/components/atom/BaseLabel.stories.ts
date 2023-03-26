import BaseLabel from "~/components/atom/BaseLabel.vue";
import {Meta, Story} from "@storybook/vue3";

export default {
    title: "BaseLabel",
    component: { BaseLabel }
} as Meta;

const Template: Story = args => ({
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
