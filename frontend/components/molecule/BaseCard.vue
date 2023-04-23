<template>
    <div class="bg-white rounded-lg overflow-hidden shadow-md">
        <div class="px-4 py-2">
            <div class="mb-3">
                <slot name="image" />
            </div>
            <div class="text-lg font-bold mb-2">
                <slot name="title" />
            </div>
            <slot name="content" />
        </div>
        <div class="px-4 py-2 bg-gray-100">
            <slot name="footer" />
        </div>
    </div>
</template>
