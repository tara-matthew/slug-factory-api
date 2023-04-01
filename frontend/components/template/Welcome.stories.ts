import { StoryFn } from "@storybook/vue3";
import Welcome from "~/components/template/Welcome.vue";
export default {
    title: "Welcome",
    component: { Welcome }
};

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { Welcome },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<Welcome v-bind='args'> </Welcome>"
});

export const Primary = Template.bind({});
Primary.args = {
    inputs: [
        {
            text: "Input 1"
        },
        {
            text: "Input 2"
        },
        {
            text: "Input 3"
        },
        {
            text: "Input 4"
        }
    ],
    buttonText: "Button text",
    headerContent: "Welcome"
};
