import { StoryFn } from "@storybook/vue3";
import BaseForm from "~/components/organism/BaseForm.vue";

export default {
    title: "BaseForm",
    component: { BaseForm }
};

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { BaseForm },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<BaseForm v-bind='args'> </BaseForm>"
});

export const Primary = Template.bind({});
Primary.args = {
    inputs: [
        {
            text: "Input 1"
        },
        {
            text: "Input 2"
        }
    ],
    buttonText: "Sign up"
};
