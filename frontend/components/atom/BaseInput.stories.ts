import { StoryFn } from "@storybook/vue3";
import BaseInput from "./BaseInput.vue";

export default {
    title: "BaseInput",
    component: { BaseInput }
};

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { BaseInput },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<BaseInput type='text' v-bind='args' id='email'>Text</BaseInput>"
});

export const Text = Template.bind({});
