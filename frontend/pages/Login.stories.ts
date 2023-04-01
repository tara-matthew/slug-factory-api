import { StoryFn } from "@storybook/vue3";
import Login from "~/components/page/Login.vue";
export default {
    title: "Login",
    component: { Login }
};

const Template: StoryFn = args => ({
    // Components used in your story `template` are defined in the `components` object
    components: { Login },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template: "<Login> </Login>"
});

export const Primary = Template.bind({});
// Primary.args = {
//     inputs: [
//         {
//             text: "Input 1",
//         },
//         {
//             text: "Input 2"
//         },
//         {
//             text: "Input 3"
//         },
//         {
//             text: "Input 4"
//         }
//     ],
//     buttonText: "Button text",
//     headerContent: "Welcome"
// }
