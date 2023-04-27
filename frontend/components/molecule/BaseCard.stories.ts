import { Meta, StoryFn } from "@storybook/vue3";
import BaseTitle from "~/components/atom/BaseTitle.vue";
import BaseCard from "~/components/molecule/BaseCard.vue";

export default {
    title: "Molecule/BaseCard",
    component: { BaseCard }
} as Meta;

const Template: StoryFn = (args, { argTypes }) => ({
    props: Object.keys(argTypes),
    // Components used in your story `template` are defined in the `components` object
    components: { BaseCard, BaseTitle },
    // The story's `args` need to be mapped into the template through the `setup()` method
    setup () {
        // Story args can be spread into the returned object
        return { args };
    },
    // Then, the spread values can be accessed directly in the template
    template:
        `<div class="w-1/3">
            <BaseCard>
            <template v-if="${"image" in args}" #image>${args.image}</template>
            <template #title>${args.title}</template>
            <template #content>${args.content}</template>
            <template #footer>${args.footer}</template>.
        </BaseCard>
        </div>`
});

export const Default = Template.bind({});
Default.args = {
    // Note: Have disabled inspections for this file as this showed as not imported
    title: "<BaseTitle tag='h1' content='My card' />",
    content: "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. " +
        "Ut enim ad minim veniam, quis nostrud exercitation " +
        "ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>",
    footer: "<button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Go somewhere</button>"
};
export const WithImage = Template.bind({});
WithImage.args = {
    // Note: Have disabled inspections for this file as this showed as not imported
    title: "<BaseTitle tag='h1' content='My card' />",
    content: "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. " +
        "Ut enim ad minim veniam, quis nostrud exercitation " +
        "ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>",
    footer: "<button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Go somewhere</button>",
    image: "<img src='https://fastly.picsum.photos/id/404/200/300.jpg?hmac=1i6ra6DJN9kJ9AQVfSf3VD1w08FkegBgXuz9lNDk1OM' alt='' class='w-full h-48 object-cover'>"
};
